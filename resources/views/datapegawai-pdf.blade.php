<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Table Pegawai</h1>

<table id="customers">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Nomor Telfon</th>
    <th>Dibuat 1</th>
    <th>Dibuat 2</th>
  </tr>
  <?php 
    $no = 1;
  ?>
  @foreach ($data as $row)
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $row->nama }}</td>
    <td>{{ $row->jeniskelamin }}</td>
    <td>0{{ $row->notelpon }}</td>
    <td>{{ $row->created_at->format('D M Y'); }}</td>
    <td>{{ $row->created_at->diffForHumans() }}</td>
  </tr>
  @endforeach
  
</table>

</body>
</html>


