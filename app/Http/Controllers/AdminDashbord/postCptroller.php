<?php

namespace App\Http\Controllers\AdminDashbord;

use App\Http\Controllers\Controller;
use App\Http\Requests\postStatusRequest;
use App\Models\Post;
use App\Notifications\WorkerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class postCptroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(postStatusRequest $request)
    {
        // dd($request);
        $post= Post::find($request->post_id);$post->update([
        'status'=>$request->status,
        'rejected_reasone'=>$request->rejected_reasone??null,
       ]);
       Notification::send($post->Worker,new WorkerNotification($post->Worker,$post));
       return response()->json([
        "message"=>"post status has been change",
       ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
