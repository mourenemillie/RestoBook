<!DOCTYPE html>
<html>
<head>
    <title>Tambah Meja</title>
</head>
<body>

<h1>Tambah Meja</h1>

<form action="{{ route('owner.kelola-meja.store') }}" method="POST">
    @csrf

    <label>Nomor Meja</label><br>
    <input type="text" name="table_number" required><br><br>

    <label>Kapasitas</label><br>
    <input type="number" name="capacity" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="available">Tersedia</option>
        <option value="occupied">Terisi</option>
        <option value="reserved">Direservasi</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>