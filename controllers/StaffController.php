<?php 
session_start();

include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $staff = new StaffContoller();
    if($method == 'showLogin') {
        $staff->showLogin();
    }
    if($method == 'login') {
        $staff->login();
    }
    if($method == 'showRegister') {
        $staff->showRegister();
    } 

    if($method == 'register') {
        $staff->Register();
    } 

    if($method == 'showSettings') {
        $staff->showSettings();
    }

    if($method == 'showChangePassword') {
        $staff->showChangePassword();
    }

    if($method == 'editProfile') {
        $staff->editProfile();
    }

    if($method == 'changePassword') {
        $staff->changePassword();
    }

    if($method == 'allkids') {
        $staff->showAllKids();
    }
    if($method == 'notifications') {
        $staff->showNotifications();
    }
    if($method == 'showProfile') {
        $staff->showProfile();
    }

    if($method == 'logout') {
        $staff->logout();
    }

}

class StaffContoller {
    private $Path = "../staff/";
    public function showLogin() {
        header('location: '.$this->Path.'login.php');
    }

    public function login() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['staff_login'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $data = [
                    'username'=>$username,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                }  
                $staff = selectOne('*','staff',"username = '$username'");
                if (empty($staff)) {
                    array_push($error,"this Username not exist in Database");
                } 

                if (!empty($staff)) {
                    if(! password_verify($password,$staff['password'])) {
                        array_push($error,"this password is invalid");
                    }
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'login.php');
                    exit();
                }
                
                $_SESSION['staff'] = $staff;
                $_SESSION['username'] = $staff['username'];
                header('location: ../');

            }
        }
    }

    public function showRegister() {
        header('location: '.$this->Path.'register.php');
    }

    public function register() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['staff_register'])) {
                $name=trim($_POST['name']);
                $username = trim($_POST['username']);
                $position = trim($_POST['position']);
                $role = trim($_POST['role']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'position'=>$position,
                    'password'=> $hashpassword,
                    'role'=>$role
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($position)) {
                    array_push($error,"position required");
                } 
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
                $staff = selectOne('*','staff',"username = '$username'");
                if (!empty($staff)) {
                    array_push($error,"this Username exist in Database");
                } 
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'register.php');
                    exit();
                }
                $inserted = array_values($data);
                $keys = join(',',array_keys($data));
                $id = insert($keys,'staff','?,?,?,?',$inserted);
                if(!empty($id)) {
                    $result = selectOne('*','staff','id = '.$id);
                    $_SESSION['staff'] = $result;
                    $_SESSION['username'] = $result['username'];
                    header('location: ../');
                }
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
                $staff_id = $_SESSION['staff']['id'];
                $data = [
                    'password'=>$hashpassword,
                    'id'=>$staff_id
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
                    $_SESSION['staff']['password'] = $hashpassword;
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
                $staff_id = $_SESSION['staff']['id'];

                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'position'=>$position,
                    'id'=>$staff_id

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
                    $_SESSION['staff']['username'] = $username; 
                    $_SESSION['staff']['name'] = $name; 
                    $_SESSION['staff']['position'] = $position; 
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

    public function showAllKids() {
        
    }

    public function showNotifications() {
        
    }

    public function showProfile() {
        header('location: '.$this->Path);
    }

    public function logout(){
        unset($_SESSION['staff']);
        unset($_SESSION['username']);
        header('location: ../');
    }
}