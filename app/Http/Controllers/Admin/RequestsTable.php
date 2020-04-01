<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestsTable extends Controller
{
    public function index(){
        return view('admin.requestsTable');
    }

    public function getRequests(){
        $requests =\App\Request::all();
        return response($requests,200);
    }
    public function deleteRequests($id){
        \App\Request::destroy($id);
        return response(null,200);

    }
    public function updateRequests(Request $request,$id){

        if ($request['isImportant'] == 1){
            \App\Request::whereId($id)->update(['important'=>false]);
        }
        else{
            \App\Request::whereId($id)->update(['important'=>true]);
        }
        return response(null,200);
    }
}
