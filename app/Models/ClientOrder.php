<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOrder extends Model
{
    use HasFactory;
    protected $fillable=['client_id','post_id'];
    public function post(){
return $this->belongsTo(Post::class,'post_id',"id")->select('id','content');
    }
    public function client(){
return $this->belongsTo(Client::class,'client_id','id')->select('id','name');
    }
}
