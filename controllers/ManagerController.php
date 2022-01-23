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
    
    if($method == 'allKids') {
        $manager->showAllKids();
    }
    if($method == 'showKid') {
        $id = $_GET['id'];
        $manager->showKid($id);
    }
    if($method == 'showParent') {
        $id = $_GET['id'];
        $manager->showParent($id);
    }
    if($method == 'showStaff') {
        $id = $_GET['id'];
        $manager->showStaff($id);
    }
    if($method == "allPayments") {
        $manager->showAllPayments();
    }
    if($method == "allStaff") {
        $manager->showAllStaff();
    }
    if($method == "sortAdvisor") {
        $manager->sortAdvisor();
    }
    if($method == "sortStaff") {
        $manager->sortStaff();
    }
    if($method == "delStaff") {
        $id = $_GET['id'];
        $manager->delStaff($id);
    }
    if($method == 'logout') {
        $manager->logout();
    }
    if($method == "showAddEvaluation") {
        $manager->showAddEvaluation();
    }
    if($method == "addEvaluate") {
        $manager->addEvaluate();
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

    public function showAllKids() {
        $select = 'p.name as parent_name , k.*';
        $table = 'parent p, kids k';
        $where = "p.id = k.parent_id and k.status = 'not accepted'";
        $_SESSION['unaccepted-kids'] = selectAll($select,$table,$where);
        $select = 'p.name as parent_name, k.* , s.name as staff_name';
        $table = 'parent p, kids k , staff s';
        $where = "p.id = k.parent_id and s.id = k.staff_id and k.status = 'accepted'";
        $_SESSION['accepted-kids'] = selectAll($select,$table,$where);
        header('location: '.$this->Path.'all-kids.php');
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

    public function showAllPayments() {
        $select = 'k.fname , k.lname , k.id as k_id , p.*';
        $table = 'payments p, kids k';
        $where = "k.id = p.kids_id ";
        $_SESSION['payments'] = selectAll($select,$table,$where);
        header('location: '.$this->Path.'all-payments.php');

    }

    public function showAllStaff() {
        $_SESSION['allStaff'] = selectAll('*','staff',"role = 'staff'",'name ASC');
        $_SESSION['allAdvisor'] = selectAll('*','staff',"role = 'advisor'",'name ASC');
        header('location: '.$this->Path.'all-staff.php');
    }
    public function sortAdvisor() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['sortAdvisor'])) { 
                $sort = trim($_POST['advisor-sort']) == 1 ? 'ASC' : 'DESC';
                $_SESSION['allAdvisor'] = selectAll('*','staff',"role = 'advisor'",'name '.$sort);
                header('location: '.$this->Path.'all-staff.php');
            }
        }
       
    }
    public function sortStaff() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['sortStaff'])) { 
                $sort = trim($_POST['staff-sort']) == 1 ? 'ASC' : 'DESC';
                $_SESSION['allStaff'] = selectAll('*','staff',"role = 'staff'",'name '.$sort);
                header('location: '.$this->Path.'all-staff.php');
            }
        }
       
    }
    public function delStaff($id) {
        $staff = selectOne('*','staff','id ='.$id);
        if($staff['role'] == "advisor") {
            $kids = selectAll('*','kids','staff_id ='.$id);
            if(!empty($kids)) {
                header('location: ../errors/advisorError.php');
                exit();
            }
        }
        $data = [$id];
        $success = delete('staff','id = ?',$data);
        if($success) {
            $_SESSION['msg'] = "Staff Deleted Successfuly";
            $_SESSION['allStaff'] = selectAll('*','staff',"role = 'staff'",'name ASC');
            $_SESSION['allAdvisor'] = selectAll('*','staff',"role = 'advisor'",'name ASC');
            header('location: '.$this->Path.'all-staff.php');
        }
    }
    public function logout(){
        unset($_SESSION['manager']);
        unset($_SESSION['username']);
        header('location: ../');

    }
    public function showAddEvaluation()
    {
        $advisors= selectAll('*','staff',"role='advisor'");
        $_SESSION['getadvisors']=$advisors;
        header('location: '.$this->Path.'addevaluation.php');
    }

    public function addEvaluate() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['manager-evaluation'])) { 
                $advisor_id = trim($_POST['advisor_id']);
                $manager_id = $_SESSION['manager']['id'];
                $type = 'manager';
                $ev = 0;
                for($i = 1 ; $i< 8 ; $i++) {
                    $ev +=  $_POST['ev-'.$i];
                }
                $result = $ev*100/28;
                $evaluation = selectOne('*','evaluation',"evaluate_id = {$advisor_id} and type = '{$type}' and staff_id = {$manager_id}");
                $flag = false;
                if(!empty($evaluation)) {
                    $id = $evaluation['id'];
                    $data = [$result,$id];
                    $success = update('result = ?','evaluation',$data,'id = ?');
                    if($success)
                        $flag = true;
                } else {
                    $data = [
                        'result' => $result,
                        'type' => $type,
                        'staff_id' => $manager_id,
                        'evaluate_id' => $advisor_id
                    ];
                    $keys = join(',',array_keys($data));
                    $values = array_values($data);
                    $insert_id = insert($keys,'evaluation','?,?,?,?',$values);
                    if($insert_id)
                        $flag = true;
                }

                if($flag == true) {
                    $ev_manager_count = selectOne('count(*) as count','evaluation',"type = '{$type}' and evaluate_id = {$advisor_id}");
                    $count_m = $ev_manager_count['count'];
                    $m_avg = 0;
                    if($count_m > 0) {
                        $ev_manager = selectAll('*','evaluation',"type = '{$type}' and evaluate_id = {$advisor_id}");
                        $m_sum = 0;
                        foreach($ev_manager as $ev_m) {
                            $m_sum += (int) $ev_m['result'];
                        }
                        $m_avg = $m_sum/$count_m;
                    }

                    $ev_parent_count = selectOne('count(*) as count','evaluation',"type = 'parent' and evaluate_id = {$advisor_id}");
                    $count_p = $ev_parent_count['count'];
                    $p_avg = 0;
                    if($count_p > 0) {
                        $ev_parent = selectAll('*','evaluation',"type = 'parent' and evaluate_id = {$advisor_id}");
                        $p_sum = 0;
                        foreach($ev_parent as $ev_p) {
                            $p_sum += (int) $ev_p['result'];
                        }
                        $p_avg = $p_sum/$count_p;
                    }
                    $avgResult = ( $m_avg + $p_avg ) / 2 ;
                    if($avgResult >= 90) {
                        $review = 'Excellent';
                    } else if ($avgResult < 90 && $avgResult >= 60) {
                        $review = 'Very Good';
                    } else if ($avgResult < 60 && $avgResult >= 30) {
                        $review = 'Good';
                    } else  {
                        $review = 'Bad';
                    }
                    $data = [$review,$advisor_id];
                    $success = update('review = ?','staff',$data,'id = ?');
                    if($success) {
                        $_SESSION['msg'] = "Evaluation Done Successfuly";
                        $this->showAllStaff();
                    }

                }
               
            }
        }
    }

}