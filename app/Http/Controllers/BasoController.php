<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BasoController extends Controller
{
    public function baso()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BASO', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BASO', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BASO', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BASO', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BASO', Auth::user()->role_id);

        return view('panel.closing.baso.baso', $data);
    }
    public function add()
    {
        return view('panel.closing.baso.add');
    }
}
