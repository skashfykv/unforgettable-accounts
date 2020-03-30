<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use Illuminate\Support\Facades\Redirect;

class ExpenseCategoryController extends Controller
{
    public function index(){
        return view('expense-category.index')->with('data',ExpenseCategory::all());
    }

    public function create(){
        return view('expense-category.create');
    }

    public function store(Request $request){

        $this->validate($request, ['name'  => 'required|unique:expense_category']);
        $season = new ExpenseCategory();
        $season->name = $request->name;
        if($season->save()){
            return Redirect::route('expense-category.create')->with('success_message','Created Successfully');
        }
        return Redirect::route('expense-category.create')->with('error_message','Something went wrong. Try again.');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $data = ExpenseCategory::find($id);
        if(!$data || !isset($data->id)){
            return view('404');
        }
        return view('expense-category.edit')->with(['data' => $data,'id' => $id]);
    }

    public function update(Request $request, $id){

        $this->validate($request, ['name'  => 'required|unique:expense_category,name,'.$id]);
        ExpenseCategory::where('id','=', $id)->update(
            array(
                'name'  => $request->name
            ));
        return Redirect::route('expense-category.edit',$id)->with('success_message','Updated Successfully');
    }

    public function destroy($id){
        $response = ExpenseCategory::destroy('id','=',$id);
        if($response){
            return Redirect::route('expense-category.index')->with('success_message','Deleted Successfully');
        }else{
            return Redirect::route('expense-category.index')->with('error_message','Something went wrong. Try again.');
        }
    }
}
