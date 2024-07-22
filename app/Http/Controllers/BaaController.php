<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BaaController extends Controller
{
    public function baa()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAA', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAA', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAA', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAA', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAA', Auth::user()->role_id);

        return view('panel.closing.baa.baa', $data);
    }
    public function add()
    {
        return view('panel.closing.baa.add');
    }
}
