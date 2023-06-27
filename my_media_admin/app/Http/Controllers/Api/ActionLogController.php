<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    public function setActionLog(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
        ActionLog::create($data);

        $current_post_data = ActionLog::where('post_id', $request->post_id)->get();
        return response()->json([
            "current_post" => $current_post_data
        ]);

    }
}
