<!DOCTYPE html>

<html>
    <head>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
        <meta charset="utf-8" />
        <title>Garaza</title>
		<link rel="icon" type="image/png" href="favicon.png"/>
    </head>
 
    <body style="background-color: black;">
    <!-- On/Off button's picture -->
	<div id="wrapper" style="width:100%; text-align:center">
	<?php
	$ctl_gpio_pin = 7;
	$gpio_desired_default = 1;
	//this php script generate the first page in function of the file
	system("gpio write ".$ctl_gpio_pin." ".$gpio_desired_default);
	system("gpio mode ".$ctl_gpio_pin." out");
	exec ("gpio read ".$ctl_gpio_pin, $ctl_gpio_state, $return );
	
	if ($ctl_gpio_state == 0 ) {
		echo ("<img id='button' src='data/img/red/red.png' onclick='change_pin (".$ctl_gpio_pin.");'/>");
	}
	else
	{
		echo ("<img id='button' src='data/img/green/green.png' onclick='change_pin (".$ctl_gpio_pin.");'/>");
	}	
	?>
	 </div>
	 <div id="kamera" style="width:100%; text-align:center">
		<?php
			print '<img src="script.php?url='.urlencode('http://192.168.73.20/tmpfs/auto.jpg').'" />';
			$url    = "http://192.168.73.20/tmpfs/auto.jpg";
			$c = curl_init($url);
			$authString = 'admin:admin';
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_USERPWD, $authString);

			$content = curl_exec($c);
			$contentType = curl_getinfo($c, CURLINFO_CONTENT_TYPE);
			header('Content-Type:'.$contentType);
			print '<img src="'.$content.'" />';
		?>
	 </div>
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>