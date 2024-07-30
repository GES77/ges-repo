<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BastController extends Controller
{
    public function bast()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAST', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAST', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAST', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAST', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAST', Auth::user()->role_id);
        $data['getRecord'] = Bast::getRecord();

        return view('panel.closing.bast.bast', $data);
    }
    public function add()
    {
        return view('panel.closing.bast.add');
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
        $dokumen->storeAs('bast', $dokumenName);
        Bast::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/bast')->with('success', 'Bast berhasil ditambah');
    }
    public function edit($id)
    {
        $bast = Bast::findOrFail($id);
        return view('panel.closing.bast.edit', compact('bast'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $bast = Bast::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/bast/{$bast->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('bast', $dokumenName);

            // Update kontrak dengan dokumen baru
            $bast->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $bast->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/bast')->with('success', 'Bast berhasil diperbarui');
    }

    public function download(bast $dokumen)
    {
        $dokumenPath = storage_path("app/bast/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Bast tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Bast::findOrFail($id);
        $dokumenPath = storage_path("app/bast/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Bast tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $bast = Bast::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/bast/{$bast->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $bast->delete();

        return redirect('panel/closing/bast')->with('error', 'Bast berhasil dihapus');
    }
}
