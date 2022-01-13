<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $home = new HomeController();
    if($method == 'showServices') {
        $home->showServices();
    }
    if($method == 'showHelp') {
        $home->showHelp();
    } 
}

class HomeController {

    public function showServices() {
        header('location: ../services.php');
    }

    public function showHelp() {
        header('location: ../help.php');
    }
}