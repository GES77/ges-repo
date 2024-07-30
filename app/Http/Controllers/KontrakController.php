<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
use App\Models\Kontrak;

class KontrakController extends Controller
{
    public function kontrak()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add kontrak', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit kontrak', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download kontrak', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview kontrak', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete kontrak', Auth::user()->role_id);
        $data['getRecord'] = Kontrak::getRecord();
        return view('panel.kontrak.kontrak', $data);
    }
    public function add()
    {
        return view('panel.kontrak.add');
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
        $dokumen->storeAs('kontrak', $dokumenName);
        Kontrak::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/kontrak')->with('success', 'Kontrak berhasil ditambah');
    }
    public function edit($id)
    {
        $kontrak = Kontrak::findOrFail($id);
        return view('panel.kontrak.edit', compact('kontrak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $kontrak = Kontrak::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/kontrak/{$kontrak->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('kontrak', $dokumenName);

            // Update kontrak dengan dokumen baru
            $kontrak->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $kontrak->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/kontrak')->with('success', 'Kontrak berhasil diperbarui');
    }

    public function download(Kontrak $dokumen)
    {
        $dokumenPath = storage_path("app/kontrak/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'Kontrak tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Kontrak::findOrFail($id);
        $dokumenPath = storage_path("app/kontrak/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "Kontrak tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }



    public function delete($id)
    {
        $kontrak = Kontrak::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/kontrak/{$kontrak->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $kontrak->delete();

        return redirect('panel/kontrak')->with('error', 'Kontrak berhasil dihapus');
    }
}
