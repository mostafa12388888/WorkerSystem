<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['price','worker_id','content','status','rejected_reasone'];

public function Worker(){
    return $this->belongsTo(Worker::class,"worker_id");
}
public function reviews(){
    return $this->hasMany(WorkerReview::class,'post_id');
}
}
