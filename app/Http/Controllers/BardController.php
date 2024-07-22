<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BardController extends Controller
{
    public function bard()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BARD', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BARD', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BARD', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BARD', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BARD', Auth::user()->role_id);

        return view('panel.closing.bard.bard', $data);
    }
    public function add()
    {
        return view('panel.closing.bard.add');
    }
}
