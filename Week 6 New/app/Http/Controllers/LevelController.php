<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    // Menampilkan halaman utama Level
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];
        
        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];
        
        $activeMenu = 'level';
        
        return view('level.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Menampilkan daftar level dalam format DataTables
    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_name');
        
        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman tambah level
    public function create()
    {
        return view('level.create', [
            'breadcrumb' => (object) ['title' => 'Tambah Level', 'list' => ['Home', 'Level', 'Tambah']],
            'page' => (object) ['title' => 'Tambah level baru'],
            'activeMenu' => 'level'
        ]);
    }

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_name' => 'required|string|max:100',
        ]);

        LevelModel::create($request->only(['level_kode', 'level_name']));

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'level_kode' => 'required|string|max:5|unique:m_level,level_kode',
                'level_name' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            LevelModel::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data level berhasil disimpan']);
        }
        return redirect('/');
    }

    // Menampilkan detail level
    public function show(string $id)
    {
        return view('level.show', [
            'breadcrumb' => (object) ['title' => 'Detail Level', 'list' => ['Home', 'Level', 'Detail']],
            'page' => (object) ['title' => 'Detail level'],
            'level' => LevelModel::find($id),
            'activeMenu' => 'level'
        ]);
    }

    // Menampilkan halaman edit level
    public function edit(string $id)
    {
        return view('level.edit', [
            'breadcrumb' => (object) ['title' => 'Edit Level', 'list' => ['Home', 'Level', 'Edit']],
            'page' => (object) ['title' => 'Edit level'],
            'level' => LevelModel::find($id),
            'activeMenu' => 'level'
        ]);
    }

    public function edit_ajax(string $id)
    {
        return view('level.edit_ajax', ['level' => LevelModel::find($id)]);
    }

    // Memperbarui data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
            'level_name' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update($request->only(['level_kode', 'level_name']));

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'level_kode' => 'required|string|max:5',
                'level_name' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data level berhasil diubah']);
            }
            return response()->json(['status' => false, 'message' => 'Data level tidak ditemukan']);
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        return view('level.confirm_ajax', ['level' => LevelModel::find($id)]);
    }

    // Menghapus data level
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
            }
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return redirect('/');
    }

    public function destroy(string $id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            $level->delete();
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
