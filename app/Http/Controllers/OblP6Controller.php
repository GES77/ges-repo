<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Oblp6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP6Controller extends Controller
{
    public function p6()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P6', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P6', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P6', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P6', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P6', Auth::user()->role_id);
        $data['getRecord'] = Oblp6::getRecord();

        return view('panel.obl.p6.p6', $data);
    }
    public function add()
    {
        return view('panel.obl.p6.add');
    }
    public function insert(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'required|mimes:pdf|max:10240',
        ],[
            'nama_file.required' => '*Isi nama file terlebih dahulu.',
            'nama_file.max:255' => '*Nama file tidak boleh lebih dari 255 karakter.',
            'dokumen.required' => '*Pilih file terlebih dahulu.',
            'dokumen.mimes:pdf' => '*Tipe file harus dalam bentuk pdf.',

        ]);
        // HASH NAMA DOKUMEN
        $dokumen = $request->file('dokumen');
        $dokumenName = $dokumen->hashName();
        $dokumen->storeAs('p6', $dokumenName);
        Oblp6::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/obl/p6')->with('success', 'P6 berhasil ditambah');
    }
    public function edit($id)
    {
        $p6 = Oblp6::findOrFail($id);
        return view('panel.obl.p6.edit', compact('p6'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $p6 = Oblp6::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/p6/{$p6->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('p6', $dokumenName);

            // Update kontrak dengan dokumen baru
            $p6->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $p6->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/obl/p6')->with('success', 'P6 berhasil diperbarui');
    }

    public function download(Oblp6 $dokumen)
    {
        $dokumenPath = storage_path("app/p6/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'P6 tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Oblp6::findOrFail($id);
        $dokumenPath = storage_path("app/p6/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "P6 tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $p6 = Oblp6::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/p6/{$p6->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $p6->delete();

        return redirect('panel/obl/p6')->with('error', 'P6 berhasil dihapus');
    }
}
