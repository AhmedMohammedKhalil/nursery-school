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
    if($method == 'search') {
        $text = $_POST['search'];
        $home->search($text);
    } 
}

class HomeController {

    public function showServices() {
        $services= selectAll('*','services');
        $_SESSION['services']=$services;
        header('location: ../services.php');
    }
    public function search($text)
    {  
        $_SESSION['oldsearch']=$text;
        $services= selectAll('*','services',"title LIKE '%{$text}%' OR body LIKE '%{$text}%'");
        $_SESSION['services']=$services;
        header('location: ../services.php');
    }
    public function showHelp() {
        $contacts= selectAll('*','contacts');
        $_SESSION['contacts']=$contacts;
        header('location: ../help.php');
    }
    
}