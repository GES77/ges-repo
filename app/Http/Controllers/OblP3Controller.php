<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP3Controller extends Controller
{
    public function p3()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P3', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P3', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P3', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P3', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P3', Auth::user()->role_id);

        return view('panel.obl.p3.p3', $data);
    }
    public function add()
    {
        return view('panel.obl.p3.add');
    }
}
