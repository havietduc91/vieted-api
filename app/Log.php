<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Mail\LogRecord;
use Illuminate\Support\Facades\Mail;

class Log extends Model
{
    const STATUS_START = 'start';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';
    public static $receiveMails = [
        'havietduc91@gmail.com',
        'duchv@vieted.net'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'table_name', 'action', 'start_time', 'end_time', 
        'status', 'log_text', 'created_at'
    ];

    public function insertByTableName($tableName, $action = '', $logText = '')
    {
        $nextId = DB::table('log')->max('id') + 1;

        $log = new Log();
        
        $log->id = $nextId;
        $log->table_name = $tableName;
        $log->action = $action;
        $log->start_time = date('Y-m-d H:i:s', time());
        $log->end_time = null;
        $log->status = self::STATUS_START;
        $log->log_text = $logText;
        $log->created_at = date('Y-m-d H:i:s', time());

        return $log->save();
    }

    public function updateStatus($table, $action, $status)
    {
        $log = DB::table('log')
                ->where('table_name', '=', $table)
                ->where('action', '=', $action)
                ->orderBy('created_at', 'desc')
                ->first();
                    
        Log::where('id', $log->id)
            ->update(
                [
                    'status' => $status,
                    'end_time' => date('Y-m-d H:i:s', time()),
                ]
            );

        $log->status = $status;
        $log->end_time = date('Y-m-d H:i:s', time());

        foreach (self::$receiveMails as $receiveMail) {
            Mail::to($receiveMail)->send(new LogRecord($log));
        }

        return $log;
    }

    public function getLastTimeSaveLog($table, $action, $statuses)
    {
        $log = DB::table('log')
            ->where('table_name', '=', $table)
            ->where('action', '=', $action)
            ->whereIn('status', $statuses)
            ->orderBy('created_at', 'desc')
            ->first();

        return $log->created_at;
    }
}
