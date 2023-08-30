<?php
namespace App\desiger\interface;

interface WorkerReviewIterface{
    public function store($request);
    public function index();
    public function show($id);
}
