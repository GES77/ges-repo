<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Oblp2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
class OblP2Controller extends Controller
{
    public function p2()
    {
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add P2', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit P2', Auth::user()->role_id);
        $data['PermissionDownload'] = PermissionRoleModel::getPermission('Download P2', Auth::user()->role_id);
        $data['PermissionPreview'] = PermissionRoleModel::getPermission('Preview P2', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete P2', Auth::user()->role_id);
        $data['getRecord'] = Oblp2::getRecord();

        return view('panel.obl.p2.p2', $data);
    }
    public function add()
    {
        return view('panel.obl.p2.add');
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
        $dokumen->storeAs('p2', $dokumenName);
        Oblp2::create([
            'nama_file' => $request->input('nama_file'),
            'dokumen' => $dokumen->getClientOriginalName(),
            'hash_dokumen' => $dokumenName,
            'uploader' => Auth::user()->nama,
        ]);

        return redirect('panel/obl/p2')->with('success', 'P2 berhasil ditambah');
    }
    public function edit($id)
    {
        $p2 = Oblp2::findOrFail($id);
        return view('panel.obl.p2.edit', compact('p2'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'dokumen' => 'nullable|mimes:pdf|max:10240',
        ]);

        $p2 = Oblp2::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            // Hapus dokumen lama
            $oldDokumenPath = storage_path("app/p2/{$p2->hash_dokumen}");
            if (file_exists($oldDokumenPath)) {
                unlink($oldDokumenPath);
            }

            // Hash nama dokumen baru
            $dokumen = $request->file('dokumen');
            $dokumenName = $dokumen->hashName();
            $dokumen->storeAs('p2', $dokumenName);

            // Update kontrak dengan dokumen baru
            $p2->update([
                'nama_file' => $request->input('nama_file'),
                'dokumen' => $dokumen->getClientOriginalName(),
                'hash_dokumen' => $dokumenName,
            ]);
        } else {
            // Update kontrak tanpa mengubah dokumen
            $p2->update([
                'nama_file' => $request->input('nama_file'),
            ]);
        }

        return redirect('panel/obl/p2')->with('success', 'P2 berhasil diperbarui');
    }

    public function download(Oblp2 $dokumen)
    {
        $dokumenPath = storage_path("app/p2/{$dokumen->hash_dokumen}");

        if (file_exists($dokumenPath)) {
            return response()->download($dokumenPath, $dokumen->dokumen);
        } else {
            abort(404, 'P2 tidak ditemukan');
        }
    }

    public function preview($id)
    {
        $dokumen = Oblp2::findOrFail($id);
        $dokumenPath = storage_path("app/p2/{$dokumen->hash_dokumen}");

        if (!file_exists($dokumenPath)) {
            abort(404, "P2 tidak ditemukan");
        }
        return response()->file($dokumenPath);
    }



    public function delete($id)
    {
        $p2 = Oblp2::findOrFail($id);

        // Hapus file dokumen
        $dokumenPath = storage_path("app/p2/{$p2->hash_dokumen}");
        if (file_exists($dokumenPath)) {
            unlink($dokumenPath);
        }

        // Hapus kontrak dari database
        $p2->delete();

        return redirect('panel/obl/p2')->with('error', 'P2 berhasil dihapus');
    }
}
