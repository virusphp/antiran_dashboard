<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Backend\BackendController as Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('permission:read-role');
        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bcrum = $this->bcrum('Daftar Role');
        return view('backend.roles.index', compact('bcrum'));
    }

    public function indexAjax(Request $request)
    {
        if ($request->ajax()) {

            $roles = Role::select('id','name')->get();

            return DataTables::of($roles)
                ->setRowId('idx')
                ->addIndexColumn()
                ->addColumn('action', function ($roles) {
                    return view('datatables._action-role', [
                        'idx' => $roles->id,
                        'name' => $roles->name,
                        'edit_url' => route('roles.edit', $roles->id),
                        'show_url' => route('roles.show', $roles->id)
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
    public function create()
    {
        $permission = Permission::get();
        $bcrum = $this->bcrum('Create', route('roles.index'), 'Roles');
        return view('backend.roles.create', compact('permission', 'bcrum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        $this->notification('success','Perhatian!', 'Role created successfully');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $bcrum = $this->bcrum('Role Details',route('roles.index'),'Data Roles');

        $role = Role::find($id);
        
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('backend.roles.show',compact('role','rolePermissions','bcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bcrum = $this->bcrum('Edit Role', route('roles.index'), 'Roles');

        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('backend.roles.edit', compact('role', 'bcrum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        $this->notification('success','Perhatian!', 'Role Berhasil Diubah');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxDestroy(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $delete = Role::findOrFail($input['idx']);
            $delete->delete();
            if ($delete) {
                return response()->jsonSuccess(200, "Sukses Menghapus Role", ['name' => $delete->name]);
            }
            return response()->jsonSuccess(201, "Gagal Menghapus Role", ['name' => $delete->name]);
        }
    }

    public function check($id)
    {
        $data['role'] = Role::where('id', $id)->select('name')->first();
        $data['permission'] = Permission::select('id', 'name')->get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return response()->json($data, 200);
    }
}
