<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $Parent = new ParentContoller();
    if($method == 'showLogin') {
        $Parent->showLogin();
    }
    if($method == 'login') {
        $Parent->login();
    }
    if($method == 'showRegister') {
        $Parent->showRegister();
    } 
    if($method == 'register') {
        $Parent->register();
    }
    if($method == 'showSettings') {
        $Parent->showSettings();
    }

    if($method == 'showChangePassword') {
        $Parent->showChangePassword();
    }

    if($method == 'editProfile') {
        $Parent->editProfile();
    }

    if($method == 'changePassword') {
        $Parent->changePassword();
    }
    if($method == 'allkids') {
        $Parent->showAllKids();
    }
    if($method == 'notifications') {
        $Parent->showNotifications();
    }
    if($method == 'showProfile') {
        $Parent->showProfile();
    }
    if($method == 'logout') {
        $Parent->logout();
    }
 

}

class ParentContoller {
    private $Path = "../parent/";
    public function showLogin() {
        header('location: '.$this->Path.'login.php');
    }

    public function login() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['parent_login'])) {
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
                $parent = selectOne('*','parent',"username = '$username'");
                if (empty($parent)) {
                    array_push($error,"this Username not exist in Database");
                } 

                if (!empty($parent)) {
                    if(! password_verify($password,$parent['password'])) {
                        array_push($error,"this password is invalid");
                    }
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'login.php');
                    exit();
                }
                $result = selectOne('phone','parent_phone','parent_id = '.$parent['id']);
                $_SESSION['parent'] = $parent;
                $_SESSION['parent']['phone'] = $result['phone'];
                $_SESSION['username'] = $parent['username'];
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
            if(isset($_POST['parent_register'])) {
                $name=trim($_POST['name']);
                $username = trim($_POST['username']);
                $ssn = trim($_POST['ssn']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'ssn'=>$ssn,
                    'phone'=>$phone,
                    'address'=>$address,
                    'password'=> $hashpassword,

                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($ssn)) {
                    array_push($error,"ssn required");
                } 
                if (empty($phone) || strlen($phone)<6 || !is_numeric($phone)) {
                    if(empty($phone))
                    {
                        array_push($error,"phone required");
                    }
                    else if(strlen($phone)<6)
                    {
                        array_push($error,"Phone must be 6 digit");
                    }
                    else{
                        array_push($error,"phone number contains numbers only");
                    }
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                } 
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password requires");
                } 
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                } 
                if (empty($address)) {
                    array_push($error,"address required");
                } 
                $parent = selectOne('*','parent',"username = '$username'");
                if (!empty($parent)) {
                    array_push($error,"this Username exist in Database");
                } 
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'register.php');
                    exit();
                }
                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'ssn'=>$ssn,
                    'address'=>$address,
                    'password'=> $hashpassword,
                ];
                $inserted = array_values($data);
                $keys = join(',',array_keys($data));
                $parent_id = insert($keys,'parent','?,?,?,?,?',$inserted);
                if(!empty($parent_id)) {
                    $data = [
                        'phone'=>$phone,
                        'parent_id'=>$parent_id,
                    ];
                    $inserted = array_values($data);
                    $keys = join(',',array_keys($data));
                    $id = insert($keys,'parent_phone','?,?',$inserted);
                    if(!empty($id)) {
    
                        $result = selectOne('*','parent','id = '.$parent_id);
                        $_SESSION['parent'] = $result;
                        $_SESSION['parent']['phone'] = $phone;
                        $_SESSION['username'] = $result['username'];
                        header('location: ../');
                    }
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
                $parent_id = $_SESSION['parent']['id'];
                $data = [
                    'password'=>$hashpassword,
                    'id'=>$parent_id
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

                $success = update('password = ?','parent',array_values($data),'id = ?');
                if($success) {
                    $_SESSION['parent']['password'] = $hashpassword;
                    header('location: '.$this->Path);
                }

            }
        }
    }



    public function editProfile() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_profile'])) {
                $name=trim($_POST['name']);
                $username = trim($_POST['username']);
                $ssn = trim($_POST['ssn']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'ssn'=>$ssn,
                    'phone'=>$phone,
                    'address'=>$address,

                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if (empty($ssn)) {
                    array_push($error,"ssn required");
                } 
                if (empty($phone) || strlen($phone)<6 || !is_numeric($phone)) {
                    if(empty($phone))
                    {
                        array_push($error,"phone required");
                    }
                    else if(strlen($phone)<6)
                    {
                        array_push($error,"Phone must be 6 digit");
                    }
                    else{
                        array_push($error,"phone number contains numbers only");
                    }
                }  
                if (empty($address)) {
                    array_push($error,"address required");
                } 
                if($username != $_SESSION['username']) {
                    $parent = selectOne('*','parent',"username = '$username'");
                    if (!empty($parent)) {
                        array_push($error,"this Username exist in Database");
                    } 
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'settings.php');
                    exit();
                }
                $parent_id = $_SESSION['parent']['id'];
                $data = [
                    'username'=>$username,
                    'name'=>$name,
                    'ssn'=>$ssn,
                    'address'=>$address,
                    'id' => $parent_id
                ];
                $success = update('username = ? , name = ? , ssn = ? , address = ?','parent',array_values($data),'id = ?');
                if($success) {
                    $data = [
                        'phone'=>$phone,
                        'parent_id'=>$parent_id,
                    ];
                    $success = update('phone = ? ','parent_phone',array_values($data),'parent_id = ?');

                    if($success) {
    
                        $_SESSION['username'] = $username;
                        $_SESSION['parent']['phone'] = $phone;
                        $_SESSION['parent']['username'] = $username;
                        $_SESSION['parent']['name'] = $name;
                        $_SESSION['parent']['ssn'] = $ssn;
                        $_SESSION['parent']['address'] = $address;
                        header('location: '.$this->Path);
                    }
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
        unset($_SESSION['parent']);
        unset($_SESSION['username']);
        header('location: ../');

    }
}