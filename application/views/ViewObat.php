<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>CUSTOMER DATA</title>

<link href="<?php echo base_url(); ?>res/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $obat->id; ?></td>
			</tr>
			<tr>
				<td valign="top">Nama</td>
				<td><?php echo $obat->nama; ?></td>
			</tr>
			<tr>
				<td valign="top">Golongan</td>
				<td><?php echo $obat->golongan ; ?></td>
			</tr>
			<tr>
				<td valign="top">Stok</td>
				<td><?php echo $obat->stok ; ?></td>
			</tr>
			<tr>
				<td valign="top">Gambar</td>
				<td><img src="<?php echo base_url('uploads'),"/".$obat->gambar?>"/></td>
			</tr>
			<tr>
				<td valign="top">Harga</td>
				<td><?php echo $obat->harga ; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
