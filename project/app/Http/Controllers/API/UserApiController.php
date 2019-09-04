<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TbUser;
use App\TbProfile;

class UserApiController extends Controller
{
    public function index(Request $req)
    {
        $users = TbUser::all();
        return Response()->json($users, 200);
    }

    public function store(Request $req)
    {
        if (!TbUser::where('user_email', $req->user_email)->exists()){
            $TbUser = new TbUser;
            $TbUser->user_fullname = $req->user_fullname;
            $TbUser->user_email = $req->user_email;
            $TbUser->user_birth_date = $req->user_birth_date;
            $TbUser->user_profile = (is_null($req->user_profile) OR $req->user_profile == "undefined")?3:$req->user_profile;
            $TbUser->user_password = $req->user_password;
            $TbUser->save();
            return Response()->json($TbUser, 201);
        }else{
            $data =
            [
                'status' => '409', 'callback_message' => 'Duplicate entry!',
                'action' => 'store', 'target' =>  $req->user_email
            ];
            return Response()->json($data, 409);
        }
    }  

    public function show($id)
    {
       if (TbUser::where('user_id', $id)->exists()){
            $TbUser = TbUser::find($id);
            $data =
                [ 
                    'status' => '200', 'callback_message' => 'show!',
                    'action' => 'show', 'target' =>  $id, 'data' => $TbUser
                ];
            return Response()->json($data, 200);
        }else{
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'show', 'target' =>  $id
            ];
            return Response()->json($data, 404);
        }
    }

    public function profileById($id){
        if (TbProfile::where('profile_id', $id)->exists()){
            $TbProfile = TbProfile::find($id);
            $data =
                [ 
                    ["profile_id"=>$TbProfile->profile_id,"profile_name"=>$TbProfile->profile_name,
                    "profile_type"=>$TbProfile->profile_type]
                ];
            return Response()->json($data, 200);
        }else{
            $data =
            [ 
                "profile_id"=>3,"profile_name"=>"Usuário",
                "profile_type"=>"USER"
            ];
            return Response()->json($data, 200);
        }
    }

    public function profiles()
    {
        $profiles = TbProfile::all();
        return Response()->json($profiles, 200);
    }

    public function update(Request $req, $id)
    {
        if (TbUser::where('user_id', $id)->exists()){
            $TbUser = TbUser::find($id);
            $TbUser->user_fullname = is_null($req->user_fullname) ? $TbUser->user_fullname : $req->user_fullname;
            $TbUser->user_email = is_null($req->user_email) ? $TbUser->user_email : $req->user_email;
            $TbUser->user_birth_date = is_null($req->user_birth_date) ? $TbUser->user_birth_date : $req->user_birth_date;
            $TbUser->user_profile = is_null($req->user_profile) ? $TbUser->user_profile : $req->user_profile;
            $TbUser->user_password = is_null($req->user_password) ? $TbUser->user_password : $req->user_password; 
            $TbUser->save();
            $data =
                [ 
                    'status' => '200', 'callback_message' => 'Updated!',
                    'action' => 'update', 'target' =>  $id, 'data' => $TbUser
                ];
            return Response()->json($data, 200);
        }else{
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'show', 'target' =>  $id
            ];
            return Response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        if(TbUser::where('user_id', $id)->exists())
        {
            if(TbUser::where('user_id', $id)->delete())
            {
                $data =
                [ 
                    'status' => '202', 'callback_message' => 'Deleted!',
                    'action' => 'delete', 'target' =>  $id
                ];
                return Response()->json($data, 202);
            }
        }
            $data =
            [
                'status' => '404', 'callback_message' => 'Not found!',
                'action' => 'delete', 'target' =>  $id
            ];
            return Response()->json($data, 404);
    }
}
