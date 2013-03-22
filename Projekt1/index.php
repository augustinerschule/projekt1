<?php
			print_r($_POST);
if(!isset($_GET["page"]))
	$page = "main";
else
	$page = $_GET["page"];
$page = strtolower($page);
if(file_exists($page.".php"))
{
	include_once($page.".php");
	$page = ucfirst($page);
	$page = new $page($page);
}