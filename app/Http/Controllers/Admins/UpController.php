<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpController extends Controller
{
    //上传oss文件阿里云服务
    public function upload(Request $request){
        $path=$request->file('file')->store('public/img');
        return ['path'=>Storage::url($path)];

    }


    //上传oss文件阿里云服务
    public function uploads(Request $request){
        $path=$request->file('file')->store('public/menus');
        return ['path'=>Storage::url($path)];

    }
}
