<?php

class Config
{
	private $xml_file;
	public $xml;
	
	public $udp_state;
	public $udp_pipe_active;
	public $udp_pipe_1;
	public $udp_pipe_2;
	public $udp_pipe_3;
	public $udp_pipe_4;
	public $udp_pipe_5;
	
	public $rtsp_state;
	public $rtsp_pipe_active;
	public $rtsp_pipe_1;
	public $rtsp_pipe_2;
	public $rtsp_pipe_3;
	public $rtsp_pipe_4;
	public $rtsp_pipe_5;
	public $rtsp_path;
	
	public $rtsp_pid;
	public $udp_pid;

	public function __construct()
	{
		$this->xml_file					= $xml_file = 'config.xml';
		$this->xml 						= simplexml_load_file($this->xml_file);
		$this->Load();
	}
	
	public function Load()
	{
		$this->rtsp_pipe_1 				= $this->xml->rtsp_pipe_1;
		$this->rtsp_pipe_2 				= $this->xml->rtsp_pipe_2;
		$this->rtsp_pipe_3 				= $this->xml->rtsp_pipe_3;
		$this->rtsp_pipe_4 				= $this->xml->rtsp_pipe_4;
		$this->rtsp_pipe_5 				= $this->xml->rtsp_pipe_5;
		$this->rtsp_pipe_active			= $this->xml->rtsp_pipe_active;
		$this->rtsp_state				= $this->xml->rtsp_state;
		
		$this->rtsp_path 				= $this->xml->rtsp_path;
		
		$this->udp_pipe_1 				= $this->xml->udp_pipe_1;
		$this->udp_pipe_2 				= $this->xml->udp_pipe_2;
		$this->udp_pipe_3 				= $this->xml->udp_pipe_3;
		$this->udp_pipe_4 				= $this->xml->udp_pipe_4;
		$this->udp_pipe_5 				= $this->xml->udp_pipe_5;
		$this->udp_pipe_active			= $this->xml->udp_pipe_active;
		$this->udp_state				= $this->xml->udp_state;
	}
	
	// notwendige Reihenfolge beachten !!!
	public function LoadFromPost()
	{
		$this->SetTextValue('udp_pipe_active', POSTorGET('udp_active'), true);
		$this->SetTextValue('udp_pipe_1', POSTorGET('udp_pipe_1'), true);
		$this->SetTextValue('udp_pipe_2', POSTorGET('udp_pipe_2'), true);
		$this->SetTextValue('udp_pipe_3', POSTorGET('udp_pipe_3'), true);
		$this->SetTextValue('udp_pipe_4', POSTorGET('udp_pipe_4'), true);
		$this->SetTextValue('udp_pipe_5', POSTorGET('udp_pipe_5'), true);
		$this->SetTextValue('rtsp_pipe_active', POSTorGET('rtsp_active'), true);
		$this->SetTextValue('rtsp_pipe_1', POSTorGET('rtsp_pipe_1'), true);
		$this->SetTextValue('rtsp_pipe_2', POSTorGET('rtsp_pipe_2'), true);
		$this->SetTextValue('rtsp_pipe_3', POSTorGET('rtsp_pipe_3'), true);
		$this->SetTextValue('rtsp_pipe_4', POSTorGET('rtsp_pipe_4'), true);
		$this->SetTextValue('rtsp_pipe_5', POSTorGET('rtsp_pipe_5'), true);
		$this->SetTextValue('rtsp_path', POSTorGET('rtsp_path'), true);
		$this->SaveXML();
	}
	
	public function Output()
	{
		$output	= "<tr><th colspan='2'>RTSP</th></tr>";
		$output.= "<tr><td>path</td><td><input type='text' name='rtsp_path' size='65' value='".$this->rtsp_path."'></td></tr>";

		$output.= "<tr><td><input type='radio' name='rtsp_active' value='rtsp_pipe_1' ".( ($this->rtsp_pipe_active=="rtsp_pipe_1")?" checked='checked'":'')."'></td><td><input type='text' name='rtsp_pipe_1' size='65' value='".$this->rtsp_pipe_1."'></td></tr>";
		$output.= "<tr><td><input type='radio' name='rtsp_active' value='rtsp_pipe_2' ".( ($this->rtsp_pipe_active=="rtsp_pipe_2")?" checked='checked'":'')."'></td><td><input type='text' name='rtsp_pipe_2' size='65' value='".$this->rtsp_pipe_2."'></td></tr>";
		$output.= "<tr><td><input type='radio' name='rtsp_active' value='rtsp_pipe_3' ".( ($this->rtsp_pipe_active=="rtsp_pipe_3")?" checked='checked'":'')."'></td><td><input type='text' name='rtsp_pipe_3' size='65' value='".$this->rtsp_pipe_3."'></td></tr>";
		$output.= "<tr><td><input type='radio' name='rtsp_active' value='rtsp_pipe_4' ".( ($this->rtsp_pipe_active=="rtsp_pipe_4")?" checked='checked'":'')."'></td><td><input type='text' name='rtsp_pipe_4' size='65' value='".$this->rtsp_pipe_4."'></td></tr>";
		$output.= "<tr><td><input type='radio' name='rtsp_active' value='rtsp_pipe_5' ".( ($this->rtsp_pipe_active=="rtsp_pipe_5")?" checked='checked'":'')."'></td><td><input type='text' name='rtsp_pipe_5' size='65' value='".$this->rtsp_pipe_5."'></td></tr>";
		$output.= "<tr><th colspan='2'>UDP</th></tr>";

		$output.= "<tr><td><input type='radio' name='udp_active' value='udp_pipe_1' ".( ($this->udp_pipe_active=="udp_pipe_1")?" checked='checked'":'')."'></td><td><input type='text' name='udp_pipe_1' size='65' value='".$this->udp_pipe_1."'></td></tr>\n";
		$output.= "<tr><td><input type='radio' name='udp_active' value='udp_pipe_2' ".( ($this->udp_pipe_active=="udp_pipe_2")?" checked='checked'":'')."'></td><td><input type='text' name='udp_pipe_2' size='65' value='".$this->udp_pipe_2."'></td></tr>\n";
		$output.= "<tr><td><input type='radio' name='udp_active' value='udp_pipe_3' ".( ($this->udp_pipe_active=="udp_pipe_3")?" checked='checked'":'')."'></td><td><input type='text' name='udp_pipe_3' size='65' value='".$this->udp_pipe_3."'></td></tr>\n";
		$output.= "<tr><td><input type='radio' name='udp_active' value='udp_pipe_4' ".( ($this->udp_pipe_active=="udp_pipe_4")?" checked='checked'":'')."'></td><td><input type='text' name='udp_pipe_4' size='65' value='".$this->udp_pipe_4."'></td></tr>\n";
		$output.= "<tr><td><input type='radio' name='udp_active' value='udp_pipe_5' ".( ($this->udp_pipe_active=="udp_pipe_5")?" checked='checked'":'')."'></td><td><input type='text' name='udp_pipe_5' size='65' value='".$this->udp_pipe_5."'></td></tr>\n";
		$output.= "<tr><th colspan='2'><button type='submit' name='do' value='save'>Save</button></th></tr>";
		return $output;
	}
	
	public function SetTextValue($field, $value, $needed = false)
	{
		$this->xml->$field = utf8_encode($value);
		$this->$field = utf8_encode($value);
	}
	
	private function SetIntValue($field, $value, $needed = false, $allow_zero = false)
	{
		if(!is_numeric($value))
		{
			$this->AddErrorMSG("Es sind f&uuml;r $field nur Werte >= 0 erlaubt!");
			return;
		}
		if($value < 0 && !$allow_zero)
			$this->AddErrorMSG("Es sind f&uuml;r $field nur Werte >= 0 erlaubt!");
		else
		{
			$this->xml->$field = $value;
			$this->$field = $value;
		}
	}
	
	public function SaveXML()
	{
		$this->xml->saveXML($this->xml_file);
		unset($this->xml);
		$this->xml = simplexml_load_file($this->xml_file);
		$this->Load();
	}

	public function GetPids()
	{
		$this->rtsp_pid = shellCmd("echo $(ps aux | grep rtsp-server | grep -v grep | awk '{print $2}')",true);
		$this->udp_pid = shellCmd("echo $(ps aux | grep raspivid | grep -v grep | awk '{print $2}')",true);
		
		if(strlen($this->rtsp_pid) > 0)
			$this->SetTextValue('rtsp_state', 1);
		else
			$this->SetTextValue('rtsp_state', 0);
		if(strlen($this->udp_pid) > 0)
		{
			$this->SetTextValue('udp_state', 1);
		}
		else
			$this->SetTextValue('udp_state', 0);
		$this->SaveXML();
	}
}

?>