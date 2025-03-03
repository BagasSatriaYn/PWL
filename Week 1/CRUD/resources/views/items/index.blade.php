<!DOCTYPE html> <!-- Deklarasi bahwa ini adalah dokumen HTML5 -->
<html>
<head>
    <title>Item List</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <h1>Items</h1> <!-- Menampilkan judul halaman -->
    
    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('succes')) 
        <p>{{ session('succes') }}</p> <!-- Menampilkan pesan sukses dari session -->
    @endif
    
    <!-- Link untuk menambahkan item baru -->
    <a href="{{ route('items.create') }}"> Add Item</a>
    
    <ul>
        <!-- Melakukan looping melalui daftar items -->
        @foreach ($items as $item)
        <li>
            {{ $item->name }} - <!-- Menampilkan nama item -->
            
            <!-- Link untuk mengedit item -->
            <a href="{{ route('items.edit', $item) }}"> Edit </a>
            
            <!-- Form untuk menghapus item -->
            <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                @csrf <!-- Token CSRF untuk keamanan -->
                @method('DELETE') <!-- Metode DELETE untuk menghapus item -->
                <button type="submit"> Delete </button> <!-- Tombol untuk menghapus item -->
            </form>
        </li>
        @endforeach
    </ul>       
</body>
</html>