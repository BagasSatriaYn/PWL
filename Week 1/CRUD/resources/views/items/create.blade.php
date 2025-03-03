<!DOCTYPE html> <!-- Deklarasi bahwa ini adalah dokumen HTML5 -->
<html>
<head>
    <title>Add Item</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <h1>Add Item</h1> <!-- Menampilkan judul halaman -->
    
    <!-- Form untuk menambahkan item, dengan metode POST yang mengarah ke route items.store -->
    <form action="{{ route ('items.store') }}" method="POST"> 
        @csrf <!-- Token CSRF untuk keamanan dari serangan CSRF -->
        
        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" required> <!-- Input untuk nama item, wajib diisi -->
        <br>
        
        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required></textarea> <!-- Textarea untuk deskripsi item, wajib diisi -->
        <br>
        
        <button type="submit">Update Item</button> <!-- Tombol untuk mengirimkan form -->
    </form>
    
    <!-- Link kembali ke halaman daftar item -->
    <a href="{{ route ('items.index') }}">Back to List</a>
</body>
</html>