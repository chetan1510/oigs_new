<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User;


class ProductController extends Controller { 
    public function index(){
        return view('gems.index',["sidebar"=>"leads","menu" => "academy"]);
    }
    
}


                 