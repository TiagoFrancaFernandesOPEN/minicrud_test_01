<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\TbUser;
use App\Http\Controllers\PageController;

class UserController extends Controller
{
    public function __construct() {
    }

    public function index(Request $req,PageController $pageCtrl ) {
        $login = $req->session()->get('login');        
        if($login['admin'])
        {
            $msg = "Successfully logged in!";
            return $pageCtrl->userListPage($req)->with('green',$msg);
        }else{
            $msg = "You are not admin!";
            return $pageCtrl->deniedPage($req)->with('red',$msg);
        }
    }

    public function loginForm(Request $req){
        if($req->session()->exists('login')){
            return redirect()->route('users.list');
        }else{
            return view('pages/login_form');
        }
    }

    public function loginPost(Request $req){
        $user = TbUser::where('user_email', $req->input('user_email'))
            ->where('user_password', $req->input('user_password'))
            ->get();

        if($user->count() > 0){
            foreach($user as $u )
            {
                $user_id = $u->user_id;
                $user_fullname = $u->user_fullname;
                $user_email = $u->user_email;
                $user_profile = $u->user_profile;
                $admin = false;
                if (in_array($user_profile, [1,2])) { 
                    $admin = true;
                }
                $userData = [
                    'user_id' => $user_id, 'user_fullname' => $user_fullname, 
                    'user_email' => $user_email, 'user_profile' => $user_profile,
                    'admin' => $admin
                ];
                continue;
            }
            $users = TbUser::all();
            $msg = "Successfully logged in!";
            $req->session()->put('login', $userData);
            return redirect()->route('users.list')
                ->with('green',$msg);
        
        }else{
            $req->session()->flush();
            $msg = "User or password is invalid!";
            return redirect()->route('login.form')->with('message_tgo',$msg);
        }
    }

    public function logout(Request $req){
        if($req->session()->exists('login')){
            $req->session()->flush();
            $msg = "Successfully logged out!";
            return redirect()->route('login.form')
            ->with('green',$msg);
        }else{
            $msg = "You are not logged";
            return redirect()->route('login.form')
            ->with('red',$msg);
        }    
    }

    public function checkUserInDb(Request $req){
        $user = TbUser::where('user_email', $req->input('user_email'))
            ->where('user_password', $req->input('user_password'))
            ->get();

        if($user->count() > 0){
            foreach($user as $u )
            {
                $user_id = $u->user_id;
                $user_fullname = $u->user_fullname;
                $user_email = $u->user_email;
                $user_profile = $u->user_profile;
                $admin = false;
                if (in_array($user_profile, [1,2])) { 
                    $admin = true;
                }
                $userData = [
                    'user_id' => $user_id, 'user_fullname' => $user_fullname, 
                    'user_email' => $user_email, 'user_profile' => $user_profile,
                    'admin' => $admin
                ];
                continue;
            }
            $users = TbUser::all();
            $msg = "Successfully logged in!";
            $req->session()->put('login', $userData);
            return redirect()->route('users.list')
                ->with('green',$msg);
        
        }else{
            $req->session()->flush();
            $msg = "User or password is invalid!";
            return redirect()->route('login.form')->with('message_tgo',$msg);
        }
    }
    
}
