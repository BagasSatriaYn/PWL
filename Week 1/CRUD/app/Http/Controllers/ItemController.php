<?php

namespace App\Http\Controllers; //Menentukan lokasi class dalam aplikasi

use App\Models\Item; //Mengimpor model Item untuk mengakses data di database
use Illuminate\Http\Request; //Mengimpor Request untuk menangani input dari pengguna

class ItemController extends Controller //Menggunakan Controller sebagai parent class
{
    public function index() //Mengembalikan view index
    {
        $items = Item::all(); //Mengambil semua data dari tabel item 
        return view('items.index', compact('items')); //Mengembalikan view index dengan data item
    }

    public function create() //Mengembalikan view create                                    
    {
        return view('items.create'); //Mengembalikan view create
    }

    public function store(Request $request) //Menerima input dari pengguna
    {
        $request->validate([ //Mengatur validasi untuk input
            'name' => 'required', //Mengatur validasi untuk field name
            'description' => 'required', //Mengatur validasi untuk field description
        ]);

        Item::create($request->only(['name', 'description'])); //Mengirimkan data ke model Item untuk disimpan di database

        return redirect()->route('items.index')->with('success', 'Item added successfully.'); //Mengembalikan view index dengan pesan sukses
    }

    public function show(Item $item) //Mengembalikan view show
    {
        return view('items.show', compact('item')); //Mengembalikan view show dengan data item
    }

    public function edit(Item $item) //Mengembalikan view edit
    {
        return view('items.edit', compact('item')); //Mengembalikan view edit dengan data item
    }

    public function update(Request $request, Item $item) //Menerima input dari pengguna
    {
        $request->validate([ //Mengatur validasi untuk input
            'name' => 'required', //Mengatur validasi untuk field name
            'description' => 'required', //Mengatur validasi untuk field description
        ]);

        $item->update($request->only(['name', 'description'])); //Mengirimkan data ke model Item untuk diupdate di database

        return redirect()->route('items.index')->with('success', 'Item updated successfully.'); //Mengembalikan view index dengan pesan sukses
    }

    public function destroy(Item $item) //Menghapus data dari database
    {
        $item->delete(); //Menghapus data dari database
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); //Mengembalikan view index dengan pesan sukses
    }
}