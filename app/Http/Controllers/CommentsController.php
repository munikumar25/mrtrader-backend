<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    function commentsStore(Request $req){
        if($req->repliedToCommentId == null){
            $comments = Comment::create([
                'user_id' => $req->userId,
                'message'=> $req->text,
                'comment_id'=>$req->comId,
                'comment_parent_id'=>0,
                'admin_approved'=>0,
                'video_id'=>$req->video_id
            ]);
        }else{
            $comments = Comment::create([
                'user_id' => $req->userId,
                'message'=> $req->text,
                'comment_id'=>$req->comId,
                'comment_parent_id'=>$req->repliedToCommentId,
                'admin_approved'=>0
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' =>  $comments
        ]);

    }

    function getAllCommentsBasedOnVideoId(){
        $results = DB::select('select * from comments where video_id = ?', ['2']);
        $collection = collect($results);
        for($i=0;$i<$collection->count();$i++){
            $res = DB::select('select * from comments where comment_id = ?', [$collection[$i]->comment_id]);
            // dd($res);
            return $res;
        }
    }
}
