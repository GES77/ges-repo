<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
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
        $data['getRecord'] = Berita::getRecord();

        return view('panel.ba.ba', $data);
    }
    public function add()
    {
        return view('panel.ba.add');
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
        $dokumen->storeAs('berita', $dokumenName);
        Berita::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/ba')->with('success', 'Berita Acara berhasil ditambah');
    }
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('panel.ba.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $berita = Berita::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/berita/{$berita->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('berita', $dokumenName);

            // Update kontrak dengan dokumen baru
            $berita->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $berita->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/ba')->with('success', 'Berita Acara berhasil diperbarui');
    }

    public function download(Berita $dokumen)
    {
        $dokumenPath = storage_path("app/berita/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Berita Acara tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Berita::findOrFail($id);
        $dokumenPath = storage_path("app/berita/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Berita Acara tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }



    public function delete($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/berita/{$berita->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $berita->delete();

        return redirect('panel/ba')->with('error', 'Berita Acara berhasil dihapus');
    }
}
