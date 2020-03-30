<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('user.index')->with('data',User::all());
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){

        $rules = [
            'name'  => 'required|min:5',
            'email'  => 'required|unique:users|email',
            'password' => 'required|min:8|required_with:confirm_password|same:confirm_password|password_rules',
            'confirm_password' => 'required',
        ];
        $messages = [
            'password.password_rules'    =>  'Use mix of letters, numbers & symbols.',
        ];
        $this->validate($request, $rules, $messages);
        $user = new User();
        $user->name = $request->name;
        $user->role_id = 2;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return Redirect::route('user.create')->with('success_message','Created Successfully');
        }
        return Redirect::route('user.create')->with('error_message','Something went wrong. Try again.');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $data = User::find($id);
        if(!$data || !isset($data->id)){
            return view('404');
        }
        return view('user.edit')->with(['data' => $data,'id' => $id]);
    }

    public function update(Request $request, $id){
        $rules = [
            'name'  => 'required|min:5',
            'email'  => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|required_with:confirm_password|same:confirm_password|password_rules',
            'confirm_password' => 'nullable',
        ];
        $messages = [
            'password.password_rules'    =>  'Use mix of letters, numbers & symbols.',
        ];

        $this->validate($request, $rules, $messages);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            return Redirect::route('user.edit',$id)->with('success_message','Updated Successfully');
        }
        return Redirect::route('user.create')->with('error_message','Something went wrong. Try again.');
    }

    public function destroy($id){

        if(Auth::user()->id == 1){
            if($id == 1){
                return Redirect::route('user.index')->with('error_message','Cannot delete system account.');
            }
            $response = User::destroy('id','=',$id);
        }else{
            if(Auth::user()->id !== $id){
                return Redirect::route('user.index')->with('error_message','Invalid Request.');
            }
            $response = User::destroy('id','=',$id);
        }

        if($response){
            return Redirect::route('user.index')->with('success_message','Deleted Successfully');
        }else{
            return Redirect::route('user.index')->with('error_message','Something went wrong. Try again.');
        }
    }
}
