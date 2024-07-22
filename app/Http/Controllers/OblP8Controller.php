<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP8Controller extends Controller
{
    public function p8()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P8', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P8', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P8', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P8', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P8', Auth::user()->role_id);

        return view('panel.obl.p8.p8', $data);
    }
    public function add()
    {
        return view('panel.obl.p8.add');
    }
}
