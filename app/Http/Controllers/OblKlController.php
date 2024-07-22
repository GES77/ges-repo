<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class OblKlController extends Controller
{
    public function kl()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add KL', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit KL', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download KL', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview KL', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete KL', Auth::user()->role_id);

        return view('panel.obl.kl.kl', $data);
    }
    public function add()
    {
        return view('panel.obl.kl.add');
    }
}
