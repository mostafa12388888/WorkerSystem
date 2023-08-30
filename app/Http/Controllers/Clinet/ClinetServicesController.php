<?php

namespace App\Http\Controllers\Clinet;

use App\desiger\interface\clinetServicesinterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\clientOrderRequest;
use Illuminate\Http\Request;

class ClinetServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $client;
    public function __construct(clinetServicesinterface $client)
    {
        // $this->middleware("auth:clinet");
        $this->client=$client;
    }
    public function addorderRequest(clientOrderRequest $request){

return $this->client->addorderRequest($request);
    }
    public function index()
    {
        return $this->client->index();
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
    public function update(Request $request, string $id)
    {
        return $this->client->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
