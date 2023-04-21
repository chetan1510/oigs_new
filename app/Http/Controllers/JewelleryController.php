<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User, App\Models\Jewellery, App\Models\Image;

class JewelleryController extends Controller{ 
    public function index(){
        return view('jewellery.index',["sidebar"=>"jewellery","menu" => "academy"]);
    }

    public function init(Request $request){
// dd(1);
        $jewelleries = DB::table('jewelleries')->select('jewelleries.*','customers.name as customerName','product_types.name as prod_type')
        ->leftJoin('customers','customers.id','=','jewelleries.cust_id')
        ->leftJoin('product_types','product_types.id','=','jewelleries.prod_type_id')
        ->where('jewelleries.inactive',0);
        $max_per_page = $request->max_per_page;
        $page_no = $request->page_no;

        if($request->created_at){
            $jewelleries = $jewelleries->where("jewelleries.created_at",date("Y-m-d",strtotime($request->created_at)));
        }

        if($request->due_amount){
            $jewelleries = $jewelleries->where("jewelleries.due_amount",$request->due_amount);
        }

        if($request->cust_id){
            $jewelleries = $jewelleries->where("jewelleries.cust_id",$request->cust_id);
        }

        if($request->prod_type_id){
            $jewelleries = $jewelleries->where("jewelleries.prod_type_id",$request->prod_type_id);
        }

        $total = $jewelleries->count();

        $jewelleries = $jewelleries->skip(($page_no-1)*$max_per_page)->limit($max_per_page)->get();

        foreach ($jewelleries as $item) {
            $item->created_at = date('d-m-Y',strtotime($item->created_at));
        }

        $data['jewelleries'] = $jewelleries;
        $data['total'] = $total;

        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 

        $data['success'] = true;

        return Response::json($data,200,[]);
    }

    public function add($id = 0){
        return view('jewellery.create',["sidebar"=>"jewellery","menu" => "academy", "id" => $id]);
    }

    public function getJewellery($id){
        $jewellery = Jewellery::find($id);
        $reprt_sequence = Jewellery::where('user_id',Auth::user()->id)->count()+1;

        if($id == 0) $data['report_no'] = date('ymd',strtotime('now')).'G'.$reprt_sequence;

        $data['jewellery'] = $jewellery;
        $data['weightType'] = User::weightType();
        $data['mesurementType'] = User::mesurementType();
        $data['reprt_sequence'] = $reprt_sequence;
        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
        $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get();
        $data['success'] = true;
        return Response::json($data,200,[]);
    }

    public function uploadProductImage(Request $request){

        $destination = 'uploads/Jewellery/';
        $extension = $request->media->getClientOriginalExtension();
        $originalName = $request->media->getClientOriginalName();
        $fileName = 'Jewellery_'.strtotime('now').'.'.$extension;
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

    public function removeJewelleryImage($id){
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
            $jewellery = Jewellery::find($request->id);
        } else {
            $jewellery = new Jewellery;
        }

        $jewellery->report_no = $request->report_no;
        $jewellery->description = $request->description;
        $jewellery->cust_id = $request->cust_id;
        $jewellery->prod_type_id = $request->prod_type_id;
        $jewellery->testing_charge = $request->testing_charge;
        $jewellery->amount = $request->amount;
        $jewellery->due_amount = $request->due_amount;
        $jewellery->gross_weight = $request->gross_weight;
        $jewellery->g_cts_ratti = $request->g_cts_ratti;
        $jewellery->diamond_wt = $request->diamond_wt;
        $jewellery->cts = $request->cts;
        $jewellery->shape_of_diamond = $request->shape_of_diamond;
        $jewellery->florescence = $request->florescence;
        $jewellery->color = $request->color;
        $jewellery->clarity = $request->clarity;
        $jewellery->cut = $request->cut;
        $jewellery->porosity = $request->porosity;
        $jewellery->shape_of_product = $request->shape_of_product;
        $jewellery->polish = $request->polish;
        $jewellery->hallmark = $request->hallmark;
        $jewellery->loose_diamond = $request->loose_diamond;
        $jewellery->prod_code = $request->prod_code;
        $jewellery->color_stone_weight = $request->color_stone_weight;
        $jewellery->ctss = $request->ctss;
        $jewellery->comments = $request->comments;
        $jewellery->oigs_quality = $request->oigs_quality;
        $jewellery->remark = $request->remark;
        $jewellery->prod_image = $request->prod_image;
        $jewellery->certi_front = $request->certi_front;
        $jewellery->certi_back = $request->certi_back;
        $jewellery->image_id = $request->image_id;
        $jewellery->status = $request->status;
        $jewellery->inactive = 0;
        $jewellery->user_id = Auth::user()->id;
        $jewellery->save();

        $data['success'] = true;
        $data['message'] = "Data was successfully uploaded";
        return Response::json($data,200,[]);
    }

    public function delete($id){
        DB::table('jewelleries')->where('id',$id)->update([
            "inactive" => 1
        ]);

        $data['success'] = true;
        $data['message'] = "Data was successfully deleted";
        return Response::json($data,200,[]);
    }

    public function editMultileJewellery($ids){
       $jewelleryIds = explode(',', $ids);
       return view('jewellery.multipleEdit',["sidebar"=>"jewellery","menu" => "academy","jewelleryIds" => $ids]);
    }

    public function updateMultipleJewellery(Request $request){
       $jewelleryIds = explode(',', $request->id);
       $data['jewellery'] = DB::table('jewelleries')->whereIn('id',$jewelleryIds)->get();
       $data['weightType'] = User::weightType();
       $data['mesurementType'] = User::mesurementType();
       $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
       $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
       $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
       $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 
       $data['success'] = true;
       return Response::json($data,200,[]);
    }

    public function submitMultipleJewellery(Request $request){
        $data = $request->all();

        foreach($data as $item){

            $jewellery = Jewellery::find($item['id']);

        $jewellery->report_no = $item["report_no"];
        $jewellery->description = $item["description"];
        $jewellery->cust_id = $item["cust_id"];
        $jewellery->prod_type_id = $item["prod_type_id"];
        $jewellery->testing_charge = $item["testing_charge"];
        $jewellery->amount = $item["amount"];
        $jewellery->due_amount = $item["due_amount"];
        $jewellery->gross_weight = $item["gross_weight"];
        $jewellery->g_cts_ratti = $item["g_cts_ratti"];
        $jewellery->diamond_wt = $item["diamond_wt"];
        $jewellery->cts = $item["cts"];
        $jewellery->shape_of_diamond = $item["shape_of_diamond"];
        $jewellery->florescence = $item["florescence"];
        $jewellery->color = $item["color"];
        $jewellery->clarity = $item["clarity"];
        $jewellery->cut = $item["cut"];
        $jewellery->porosity = $item["porosity"];
        $jewellery->shape_of_product = $item["shape_of_product"];
        $jewellery->polish = $item["polish"];
        $jewellery->hallmark = $item["hallmark"];
        $jewellery->loose_diamond = $item["loose_diamond"];
        $jewellery->prod_code = $item["prod_code"];
        $jewellery->color_stone_weight = $item["color_stone_weight"];
        $jewellery->ctss = $item["ctss"];
        $jewellery->comments = $item["comments"];
        $jewellery->oigs_quality = $item["oigs_quality"];
        $jewellery->remark = $item["remark"];
        $jewellery->prod_image = $item["prod_image"];
        $jewellery->certi_front = $item["certi_front"];
        $jewellery->certi_back = $item["certi_back"];
        $jewellery->image_id = $item["image_id"];
        $jewellery->status = $item["status"];
        $jewellery->save();

        }
        $data['success'] = true;
        $data['message'] = "Data successfully updated";
       return Response::json($data,200,[]);
    }

    public function daleteMultipleJewellery(Request $request){
        DB::table('jewelleries')->whereIn('id',$request->ids)->update([
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
        $jewellery = DB::table('jewelleries')->whereIn('id',$report_no)->where('status',$status)->get();

        if($status == 1){
            return view('jewellery.small',["sidebar"=>"jewellery","menu" => "academy", "jewellery" => $jewellery]);
        }

        if($status = 2){
            return view('jewellery.large',["sidebar"=>"jewellery","menu" => "academy", "jewellery" => $jewellery]);
        }

        if($status = 3){
            return view('jewellery.sticker',["sidebar"=>"jewellery","menu" => "academy", "jewellery" => $jewellery]);  
        }
    }

}


                 