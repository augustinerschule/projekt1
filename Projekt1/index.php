<?php
session_start();
if(!isset($_GET["page"]))
	$page = "main";
else
	$page = $_GET["page"];
$page = strtolower($page);
if(file_exists("classes/pages/".$page.".php"))
{
	include_once("classes/pages/".$page.".php");
	$page = ucfirst($page);
	$page = new $page($page);
	$page->update();
	$page->show();
}