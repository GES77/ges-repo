<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP4Controller extends Controller
{
    public function p4()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P4', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P4', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P4', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P4', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P4', Auth::user()->role_id);

        return view('panel.obl.p4.p4', $data);
    }
    public function add()
    {
        return view('panel.obl.p4.add');
    }
}
