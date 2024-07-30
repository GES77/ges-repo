<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Oblp8;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP8Controller extends Controller
{
    public function p8()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P8', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P8', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P8', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P8', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P8', Auth::user()->role_id);
        $data['getRecord'] = Oblp8::getRecord();

        return view('panel.obl.p8.p8', $data);
    }
    public function add()
    {
        return view('panel.obl.p8.add');
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
        $dokumen->storeAs('p8', $dokumenName);
        Oblp8::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/obl/p8')->with('success', 'P8 berhasil ditambah');
    }
    public function edit($id)
    {
        $p8 = Oblp8::findOrFail($id);
        return view('panel.obl.p8.edit', compact('p8'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $p8 = Oblp8::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/p8/{$p8->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('p8', $dokumenName);

            // Update kontrak dengan dokumen baru
            $p8->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $p8->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/obl/p8')->with('success', 'P8 berhasil diperbarui');
    }

    public function download(Oblp8 $dokumen)
    {
        $dokumenPath = storage_path("app/p8/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'P8 tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Oblp8::findOrFail($id);
        $dokumenPath = storage_path("app/p8/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "P8 tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }

    public function delete($id)
    {
        $p8 = Oblp8::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/p8/{$p8->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $p8->delete();

        return redirect('panel/obl/p8')->with('error', 'P8 berhasil dihapus');
    }
}
