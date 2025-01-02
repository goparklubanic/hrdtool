<?php
$tga = date('Y-m-d');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=KaryawanAbsen_{$tga}.xlsx");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absen: {{ $tanggal }}</title>
</head>
<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th colspan="4">Daftar Karyawan Tidak Hadir: {{ $tanggal }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d=>$emp)
            <tr>
                <td colspan="3"><b>{{ $d }}</td>
                <td align="right">{{ COUNT($emp) }}</td>
            </tr>
            <tr>
                <td>No.</td>
                <td>NIK</td>
                <td>Nama Lengkap</td>
                <td>Kehadiran</td>
            </tr>
                <?php $no=1; ?>
                @foreach($emp as $e)
                <tr>
                    <td>{{ $no++ }}.</td>
                    <td>`{{ $e->NikKaryawan }}</td>
                    <td>{{ $e->NamaLengkap }}</td>
                    <td align="center">{{ $e->Kehadiran }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">&nbsp</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>