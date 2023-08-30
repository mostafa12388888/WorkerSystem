<?php

namespace App\Http\Controllers;

use App\desiger\interface\WorkerReviewIterface;
use App\Http\Requests\worker\WorkerReview as WorkerWorkerReview;
use App\Models\WorkerReview;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class WorkerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $worker;
    public Function __construct(WorkerReviewIterface $worker)
    {
        $this->worker=$worker;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkerWorkerReview $request)
    {

    return  $this->worker->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return  $this->worker->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkerReview $workerReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkerReview $workerReview)
    {
        //
    }
}
