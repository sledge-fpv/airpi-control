<?php
require_once 'config.inc.php';

//XML per Post annehmen und in die commands.xml speichern
$input = $_POST['commands'];
$commandshandle = fopen('commands.xml', 'w');
fwrite($commandshandle, $input);
fclose($commandshandle);



$config = new Config();

//commands.xml in Array schreiben
function xml2array($fname)
{
	$sxi = new SimpleXmlIterator($fname, null, true);
	return sxiToArray($sxi);
}

function sxiToArray($sxi)
{
	$a = array();
	for( $sxi->rewind(); $sxi->valid(); $sxi->next() )
	{
		if(!array_key_exists($sxi->key(), $a))
		{
			$a[$sxi->key()] = array();
		}
		if($sxi->hasChildren())
		{
			$a[$sxi->key()][] = sxiToArray($sxi->current());
		}
		else
		{
			$a[$sxi->key()][] = strval($sxi->current());
		}
	}
	return $a;
}

$commandsArray = xml2array('commands.xml');

//einzelne Kommandos abarbeiten
foreach ($commandsArray as $commands)
{
	foreach ($commands as $key=>$command)
	{
		run_command($config, $command);
	}
	$config->SaveXML();
}

echo $config->xml->asXML();

//1. Entscheidung nach $type
function run_command($config, $command)
{
	$from_api = true;
	
	$entity = $command['entity'][0];
	$param = $command['param'][0];
	$type = $command['type'][0];
	
	switch ($type)
	{
		case 'udp_pipe' :
			$config->SetTextValue('udp_pipe_'.$entity, $param);
			break;
		case 'rtsp_pipe' :
			$config->SetTextValue('rtsp_pipe_'.$entity, $param);
			break;
		case 'action' : //weiter in action.php
			$action = $entity;
			include 'action.php';
			break;
		case 'udp_setpipe' :
			$config->SetTextValue('udp_pipe_active', 'udp_pipe_'.$entity);
			break;
		case 'rtsp_setpipe' :
			$config->SetTextValue('rtsp_pipe_active', 'rtsp_pipe_'.$entity);
			break;
	}
}

?>