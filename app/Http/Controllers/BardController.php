<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bard;
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
        $data['getRecord'] = Bard::getRecord();

        return view('panel.closing.bard.bard', $data);
    }
    public function add()
    {
        return view('panel.closing.bard.add');
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
        $dokumen->storeAs('bard', $dokumenName);
        Bard::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/bard')->with('success', 'Bard berhasil ditambah');
    }
    public function edit($id)
    {
        $bard = Bard::findOrFail($id);
        return view('panel.closing.bard.edit', compact('bard'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $bard = Bard::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/bard/{$bard->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('bard', $dokumenName);

            // Update kontrak dengan dokumen baru
            $bard->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $bard->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/bard')->with('success', 'Bard berhasil diperbarui');
    }

    public function download(bard $dokumen)
    {
        $dokumenPath = storage_path("app/bard/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Bard tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Bard::findOrFail($id);
        $dokumenPath = storage_path("app/bard/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Bard tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $bard = Bard::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/bard/{$bard->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $bard->delete();

        return redirect('panel/closing/bard')->with('error', 'Bard berhasil dihapus');
    }
}
