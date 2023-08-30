<?php
namespace App\desiger\Repostory;

use App\desiger\interface\clinetServicesinterface;
use App\Models\ClientOrder;
// use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;

class clinetServicesRepostory implements clinetServicesinterface{
    public function addorderRequest($request){
        $clientId=auth()->guard('clinet')->user()->id;
if(ClientOrder::where("client_id",$clientId)->where('post_id',$request->post_id)->exists())
return response()->json([
    "message"=>"this order is elrady exist",
]);
$data=$request->all();
$data["client_id"]= $clientId;
ClientOrder::create($data);
return response()->json(["message"=>"succes"]);

    }
    public function index(){

        return response()->json(["message"=>ClientOrder::with("post","client")->whereStatus("pending")->whereHas('post',function($query){
           return  $query->where('worker_id',auth()->guard('worker')->user()->id);
        })->get()]);
    }
    public function update($request,$id){
        ClientOrder::findOrFail($id)->SetAttribute('status',$request->status)->save();
        return response()->json(["message"=>"updated Successfully"]);
    }
}
