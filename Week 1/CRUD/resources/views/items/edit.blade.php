<!DOCTYPE html> <!-- Menentukan bahwa ini adalah dokumen HTML5 -->
<html>

<head>
    <title>Edit Item</title> <!-- Menentukan judul halaman -->
</head>

<body>
    <h1>Edit Item</h1> <!-- Menampilkan judul halaman -->

    <form action="{{ route('items.update', $item) }}" method="POST"> <!-- Form untuk mengupdate item, mengarah ke route 'items.update' -->
        @csrf <!-- Token CSRF untuk keamanan -->
        @method('PUT') <!-- Menggunakan metode PUT untuk memperbarui data -->

        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" value="{{ $item->name }}" required> <!-- Input untuk nama item, dengan nilai default dari database -->

        <br> <!-- Baris baru -->

        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required>{{ $item->description }}</textarea> <!-- Input untuk deskripsi item, dengan nilai default dari database -->

        <br> <!-- Baris baru -->

        <button type="submit">Update Item</button> <!-- Tombol untuk mengupdate item -->
    </form>

    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>

</html>