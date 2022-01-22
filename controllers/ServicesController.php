<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $service = new ServicesController();
    if($method == 'showServices') {
        $service->showServices();
    }
    if($method == 'addService') {
        $service->addService();
    }
    if($method == 'storeService') {
        $service->storeService();
    }
    if($method == 'editService') {
        $id = $_GET['id'];
        $service->editService($id);
    }
    if($method == 'updateService') {
        $id = $_GET['id'];
        $service->updateService($id);
    }
    if($method == 'delService') {
        $id = $_GET['id'];
        $service->delService($id);
    }
}

class ServicesController {

    public function showServices() {
        $_SESSION['services'] = selectAll('*','services');
        header('location: ../manager/allServices.php');
    }
    public function addService() {
        header('location: ../manager/add-service.php');
    }
    public function storeService() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_service'])) {
                $title=trim($_POST['title']);
                $body = trim($_POST['body']);
                $data = [
                    'title'=>$title,
                    'body'=>$body,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($title)) {
                    array_push($error,"title required");
                } 
                if (empty($body)) {
                    array_push($error,"body required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/add-service.php');
                    exit();
                }
                $inserted = array_values($data);
                $keys = join(',',array_keys($data));
                $id = insert($keys,'services','?,?',$inserted);
                if(!empty($id)) {
                    $_SESSION['msg'] = "Service Added Successfuly";

                    $this->showServices();
                }
            }
        }
    }
    public function editService($id) {
        $_SESSION['service'] = selectOne('*','services','id = '.$id);
        header('location: ../manager/edit-service.php');
    }
    public function updateService($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['update_service'])) {
                $title=trim($_POST['title']);
                $body = trim($_POST['body']);
                $data = [
                    'title'=>$title,
                    'body'=>$body,
                    'id'=>$id
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($title)) {
                    array_push($error,"title required");
                } 
                if (empty($body)) {
                    array_push($error,"body required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/edit-service.php');
                    exit();
                }
                $inserted = array_values($data);
                $success = update('title = ?,body = ?','services',$inserted,'id = ?');
                if($success) {
                    unset($_SESSION['service']);
                    $_SESSION['msg'] = "Service Updated Successfuly";
                    $this->showServices();
                }
            }
        }
    }
    public function delService($id) {
        $data = [$id];
        $success = delete('services','id = ?',$data);
        if($success) {
            $_SESSION['msg'] = "Service Deleted Successfuly";
            $this->showServices();
        }
    }

    
}