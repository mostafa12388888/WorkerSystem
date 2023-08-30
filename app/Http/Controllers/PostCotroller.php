<?php

namespace App\Http\Controllers;

use App\filter\postfilter;
use App\Http\Requests\PostRequest;
use App\Models\admin;
use App\Models\Post;
use App\Notifications\WorkerNotification;
use App\Traits_function\upload_Attachment;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Notification;
use Spatie\QueryBuilder\QueryBuilder;


class PostCotroller extends Controller
{
    use upload_Attachment;
    public function __construct()
    {
        $this->middleware('auth:worker');
    }
    public Function index(){
        $post=Post::all();
        return response()->json([
"message"=> $post
        ],200);
    }
    public Function approved(){

        $post=Post::with("Worker:id,name")->where('status','approved')->get()->makeHidden("status");
        return response()->json([
"message"=> $post
        ],200);
    }
    public Function approvedFiltering(){
        $posts = QueryBuilder::for(Post::class)
        ->allowedFilters((new postfilter())->filter())->with('worker:id,name')
        ->where('status','approved',)
        ->get(['id','price','worker_id','content']);

        return response()->json([
"message"=> $posts
        ],200);
    }
    public function store(PostRequest $request){
    //  dd($request->file("photo"));
        try{
            DB::beginTransaction();
            $data=array_merge($request->except('photo'),['worker_id'=>Auth::guard('worker')->user()->id]);
            $data["price"]-=$data["price"]*.05;
$post=Post::create($data);
if($request->photo)
$this->upload_Attachment_photo($request,"photo","App\Models\Post",$post->id,"Worker","Posts");
Notification::send(admin::get(), new WorkerNotification(Auth::guard("worker")->user()->namee,$post));
DB::commit();
return response()->json([
    'message'=>"post success",
    "posts"=>$post
]);}catch(\Exception $e){
    DB::rollBack();
    return $e->getMessage();
}
    }
}
