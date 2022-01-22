<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $new = new NewsController();
    if($method == 'showNews') {
        $new->showNews();
    }
    if($method == 'addNew') {
        $new->addNew();
    }
    if($method == 'storeNew') {
        $new->storeNew();
    }
    if($method == 'editNew') {
        $id = $_GET['id'];
        $new->editNew($id);
    }
    if($method == 'updateNew') {
        $id = $_GET['id'];
        $new->updateNew($id);
    }
    if($method == 'delNew') {
        $id = $_GET['id'];
        $new->delNew($id);
    }
    
}

class NewsController {

    public function showNews() {
        $_SESSION['news'] = selectAll('*','news');
        header('location: ../manager/allNews.php');
    }
    public function addNew() {
        header('location: ../manager/add-new.php');
    }

    public function storeNew() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_new'])) {
                $title=trim($_POST['title']);
                $content = trim($_POST['content']);
                $data = [
                    'title'=>$title,
                    'content'=>$content,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($title)) {
                    array_push($error,"title required");
                } 
                if (empty($content)) {
                    array_push($error,"content required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/add-new.php');
                    exit();
                }
                $inserted = array_values($data);
                $keys = join(',',array_keys($data));
                $id = insert($keys,'news','?,?',$inserted);
                if(!empty($id)) {
                    $_SESSION['msg'] = "New Added Successfuly";
                    $this->showNews();
                }
            }
        }
    }

    public function editNew($id) {
        $_SESSION['new'] = selectOne('*','news','id = '.$id);
        header('location: ../manager/edit-new.php');
    }

    public function updateNew($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['update_new'])) {
                $title=trim($_POST['title']);
                $content = trim($_POST['content']);
                $data = [
                    'title'=>$title,
                    'content'=>$content,
                    'id'=>$id
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($title)) {
                    array_push($error,"title required");
                } 
                if (empty($content)) {
                    array_push($error,"content required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/edit-new.php');
                    exit();
                }
                $inserted = array_values($data);
                $success = update('title = ?,content = ?','news',$inserted,'id = ?');
                if($success) {
                    unset($_SESSION['new']);
                    $_SESSION['msg'] = "New Updated Successfuly";

                    $this->showNews();
                }
            }
        }
    }

    public function delNew($id) {
        $data = [$id];
        $success = delete('news','id = ?',$data);
        if($success) {
            $_SESSION['msg'] = "New Deleted Successfuly";
            $this->showNews();
        }
    }
}