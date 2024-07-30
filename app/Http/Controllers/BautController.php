<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baut;
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
        $data['getRecord'] = Baut::getRecord();

        return view('panel.closing.baut.baut', $data);
    }
    public function add()
    {
        return view('panel.closing.baut.add');
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
        $dokumen->storeAs('baut', $dokumenName);
        Baut::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/baut')->with('success', 'Baut berhasil ditambah');
    }
    public function edit($id)
    {
        $baut = Baut::findOrFail($id);
        return view('panel.closing.baut.edit', compact('baut'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $baut = Baut::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/baut/{$baut->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('baut', $dokumenName);

            // Update kontrak dengan dokumen baru
            $baut->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $baut->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/baut')->with('success', 'Baut berhasil diperbarui');
    }

    public function download(baut $dokumen)
    {
        $dokumenPath = storage_path("app/baut/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Baut tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Baut::findOrFail($id);
        $dokumenPath = storage_path("app/baut/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Baut tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $baut = Baut::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/baut/{$baut->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $baut->delete();

        return redirect('panel/closing/baut')->with('error', 'Baut berhasil dihapus');
    }
}
