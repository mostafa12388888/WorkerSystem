<?php

namespace App\Http\Controllers;

use App\desiger\interface\workerprofileInterFace;
use App\Http\Requests\WorkerProfileUpdate;
use App\Models\Worker;
use App\Models\WorkerReview;
use Illuminate\Http\Request;

class WorkerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $worker;
    public function __construct(workerprofileInterFace $worker)
    {
        $this->worker=$worker;
    }
    public function UserProfile(){
       return $this->worker->UserProfile();
    }
    public function index()
    {

        return $this->worker->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->worker->show();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
    public function update(WorkerProfileUpdate $request)
    {
        return $this->worker->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        return $this->worker->destroy();
    }
}
