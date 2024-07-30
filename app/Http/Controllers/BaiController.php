<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BaiController extends Controller
{
    public function bai()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAI', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAI', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAI', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAI', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAI', Auth::user()->role_id);
        $data['getRecord'] = Bai::getRecord();

        return view('panel.closing.bai.bai', $data);
    }
    public function add()
    {
        return view('panel.closing.bai.add');
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
        $dokumen->storeAs('bai', $dokumenName);
        Bai::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/bai')->with('success', 'Bai berhasil ditambah');
    }
    public function edit($id)
    {
        $bai = Bai::findOrFail($id);
        return view('panel.closing.bai.edit', compact('bai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $bai = Bai::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/bai/{$bai->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('bai', $dokumenName);

            // Update kontrak dengan dokumen baru
            $bai->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $bai->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/bai')->with('success', 'Bai berhasil diperbarui');
    }

    public function download(bai $dokumen)
    {
        $dokumenPath = storage_path("app/bai/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Bai tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Bai::findOrFail($id);
        $dokumenPath = storage_path("app/bai/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Bai tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $bai = Bai::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/bai/{$bai->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $bai->delete();

        return redirect('panel/closing/bai')->with('error', 'Bai berhasil dihapus');
    }
}
