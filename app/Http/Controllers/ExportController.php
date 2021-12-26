<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    // export data.sql file
    public function download(){

     Artisan::call('backup:run'); // cmd for extractin database.sql file

     $path = storage_path('app/Laravel-Admin/*'); // save in storage/app/Laravel-Admin
     $latest_ctime = 0;
     $latest_filename = '';
     $files = glob($path);
     foreach($files as $file)
     {
         if (is_file($file) && filectime($file) > $latest_ctime)
         {
                 $latest_ctime = filectime($file);
                 $latest_filename = $file;
         }
     }
     return response()->download($latest_filename);
    }
}
