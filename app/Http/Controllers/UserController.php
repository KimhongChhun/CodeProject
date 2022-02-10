<?php
    
// namespace App\Http\Controllers;
    
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Spatie\Permission\Models\Role;
// use DB;
// use Hash;
// use Illuminate\Support\Arr;
// use DataTables;
// use App\DataTables\UserDataTable;

// class UserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index(Request $request)
//     {
//         $data = User::orderBy('id','DESC')->paginate(5);
//         return view('users.index',compact('data'))
//             ->with('i', ($request->input('page', 1) - 1) * 5);
//     }
    
//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         $roles = Role::pluck('name','name')->all();
//         return view('users.create',compact('roles'));
//     }
    
//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $this->validate($request, [
//             'name' => 'required',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|same:confirm-password',
//             'roles' => 'required'
//         ]);
    
//         $input = $request->all();
//         $input['password'] = Hash::make($input['password']);
    
//         $user = User::create($input);
//         $user->assignRole($request->input('roles'));
    
//         return redirect()->route('users.index')
//                         ->with('success','User created successfully');
//     }
    
//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         $user = User::find($id);
//         return view('users.show',compact('user'));
//     }
    
//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         $user = User::find($id);
//         $roles = Role::pluck('name','name')->all();
//         $userRole = $user->roles->pluck('name','name')->all();
    
//         return view('users.edit',compact('user','roles','userRole'));
//     }
    
//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         $this->validate($request, [
//             'name' => 'required',
//             'email' => 'required|email|unique:users,email,'.$id,
//             'password' => 'same:confirm-password',
//             'roles' => 'required'
//         ]);
    
//         $input = $request->all();
//         if(!empty($input['password'])){ 
//             $input['password'] = Hash::make($input['password']);
//         }else{
//             $input = Arr::except($input,array('password'));    
//         }
    
//         $user = User::find($id);
//         $user->update($input);
//         DB::table('model_has_roles')->where('model_id',$id)->delete();
    
//         $user->assignRole($request->input('roles'));
    
//         return redirect()->route('users.index')
//                         ->with('success','User updated successfully');
//     }
    
//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         User::find($id)->delete();
//         return redirect()->route('users.index')
//                         ->with('success','User deleted successfully');
//     }
// }


 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DataTables;


class UserController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fas fa-pen text-white"></i></a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';

                return $btn;

            })
            ->rawColumns(['action'])->make(true);

        }

        return view('userAjax');
    }   
    public function create()
    {
        $user = User::get();
        return view('users.create',compact('user'));
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
            User::createOrUpdate($input);        
            
            return response()->json(['success'=>'User saved successfully.']);
        } catch(Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
     
        return response()->json(['success'=>'User deleted successfully.']);
    }
}
 
