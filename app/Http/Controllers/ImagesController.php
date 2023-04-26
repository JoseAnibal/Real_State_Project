<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{

    public function storeImages(Request $request){
        
        try{

            // MULTIPLE IMAGES PICKER AND VALIDATION
            $propertyNextId=DB::select("SELECT AUTO_INCREMENT
            FROM information_schema.TABLES
            WHERE TABLE_SCHEMA = 'real_state'
            AND TABLE_NAME = 'properties'")[0]->AUTO_INCREMENT;

            dd($propertyNextId);

            $allowed=['png','jpg','jpeg','webp'];
            $message='Propiedad creada! 😀';

            if($request->file('image')){

                foreach($request->file('image') as $file){

                    $image_name=$propertyNextId.'_'.md5(rand(1000,2000));
                    $extension=strtolower($file->getClientOriginalExtension());

                    if(in_array($extension,$allowed)){
                        $image_full_name = $image_name.'.'.$extension;
                        $path='Images/Properties/';
                        $image_url=$path.$image_full_name;
                        $file->move($path,$image_full_name);
                        $image[]=$image_url;
                    }

                }

                if(count($request->file('image'))>count($image)){
                    $message.=' (Se ha descartado los archivos que no eran imágenes)';
                }

                foreach($image as $key=>$value){
                    Image::create([
                        'property_id'=>$propertyNextId,
                        'image_url'=>$value
                    ]);
                }
                return redirect()->route('properties.index')->with('success',$message);
            }else{
                $message.=' (Sin imágenes)';
                return redirect()->route('properties.index')->with('warning',$message);
            }

        }catch(\Exception $e){

        }
    }

}
