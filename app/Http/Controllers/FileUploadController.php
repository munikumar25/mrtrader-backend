<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class FileUploadController extends Controller
{
    function store(Request $req){

        if($req->has('file')){
            $image = $req->file;
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('upload');
            $image->move($path,$name);
            $user = Document::create([
                'document_name' => $req->documentName,
                'file_path'=> $path .'/'.$name,
                'file_type'=> $image->getClientOriginalExtension(),
            ]);
    
            return response()->json([
                'success' => true,
                'data' =>  $user
            ]);
            // return response()->json(['data'=>'','message'=>'Image upload successfully.'],200);
        }
    }
}
