<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChartRequest;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function index()
    {
        $data['activeChart'] = 'active';
        $data['chartData'] = Chart::get();

        return view('chart.index', $data);
    }

    public function store(ChartRequest $request){
        $chart = $request->validated();
        try {
            DB::beginTransaction();

            $id = $request->get('id', 0);
            $chart = Chart::find($id);
            if (is_null($chart)) {
                $chart = new Chart();
            }

            $chart->time = $request->time;
            $chart->open = $request->open;
            $chart->high = $request->high;
            $chart->low = $request->low;
            $chart->close = $request->close;
            $chart->save();
            DB::commit();
            return response()->json(['success' => 'Data added successfully']);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => 'something went rong !..']);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $chart = Chart::where('id', $id)->first();
            $chart->delete();
            DB::commit();
            return redirect()->route('chart.index')->with('SUCCESS_MESSAGE', 'Data deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
        }
    }


    // api data get
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
