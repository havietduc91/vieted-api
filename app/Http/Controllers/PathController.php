<?php

namespace App\Http\Controllers;

use App\Path;
use Illuminate\Http\Request;

class PathController extends Controller
{
    public function insertPathFromElearning(Request $request)
    {
        $input = $request->all();
        try {
            $res = Path::where('code', '=', $input['code'])->first();
            if ($res) {
                $input['elearning_status'] = 'U';
                $path = Path::where('code', '=', $input['code'])
                    ->update($input);
            } else {
                $pathModel = new Path();
                $input['elearning_status'] = 'I';
                $path = $pathModel->insertPath($input);
            }
        } catch (\Exception $ex) {
            return;
        }

        return intval($path);
    }
}