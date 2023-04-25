<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audio;
use Illuminate\Database\Eloquent\Model;

class AudioController extends Controller
{
    function index(){

        return Audio::all();
    }

    function uploadAudios(Request $res){
        $audio = Audio::create([
            'audio_name' => $res->audioName,
            'audio_discription'=> $res->audioDiscription,
            'audio_thumbnail'=>$res->audioThumbnail,
            'url'=> $res->audioUrl,
            'audio_status'=> $res->audioStatus,
            'access'=> $res->access,
        ]);
        return response()->json([
            'success' => true,
            'data' =>  $audio
        ]);
    }

    function uploadAudio(Request $res){
        $collection = collect($res);
   $data = [];
        for ($i=0; $i < $collection->count(); $i++) {
            $audio = new Audio();
            $audio->audio_name = $collection[$i]['audioName'];
            $audio->audio_discription = $collection[$i]['audioDiscription'];
            $audio->audio_thumbnail = $collection[$i]['audioThumbnail'];
            $audio->url = $collection[$i]['url'];
            $audio->audio_status = $collection[$i]['audioStatus'];
            $audio->access = $collection[$i]['access'];
            $audio->save();
        }
        return response()->json([
            'success' => true,
            'data' =>  "Success Fully Data inserted"
        ]);
    }

    function deleteAudio($id){
        $audio =Audio::find($id);
        $data = $audio->delete();
        if($data){
            return "Data Deleted Successfully";
        }else{
            return "Data Not Deleted Successfully";
        }
    }

    function updateAudio(Request $request){
        $audio = Audio::find($request->id);
        $audio->audio_name = $request->audioName;
        $audio->audio_discription = $request->audioDiscription;
        $audio->audio_thumbnail = $request->audioThumbnail;
        $audio->url = $request->url;
        $audio->audio_status = $request->audioStatus;
        $audio->access = $request->access;
        $result =  $audio->save();
        if($result){
            return["result" => "data has been updated"];
        }else{
            return ["return"=>"faild"];
        }
    }

}

