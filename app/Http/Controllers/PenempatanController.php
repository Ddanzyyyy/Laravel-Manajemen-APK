<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penempatans = Penempatan::with('user')->get();
        $users = \App\Models\User::ditugaskan()
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->whereNotNull('Jabatan')
            ->where('Jabatan', '!=', '')
            ->get();
        $title = 'Data Penempatan';
        return view('penempatan.index', compact('penempatans', 'users', 'title'));
    }

    public function create()
    {
        $users = \App\Models\User::ditugaskan()
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->whereNotNull('Jabatan')
            ->where('Jabatan', '!=', '')
            ->get();
        $title = 'Tambah Penempatan';
        return view('penempatan.create', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'keterangan' => 'required|string',
            'foto_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->only('user_id', 'keterangan');
        if ($request->hasFile('foto_tugas')) {
            $file = $request->file('foto_tugas');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/penempatan', $filename);
            $data['foto_tugas'] = $filename;
        }
        Penempatan::create($data);
        return redirect()->route('penempatan.index')->with('success', 'Penempatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penempatan = Penempatan::findOrFail($id);
        $users = \App\Models\User::ditugaskan()
            ->whereNotNull('name')
            ->where('name', '!=', '')
            ->whereNotNull('jabatan')
            ->where('jabatan', '!=', '')
            ->get();
        $title = 'Edit Penempatan';
        return view('penempatan.edit', compact('penempatan', 'users', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'keterangan' => 'required|string',
            'foto_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $penempatan = Penempatan::findOrFail($id);
        $data = $request->only('user_id', 'keterangan');
        if ($request->hasFile('foto_tugas')) {
            $file = $request->file('foto_tugas');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/penempatan', $filename);
            $data['foto_tugas'] = $filename;
        }
        $penempatan->update($data);
        return redirect()->route('penempatan.index')->with('success', 'Penempatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $penempatan = Penempatan::findOrFail($id);
        $penempatan->delete();
        return redirect()->route('penempatan.index')->with('success', 'Penempatan berhasil dihapus');
    }

}
