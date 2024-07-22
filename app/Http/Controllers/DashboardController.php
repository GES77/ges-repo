<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $currentUser = Auth::user();
        $roleName = DB::table('users')
            ->join('role', 'users.role_id', '=', 'role.nama')
            ->where('users.id', $currentUser->id)
            ->value('role.nama'); // Asumsikan kolom nama peran adalah 'name'

        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete User', Auth::user()->role_id);
        $data['getRecord'] = User::getRecord();
        return view('panel.user.dashboard', $data, compact('currentUser', 'roleName'));
    }

    public function add()
    {
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.add', $data);
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.edit', $data);
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'nama' => ['required', 'min:3', 'string'],
                'username' => ['required', 'alpha_dash', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'role_id' => ['required'],

            ],
            [
                'username.required' => '*Isi username terlebih dahulu.',
                'username.alpha_dash' => '*Username hanya boleh mengandung huruf, angka, tanda hubung, dan garis bawah.',
                'username.unique' => '*Username telah pernah dibuat.',
                'password.required' => '*Isi password terlebih dahulu.',
                'password.min' => '*Password minimal harus 8 karakter.',
                'nama.required' => '*Isi nama terlebih dahulu.',
                'role_id.required' => '*Pilih role terlebih dahulu.',
            ]
        );

        $user = new User;
        $user->nama = trim($request->nama);
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('success', "User berhasil dibuat");
    }

    public function update($id, Request $request)
    {
        $user = User::getSingle($id);
        $user->nama = trim($request->nama);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('success', "User berhasil diedit");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->delete();

        return redirect('panel/user')->with('error', "User berhasil dihapus");
    }
}
