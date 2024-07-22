<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class KontrakController extends Controller
{
    public function kontrak()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add kontrak', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit kontrak', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download kontrak', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview kontrak', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete kontrak', Auth::user()->role_id);

        return view('panel.kontrak.kontrak', $data);
    }
    public function add()
    {
        return view('panel.kontrak.add');
    }
}
