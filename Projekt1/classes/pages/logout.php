<?php
require_once 'page.php';
class Logout extends Page {

	public function __construct()
	{
		parent::__construct();
		session_destroy();
		header("location:index.php");
	}
}