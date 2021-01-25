<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

    protected function getPhoto($kodePegawai, $foto)
    {
        $wid = 472;
        $hig = 709;

        $dir = public_path(). DIRECTORY_SEPARATOR. "images" . DIRECTORY_SEPARATOR . "pegawai";
        file_put_contents($dir.DIRECTORY_SEPARATOR.($filename = $kodePegawai.".jpg"), $foto);
        // Storage::disk('pegawai').put($kodePegawai.".jpg", $foto);

        $canvas = Image::canvas($wid, $hig);

        $image = Image::make($dir.DIRECTORY_SEPARATOR.$kodePegawai.".jpg")->resize($wid, $hig, function($constraint){
            $constraint->aspectRatio();
        });

        $canvas->insert($image, "center");

        $canvas->save($dir. \DIRECTORY_SEPARATOR. $kodePegawai. ".jpg");

        $fullPath = url("/") . $dir . DIRECTORY_SEPARATOR. $filename;
        
        return $dir;
    }
}
