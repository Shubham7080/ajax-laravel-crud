<?php

namespace App\Http\Controllers;

use \App\Models\Post;

use Illuminate\Http\Request;
use DataTables;
use Validator;

class FormController extends Controller
{
    function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required'
        ]);
        if ($validator->passes()) {
            $post_id = $request->post_id;
            $data['title'] = $request->title;
            $data['description'] = $request->desc;
            $post_id = $request->post_id;
            if(!empty($post_id)){
                $resp = Post::where('id',$post_id)->update($data);                
                if($resp) {
                    $response = array("status" => true, "code" => 200, "message" => "data updated successfully");
                } else {
                    $response = array("status" => false, "code" => 201, "message" => "data 
                    not update successfully");
                }
            }else{
                $res = Post::insertGetId($data);
                if ($res) {
                    $response = array("status" => true, "code" => 200, "message" => "data inserted successfully");
                } else {
                    $response = array("status" => false, "code" => 201, "message" => "data 
                    not inserted successfully");
                } 
            }
        } else {
            $response = array("status" => false, "code" => 301, "message" => $validator->errors()->all());
        }
        return $response;
    }
    //function for show data in yajra table
    function show_data(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" onclick="editdata('.$row->id.')" class="btn btn-sm btn-primary">Edit</a> <a href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('action1', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" onclick="editdata('.$row->id.')" class="btn btn-sm btn-primary">Edit</a> <a href="javascript:void(0)" onclick="delete_data('.$row->id.')" class="btn btn-sm btn-danger">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'action1'])
                ->make(true);
        }
    }
    //end of function 
    function delete_data(Request $request)
    {
        $data = Post::where('id',$request->id)->delete();
        if($data){
            $response = array("code"=>200,"status"=>true,"message"=>"data deleted successfully");
        }
        else{
            $response = array("code"=>201,"status"=>false,"message"=>"data not deleted successfully");
        }
        return $response;
    }
    function edit_data(Request $request){
        $data = Post::where('id',$request->id)->first(['id','title','description']);

        if($data){
            $response =array(
                "code"=>200,
                "status"=>true,
                "data"=>$data
            );
        }
        else{
            $response =array(
                "code"=>201,
                "status"=>false,
                "data"=>[],
                "message"=>"can't edit"
            );

        }
        return $response;

    }
}
