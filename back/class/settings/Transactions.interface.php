<?php
/*
this interface define all methods that the class should have for 
to do transactions sql
*/

interface Transactions
	{ 
        public function save($sentence);
	public function update($sentence);
	public function _update($sentence,$filter);
	public function delete($sentence);
	public function _delete($sentence,$filter);
	public function select($fileds);
	public function _select($fields,$filter);

	}
?>