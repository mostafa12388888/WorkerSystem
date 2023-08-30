<?php
namespace App\desiger\Repostory;

use App\desiger\interface\workerprofileInterFace;
use App\Models\Post;
use App\Models\Worker;
use App\Traits_function\upload_Attachment;

class workerprofileRepostory implements workerprofileInterFace{
    use upload_Attachment;
    public function index(){}
    public function show(){
return response()->json(['data'=>(Worker::findOrfail(auth()->guard('worker')->id()))->makeHidden('verificatio_token','status','verified_at')],200);
    }
    public function update($request){
        $data=$request->all();

        if(request()->has("photo")){
        $this->upload_Attachment_photo(request(),"photo","App\Models\Worker",$request->id,"Worker","Worker");
        unset($data["photo"]);

    }

Worker::findOrFail($data["id"])->update($data);
return response()->json(["message"=>"succed"],200);
    }
    public function UserProfile(){
        $worker=Worker::with('posts.reviews')->findOrfail(auth()->guard('worker')->user()->id)->makeHidden('verificatio_token','status','verified_at');
        $post_id=$worker->posts()->pluck('id');
        $review= WorkerReview::WhereIn('post_id',$post_id)->get(['id','comment','rate']);
        $reviews_avrage=round($review->sum('rate')/$review->count());
        return response()->json([
            "data"=>array_merge($worker->toArray(),['reviews_avrage'=>$reviews_avrage]),
            "reviews_data"=> $review
         ],200);
    }
    public function destroy(){

Post::where('worker_id',auth()->guard('worker')->user()->id)->delete();
        return response()->json(["message"=>"deleted Succesfuly"],200);
    }
}
