<!DOCTYPE html>
<html>
	<head>
		<title>MENU UTAMA</title>
		<style>
		  * { margin:0; padding: 0;}
		  
		  body {
		    font-family: Helvetica, Verdana;
		    font-size: 12px;
		    background: rgb(42,32,30);
		  }
	  
		  div.container {
		    width: 300px;
		    margin: 0 auto;
		  }
		  
		  div.header {
		    width: 100%;
		    height: 30px;
		    line-height: 30px;
		    font-size: 12px;
		    background: rgb(78,92,127);
		    margin-bottom: 20px;
		  }
		  
		  div.header p {
		    padding: 0 10px;
		  }
		  
		  div.header a {
		    color: #FFF;
		    text-decoration: none;
		    font-weight: bold;
		  }
		</style>
		<link href="<?php echo base_url(); ?>res/css/nice-menu.css" rel="stylesheet" type="text/css" />
		
  	 <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17363589-1']);
      _gaq.push(['_trackPageview']);
  
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
	</head>
	<body>
	   <div class = "header">
	     <p><a href="http://calvinbahal.wordpress.com" target="blank">Calvin Bahal Marpaung</a></p>
	   </div>
	   <div class = "container" style = "">

	     <ul class = "nice-menu">
	       <li class = "orange"><?php echo anchor('konsumen/menu/','Menu'); ?></li>
	       <li class = "red"><?php echo anchor('konsumen/index/','Data Konsumen'); ?></li>
	       <li class = "green"><?php echo anchor('obat/index/','Data Obat'); ?></li>
	       <li class = "blue"><a href = "">Blog</a></li>
	       <li class = "bright"><?php echo anchor('konsumen/logout/','Logout'); ?></li>
</ul>
	   </div>
	  
	
	</body>

</html>