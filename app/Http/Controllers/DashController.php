<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dash;
use Illuminate\Support\Facades\DB;
use DataTables;

class DashController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Dash::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrgan"><i class="fas fa-pen text-white"></i></a>';
            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrgan"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';

            return $btn;

        })
        ->rawColumns(['action'])->make(true);
        }
        return view('dashAjax');
    }
}
