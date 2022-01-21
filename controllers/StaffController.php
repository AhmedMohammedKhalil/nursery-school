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

    if($method == 'allKids') {
        $staff->showAllKids();
    }
    if($method == 'showKid') {
        $id = $_GET['id'];
        $staff->showKid($id);
    }
    if($method == 'showParent') {
        $id = $_GET['id'];
        $staff->showParent($id);
    }
    if($method == 'showStaff') {
        $id = $_GET['id'];
        $staff->showStaff($id);
    }
    if($method == 'showNotifications') {
        $staff->showNotifications();
    }
    if($method == 'showProfile') {
        $staff->showProfile();
    }
    if($method == 'showAcceptedKid') {
        $id = $_GET['id'];
        $staff->showAcceptedKid($id);
    }

    if($method == 'acceptedKid') {
        $staff->acceptedKid();
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
                $captcha = trim($_POST['captcha']);
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
                if ($_SESSION['CAPTCHA_CODE'] != $captcha) {
                    array_push($error,"Captcha Not Matched");
                }
                $staff = selectOne('*','staff',"username = '$username'");
                if (empty($staff)) {
                    array_push($error,"this Username not exist in Database");
                } 

                if (!empty($staff) ) {
                    if($staff['role'] == 'manager') {
                        array_push($error,"please login from Manager, You are Manager");
                    }
                    else if(! password_verify($password,$staff['password'])) {
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
                $this->dashboard();


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
                $captcha = trim($_POST['captcha']);
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
                if ($_SESSION['CAPTCHA_CODE'] != $captcha) {
                    array_push($error,"Captcha Not Matched");
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
                $id = insert($keys,'staff','?,?,?,?,?',$inserted);
                if(!empty($id)) {
                    $result = selectOne('*','staff','id = '.$id);
                    $_SESSION['staff'] = $result;
                    $_SESSION['username'] = $result['username'];
                    $this->dashboard();  
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
        $staff_id = $_SESSION['staff']['id'];
        if($_SESSION['staff']['role'] == 'staff') {
            $select = 'p.name as parent_name , k.*';
            $table = 'parent p, kids k';
            $where = "p.id = k.parent_id and k.status = 'not accepted'";
            $_SESSION['unaccepted-kids'] = selectAll($select,$table,$where);
            $select = 'p.name as parent_name, k.* , s.name as staff_name';
            $table = 'parent p, kids k , staff s';
            $where = "p.id = k.parent_id and s.id = k.staff_id and k.status = 'accepted'";
            $_SESSION['accepted-kids'] = selectAll($select,$table,$where);
        } else {
            $select = 'p.name as parent_name , k.*';
            $table = 'parent p, kids k';
            $where = "p.id = k.parent_id and k.status = 'accepted' and k.staff_id = {$staff_id}";
            $_SESSION['all_kids'] = selectAll($select,$table,$where);
        }
        header('location: '.$this->Path.'all-kids.php');
    }

    public function showNotifications() {
        $staff_id = $_SESSION['staff']['id'];
        $allnotifications = selectAll('k.status, n.*','notifications n , kids k',"k.id = n.kid_id and n.message_to = 'staff' and n.staff_id ={$staff_id}" ,'id DESC');
        $_SESSION['notifications'] = $allnotifications;
        header('location: '.$this->Path.'notifications.php');
    }

    public function showProfile() {
        header('location: '.$this->Path);
    }

    public function showKid($id) {
        $_SESSION['kid'] = selectOne('*','kids','id ='.$id);
        header('location: '.$this->Path.'kids-info.php');
    }

    public function showStaff($id) {
        $_SESSION['staff_info'] = selectOne('*','staff','id ='.$id);
        header('location: '.$this->Path.'staff-info.php');
    }

    public function showParent($id) {
        $_SESSION['parent_info'] = selectOne('*','parent','id ='.$id);
        $phone = selectOne('phone','parent_phone','parent_id ='.$id);
        $_SESSION['parent_info']['phone'] = $phone['phone'];
        header('location: '.$this->Path.'parent-info.php');
    }


    public function showAcceptedKid($id) {
        $advisors = selectAll('*','staff',"role = 'advisor'");
        if(!empty($advisors)) {
            $_SESSION['advisors'] = $advisors;
            $_SESSION['kid_id'] = $id;
            header('location: '.$this->Path.'accepted-kid.php');
        } else {
            header('location: ../errors/staffError.php');
        }
    }

    public function acceptedKid() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['accepted_kid'])) {
                $kid_id = trim($_POST['id']);
                $advisor_id = trim($_POST['advisor']);
                $inserted = ['accepted',$advisor_id,$kid_id];
                $success = update('status = ? , staff_id = ?','kids',$inserted,'id = ?');
                if($success) {
                    $data = [
                        'message'=>'your Kid Accepted',
                        'message_to'=>'parent',
                        'staff_id'=>$advisor_id,
                        'kid_id'=>$kid_id
                    ];
                    $keys=join(',',array_keys($data));
                    $inserted=array_values($data);
                    $id = insert($keys,'notifications','?,?,?,?',$inserted);
                    if($id) {
                        unsetAllSession();
                        $this->showAllKids();
                    }
                }
            }
        }
    }

    public function logout(){
        unset($_SESSION['staff']);
        unset($_SESSION['username']);
        header('location: ../');
    }

    public function dashboard() {
        header('location: '.$this->Path.'dashboard.php');
    }
}