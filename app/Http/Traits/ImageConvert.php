<?php

namespace App\Http\Traits;
use Intervention\Image\Facades\Image;
use File;

trait ImageConvert
{
    // CONVERT FILE BLOB TO IMAGE 
    protected function getPhoto($kodePegawai, $foto)
    {
        $width = config('photo.image.small.width');
        $height = config('photo.image.small.height');
        $filename = $kodePegawai. ".jpg";
        $destination = config('photo.profil.directory');

        $publicDir = public_path().DIRECTORY_SEPARATOR. $destination;
        file_put_contents($publicDir.DIRECTORY_SEPARATOR.$filename, $foto);

        $canvas = Image::canvas($width, $height);

        $image = Image::make($publicDir.DIRECTORY_SEPARATOR.$kodePegawai.".jpg")->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        });

        $canvas->insert($image, "center");

        $canvas->save($publicDir. DIRECTORY_SEPARATOR. $kodePegawai. ".jpg");

        $fullPath =  $destination . DIRECTORY_SEPARATOR. $filename;
        
        return $fullPath;
    }

    // CONVERT FILE BLOB TO IMAGE 
    protected function getPhotos($kodePegawai, $foto)
    {
        $width = config('photo.image.small.width');
        $height = config('photo.image.small.height');
        $filename = $kodePegawai. ".jpg";
        $destination = config('photo.profil.directory');

        // $publicDir = public_path().DIRECTORY_SEPARATOR. $destination;
        $storageDir = storage_path("app/public".DIRECTORY_SEPARATOR. $destination);
        if (!is_dir($storageDir)) {
            File::makeDirectory($storageDir, 0777, true, true);
        }
        file_put_contents($storageDir.DIRECTORY_SEPARATOR.$filename, $foto);

        if (mime_content_type($storageDir.DIRECTORY_SEPARATOR.$kodePegawai.".jpg") == "image/jpeg") {
            $canvas = Image::canvas($width, $height);

            $image = Image::make($storageDir .DIRECTORY_SEPARATOR. $kodePegawai.".jpg")->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
            });

            $canvas->insert($image, "center");

            $canvas->save($storageDir .DIRECTORY_SEPARATOR. $kodePegawai. ".jpg");

            $fullPath =  $destination . DIRECTORY_SEPARATOR. $filename;
            
            return $fullPath;
        } else {
            $fullPath =  $destination . DIRECTORY_SEPARATOR. $filename;
            
            return $fullPath;
        }
           
    }
}