<?php

class BNextday extends AppModel {
    public $useTable = false;

    public function findAll(){
    	$sql = "select * from B_NEXTDAY";
		return $this->query($sql);
    }

}