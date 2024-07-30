<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baso;
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
        $data['getRecord'] = Baso::getRecord();

        return view('panel.closing.baso.baso', $data);
    }
    public function add()
    {
        return view('panel.closing.baso.add');
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
        $dokumen->storeAs('baso', $dokumenName);
        Baso::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/baso')->with('success', 'Baso berhasil ditambah');
    }
    public function edit($id)
    {
        $baso = Baso::findOrFail($id);
        return view('panel.closing.baso.edit', compact('baso'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $baso = Baso::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/baso/{$baso->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('baso', $dokumenName);

            // Update kontrak dengan dokumen baru
            $baso->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $baso->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/baso')->with('success', 'Baso berhasil diperbarui');
    }

    public function download(baso $dokumen)
    {
        $dokumenPath = storage_path("app/baso/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Baso tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Baso::findOrFail($id);
        $dokumenPath = storage_path("app/baso/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Baso tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $baso = Baso::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/baso/{$baso->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $baso->delete();

        return redirect('panel/closing/baso')->with('error', 'Baso berhasil dihapus');
    }
}
