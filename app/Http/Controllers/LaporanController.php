<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pro;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;


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

        // ✅ Filter berdasarkan Operator A atau B
        if ($request->filled('operator')) {
            $query->where(function ($q) use ($request) {
                $q->where('operator_a', $request->operator)
                ->orWhere('operator_b', $request->operator);
            });
        }

        $laporan = $query->paginate(10);
        $operator = Operator::all(); // pastikan variabel ini dikirim ke view


        // Pagination dan simpan query string
        $laporan = $query->paginate(5)->appends($request->all());

        // Ambil semua operator untuk dropdown select2
        $operators = \App\Models\Operator::orderBy('nama_operator')->get();

        return view('laprekap', compact('laporan', 'operator'));
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
    public function dashboard(Request $request)
    {
        $bulan = $request->bulan;

        // query dasar
        $laporanQuery = Laporan::query();

        // filter bulan (jika ada)
        if ($bulan) {
            $laporanQuery->whereMonth('tanggal', $bulan);
        }

        // total semua laporan (termasuk yang operatornya "-")
        $totalLaporan = (clone $laporanQuery)->count();

        // total laporan Operator A (operator_a != 1)
        $totalA = (clone $laporanQuery)
            ->where('operator_a', '!=', 1)   // <-- filter ID "-"
            ->whereNotNull('operator_a')
            ->count();

        // total laporan Operator B (operator_b != 1)
        $totalB = (clone $laporanQuery)
            ->where('operator_b', '!=', 1)   // <-- filter ID "-"
            ->whereNotNull('operator_b')
            ->count();

        // ambil laporan terbaru (5 terakhir sesuai filter)
        $laporanTerbaru = (clone $laporanQuery)
            ->orderBy('tanggal', 'desc')
            ->take(4)
            ->get();

        // ambil daftar bulan unik dari tabel laporan
        $daftarBulan = Laporan::selectRaw('MONTH(tanggal) as bulan')
            ->distinct()
            ->orderBy('bulan')
            ->pluck('bulan');

        return view('lapdashboard', compact(
            'totalLaporan',
            'totalA',
            'totalB',
            'laporanTerbaru',
            'daftarBulan',
            'bulan'
        ));
    }
    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun', date('Y'));

        return Excel::download(new LaporanExport($bulan, $tahun), 'Rekap Laporan Upload Konten Youtube.xlsx');
    }
}
