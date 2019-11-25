<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use View;
use Response;

class MostrarArchivosController extends Controller
{
    //
    public function index(){
        $filesList = Storage::files('public');
        $listFilestmp = [];
        foreach ($filesList as $filetmp) {
            $tmp = Storage::url($filetmp);
            $url = public_path($tmp);
            $urtmp = str_replace('\\', '/', $url);
            $urltmp = str_replace('//', '/', $urtmp);
            $urlfinal = str_replace('/', '\\', $urtmp);
            $urltmp2 = str_replace('\\\\', '\\', $urlfinal);
            $newFileName = $filetmp;
            $array_name = explode('/',$newFileName);

            $size = Storage::size($filetmp);
            
            array_push($listFilestmp, [$tmp, $size, $urltmp2, $array_name[1]]);
        }
        return View::make('mostrarArchivos.mostrarArchivos')->with('filesList', $listFilestmp);
    }

    public function download($fileName)
    {   
        $filetmp = $fileName;
        $headers = ['Content-Type: application/pdf'];
        $newName = "demo.pdf";
        return Response::download($filetmp, "demo.pdf", $headers);
    }
}
