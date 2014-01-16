	<div style="text-align: center;">
	<div style="box-sizing: border-box; display: inline-block; width: auto; max-width: 480px; background-color: #C6C6BA; border: 2px solid #0361A8; border-radius: 5px; box-shadow: 0px 0px 8px #ABAB9A; margin: 50px auto auto;">
	<div style="background: #000; border-radius: 5px 5px 0px 0px; padding: 15px;"><span style="font-family: verdana,arial; color: #D4D4D4; font-size: 1.00em; font-weight:bold;">Enter your login and password</span></div>
	<div style="background: ; padding: 15px">
	<style type="text/css" scoped>
	td { text-align:left; font-family: verdana,arial; color: #064073; font-size: 1.00em; }
	input { border: 1px solid #BFBF96; border-radius: 5px; color: #666666; display: inline-block; font-size: 1.00em;  padding: 5px; width: 100%; }
	input[type="button"], input[type="reset"], input[type="submit"] { height: auto; width: auto; cursor: pointer; box-shadow: 0px 0px 5px #0361A8; float: right; margin-top: 10px; }
	table.center { margin-left:auto; margin-right:auto; }
	.error { font-family: verdana,arial; color: #D41313; font-size: 1.00em; }
	</style>
<table class='center'>
<tr><?php 
		echo form_open("konsumen/check_login");
		echo "Username " . form_input("uname","");
		echo "<br/>Password " . form_password("pass","");
		echo "<br/>".form_submit('mysubmit', 'Submit');
		echo form_close();
		?></tr>
</table>
</div></div></div>