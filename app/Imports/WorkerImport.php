<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\Worker;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;


class WorkerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $value)
    {

        $post= new Post([
                   'worker_id'     => $value[1],
                   'content'     =>  $value[2],
                   'price'    =>  $value[3],
                ]);
return $post;
}
}
