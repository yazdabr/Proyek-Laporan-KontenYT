<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pro;
use App\Models\Operator;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with(['pro', 'operatorA', 'operatorB'])->orderBy('tanggal', 'desc');

        // 🔍 Filter teks (opsional jika kamu masih punya input search manual)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('acara', 'like', "%{$search}%")
                ->orWhere('topik', 'like', "%{$search}%");
            });
        }

        // 🎯 Filter acara dari select2
        if ($request->filled('acara')) {
            $query->where('acara', $request->acara);
        }

        // 🎯 Filter topik dari select2
        if ($request->filled('topik')) {
            $query->where('topik', $request->topik);
        }

        // 📅 Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // 👤 Filter operator
        if ($request->filled('operator')) {
            $operator = $request->operator;
            $query->where(function ($q) use ($operator) {
                $q->where('operator_a', $operator)
                ->orWhere('operator_b', $operator);
            });
        }

        // Pagination dan simpan query string
        $laporan = $query->paginate(5)->appends($request->all());

        // Ambil semua operator untuk dropdown select2
        $operators = \App\Models\Operator::orderBy('nama_operator')->get();

        return view('laprekap', compact('laporan', 'operators'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_pro' => 'required',
            'acara' => 'required|string',
            'topik' => 'required|string',
            'narasumber' => 'nullable|string',
            'link_youtube' => 'required|url',
            'operator_a' => 'nullable|string',
            'operator_b' => 'nullable|string',
            'media' => 'nullable|string',
        ]);

        Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil disimpan!');
    }
    public function create()
    {
        $pros = Pro::orderBy('nama_pro')->get();          // Ambil semua PRO
        $operators = Operator::orderBy('nama_operator')->get(); // Ambil semua operator

        return view('lapinput', compact('pros', 'operators'));
    }
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $pros = Pro::orderBy('nama_pro')->get();
        $operators = Operator::orderBy('nama_operator')->get();

        return view('lapedit', compact('laporan', 'pros', 'operators'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_pro' => 'required',
            'acara' => 'required|string',
            'topik' => 'required|string',
            'narasumber' => 'nullable|string',
            'link_youtube' => 'required|url',
            'operator_a' => 'nullable|string',
            'operator_b' => 'nullable|string',
            'media' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }
}
