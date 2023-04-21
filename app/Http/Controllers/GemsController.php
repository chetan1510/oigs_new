<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\User, App\Models\Gems, App\Models\Image;

class GemsController extends Controller{ 
    public function index(){
        return view('gems.index',["sidebar"=>"gems","menu" => "academy"]);
    }

    public function init(Request $request){
        $gems = DB::table('gems')->select('gems.*','customers.name as customerName','results.name as result','product_types.name as prod_type')
        ->leftJoin('customers','customers.id','=','gems.cust_id')
        ->leftJoin('results','results.id','=','gems.result_id')
        ->leftJoin('product_types','product_types.id','=','gems.prod_type_id')
        ->where('gems.inactive',0);

        $max_per_page = $request->max_per_page;
        $page_no = $request->page_no;

        if($request->date){
            $gems = $gems->where("gems.date",date("Y-m-d",strtotime($request->date)));
        }

        if($request->due_amount){
            $gems = $gems->where("gems.due_amount",$request->due_amount);
        }

        if($request->cust_id){
            $gems = $gems->where("gems.cust_id",$request->cust_id);
        }

        if($request->result_id){
            $gems = $gems->where("gems.result_id",$request->result_id);
        }

        if($request->prod_type_id){
            $gems = $gems->where("gems.prod_type_id",$request->prod_type_id);
        }

        if($request->report_no){
            $gems = $gems->where("gems.id",$request->report_no);
        }

        $total = $gems->count();

        $gems = $gems->skip(($page_no-1)*$max_per_page)->limit($max_per_page)->get();

        foreach ($gems as $item) {
            $item->created_at = date('d-m-Y',strtotime($item->created_at));
        }

        $data['gems'] = $gems;
        $data['total'] = $total;

        $data['customers'] = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['results'] = DB::table('results')->where('user_id',Auth::user()->id)->get(); 
        $data['productTypes'] = DB::table('product_types')->where('user_id',Auth::user()->id)->get(); 

        $data['success'] = true;

        return Response::json($data,200,[]);
    }
 
    public function add($id = 0){
        return view('gems.create',["sidebar"=>"gems","menu" => "academy", "id" => $id]);
    }

    public function getGems($id){
        $gems = Gems::find($id);
        $reprt_sequence = Gems::where('user_id',Auth::user()->id)->count()+1;

        if($id == 0) $data['report_no'] = date('ymd',strtotime('now')).'G'.$reprt_sequence;
 
        $data['gems'] = $gems;
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

        $destination = 'uploads/Gems/';
        $extension = $request->media->getClientOriginalExtension();
        $originalName = $request->media->getClientOriginalName();
        $fileName = 'Gems_'.strtotime('now').'.'.$extension;
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

    public function removeGemsImage($id){
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
            $gems = Gems::find($request->id);
        } else {
            $gems = new Gems;
            $gems->date = date("Y-m-d");
        }

        $gems->amount = $request->amount;
        $gems->axial_figure = $request->axial_figure;
        $gems->birefringence = $request->birefringence;
        $gems->certi_back_id = $request->certi_back_id;
        $gems->certi_front_id = $request->certi_front_id;
        $gems->color = $request->color;
        $gems->comments = $request->comments;
        $gems->crystal_system = $request->crystal_system;
        $gems->cust_id = $request->cust_id;
        $gems->description = $request->description;
        $gems->due_amount = $request->due_amount;
        $gems->image_id = $request->image_id;
        $gems->hardness = $request->hardness;
        $gems->measurement = $request->measurement;
        $gems->mesurement_type = $request->mesurement_type;
        $gems->microscopic_obs = $request->microscopic_obs;
        $gems->oigs_quality = $request->oigs_quality;
        $gems->optic_character = $request->optic_character;
        $gems->prod_image = $request->prod_image;
        $gems->prod_type_id = $request->prod_type_id;
        $gems->remark = $request->remark;
        $gems->report_no = $request->report_no;
        $gems->result_id = $request->result_id;
        $gems->ri = $request->ri;
        $gems->sg = $request->sg;
        $gems->shape_cut = $request->shape_cut;
        $gems->species = $request->species;
        $gems->status = $request->status;
        $gems->testing_charge = $request->testing_charge;
        $gems->weight = $request->weight;
        $gems->weight_type = $request->weight_type;
        $gems->inactive = 0;
        $gems->user_id = Auth::user()->id;
        $gems->save();

        $data['success'] = true;
        $data['message'] = "Data was successfully uploaded";
        return Response::json($data,200,[]);
    }

    public function delete($id){
        DB::table('gems')->where('id',$id)->update([
            "inactive" => 1
        ]);

        $data['success'] = true;
        $data['message'] = "Data was successfully deleted";
        return Response::json($data,200,[]);
    }

    public function editMultileGems($ids){
       $gemsIds = explode(',', $ids);
       return view('gems.multipleEdit',["sidebar"=>"gems","menu" => "academy","gemsIds" => $ids]);
    }

    public function updateMultipleGems(Request $request){
       $gemsIds = explode(',', $request->id);
       $data['gems'] = DB::table('gems')->whereIn('id',$gemsIds)->get();
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

    public function submitMultipleGems(Request $request){
        $data = $request->all();

        foreach($data as $item){

            $gems = Gems::find($item['id']);

            $gems->amount = $item['amount'];
            $gems->axial_figure = $item['axial_figure'];
            $gems->birefringence = $item['birefringence'];
            $gems->certi_back_id = $item['certi_back_id'];
            $gems->certi_front_id = $item['certi_front_id'];
            $gems->color = $item['color'];
            $gems->comments = $item['comments'];
            $gems->crystal_system = $item['crystal_system'];
            $gems->cust_id = $item['cust_id'];
            $gems->description = $item['description'];
            $gems->due_amount = $item['due_amount'];
            $gems->image_id = $item['image_id'];
            $gems->hardness = $item['hardness'];
            $gems->measurement = $item['measurement'];
            $gems->mesurement_type = $item['mesurement_type'];
            $gems->microscopic_obs = $item['microscopic_obs'];
            $gems->oigs_quality = $item['oigs_quality'];
            $gems->optic_character = $item['optic_character'];
            $gems->prod_image = $item['prod_image'];
            $gems->prod_type_id = $item['prod_type_id'];
            $gems->remark = $item['remark'];
            $gems->report_no = $item['report_no'];
            $gems->result_id = $item['result_id'];
            $gems->ri = $item['ri'];
            $gems->sg = $item['sg'];
            $gems->shape_cut = $item['shape_cut'];
            $gems->species = $item['species'];
            $gems->status = $item['status'];
            $gems->testing_charge = $item['testing_charge'];
            $gems->weight = $item['weight'];
            $gems->weight_type = $item['weight_type'];
            $gems->save();

        }
        $data['success'] = true;
        $data['message'] = "Data successfully updated";
       return Response::json($data,200,[]);
    }

    public function daleteMultipleGems(Request $request){
        DB::table('gems')->whereIn('id',$request->ids)->update([
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

        $gems = DB::table('gems')->select('gems.*','customers.name as customerName','results.name as result','product_types.name as prod_type','frontImage.name as certi_front','backImage.name as certi_back')->leftJoin('customers','customers.id','=','gems.cust_id')
        ->leftJoin('results','results.id','=','gems.result_id')
        ->leftJoin('product_types','product_types.id','=','gems.prod_type_id')
        ->leftJoin('images as frontImage','frontImage.id','=','gems.certi_front_id')
        ->leftJoin('images as backImage','backImage.id','=','gems.certi_back_id')
        ->where('gems.inactive',0)->where('status',$status)
        ->whereIn('gems.id',$report_no)
        ->get();

        // dd($gems);

        if($status == 1){
            return view('gems.small',["sidebar"=>"gems","menu" => "academy", "gems" => $gems]);
        }

        if($status = 2){
            return view('gems.large',["sidebar"=>"gems","menu" => "academy", "gems" => $gems]);
        }

        if($status = 3){
            return view('gems.sticker',["sidebar"=>"gems","menu" => "academy", "gems" => $gems]);  
        }
    }

    public function getResultData($result_id){
        $records = DB::table('gems')->where('result_id',$result_id)->orderBy('id','DESC')->first();
        $data['success'] = true;
        $data['records'] = $records;
        return Response::json($data,200,[]);
    }

}


                 