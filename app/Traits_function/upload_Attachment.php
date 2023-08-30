<?php

namespace App\Traits_function;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\For_;
use PhpParser\Node\Stmt\Foreach_;

trait upload_Attachment{
    public function upload_Attachment_photo($request,$image,$imageable_type,$imageable_id,$disk,$folder){

if($request->hasFile($image)){

Foreach($request->file($image) as $index=>$image_data){
    
    if(!$image_data->isValid()){
        flash("invalid Image")->error()->important();
        return redirect()->back()->withInput();}
        $photo=\Str::slug($request->input('name')??auth()->user()->name).$index.'.'.$image_data->getClientOriginalExtension();
Image::create([
    'photo'=>$photo,
    'imageable_type'=>$imageable_type,
    'imageable_id'=>$imageable_id,
]);
$image_data->storeAs($folder,$photo,$disk);
}
return  1;

}

return 0;
    }
}
