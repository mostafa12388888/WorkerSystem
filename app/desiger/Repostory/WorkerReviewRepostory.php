<?php
namespace App\desiger\Repostory;

use App\desiger\interface\WorkerReviewIterface;
use App\Models\WorkerReview;

class WorkerReviewRepostory implements WorkerReviewIterface{
    public function store($request){
        $data=$request->all();
        $data['client_id']=auth()->guard('clinet')->user()->id;
WorkerReview::create($data);
return response()->json([
"message"=>"suucessfully",
],200);
    }
    public function index(){
        return response()->json([
            "message"=>WorkerReview::all(),
        ],200);
    }
    public function show($id){
        $worker=WorkerReview::wherePostId($id);
        $avrage= $worker->sum('rate')/ $worker->count();
        return response()->json([
            "Total"=>round( $avrage),
            "date"=>$worker->get(),
        ]);
    }
}
