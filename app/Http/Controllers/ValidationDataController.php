<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validation;

class ValidationDataController extends Controller
{
    function getAllData(){
        return Validation::all();
    }

    function multiUserSave(Request $request){
        $collection = collect($request);
        for ($i=0; $i < $collection->count(); $i++) {
            $userValidationData = new Validation();
            $userValidationData->name = $collection[$i]['name'];
            $userValidationData->code = $collection[$i]['code'];
            $userValidationData->aadhar = $collection[$i]['aadhar'];
            $userValidationData->pan = $collection[$i]['pan'];
            $userValidationData->save();
        }
        return response()->json([
            'success' => true,
            'data' =>  "Success Fully Data inserted"
        ]);
    }

    function deleteValidationData($id){
        $userValidationData =Validation::find($id);
        $data = $userValidationData->delete();
        if($data){
            return "Data Deleted Successfully";
        }else{
            return "Data Not Deleted Successfully";
        }
    }

    function updateValidationData(Request $request){
        $userValidationData =  Validation::find($request->id);
        $userValidationData->name = $request->name;
        $userValidationData->code = $request->code;
        $userValidationData->aadhar = $request->aadhar;
        $userValidationData->pan = $request->pan;
        $result = $userValidationData->save();
        if($result){
         return["result" => "data has been updated"];
        }else{
         return ["return"=>"faild"];
        }
     }
}
