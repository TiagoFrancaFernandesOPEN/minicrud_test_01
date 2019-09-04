<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TbUser;
use App\TbProfile;

class PageController extends Controller
{
    public function defaultPage(Request $req){
        $title = $req->session()->exists('title') ? $req->session()->get('title') : '';
        $content = $req->session()->exists('content') ? $req->session()->get('content') : '';
        return view('pages/default_page', compact(['req','title','content']));
    }

    public function deniedPage(Request $req){
        $title = $req->session()->exists('title') ? $req->session()->get('title')
        : "Denied access";
        $content = $req->session()->exists('content') 
        ? $req->session()->get('content') 
        : "You don't have sufficient permissions to view requested content!";
        $req->session()->put('red',$title." | ".$content);
        return view('pages/default_page', compact(['req','title','content']));
    }
    public function userListPage(Request $req){
        $users = TbUser::paginate(10);
        $profiles = TbProfile::all();
        $login = $req->session()->exists('login') ? $req->session()->get('login') : null;
        return view('pages/users', compact(['users','profiles','login']));
    }
}
