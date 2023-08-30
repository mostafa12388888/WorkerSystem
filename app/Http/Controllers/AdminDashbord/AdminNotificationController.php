<?php

namespace App\Http\Controllers\AdminDashbord;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
 public function index(){
    return response()->json([
        "all_notification"=>admin::find(auth()->user()->id)->notifications
    ]);
 }
 public function unread(){
    return response()->json([
        "unreadNotification"=>admin::find(auth()->user()->id)->unreadNotifications
    ]);
 }
public function Read_All_Notifiaction(){
    foreach (admin::find(auth()->user()->id)->unreadNotifications as $notification) {
        $notification->markAsRead();
    }
    return response()->json([
        "unreadNotification"=>"read succesfully"
    ]);
 }
public function Read_One_Notifiaction(Request $request){
    // dd();
    $notifaction= DB::table("notifications")->where('id',$request->id);
    // $admin=admin::find(auth()->user()->id)->notifications;
    if(admin::find(auth()->user()->id)->id!= $notifaction->first()->notifiable_id)
    return response()->json(["Notification"=>"ther is Not Notification"]);
//    dd( $notifaction);
$notifaction->update([
        "read_at"=>now(),
    ]);
    return response()->json([
        "unreadNotification"=>"read succesfully"
    ]);
 }
public function DeleteAll_Notifiaction(){
    admin::find(auth()->user()->id)->notifications()->delete();
    return response()->json([
        "unreadNotification"=>"delete All Notifcations"]);
 }
public function DeleteOne_Notifiaction(Request $request){
    $notifaction= DB::table("notifications")->where('id',$request->id);
    if(admin::find(auth()->user()->id)->id!= $notifaction->first()->notifiable_id)
    return response()->json(["Notification"=>"ther is Not Notification"]);

    $notifaction->delete();
    return response()->json([
        "unreadNotification"=>"deleted Succefully"
    ]);
 }
}
