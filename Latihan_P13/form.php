<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Data Mahasiswa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #ff9800;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 10px;
      vertical-align: middle;
    }

    input, select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .btn {
      padding: 10px 18px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .submit {
      background: #00aeff;
      color: #fff;
      margin-right: 10px;
    }

    .cancel {
      background: #ff8800;
      color: #fff;
    }

    .actions {
      text-align: right;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Form Input Data Mahasiswa</h2>
    <form action="proses_form.php" method="POST">
      <table>
        <tr>
          <td>ID Mahasiswa / NIM</td>
          <td><input type="text" name="nim" required></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
          <td>Jurusan</td>
          <td>
            <select name="jurusan" required>
              <option value="">- Pilih Jurusan -</option>
              <option value="Teknik Informatika">Teknik Informatika</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Teknik Komputer">Teknik Komputer</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td><input type="text" name="alamat" required></td>
        </tr>
        <tr>
          <td>No. Telp</td>
          <td><input type="text" name="telp" required></td>
        </tr>
        <tr>
          <td></td>
          <td class="actions">
            <button type="submit" class="btn submit">Submit</button>
            <button type="reset" class="btn cancel">Cancel</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
<!-- Project 13.1 By ASEP SURYA AGUSTIN - 221011450392  -->
</body>
</html>