<?php

namespace App\Http\Controllers;

use App\Exports\WorkerExport;
use App\Imports\WorkerImport;
use App\Models\Worker;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WorkerEXportAndImport extends Controller
{
    public function Export_posts(){
        return Excel::download(new WorkerExport , Worker::findOrFail(auth()->guard('worker')->user()->id)->name.".xlsx");
    }
    public function Import_posts(){
        Excel::import(new WorkerImport,request()->file("ExceilFile"),null,\Maatwebsite\Excel\Excel::XLSX);

        return response()->json(["Message"=>"succes ImPort"]);
    }

}
