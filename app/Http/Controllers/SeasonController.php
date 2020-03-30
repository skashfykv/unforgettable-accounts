<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Season;
use Illuminate\Support\Facades\Redirect;

class SeasonController extends Controller
{
    public function index(){
        return view('season.index')->with('data',Season::all());
    }

    public function create(){
        return view('season.create');
    }

    public function store(Request $request){

        $this->validate($request, ['name'  => 'required|unique:seasons']);
        $season = new Season();
        $season->name = $request->name;
        if($season->save()){
            return Redirect::route('season.create')->with('success_message','Created Successfully');
        }
        return Redirect::route('season.create')->with('error_message','Something went wrong. Try again.');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $data = Season::find($id);
        if(!$data || !isset($data->id)){
            return view('404');
        }
        return view('season.edit')->with(['data' => $data,'id' => $id]);
    }

    public function update(Request $request, $id){

        $this->validate($request, ['name'  => 'required|unique:seasons,name,'.$id]);
        Season::where('id','=', $id)->update(
            array(
                'name'  => $request->name
            ));
        return Redirect::route('season.edit',$id)->with('success_message','Updated Successfully');
    }

    public function destroy($id){
        $response = Season::destroy('id','=',$id);
        if($response){
            return Redirect::route('season.index')->with('success_message','Deleted Successfully');
        }else{
            return Redirect::route('season.index')->with('error_message','Something went wrong. Try again.');
        }
    }
}
