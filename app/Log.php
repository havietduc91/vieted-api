<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const STATUS_START = 'start';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

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
                ->orderBy('created_at', 'desc')
                ->first();
                    
        return DB::table('log')
                ->where('id', $log->id)
                ->update(
                    [
                        'status' => $status,
                        'end_time' => date('Y-m-d H:i:s', time()),
                    ]
                );
    }
}
