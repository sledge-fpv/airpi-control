<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>AirPi Control</title>
<style type="text/css">

button { background-color:#aaa; color:#fff; width:175px; height:50px; border:6px solid #ddd; }
.highlight {background-color:green;}
</style>
</head>
<body bgcolor="white" text="black">
<form action="index.php" method="POST">
<table align="center">
<tr><th colspan="2">AirPi Control</th></tr>

<?php
function POSTorGET($name)
{
	if ( isset($_POST[$name]) )
		return $_POST[$name];
	elseif (isset($_GET[$name]))
	return $_GET[$name];
	else
		return false;
}


require_once 'config.inc.php';
require_once 'helper.inc.php';

$config = new Config();

$show_default = true;


//$rtsp_pid = shellCmd("echo $(ps aux | grep rtsp-server | grep -v grep | awk '{print $2}')",true);
//$udp_pid = shellCmd("echo $(ps aux | grep raspivid | grep -v grep | awk '{print $2}')",true);

$config->GetPids();

$from_api = false;

$action = POSTorGET('action');
$do = POSTorGET('do');
if(!isset($do))
	$do = false;

if( $action && ($do != 'no') )
{
	$show_default = false;
	echo "<input type='hidden' name='action' value='$action'>";
	include('action.php');
}


if($show_default)
{
	echo "<tr><td>".makeButton('action', 'udp_start', 'UDP start',($config->udp_pid))."</td><td>".makeButton('action', 'udp_stop', 'UDP stop')."</td></tr>\n";
	
	echo "<tr><td>".makeButton('action', 'rtsp_start', 'RTSP start',($config->rtsp_pid))."</td><td>".makeButton('action', 'rtsp_stop', 'RTSP stop')."</td></tr>\n";
	
	?>

	<tr>
		<td>
			<button type="submit" name="action" value="airpi_reboot">AirPi reboot</button>
		</td>
		<td>
			<button type="submit" name="action" value="airpi_shutdown">AirPi shutdown</button>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<button type="submit" name="action" value="setup">Setup</button>
		</td>
	</tr>
	
	<?php
}

function makeButton($name, $value, $bezeichnung, $highlight=false)
{
	return "<button ". ($highlight?"class='highlight'":'') ." type='submit' name='$name' value='$value'>$bezeichnung</button>";
}

?>

</table>

</form>


</body>
</html>