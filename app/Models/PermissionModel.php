<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory;

    protected $table = 'permission';

    static public function getSingle($id)
    {
        return RoleModel::find($id);
    }

    static public function getRecord()
    {
        $getPermission = PermissionModel::groupBy('groupby')->get();
        $result = array();
        foreach ($getPermission as $value)
        {
            $getPermissionGroup = PermissionModel::getPermissionGroup($value->groupby);
            $data = array();
            $data['id'] = $value->id;
            $data['nama'] = $value->nama;
            $group = array();
            foreach($getPermissionGroup as $valueG)
            {
                $dataG = array();
                $dataG['id'] = $valueG->id;
                $dataG['nama'] = $valueG->nama ;
                $group[] = $dataG;
            }
            $data['group'] = $group;
            $result[] = $data;
        }
        return $result;
    }

    static public function getPermissionGroup($groupby)
    {
        return PermissionModel::where('groupby', '=', $groupby)->get();
    }
}
