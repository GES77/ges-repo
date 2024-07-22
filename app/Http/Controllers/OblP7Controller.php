<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP7Controller extends Controller
{
    public function p7()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P7', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P7', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P7', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P7', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P7', Auth::user()->role_id);

        return view('panel.obl.p7.p7', $data);
    }
    public function add()
    {
        return view('panel.obl.p7.add');
    }
}
