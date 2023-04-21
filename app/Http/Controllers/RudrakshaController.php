<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User, App\Models\Rudraksha, App\Models\Image;

class RudrakshaController extends Controller{ 
    public function index(){
        return view('rudraksha.index',["sidebar"=>"rudraksha","menu" => "academy"]);
    }

    public function init(Request $request){

        $rudraksha = DB::table('rudraksha')->select('rudraksha.*','customers.name as customerName','results.name as result','product_types.name as prod_type')
        ->leftJoin('customers','customers.id','=','rudraksha.cust_id')
        ->leftJoin('results','results.id','=','rudraksha.result_id')
        ->leftJoin('product_types','product_types.id','=','rudraksha.prod_type_id')
        ->where('rudraksha.inactive',0);
        $max_per_page = $request->max_per_page;
        $page_no = $request->page_no;

        if($request->created_at){
            $rudraksha = $rudraksha->where("rudraksha.created_at",date("Y-m-d",strtotime($request->created_at)));
        }

        if($request->due_amount){
            $rudraksha = $rudraksha->where("rudraksha.due_amount",$request->due_amount);
        }

        if($request->cust_id){
            $rudraksha = $rudraksha->where("rudraksha.cust_id",$request->cust_id);
        }

        if($request->prod_type_id){
            $rudraksha = $rudraksha->where("rudraksha.prod_type_id",$request->prod_type_id);
        }

        if($request->result_id){
            $rudraksha = $rudraksha->where("rudraksha.result_id",$request->result_id);
        }

        $total = $rudraksha->count();

        $rudraksha = $rudraksha->skip(($page_no-1)*$max_per_page)->limit($max_per_page)->get();

        foreach ($rudraksha as $item) {
            $item->created_at = date('d-m-Y',strtotime($item->created_at));
        }

        $data['rudraksha'] = $rudraksha;
        $data['total'] = $total;

        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['success'] = true;

        return Response::json($data,200,[]);
    }

    public function add($id = 0){
        return view('rudraksha.create',["sidebar"=>"rudraksha","menu" => "academy", "id" => $id]);
    }

    public function getRudraksha($id){
        $rudraksha = Rudraksha::find($id);
        $reprt_sequence = Rudraksha::where('user_id',Auth::user()->id)->count()+1;

        if($id == 0) $data['report_no'] = date('ymd',strtotime('now')).'R'.$reprt_sequence;

        $data['rudraksha'] = $rudraksha;
        $data['weightType'] = User::weightType();
        $data['mesurementType'] = User::mesurementType();
        $data['reprt_sequence'] = $reprt_sequence;
        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
        $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['success'] = true;
        return Response::json($data,200,[]);
    }

    public function uploadProductImage(Request $request){

        $destination = 'uploads/rudraksha/';
        $extension = $request->media->getClientOriginalExtension();
        $originalName = $request->media->getClientOriginalName();
        $fileName = 'rudraksha_'.strtotime('now').'.'.$extension;
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

    public function removeRudrakshaImage($id){
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
            $rudraksha = Rudraksha::find($request->id);
        } else {
            $rudraksha = new Rudraksha;
        }

        $rudraksha->report_no = $request->report_no;
        $rudraksha->description = $request->description;
        $rudraksha->cust_id = $request->cust_id;
        $rudraksha->prod_type_id = $request->prod_type_id;
        $rudraksha->testing_charge = $request->testing_charge;
        $rudraksha->amount = $request->amount;
        $rudraksha->due_amount = $request->due_amount;
        $rudraksha->weight = $request->weight;
        $rudraksha->g_cts_ratti = $request->g_cts_ratti;
        $rudraksha->measurement = $request->measurement;
        $rudraksha->cts = $request->cts;
        $rudraksha->color = $request->color;
        $rudraksha->shape_cut = $request->shape_cut;
        $rudraksha->real_face = $request->real_face;
        $rudraksha->artificial_face = $request->artificial_face;
        $rudraksha->resin = $request->resin;
        $rudraksha->microscopic_obs = $request->microscopic_obs;
        $rudraksha->x_ray = $request->x_ray;
        $rudraksha->mag_resonance_imag = $request->mag_resonance_imag;
        $rudraksha->cut_test = $request->cut_test;
        $rudraksha->origins = $request->origins;
        $rudraksha->kingdom_division = $request->kingdom_division;
        $rudraksha->result_id  = $request->result_id;
        $rudraksha->spicies = $request->spicies;
        $rudraksha->oigs_quality = $request->oigs_quality;
        $rudraksha->comments = $request->comments;
        $rudraksha->prod_image = $request->prod_image;
        $rudraksha->certi_front = $request->certi_front;
        $rudraksha->certi_back = $request->certi_back;
        $rudraksha->image_id = $request->image_id;
        $rudraksha->status = $request->status;
        $rudraksha->inactive = 0;
        $rudraksha->user_id = Auth::user()->id;
        $rudraksha->save();

        $data['success'] = true;
        $data['message'] = "Data was successfully uploaded";
        return Response::json($data,200,[]);
    }

    public function delete($id){
        DB::table('rudraksha')->where('id',$id)->update([
            "inactive" => 1
        ]);

        $data['success'] = true;
        $data['message'] = "Data was successfully deleted";
        return Response::json($data,200,[]);
    }

    public function editMultileRudraksha($ids){
       $rudrakshaIds = explode(',', $ids);
       return view('rudraksha.multipleEdit',["sidebar"=>"rudraksha","menu" => "academy","rudrakshaIds" => $ids]);
    }

    public function updateMultipleRudraksha(Request $request){
       $rudrakshaIds = explode(',', $request->id);
       $data['rudraksha'] = DB::table('rudraksha')->whereIn('id',$rudrakshaIds)->get();
       $data['weightType'] = User::weightType();
       $data['mesurementType'] = User::mesurementType();
       $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
       $data['frontImages'] = DB::table('images')->where('type',6)->where('user_id',Auth::user()->id)->get();
       $data['backImages'] = DB::table('images')->where('type',7)->where('user_id',Auth::user()->id)->get();
       $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 
       $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
       $data['success'] = true;
       return Response::json($data,200,[]);
    }

    public function submitMultipleRudraksha(Request $request){
        $data = $request->all();

        foreach($data as $item){

            $rudraksha = Rudraksha::find($item['id']);

            $rudraksha->report_no = $item["report_no"];
            $rudraksha->description = $item["description"];
            $rudraksha->cust_id = $item["cust_id"];
            $rudraksha->prod_type_id = $item["prod_type_id"];
            $rudraksha->testing_charge = $item["testing_charge"];
            $rudraksha->amount = $item["amount"];
            $rudraksha->due_amount = $item["due_amount"];
            $rudraksha->weight = $item["weight"];
            $rudraksha->g_cts_ratti = $item["g_cts_ratti"];
            $rudraksha->measurement = $item["measurement"];
            $rudraksha->cts = $item["cts"];
            $rudraksha->color = $item["color"];
            $rudraksha->shape_cut = $item["shape_cut"];
            $rudraksha->real_face = $item["real_face"];
            $rudraksha->artificial_face = $item["artificial_face"];
            $rudraksha->resin = $item["resin"];
            $rudraksha->microscopic_obs = $item["microscopic_obs"];
            $rudraksha->x_ray = $item["x_ray"];
            $rudraksha->mag_resonance_imag = $item["mag_resonance_imag"];
            $rudraksha->cut_test = $item["cut_test"];
            $rudraksha->origins = $item["origins"];
            $rudraksha->kingdom_division = $item["kingdom_division"];
            $rudraksha->result_id  = $item["result_id"];
            $rudraksha->spicies = $item["spicies"];
            $rudraksha->oigs_quality = $item["oigs_quality"];
            $rudraksha->comments = $item["comments"];
            $rudraksha->prod_image = $item["prod_image"];
            $rudraksha->certi_front = $item["certi_front"];
            $rudraksha->certi_back = $item["certi_back"];
            $rudraksha->image_id = $item["image_id"];
            $rudraksha->status = $item["status"];
        $rudraksha->save();

        }
        $data['success'] = true;
        $data['message'] = "Data successfully updated";
       return Response::json($data,200,[]);
    }

    public function daleteMultipleRudraksha(Request $request){
        DB::table('rudraksha')->whereIn('id',$request->ids)->update([
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
        $rudraksha = DB::table('rudraksha')->whereIn('id',$report_no)->where('status',$status)->get();

        if($status == 1){
            return view('rudraksha.small',["sidebar"=>"rudraksha","menu" => "academy", "rudraksha" => $rudraksha]);
        }

        if($status = 2){
            return view('rudraksha.large',["sidebar"=>"rudraksha","menu" => "academy", "rudraksha" => $rudraksha]);
        }

        if($status = 3){
            return view('rudraksha.sticker',["sidebar"=>"rudraksha","menu" => "academy", "rudraksha" => $rudraksha]);  
        }
    }

}


                 