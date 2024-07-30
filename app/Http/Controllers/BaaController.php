<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class BaaController extends Controller
{
    public function baa()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add BAA', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit BAA', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download BAA', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview BAA', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete BAA', Auth::user()->role_id);
        $data['getRecord'] = Baa::getRecord();

        return view('panel.closing.baa.baa', $data);
    }
    public function add()
    {
        return view('panel.closing.baa.add');
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
        $dokumen->storeAs('baa', $dokumenName);
        Baa::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/closing/baa')->with('success', 'Baa berhasil ditambah');
    }
    public function edit($id)
    {
        $baa = Baa::findOrFail($id);
        return view('panel.closing.baa.edit', compact('baa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $baa = Baa::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/baa/{$baa->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('baa', $dokumenName);

            // Update kontrak dengan dokumen baru
            $baa->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $baa->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/closing/baa')->with('success', 'Baa berhasil diperbarui');
    }

    public function download(Baa $dokumen)
    {
        $dokumenPath = storage_path("app/baa/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Baa tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Baa::findOrFail($id);
        $dokumenPath = storage_path("app/baa/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Baa tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $baa = Baa::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/baa/{$baa->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $baa->delete();

        return redirect('panel/closing/baa')->with('error', 'Baa berhasil dihapus');
    }
}
