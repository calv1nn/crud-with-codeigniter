<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>CUSTOMER DATA</title>

<link href="<?php echo base_url(); ?>res/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="content">
	<!--  	<h1><?php echo $title; ?></h1>	-->
	<?php if (!empty($message)) echo $message;?>
		<h1>Add Obat</h1>
		<?php echo form_open_multipart('obat/buyobat')?>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $obat->id; ?></td>
				
				<input type="hidden" name="id" value=<?php echo $obat->id;?> />
			</tr>
			<tr>
				<td valign="top">Nama</td>
				<td><?php echo $obat->nama; ?></td>
				<input type="hidden" name="nama" value=<?php echo $obat->nama;?> />
			</tr>
			<tr>
				<td valign="top">Golongan</td>
				<td><?php echo $obat->golongan ; ?></td>
				<input type="hidden" name="golongan" value=<?php echo $obat->golongan;?> />
			</tr>

			<tr>
				<td valign="top">Stok</td>
				<td><?php echo $obat->stok ; ?></td>
				<input type="hidden" name="stok" value=<?php echo $obat->stok;?> />
				<input type="hidden" name="harga" value=<?php echo $obat->harga;?> />
			</tr>
			<tr>
				<td valign="top">Jumlah Beli</td>
				<td><input name="buy" type="text"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Buy" name="Beli"/></td>
			</tr>
		</table>
		</div>
		<?php echo form_close();?>
		
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
