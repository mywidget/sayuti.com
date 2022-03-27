<?php
class WebService{
protected $name;
// protected $umur;

//contoh API utk client
protected $API = 'kalkulatorcetak.com';

public function setName($name){
	
	$this->name = $name;
}
public function getName(){
	
	return $this->name;
}

public function validateAPI($api){
	if($this->API !== $api)
		return false;
	return true;
}
}