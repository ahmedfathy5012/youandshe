<?php

namespace Src\Base\Core\Helpers;

trait ImageHelper
{
     public function uploadImage($image) : ?string
     {

         $imageName = time().'.'.$image->extension();
         // Public Folder
         $image->move(public_path('images'), $imageName);
         // //Store in Storage Folder
         // $request->image->storeAs('images', $imageName);
         // // Store in S3
         // $request->image->storeAs('images', $imageName, 's3');
         //Store IMage in DB

         return $imageName;


         return back()->with('success', 'Image uploaded Successfully!')
             ->with('image', $imageName);
     }
}
