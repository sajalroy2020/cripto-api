<?php

namespace App\Http\Controllers\Api;

use App\Models\Chart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // chart data get
    public function chartDataGet(){
        $chartData = Chart::get();

        if (count($chartData) > 0) {
            $response = [
                'message' => count($chartData), 'data found',
                'status'  => 1,
                'data'    => $chartData,
            ];
        }else{
            $response = [
                'message' => count($chartData), 'data found',
                'status'  => 0,
            ];
        }
        return response()->json($response, 200);
    }


}
