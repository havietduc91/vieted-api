<?php

namespace App\Http\Controllers;

use App\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function insertProgressFromElearning(Request $request)
    {
        $input = $request->all();
        $input['course_code'] = !empty($input['course_code']) ? $input['course_code'] : "";
        $input['path_code'] = !empty($input['path_code']) ? $input['path_code'] : "";

        try {
            $query = Progress::where('ns_id', '=', intval($input['ns_id']))
                    ->where('item_type', '=', intval($input['item_type']));
            if (!empty($input['path_code'])) {
                $query = $query->where('path_code', '=', $input['path_code']);
            }

            if (!empty($input['course_code'])) {
                $query = $query->where('course_code', $input['course_code']);
            }
            $res = $query->first();

            if ($res) {
                $input['elearning_status'] = 'U';
                $progress = $query->update($input);
            } else {
                $progressModel = new Progress();
                $input['elearning_status'] = 'I';
                $progress = $progressModel->insertProgress($input);
            }
        } catch (\Exception $ex) {
            return;
        }

        return $progress;
    }
}