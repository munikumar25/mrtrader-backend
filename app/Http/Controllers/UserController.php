<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    function dashboardCount(){
        $listPerson = [];
        $totalUsers = DB::select('SELECT count(role) as `tuser` FROM `users` WHERE role=2');
        array_push($listPerson,$totalUsers);
        $verifiedPendingUsers = DB::select('SELECT count(role) as `vpending` FROM `users` WHERE role=2 and verification_status=0');
        array_push($listPerson,$verifiedPendingUsers);
        $activeUsers = DB::select('SELECT count(role) as `auser` FROM `users` WHERE role=2 and verification_status=1 and user_status=1;');
        array_push($listPerson,$activeUsers);
        // dd($listPerson);
        return $listPerson;
    }

    function getActiveUsers(){
        $activeUser = DB::select('SELECT * FROM `users` WHERE role=2 and verification_status=1 and user_status=1;');
        return response()->json([
            'success' => true,
            'data' =>  $activeUser
        ]);
    }

    function getPendingUsers(){
       $pendingUser =  DB::select('SELECT * FROM `users` WHERE role=2 and verification_status=0');
        return response()->json([
            'success' => true,
            'data' =>  $pendingUser
        ]);
    }


    function getData(){
         $user = User::all();
         $listPerson = [];
         for($i=0;$i<count($user);$i++){
             $userData = new User();
             $userData->id = $i+1;
             $userData->user_id = $user[$i]->id;
             $userData->first_name = $user[$i]->first_name;
             $userData->last_name = $user[$i]->last_name;
             $userData->email = $user[$i]->email;
             $userData->mobile_no = $user[$i]->mobile_no;
             $userData->gender = $user[$i]->gender;
             $userData->trade_account = $user[$i]->trade_account;
             $userData->unique_code = $user[$i]->unique_code;
             $userData->role = $user[$i]->role;
             if($user[$i]->role == 1){
                $userData->role = "Admin";
             }else{
                $userData->role = "User";
             }
             if($user[$i]->verification_status == 1){
                $userData->verification_status = "Verified";
             }else{
                $userData->verification_status = "Not Verified";
             }
             if($user[$i]->user_status == 1){
                $userData->user_status = "Active";
             }else{
                $userData->user_status = "In Active";
             }
             
             array_push($listPerson,$userData);
         }
        return $listPerson;
    }

    function saveUser(Request $res){
        $value = $res->firstName;
        $results = DB::select('select * from validations where unique_id = ?', ['AQU1234AS']);
        if($results != null){
            //if($results[0]->email == $res->email && $results[0]->mobile_no ==  $res->mobileNo){
            if(false){
               $userStatus = 1; 
               $verificationStatus = 1;
               $user = $this->userValidated($res, $userStatus,$verificationStatus);
            }else{
                $user =  $this->userNotValidated($res);
            }

        }else{
            $user = $this->userNotValidated($res);
        }
        return response()->json([
            'success' => true,
            'data' =>  $user
        ]);
    }

    function userValidated(Request $res,$userStatus,$validation){
        $user = User::create([
            'first_name' => $res->firstName,
            'last_name'=> $res->lastName,
            'email'=> $res->email,
            'gender'=>$res->gender,
            'password'=> Hash::make($res->password),
            'mobile_no'=> $res->mobileNo,
            'trade_account'=>$res->selectTrade,
            'unique_code'=> $res->uniqueId,
            'role'=> $res->role,
            'user_status'=>$userStatus,
            'verification_status' => $validation
        ]);

        return response()->json([
            'success' => true,
            'data' =>  $user
        ]);
    }

    function userNotValidated(Request $res){
        $user = User::create([
            'first_name' => $res->firstName,
            'last_name'=> $res->lastName,
            'email'=> $res->email,
            'gender'=>$res->gender,
            'password'=> Hash::make($res->password),
            'mobile_no'=> $res->mobileNo,
            'trade_account'=>$res->selectTrade,
            'unique_code'=> $res->uniqueId,
            'role'=> $res->role,
            'user_status'=>0,
            'verification_status' => 0
        ]);

        return response()->json([
            'success' => true,
            'data' =>  $user
        ]);
    }
    

    function loginDataValidation(Request $request){
       
        $user= User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
            $token = $user->createToken('my-app-token')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token,
            'role' => $user->role
        ];
        return response($response, 201);
    }

    function deleteUser($id){
        $user =User::find($id);
        $data = $user->delete();
        if($data){
            return "Data Deleted Successfully";
        }else{
            return "Data Not Deleted Successfully";
        }
    }

    function getDataById($id){
        $results = DB::select('select * from users where id = ?', [$id]);

        $validationData = DB::select('select * from validations where unique_id = ?', [$results[0]->unique_code]);

       $userValidation = new UserResponse();
       $userValidation->userId = $results[0]->id;
       $userValidation->firstName = $results[0]->first_name;
       $userValidation->lastName = $results[0] ->last_name;
       $userValidation->email = $results[0] -> email;
       $userValidation->mobileNo = $results[0] ->mobile_no;
       if($results[0] ->gender == "M"){
        $userValidation->gender= "Male";
       }else{
        $userValidation->gender= "Female";
       }
       if($validationData==null){
        $userValidation->selectTrade = "";
        $userValidation->uniqueId = "";
        $userValidation->aadhar = "";
        $userValidation->pan = "";
       }else{
        $userValidation->selectTrade = $validationData[0] ->trade_account;
        $userValidation->uniqueId = $validationData[0] ->unique_id;
        $userValidation->aadhar = $validationData[0] ->aadhar;
        $userValidation->pan = $validationData[0] ->pan;
       }
       
       if($results[0] ->role == 1){
        $userValidation->role= "Admin";
       }else{
        $userValidation->role= "User";
       }

       if($results[0] ->verification_status == 1){
        $userValidation->verificationStatus= "Active";
       }else{
        $userValidation->verificationStatus= "In Active";
       }


       if($results[0] ->user_status == "1"){
        $userValidation->userStatus= "Active";
       }else{
        $userValidation->userStatus= "In Active";
       }
        // dd($userValidation);
        // return $userValidation;
        $response = [
            'data' => $userValidation
        ];
        return response($response, 201);
    }


    function updateUser(Request $request){
       $user =  User::find($request->userId);
       $user->first_name = $request->firstName;
       $user->last_name = $request->lastName;
       $user->email = $request->email;
       $user->gender = $request->gender;
       $user->password = Hash::make($request->password);
       $user->mobile_no = $request->mobileNo;
       $user->trade_account = $request->selectTrade;
       $user->unique_code = $request->uniqueId;
       $user->role = $request->role;
       $result = $user->save();
       if($result){
        return["result" => "data has been updated"];
       }else{
        return ["return"=>"faild"];
       }
    }
}
