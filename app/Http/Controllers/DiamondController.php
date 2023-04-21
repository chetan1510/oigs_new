<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User, App\Models\diamond, App\Models\Image;

class DiamondController extends Controller{ 
    public function index(){
        return view('diamond.index',["sidebar"=>"diamond","menu" => "academy"]);
    }

    public function init(Request $request){

        $diamonds = DB::table('diamonds')->select('diamonds.*','customers.name as customerName','product_types.name as prod_type')
        ->leftJoin('customers','customers.id','=','diamonds.cust_id')
        ->leftJoin('product_types','product_types.id','=','diamonds.prod_type_id')
        ->where('diamonds.inactive',0);
        $max_per_page = $request->max_per_page;
        $page_no = $request->page_no;

        if($request->created_at){
            $diamonds = $diamonds->where("diamonds.created_at",date("Y-m-d",strtotime($request->created_at)));
        }

        if($request->due_amount){
            $diamonds = $diamonds->where("diamonds.due_amount",$request->due_amount);
        }

        if($request->cust_id){
            $diamonds = $diamonds->where("diamonds.cust_id",$request->cust_id);
        }

        if($request->prod_type_id){
            $diamonds = $diamonds->where("diamonds.prod_type_id",$request->prod_type_id);
        }

        $total = $diamonds->count();

        $diamonds = $diamonds->skip(($page_no-1)*$max_per_page)->limit($max_per_page)->get();

        foreach ($diamonds as $item) {
            $item->created_at = date('d-m-Y',strtotime($item->created_at));
        }

        $data['diamonds'] = $diamonds;
        $data['total'] = $total;

        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 

        $data['success'] = true;

        return Response::json($data,200,[]);
    }

    public function add($id = 0){
        return view('diamond.create',["sidebar"=>"diamond","menu" => "academy", "id" => $id]);
    }

    public function getDiamond($id){
        $diamond = diamond::find($id);
        $reprt_sequence = diamond::where('user_id',Auth::user()->id)->count()+1;

        if($id == 0) $data['report_no'] = date('ymd',strtotime('now')).'D'.$reprt_sequence;

        $data['diamond'] = $diamond;
        $data['weightType'] = User::weightType();
        $data['mesurementType'] = User::mesurementType();
        $data['reprt_sequence'] = $reprt_sequence;
        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get();
        $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
        $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get();
        $data['success'] = true;
        return Response::json($data,200,[]);
    }

    public function uploadProductImage(Request $request){

        $destination = 'uploads/diamond/';
        $extension = $request->media->getClientOriginalExtension();
        $originalName = $request->media->getClientOriginalName();
        $fileName = 'diamond_'.strtotime('now').'.'.$extension;
        $request->media->move($destination,$fileName);

        $image = new Image;

        $image->type = 1;
        $image->original_name = $originalName;
        $image->name = $destination.$fileName;
        $image->user_id = Auth::user()->id;
        $image->save();

        $data['fileName'] = $image->name;
        $data['image_id'] = $image->id;
        $data['success'] = true;
        $data['message'] = "File was successfully uploaded";
        return Response::json($data,200,[]);

    }

    public function removediamondImage($id){
        $image  = Image::find($id);
        unlink($image->name);
        Image::where('id',$id)->delete($id);
        $data['success'] = true;
        $data['message'] = "File was successfully removed";
        return Response::json($data,200,[]);
    }

    public function Store(Request $request){

        if(!$request->prod_image){
            $data['success'] = false;
            $data['message'] = "Please upload Product image";
            return Response::json($data,200,[]);
        }

        if($request->id){
            $diamond = diamond::find($request->id);
        } else {
            $diamond = new diamond;
        }

            $diamond->report_no = $request->report_no;
            $diamond->description = $request->description;
            $diamond->cust_id = $request->cust_id;
            $diamond->prod_type_id = $request->prod_type_id;
            $diamond->testing_charge = $request->testing_charge;
            $diamond->amount = $request->amount;
            $diamond->due_amount = $request->due_amount;
            $diamond->diamond_wt = $request->diamond_wt;
            $diamond->g_cts_ratti = $request->g_cts_ratti;
            $diamond->measurement = $request->measurement;
            $diamond->cts = $request->cts;
            $diamond->shape_of_diamond = $request->shape_of_diamond;
            $diamond->florescence = $request->florescence;
            $diamond->color = $request->color;
            $diamond->clarity = $request->clarity;
            $diamond->cut = $request->cut;
            $diamond->polish = $request->polish;
            $diamond->symmetry = $request->symmetry;
            $diamond->clarity_characteristics = $request->clarity_characteristics;
            $diamond->table = $request->table;
            $diamond->dispersion = $request->dispersion;
            $diamond->prod_code = $request->prod_code;
            $diamond->enhancements = $request->enhancements;
            $diamond->comments = $request->comments;
            $diamond->oigs_quality = $request->oigs_quality;
            $diamond->prod_image = $request->prod_image;
            $diamond->remark = $request->remark;
            $diamond->certi_front = $request->certi_front;
            $diamond->certi_back = $request->certi_back;
            $diamond->image_id = $request->image_id;
            $diamond->status = $request->status;
            $diamond->inactive = 0;
            $diamond->user_id = Auth::user()->id;
            $diamond->save();

        $data['success'] = true;
        $data['message'] = "Data was successfully uploaded";
        return Response::json($data,200,[]);
    }

    public function delete($id){
        DB::table('diamonds')->where('id',$id)->update([
            "inactive" => 1
        ]);

        $data['success'] = true;
        $data['message'] = "Data was successfully deleted";
        return Response::json($data,200,[]);
    }

    public function editMultilediamond($ids){
       $diamondIds = explode(',', $ids);
       return view('diamond.multipleEdit',["sidebar"=>"diamond","menu" => "academy","diamondIds" => $ids]);
    }

    public function updateMultiplediamond(Request $request){
       $diamondIds = explode(',', $request->id);
       $data['diamond'] = DB::table('diamonds')->whereIn('id',$diamondIds)->get();
       $data['weightType'] = User::weightType();
       $data['mesurementType'] = User::mesurementType();
       $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
       $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get();
       $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
       $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
       $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 
       $data['success'] = true;
       return Response::json($data,200,[]);
    }

    public function submitMultiplediamond(Request $request){
        $data = $request->all();

        foreach($data as $item){

            $diamond = diamond::find($item['id']);

            $diamond->description = $item["description"];
            $diamond->cust_id = $item["cust_id"];
            $diamond->prod_type_id = $item["prod_type_id"];
            $diamond->testing_charge = $item["testing_charge"];
            $diamond->amount = $item["amount"];
            $diamond->due_amount = $item["due_amount"];
            $diamond->diamond_wt = $item["diamond_wt"];
            $diamond->g_cts_ratti = $item["g_cts_ratti"];
            $diamond->measurement = $item["measurement"];
            $diamond->cts = $item["cts"];
            $diamond->shape_of_diamond = $item["shape_of_diamond"];
            $diamond->florescence = $item["florescence"];
            $diamond->color = $item["color"];
            $diamond->clarity = $item["clarity"];
            $diamond->cut = $item["cut"];
            $diamond->polish = $item["polish"];
            $diamond->symmetry = $item["symmetry"];
            $diamond->clarity_characteristics = $item["clarity_characteristics"];
            $diamond->table = $item["table"];
            $diamond->dispersion = $item["dispersion"];
            $diamond->prod_code = $item["prod_code"];
            $diamond->enhancements = $item["enhancements"];
            $diamond->comments = $item["comments"];
            $diamond->oigs_quality = $item["oigs_quality"];
            $diamond->prod_image = $item["prod_image"];
            $diamond->remark = $item["remark"];
            $diamond->certi_front = $item["certi_front"];
            $diamond->certi_back = $item["certi_back"];
            $diamond->image_id = $item["image_id"];
            $diamond->status = $item["status"];
            $diamond->save();

        }
        $data['success'] = true;
        $data['message'] = "Data successfully updated";
       return Response::json($data,200,[]);
    }

    public function daleteMultiplediamond(Request $request){
        DB::table('diamonds')->whereIn('id',$request->ids)->update([
            "inactive" => 1
        ]);

        $data['success'] = true;
        $data['message'] = "Data was successfully deleted";
        return Response::json($data,200,[]);
    }

    public function printReport($report, $status){

        $result = preg_replace_callback('/(\d+)-(\d+)/', function($m) {
            return implode(',', range($m[1], $m[2]));
        }, $report);

        $report_no = explode(',',$result);
        $diamond = DB::table('diamonds')->whereIn('id',$report_no)->where('status',$status)->get();

        if($status == 1){
            return view('diamond.small',["sidebar"=>"diamond","menu" => "academy", "diamond" => $diamond]);
        }

        if($status = 2){
            return view('diamond.large',["sidebar"=>"diamond","menu" => "academy", "diamond" => $diamond]);
        }

        if($status = 3){
            return view('diamond.sticker',["sidebar"=>"diamond","menu" => "academy", "diamond" => $diamond]);  
        }
    }

}


                 