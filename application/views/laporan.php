<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Metode TOPSIS</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>

<h4>Hasil Akhir Perankingan TOPSIS</h4>
<table border="1" width="100%">
	<thead>
		<tr align="center">
			<th>Nomor Antrian</th>
			<th>Pelaporan</th>
			<th>Tanggal Pengaduan</th>
			<th>Nilai Prioritas</th>
			<th width="15%">Rank</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			foreach ($hasil_topsis as $keys): ?>
		<tr align="center">
			<td align="left"><?= $keys->id_alternatif ?></td>
			<td align="left"><?= $keys->nama ?></td>
			<td align="left"><?= $keys->tgl_laporan ?></td>
			<td><?= $keys->nilai ?></td>
			<td><?= $no; ?></td>
		</tr>
		<?php
			$no++;
			endforeach ?>
	</tbody>
</table>
<script>
	window.print();
</script>
</body>
</html>