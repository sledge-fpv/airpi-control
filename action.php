<?php
require_once 'helper.inc.php';

if($from_api)
	$do = true;

switch ($action)
{
	case 'udp_start' :
		$ap = $config->xml->udp_pipe_active;
		shellCmd("sudo ".$config->xml->$ap,false);
		sleep(8);
		$config->GetPids();
		$show_default = true;
		break;
	case 'udp_stop' :
		if($do)
		{
			$command="sudo kill -9 $(ps aux | grep raspivid | grep -v grep | awk '{print $2}')";
			echo shellCmd($command,true);
			sleep(1);
			$config->GetPids();
			$show_default = true;
		}
		else
		{
			echo "<tr><td colspan='2'>Wirklich den UDP-Server stoppen???</td></tr>";
			echo getYesNo();
		}
		break;
	case 'rtsp_start' :
		$path=$config->xml->rtsp_path;
		$ap=$config->xml->rtsp_pipe_active;
		$command="sudo ".$path.$config->xml->$ap;
		shellCmd($command);
		sleep(8);
		$config->GetPids();
		$show_default = true;
		break;
	case 'rtsp_stop' :
		if($do)
		{
			$command="sudo kill -9 $(ps aux | grep rtsp-server | grep -v grep | awk '{print $2}')";
			echo shellCmd($command,true);
			sleep(1);
			$config->GetPids();
			$show_default = true;
		}
		else
		{
			echo "<tr><td colspan='2'>Wirklich den RTSP-Server stoppen???</td></tr>";
			echo getYesNo();
		}
		break;
	case 'airpi_reboot' :
		if($do)
		{
			shellCmd("sudo reboot");
		}
		else
		{
			echo "<tr><td colspan='2'>Wirklich den AirPi stoppen???</td></tr>";
			echo getYesNo();
		}
		break;
	case 'airpi_shutdown' :
		if($do)
		{
			shellCmd("sudo shutdown -h now");
		}
		else
		{
			echo "<tr><td colspan='2'>Wirklich den AirPi stoppen???</td></tr>";
			echo getYesNo();
		}
		break;
	case 'setup' :
		if( $do=='save' )
		{
			$config->LoadFromPost();
			$show_default = true;
		}
		else
			echo $config->Output();
		break;
}
/*
 *
 *
kill -9 $(ps aux | grep rtsp-server | grep -v grep | awk '{print $2}')
kill -9 $(ps aux | grep raspivid | grep -v grep | awk '{print $2}')
 *
 */




?>