<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\UserRequest;
use App\Repository\User\User as UserRepo;
use DB;
use Yajra\DataTables\DataTables;

class UserController extends BackendController
{
    protected $user;
    function __construct()
    {
        $this->user = new UserRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bcrum = $this->bcrum('Data User');

        return view('backend.users.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {

            $user = $this->user->getUser();

            return DataTables::of($user)
                ->setRowId('idx')
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return view('datatables._action-user', [
                        'idx' => $user->kd_pegawai,
                        'name' => $user->nama_pegawai,
                        'edit_url' => route('users.edit', $user->kd_pegawai)
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {

        $bcrum = $this->bcrum('Create', route('users.index'), 'Data User');
        $roles = Role::pluck('name', 'name')->all();
        return view('backend.users.create', compact('user', 'roles', 'bcrum'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $this->notification('success','Perhatian!', 'User ' . $user->name . ' berhasil di buat!');

        return redirect()->route('users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bcrum = $this->bcrum('Details User', route('users.index'), 'Data User');

        $user = User::find($id);
        return view('backend.users.show', compact('user', 'bcrum'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bcrum = $this->bcrum('Edit', route('users.index'), 'Data User');

        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('backend.users.edit', compact('user', 'roles', 'bcrum'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));


        $this->notification('success','Perhatian', 'User ' . $user->name . ' berhasil di ubah!');

        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = User::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus User", ['name' => $delete->name]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus User", ['name' => $delete->name]);
        }
    }
}
