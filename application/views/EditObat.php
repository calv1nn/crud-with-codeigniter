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
		<h1>Add Obat</h1>
		<?php echo $message; ?>
		<?php echo form_open_multipart('obat/addobat')?>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id',$this->form_data->id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Nama<span style="color:red;">*</span></td>
				<td><input type="text" name="nama" class="text" value="<?php echo set_value('nama',$this->form_data->nama); ?>"/>
<?php echo form_error('nama'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Golongan<span style="color:red;">*</span></td>
				<td><input type="radio" name="golongan" value="Obat Bebas" <?php echo set_radio('golongan', 'Obat Bebas', $this->form_data->golongan == 'Obat Bebas'); ?>/> Obat Bebas
					<input type="radio" name="golongan" value="Obat Keras" <?php echo set_radio('golongan', 'Obat Keras', $this->form_data->golongan == 'Obat Keras'); ?>/> Obat Keras
<?php echo form_error('golongan'); ?>
					</td>
			</tr>
			<tr>
				<td valign="top">Stok<span style="color:red;">*</span></td>
				<td><input type="text" name="stok" class="text" value="<?php echo set_value('stok',$this->form_data->stok); ?>"/>
<?php echo form_error('stok'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Gambar<span style="color:red;">*</span></td>
				<td><input type="file" name="userfile">
<?php echo form_error('gambar'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Harga<span style="color:red;">*</span></td>
				<td><input type="text" name="harga" class="text" value="<?php echo set_value('harga',$this->form_data->harga); ?>"/>
<?php echo form_error('harga'); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save" name="save"/></td>
			</tr>
		</table>
		</div>
		<?php echo form_close();?>
		
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
