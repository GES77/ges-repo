<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Oblkl;
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
        $data['getRecord'] = Oblkl::getRecord();

        return view('panel.obl.kl.kl', $data);
    }
    public function add()
    {
        return view('panel.obl.kl.add');
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
        $dokumen->storeAs('kl', $dokumenName);
        Oblkl::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/obl/kl')->with('success', 'KL/SP/WO berhasil ditambah');
    }
    public function edit($id)
    {
        $kl = Oblkl::findOrFail($id);
        return view('panel.obl.kl.edit', compact('kl'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $kl = Oblkl::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/kl/{$kl->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('kl', $dokumenName);

            // Update kontrak dengan dokumen baru
            $kl->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $kl->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/obl/kl')->with('success', 'KL/SP/WO berhasil diperbarui');
    }

    public function download(Oblkl $dokumen)
    {
        $dokumenPath = storage_path("app/kl/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'KL/SP/WO tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Oblkl::findOrFail($id);
        $dokumenPath = storage_path("app/kl/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "KL/SP/WO tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $kl = Oblkl::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/kl/{$kl->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $kl->delete();

        return redirect('panel/obl/kl')->with('error', 'KL/SP/WO berhasil dihapus');
    }
}
