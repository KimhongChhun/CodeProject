<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use Illuminate\Support\Facades\DB;
use DataTables;

class OrganController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Organ::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fas fa-pen text-white"></i></a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';

                return $btn;

            })
            ->rawColumns(['action'])->make(true);

        }

        return view('organAjax');
    }
    public function create()
    {
        $organ = Organ::get();
        return view('organs.create',compact('organ'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            Organ::createOrUpdate($input);

            return response()->json(['success'=>'Organization saved successfully.']);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organ = Organ::find($id);
        return response()->json($organ);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Organ::find($id)->delete();

        return response()->json(['success'=>'Organization deleted successfully.']);

    }

}
