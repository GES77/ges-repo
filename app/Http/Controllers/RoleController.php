<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    // MENGAMBIL DAN MENAMMPILKAN DATA ROLE
    public function list()
    {
        $PermissionRole = PermissionRoleModel::getPermission('Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);
        $data['getRecord'] = RoleModel::getRecord();

        return view('panel.role.list', $data);
    }
    // MENGAMBIL DAN MENAMMPILKAN DATA ROLE


    public function add()
    {
        $PermissionRole = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        $getPermission = PermissionModel::getRecord();
        $data['getPermission'] = $getPermission;
        return view('panel.role.add', $data );
    }

    // MENAMBAHKAN ROLE BARU
    public function insert(Request $request)
    {
        $PermissionRole = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        // dd($request->all());
        $save = new RoleModel;
        $save->nama = $request->nama;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/role')->with('success', "Role berhasil dibuat");
    }
    // MENAMBAHKAN ROLE BARU

    // MENGEDIT DATA ROLE
    public function edit($id)
    {
        $PermissionRole = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        // $getPermission = PermissionModel::getRecord();
        $data['getRecord'] = RoleModel::getSingle($id);
        $data['getPermission'] = PermissionModel::getRecord();
        $data['getRolePermission'] = PermissionRoleModel::getRolePermission($id);
        return view('panel.role.edit', $data);
    }
    // MENGEDIT DATA ROLE

    // MENGUPDATE ROLE BARU
    public function update($id, Request $request)
    {
        $PermissionRole = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        $save = RoleModel::getSingle($id);
        $save->nama = $request->nama;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/role')->with('success', "Role berhasil diedit");
    }
    // MENGUPDATE ROLE BARU

    // MENGHAPUS ROLE BARU
    public function delete($id, Request $request)
    {
        $PermissionRole = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);
        if (empty($PermissionRole))
        {
            abort(404);
        }
        $save = RoleModel::getSingle($id);
        $save->delete();


        return redirect('panel/role')->with('error', "Role berhasil dihapus");
    }
    // MENGHAPUS ROLE BARU

}
