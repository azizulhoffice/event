<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

trait StoreImageTrait {

    public function verifyAndStoreImage(Request $request, $fieldname = 'image',$slug = 'slug', $directory = 'unknown')
    {
            $file = $request->file($fieldname);
            $slug =  Str::slug($slug);
            if(isset($file))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $request->file($fieldname)->storePubliclyAs($directory, $imageName,'public');
            }

            return $imageName;
    }
    public function verifyAndStoreImage2($file, $fieldname = 'image',$slug = 'slug', $directory = 'unknown')
    {
            $slug =  Str::slug($slug);

            if(isset($file))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->storePubliclyAs($directory, $imageName,'public');
            }

            return $imageName;
    }

}
