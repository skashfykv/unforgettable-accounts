<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function index(){
        return view('brand.index')->with('data',Brand::all());
    }

    public function create(){
        return view('brand.create');
    }

    public function store(Request $request){

        $this->validate($request, ['name'  => 'required|unique:brands']);
        $brand = new Brand();
        $brand->name = $request->name;
        if($brand->save()){
            return Redirect::route('brand.create')->with('success_message','Created Successfully');
        }
        return Redirect::route('brand.create')->with('error_message','Something went wrong. Try again.');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $data = Brand::find($id);
        if(!$data || !isset($data->id)){
            return view('404');
        }
        return view('brand.edit')->with(['data' => $data,'id' => $id]);
    }

    public function update(Request $request, $id){

        $this->validate($request, ['name'  => 'required|unique:brands,name,'.$id]);
        Brand::where('id','=', $id)->update(
            array(
                'name'  => $request->name
            ));
        return Redirect::route('brand.edit',$id)->with('success_message','Updated Successfully');
    }

    public function destroy($id){
        $response = Brand::destroy('id','=',$id);
        if($response){
            return Redirect::route('brand.index')->with('success_message','Deleted Successfully');
        }else{
            return Redirect::route('brand.index')->with('error_message','Something went wrong. Try again.');
        }
    }
}
