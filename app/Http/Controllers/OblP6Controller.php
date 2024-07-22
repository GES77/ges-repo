<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP6Controller extends Controller
{
    public function p6()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P6', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P6', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P6', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P6', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P6', Auth::user()->role_id);

        return view('panel.obl.p6.p6', $data);
    }
    public function add()
    {
        return view('panel.obl.p6.add');
    }
}
