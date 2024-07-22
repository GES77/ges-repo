<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BautController extends Controller
{
    public function baut()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAUT', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAUT', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAUT', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAUT', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAUT', Auth::user()->role_id);

        return view('panel.closing.baut.baut', $data);
    }
    public function add()
    {
        return view('panel.closing.baut.add');
    }
}
