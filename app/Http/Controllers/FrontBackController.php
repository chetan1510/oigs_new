<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User;
use App\Models\Image;

class FrontBackController extends Controller { 
    public function index(){
        $imageMode = Image::imageMode();
        return view('frontBack.index',["sidebar"=>"leads","menu" => "academy","imageMode" => $imageMode]);
    }


    public function init(Request $request){
        $imageMode = Image::imageMode();

        $max_per_page = $request->max_per_page;
        $page_no = $request->page_no;

        $images = DB::table('images');

        if($request->type){
            $images = $images->where("type",$request->type);
        }


        $total = $images->where('user_id',Auth::user()->id)->count();
        $images = $images->skip(($page_no-1)*$max_per_page)->limit($max_per_page)->orderBy('id','DESC')->get();

        foreach($images as $image){
            $image->type = $imageMode[$image->type];
            $image->created_at = date('d-m-Y h:i:s',strtotime($image->created_at));
        }

        $data['images'] = $images;
        $data['total'] = $total;
        $data['imageMode'] = $imageMode;
        $data['success'] = true;

        return Response::json($data,200,[]);
    }


    public function uploadFrontBackImage(Request $request){

        $imageMode = Image::imageMode();
        $type = $imageMode[$request->type];
        $destination = 'uploads/'.$type.'/';

        foreach($request->file('image') as $image){
            $extension = $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            $fileName = $type.'_'.rand().strtotime('now').'.'.$extension;
            $image->move($destination,$fileName); 

            $image = new Image;

            $image->type = $request->type;
            $image->original_name = $originalName;
            $image->name = $destination.$fileName;
            $image->user_id = Auth::user()->id;
            $image->save();
        }
        return Redirect::back()->with("success","File was successfully uploaded....");
    }

    public function delete($id){

        $image  = Image::find($id);
        unlink($image->name);
        Image::where('id',$id)->delete($id);
        $data['success'] = true;
        $data['message'] = "Data successfully deleted";
        return Response::json($data,200,[]);
    }

    public function uploadExcel(Request $request){

        $imageMode = Image::imageMode();
        $type = $imageMode[$request->type];
        $destination = 'temp';

        foreach($request->file('image') as $image){
            $extension = $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();
            $fileName = $type.'_'.rand().strtotime('now').'.'.$extension;
            $image->move($destination,$fileName); 

        }
        return Redirect::back()->with("success","File was successfully uploaded....");

    }

    
}


                 