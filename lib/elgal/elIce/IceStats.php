<?php

// based on original php class by Baku Clat e-mail: prando@malasystem.com from: http://www.phpclasses.org/browse/package/2433.html
// this code is GPL

class IceStats{

	// connect to icecast and get the xml info.
	function iceinfo($ip,$port,$user,$pass) {
		$this->infila = array();
		$this->temp=null;
		$this->objcomp=null;

		$this->ch = curl_init();
		
		curl_setopt($this->ch,CURLOPT_URL,"http://".$ip.":".$port."/admin/stats");
		curl_setopt($this->ch,CURLOPT_HEADER,false);
		curl_setopt($this->ch,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
		curl_setopt($this->ch,CURLOPT_USERPWD,$user.":".$pass);
		//cannot set this in safe_mode
		//curl_setopt($this->ch,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER, true);
		
		$this->output=curl_exec($this->ch);
		
		if (curl_errno($this->ch))
			echo curl_error($this->ch);
		
		curl_close($this->ch);
		
		$this->parser = xml_parser_create();

		xml_set_object($this->parser,$this);
		xml_set_element_handler($this->parser,"inizio","fine");
		xml_set_character_data_handler($this->parser,"componi");
		xml_parse($this->parser,$this->output);
		xml_parser_free($this->parser);

		return $this->infila;
	}
	
	//functions to parse the icecast xml (inizio,componi,fine)
	function inizio($parser,$name,$attr) {
		if ($name == "SOURCE") {
			// create nuovatemp empty
			$this->temp->mount=$attr["MOUNT"];
		}
		else  $this->objcomp = $name;
	}
	
	function componi($parser,$dato) {
		if (is_null($this->objcomp) || is_null($this->temp)) 
			return;
		$field = strtolower($this->objcomp);
		$this->temp->$field = $dato;
	}
	
	function fine($parser,$name) {
		if ($name == "SOURCE") {
			array_push($this->infila,$this->temp);
			$this->temp=null;
		}
		else $this->objcomp=null;
	}
}

?>
