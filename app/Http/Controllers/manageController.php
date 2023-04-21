<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB, App\Models\User, App\Models\ClassAndSection;

class manageController extends Controller{
    public function index(){
        return view('manage.index',['menu' => "academy", "sidebar" => "management"]);
    }

    public function customerList(Request $request){
        $customers  = DB::table('customers')->where('user_id',Auth::user()->id)->get();
        $data['success'] = true;
        $data['customers'] = $customers;
        return Response::json($data, 200, array());
    }

    public function saveCustomer(Request $request){
        $customers = $request->customer;

        foreach($customers as $customer){
            if(isset($customer['id']) ? $customer['id'] : ''){
                DB::table('customers')->where('id',$customer['id'])->update(["name" => $customer['name']]);
            } else {
                DB::table('customers')->insert([
                    "name" => $customer['name'],
                    "user_id" => Auth::user()->id
                ]);

            }
        }

        $data['message'] = "data successfully saved";
        $data['success'] = true; 
        return Response::json($data, 200, []);
    }

    public function deleteCustomer($id){
        DB::table('customers')->where('id',$id)->delete();
        $data['success'] = true;
        $data['message'] = "Data successfully deleted";
        return Response::json($data, 200, []);
    }   

    // houses parameters start

    public function resultList(Request $request){
        $results  = DB::table('results')->where('user_id',Auth::user()->id)->get();
        $data['success'] = true;
        $data['results'] = $results;
        return Response::json($data, 200, array());
    }

    public function saveResult(Request $request){
        $results = $request->result;

        foreach($results as $result){
            if(isset($result['id']) ? $result['id'] : ''){
                DB::table('results')->where('id',$result['id'])->update(["name" => $result['name']]);
            } else {
                DB::table('results')->insert([
                    "name" => $result['name'],
                    "user_id" => Auth::user()->id
                ]);
            }
        }

        $data['message'] = "data successfully saved";
        $data['success'] = true; 
        return Response::json($data, 200, []);
    }

    public function deleteResult($id){
        DB::table('results')->where('id',$id)->delete();
        $data['success'] = true;
        $data['message'] = "Data successfully deleted";
        return Response::json($data, 200, []);
    } 

    public function productTypeList(Request $request){

        $productTypes  = DB::table('product_types')->where('user_id',Auth::user()->id)->get();
        $data['success'] = true;
        $data['productTypes'] = $productTypes;
        return Response::json($data, 200, array());

    }

    public function saveProductType(Request $request){

        $products = $request->product;

        foreach($products as $product){
            if(isset($product['id']) ? $product['id'] : ''){
                DB::table('product_types')->where('id',$product['id'])->update(["name" => $product['name']]);
            } else {
                DB::table('product_types')->insert([
                    "name" => $product['name'],
                    "user_id" => Auth::user()->id
                ]);
            }
        }

        $data['message'] = "data successfully saved";
        $data['success'] = true; 
        return Response::json($data, 200, []);

    }

    public function deleteProduct($id){

        DB::table('product_types')->where('id',$id)->delete();
        $data['success'] = true;
        $data['message'] = "Data successfully deleted";
        return Response::json($data, 200, []);

    }


}


                 