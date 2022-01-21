<?php 
session_start();

include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $manager = new ManagerController();
    if($method == 'showLogin') {
        $manager->showLogin();
    }

    if($method == 'login') {
        $manager->login();
    }

    if($method == 'showSettings') {
        $manager->showSettings();
    }

    if($method == 'showChangePassword') {
        $manager->showChangePassword();
    }

    if($method == 'editProfile') {
        $manager->editProfile();
    }

    if($method == 'changePassword') {
        $manager->changePassword();
    }

    if($method == 'showProfile') {
        $manager->showProfile();
    }

    if($method == 'dashboard') {
        $manager->showDashboard();
    }
    if($method == 'showNews') {
        $manager->showNews();
    }
    
   
    if($method == 'logout') {
        $manager->logout();
    }
    

}

class ManagerController {
    private $Path = "../manager/";
    public function showLogin() {
        header('location: '.$this->Path.'login.php');
    }

    public function login() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['manager_login'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $captcha = trim($_POST['captcha']);
                $data = [
                    'username'=>$username,
                ];
                $error=[];
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if ($_SESSION['CAPTCHA_CODE'] != $captcha) {
                    array_push($error,"Captcha Not Matched");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                }  
                $manager = selectOne('*','staff',"username = '$username'");
                if (empty($manager)) {
                    array_push($error,"this Username not exist in Database");
                } 

                if (!empty($manager) ) {
                    if($manager['role'] != 'manager') {
                        array_push($error,"please login from Staff, You are Staff");
                    }
                    else if(! password_verify($password,$manager['password'])) {
                            array_push($error,"this password is invalid");
                    }
                }

                if(!empty($error))
                {
                    $_SESSION['oldData'] = $data;
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'login.php');
                    exit();
                }
                
                $_SESSION['manager'] = $manager;
                $_SESSION['username'] = $manager['username'];
                $_SESSION['msg'] = "Manager Login Successfuly";

               // header('location: ../');
                header('location: ../manager/dashboard.php');


            }
        }
    }

    public function changePassword() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['change_password'])) {
                $confirm_password = trim($_POST['confirm_password']);
                $password = trim($_POST['password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $manager_id = $_SESSION['manager']['id'];
                $data = [
                    'password'=>$hashpassword,
                    'id'=>$manager_id
                ];
                $error=[];
                if (empty($password)) {
                    array_push($error,"password required");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                } 
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password required");
                } 
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'changePassword.php');
                    exit();
                }

                $success = update('password = ?','staff',array_values($data),'id = ?');
                if($success) {
                    $_SESSION['manager']['password'] = $hashpassword;
                    $_SESSION['msg'] = "Change Password Successfuly";

                    header('location: '.$this->Path);
                }

            }
        }
    }

    public function editProfile() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_profile'])) {
                $username = trim($_POST['username']);
                $name = trim($_POST['name']);
                $position = trim($_POST['position']);
                $manager_id = $_SESSION['manager']['id'];

                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'position'=>$position,
                    'id'=>$manager_id

                ];
                $error=[];
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($position)) {
                    array_push($error,"position required");
                } 
                if($username != $_SESSION['username']) {
                    $manager = selectOne('*','staff',"username = '$username'");
                    if (!empty($manager) ) {
                        array_push($error,"this Username exist in Database");
                    } 
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    header('location: '.$this->Path.'settings.php');
                    exit();
                }
                
                $success = update('username = ? , name = ? , position = ?','staff',array_values($data),'id = ?');
                if($success) {
                    $_SESSION['username'] = $username;
                    $_SESSION['manager']['username'] = $username; 
                    $_SESSION['manager']['name'] = $name; 
                    $_SESSION['manager']['position'] = $position; 
                    $_SESSION['msg'] = "Edit Profile Successfuly";

                    header('location: '.$this->Path);

                }


            }
        }
    }

    public function showSettings() {
        header('location: '.$this->Path.'settings.php');
    }

    public function showChangePassword() {
        header('location: '.$this->Path.'changePassword.php');

    }

    public function showProfile() {
        header('location: '.$this->Path);
    }

    public function showDashboard() {
        header('location: '.$this->Path.'dashboard.php');
    }

    public function showNews() {
        $_SESSION['news'] = selectAll('*','news',null,'id DESC');
        header('location: '.$this->Path.'allNews.php');
    }

    

   


    public function logout(){
        unset($_SESSION['manager']);
        unset($_SESSION['username']);
        header('location: ../');

    }
}