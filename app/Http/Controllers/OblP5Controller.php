<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP5Controller extends Controller
{
    public function p5()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P5', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P5', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P5', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P5', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P5', Auth::user()->role_id);

        return view('panel.obl.p5.p5', $data);
    }
    public function add()
    {
        return view('panel.obl.p5.add');
    }
}
