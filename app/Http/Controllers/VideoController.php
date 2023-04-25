<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    function index(){
       $data = Video::all();
        return response()->json([
            'success' => true,
            'data' =>  $data
        ]);
    }

    function uploadVideo(Request $res){
        $video = Video::create([
            'video_name' => $res->videoName,
            'video_discription'=> $res->videoDiscription,
            'url'=> $res->url,
            'video_thumbnail'=> $res->videoThumbnail,
            // 'category'=>$this->getId($res->category),
            'video_status'=> $res->videoStatus,
            'access'=> $res->access,
        ]);
        return response()->json([
            'success' => true,
            'data' =>  $video
        ]);
    }

    function deleteVideo($id){
        $video =Video::find($id);
        $data = $video->delete();
        if($data){
            return "Data Deleted Successfully";
        }else{
            return "Data Not Deleted Successfully";
        }
    }

    function updateVideo(Request $request){
        $video = Video::find($request->id);
        $video->video_name = $request->videoName;
        $video->video_discription = $request->videoDiscription;
        $video->video_thumbnail = $request->videoThumbnail;
        $video->url = $request->url;
        $video->video_status = $request->videoStatus;
        $video->access = $request->access;
        $result =  $video->save();
        if($result){
            return["result" => "data has been updated"];
        }else{
            return ["return"=>"faild"];
        }
    }


    // URLS Controller

    public function getUrlById($id){
        $results = DB::select('select * from urls where url_parent_id = ?', [$id]);
        // dd($results);
        return $results;
    }
}
