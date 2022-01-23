<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $contact = new ContactController();
    if($method == 'showContacts') {
        $contact->showContacts();
    }
    if($method == 'addContact') {
        $contact->addContact();
    }
    if($method == 'storeContact') {
        $contact->storeContact();
    }
    if($method == 'editContact') {
        $id = $_GET['id'];
        $contact->editContact($id);
    }
    if($method == 'updateContact') {
        $id = $_GET['id'];
        $contact->updateContact($id);
    }
    if($method == 'delContact') {
        $id = $_GET['id'];
        $contact->delContact($id);
    }
    
}

class ContactController {

    public function showContacts() {
        
        $_SESSION['contacts'] = selectAll('*','contacts');
        header('location: ../manager/allContacts.php');
    }

    public function addContact() {
        header('location: ../manager/add-contact.php');
    }

    public function storeContact() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_contact'])) {
                $type=trim($_POST['type']);
                $contact = trim($_POST['contact']);
                $data = [
                    'contact'=>$contact,
                    'type'=>$type,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($contact)) {
                    array_push($error,"contact required");
                } 
                if (empty($type)) {
                    array_push($error,"type required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/add-contact.php');
                    exit();
                }
                $inserted = array_values($data);
                $keys = join(',',array_keys($data));
                $id = insert($keys,'contacts','?,?',$inserted);
                if(!empty($id)) {
                    $_SESSION['msg'] = "Contact Added Successfuly";
                    $this->showContacts();
                }
            }
        }
    }

    public function editContact($id) {
        $_SESSION['contact'] = selectOne('*','contacts','id = '.$id);
        header('location: ../manager/edit-contact.php');
    }

    public function updateContact($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['update_contact'])) {
                $type=trim($_POST['type']);
                $contact = trim($_POST['contact']);
                $data = [
                    'contact'=>$contact,
                    'type'=>$type,
                    'id' => $id
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($contact)) {
                    array_push($error,"contact required");
                } 
                if (empty($type)) {
                    array_push($error,"type required");
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../manager/edit-contact.php');
                    exit();
                }
                $inserted = array_values($data);
                $success = update('contact = ? , type = ? ','contacts',$inserted,'id = ?');
                if($success) {
                    unset($_SESSION['contact']);
                    $_SESSION['msg'] = "Contact Updated Successfuly";
                    $this->showContacts();
                }
            }
        }
    }

    public function delContact($id) {
        $data = [$id];
        $success = delete('contacts','id = ?',$data);
        if($success) {
            $_SESSION['msg'] = "Contact Deleted Successfuly";
            $this->showContacts();
        }
    }
}