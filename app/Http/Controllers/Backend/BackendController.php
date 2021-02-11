<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BackendController extends Controller
{
    protected $limit = 10;

    function __construct()
    {
        // $this->middleware('auth:web')s
    }
    
    protected function bcrum($current, $urlSecond = null, $nameSecond = null)
    {
        return [
            'url-first' => route('home'),
            'name-first' => 'Home',
            'url-second' => $urlSecond,
            'name-second' => $nameSecond,
            'current' => $current
        ];
    }

    protected function notification($level, $title, $message)
    {
        return  Session::flash('flash_notification', [
            'title'   => $title,
            'level'   => $level,
            'message' => $message
        ]);
    }

    // CONVERT FILE BLOB TO IMAGE 
    protected function getPhoto($kodePegawai, $foto)
    {
        $width = config('photo.image.small.width');
        $height = config('photo.image.small.height');
        $filename = $kodePegawai. ".jpg";
        $destination = config('photo.image.directory');

        $publicDir = public_path().DIRECTORY_SEPARATOR. $destination;
        file_put_contents($publicDir.DIRECTORY_SEPARATOR.$filename, $foto);

        $image = ['images' => $publicDir.DIRECTORY_SEPARATOR.$kodePegawai.".jpg"];

        $rules = [
            'images' => 'mimes:jpeg,jpg,png,gif'
        ];

        $validator = Validator::make($image, $rules);

        $canvas = Image::canvas($width, $height);
        if (!$validator->fails()) {

            $image = Image::make($publicDir.DIRECTORY_SEPARATOR.$kodePegawai.".jpg")->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
            });
    
        }
        $canvas->insert($image, "center");
    
        $canvas->save($publicDir. DIRECTORY_SEPARATOR. $kodePegawai. ".jpg");

        $fullPath =  $destination . DIRECTORY_SEPARATOR. $filename;
        
        return $fullPath;
    }
}
