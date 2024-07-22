<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class BeritaAcaraController extends Controller
{
    public function berita()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BA', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BA', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BA', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BA', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BA', Auth::user()->role_id);

        return view('panel.ba.ba', $data);
    }
    public function add()
    {
        return view('panel.ba.add');
    }
}
