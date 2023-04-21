<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User, App\Models\MailQueue, App\Models\Utilities;

class UserController extends Controller {

	public function login(){
		return view('login');
	}

	public function postLogin(Request $request){

		$cre = [
			"username" => $request->username,
			"password" => $request->password
		];

		$rules = [
			"username"=>"required",
			"password"=>"required"
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$cre["inactive"] = 0;

			if(Auth::attempt($cre)){
	 			return Redirect::to("gems");
			} else {
				return Redirect::back()->withInput()->with('failure','Invalid email or password');
			}
		} else {
            return Redirect::back()->withErrors($validator)->withInput()->with('failure',$validator->errors()->first());
		}
	}




	public function logout(){
		Auth::logout();
		return Redirect::to("/");
	}
	
	public function viewUsers(){
        User::pageAccess(5);
		return view('users.view_users',["sidebar"=>"users" ,"menu" => "admin"]);
	}

	public function viewAddUser(){
		return view('users.add_user',["update" => 0,"sidebar"=>"users" ,"menu" => "admin"]);
	}

	public function editUser($id){
        User::pageAccess(5);
		return view('users.add_user',["update"=>$id,"sidebar"=>"users" ,"menu" => "admin"]);
	}

	public function viewUserRoles(){
        User::pageAccess(25);
		return view('users.user_roles',["sidebar"=>"users" ,"menu" => "admin"]);
	}	

	public function viewAccessRights(){
		return view('users.user_rights',["sidebar"=>"users" ,"menu" => "admin"]);
	}

	public function staffAttendance(){
        User::pageAccess(22);
		return view('users.staff.attendance.index',["sidebar"=>"users" ,"menu" => "admin"]);
	}

	public function dashboard(){
		return view('dashboard');
	}

	public function switchDashboard($type){
		Session::put("dashboard",$type);
		if($type == "academy"){
			$link = "students";
		} else if($type == "accounts"){
			$link = "payments";
		} else if($type == "leads"){
			$link = "leads";
		} else if($type == "admin"){
			$link = "city";
		}else if($type == "inventory"){
			$link = "inventory/request";
		}else if($type == "communication"){
			$link = "communications/send-message";
		}
		return Redirect::to($link);
	}


    public function postForgetPassword(Request $request){

        $validator = Validator::make(["email"=>$request->email],["email"=>"required|email"]);
        
        if($validator->fails()){
        	$data['success'] = false;
			$data['message'] = $validator->errors()->first();
			return Response::json($data, 200, array());
        }
        
        $user = User::where('email',$request->email)->where("inactive",0)->first();
        
        if(!$user){

        	$data['success'] = false;
			$data['message'] = "No user found with this email id";
			return Response::json($data, 200, array());
        }

        $rand_pwd = User::getRandPassword();
        
        $user->password = Hash::make($rand_pwd);
        $user->password_check = $rand_pwd;
        $user->save();

        $mail = new MailQueue;

        if($request->email == "admin"){
            $mail->mailto = $user->inactive_email;
        } else {
            $mail->mailto = $user->email;
        }

        $mail->subject = "Academy - Reset Password";
        $mail->content = view('mails.password_reset',["user"=>$user]);
        $mail->client_id = $user->client_id;
        $mail->priority = 1;
        $mail->save();

        $data['success'] = false;
		$data['message'] = "New password has been sent to your registered email id";
		return Response::json($data, 200, array());
    }


    public function changePassword(){
        return view('change_password',['menu' => "academy"]);
    }

    public function updatePassword(Request $request){
        $cre = ["old_password"=>$request->old_password,"new_password"=>$request->new_password,"confirm_password"=>$request->confirm_password];
        $rules = ["old_password"=>'required',"new_password"=>'required|min:5',"confirm_password"=>'required|same:new_password'];
        $old_password = Hash::make($request->old_password);
        $validator = Validator::make($cre,$rules);
        if ($validator->passes()) { 
            if (Hash::check($request->old_password, Auth::user()->password )) {
                $password = Hash::make($request->new_password);
                $user = User::find(Auth::id());
                $user->password = $password;
                $user->password_check = $request->new_password;
                $user->save();

                return Redirect::back()->with('success', 'Password changed successfully ');
                
            } else {
                return Redirect::back()->withInput()->with('failure', 'Old password does not match.');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::back()->withErrors($validator)->withInput()->with('failure','Unauthorised Access or Invalid Password');
    }

	// public function addAccessRights(){
	// 	$access_data = Input::get('rights_data'); 
	// 	if ($access_data) {
	// 		DB::table('access_rights')->insert([
	// 			"access_rights"=>$access_data['access_rights']
	// 		]);
	// 		$success["success"] = true;
	// 	}
	// 	else{
	// 		$success["success"] = false;
	// 	}
	// 	return json_encode(["success"=>$success]);
	// }

	// public function updateAccessRights(){
	// 	$access_data = Input::get('rights_data'); 
	// 	if ($access_data) {
	// 		DB::table('access_rights')->where('id',$access_data['id'])
	// 		->update([
	// 			"access_rights"=>$access_data['access_rights']
	// 		]);
	// 		$success["success"] = true;
	// 	}
	// 	else{
	// 		$success["success"] = false;
	// 	}
	// 	return json_encode(["success"=>$success]);
	// }

	// public function deleteAccessRights(){

	// 	$id = Input::get('roles')['id'];
	// 	if ($id) {
	// 		DB::table('access_rights')->where('id',$id)
	// 		->delete();
	// 		$success["success"] = true;
	// 	}
	// 	else{
	// 		$success["success"] = false;
	// 	}

	// 	return json_encode($success);
	// }
}
