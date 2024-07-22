<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BaiController extends Controller
{
    public function bai()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAI', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAI', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAI', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAI', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAI', Auth::user()->role_id);

        return view('panel.closing.bai.bai', $data);
    }
    public function add()
    {
        return view('panel.closing.bai.add');
    }
}
