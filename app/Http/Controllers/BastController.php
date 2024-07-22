<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BastController extends Controller
{
    public function bast()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAST', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAST', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAST', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAST', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAST', Auth::user()->role_id);

        return view('panel.closing.bast.bast', $data);
    }
    public function add()
    {
        return view('panel.closing.bast.add');
    }
}
