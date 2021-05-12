<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class StorageModelController extends Controller
{
    public function index()
    {
        dd('hi');
    }
    
    public function onUpload(Request $request)
    {

        // $request->file('file')->path();
        // $request->file('file')->isValid();
        // $request->file('file')->extension();

        // $request->whenHas('file', function ($input) {
        //     dd($input);
        // });

        // return back()->withInput();


        // 1/ upload file by selecting a disk from filesystem.php 
        // Storage::disk('public')->put($folder, $request->file);


        // 2/ upload with default driver 
        // return Storage::put($folder, $request->file);

        // 3 / with putFIle()
        // return Storage::putFile('photos', $request->file);

        // 4/ with putFileAs() 
        // Storage::putFileAs('photos', $request->file,'photo.jpg');
        // Storage::disk('public')->putFileAs('photos', $request->file,'photo.jpg');

        // if driver is s3 you can set visiblity mode 
        // $mode = 'public';
        // Storage::putFile('photos2', $request->file,$mode);


        // copy or move file with 2 params first is copy(oldpath , targetpath) or move(oldpath , targetpath)
        // Storage::copy('photos2/abULTH9QxTK0UEWjmREU6MNguIrw9cQEzrdYhRZs.jpg', 'public/photos2/new.jpg');
        // Storage::move('photos2/abULTH9QxTK0UEWjmREU6MNguIrw9cQEzrdYhRZs.jpg', 'public/photos2/new.jpg');



        // ============================== File Store without facades ============================

        $folderName = "newfolders2";
        $disk = "public";
        $mode = "public";

        // 1/ make sure you can't use disk() if you need to change disk set inside in filesystem.php
        // $request->file->store($folderName);
        // $request->file->store($folderName,$disk);

        // $request->file->storeAs($folderName,'demo.png');
        // $request->file->storeAs($folderName,'test.jpg',$disk);

        // $request->file->storePublicly($folderName,$disk);
        // $request->file->storePubliclyAs($folderName,'neww.jpg',$disk);


        // ===============file mode ====================================
        // 1/ get file mode 
        // $visibility = Storage::getVisibility($filePath);
        // $visibility = Storage::disk('public')->getVisibility($filePath);

        // 2/ set file mode 
        // Storage::disk('public')->setVisibility('new.jpg',$mode);

        // ====================== get all files & directories ==========================
        // Storage::files();
        // Storage::disk($disk)->files();
        // $files = Storage::allFiles($folder);
        // $files = Storage::files($folder);


        // Storage::directories();
        // Storage::directories($folder);
        // Storage::allDirectories($folder);


        // ==================== Delete file =================================
        // Storage::delete($filePath);
        // Storage::delete(['newfolders/demo.png', 'newfolders/ElcXeo0Mo8WNQivempLZhudDFmH5S8Ion6PZeumE.jpg']);
        // Storage::disk($disk)->delete($filePath);

        // ======================= create & delete directory =====================
        // Storage::makeDirectory('avatarores');
        // Storage::deleteDirectory('avatarores');

        // ================ download ============================
        // Storage::download($filePath);
        // Storage::download($filePath,'new.jpg');
        




        if($request->hasFile('file')){
            $folder   = 'avatars';
            // $fileName = 'CuGlE7cK9T009M5MOzYehaosrfoS5WR3hShpzq1S.jpg';
            // $filePath = $folder.'/'.$fileName;

            // $getFile             = Storage::get($filePath);
            // $checkFileExists     = Storage::disk('local')->exists($filePath);
            // $checkFileIsMissing  = Storage::disk('local')->missing($filePath);

            // $url = Storage::url($fileName); // default url is return from local disk  or you can set own file url 

            // $url = Storage::disk('local')->url($fileName);
            // $url = Storage::disk('public')->url($fileName);
            // $size= Storage::size($filePath);

            // convert file lastmodified time to datetime 
            // $time           = Storage::lastModified($filePath);
            // $lastmodified   = DateTime::createFromFormat("U", $time);
            // $dateTime       = $lastmodified->setTimezone(new DateTimeZone('Asia/Dhaka'));


            // old file path 
            // $oldPath = Storage::path($fileName); // default from local disk 

            // $oldPath = Storage::disk('public')->path($fileName);  // select a specific disk


            // dd($oldPath);

            // return Storage::deleteDirectory('avatarores');

            // return Storage::disk($disk)->delete(['avatars22/neww.jpg', 'avatars22/ZBmTmn1dLq9CEn8k5IIAKb7eSOOFIkT0PE1IEzJi.jpg']);

            // return $visibility = Storage::disk('public')->getVisibility("avatars22/ZBmTmn1dLq9CEn8k5IIAKb7eSOOFIkT0PE1IEzJi.jpg");
            // return $request->file->storeAs($folderName,'test.jpg',$disk);

            // dd(App::environment());
            
            return $request->file->store($folder,$disk);
        }
        dd('wrong!');
    }
}
