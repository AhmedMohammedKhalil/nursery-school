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
    if($method == 'allKids') {
        $Parent->showAllKids();
    }
    if($method == 'showKidsAdvisors') {
        $Parent->showKidsAdvisors();
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
    if($method == 'addKid') {
        $Parent->addKid();
    }
    if($method == 'storeKid') {
        $Parent->storeKid();
    }
    if($method == 'editKid') {
        $id = $_GET['id'];
        $Parent->editKid($id);
    }
    if($method == 'updateKid') {
        $Parent->updateKid();
    }
    if($method == 'deleteKid') {
        $id = $_GET['id'];
        $Parent->deleteKid($id);
    }
    if($method == 'showKid') {
        $id = $_GET['id'];
        $Parent->showKid($id);
    }
    if($method == 'showStaff') {
        $id = $_GET['id'];
        $Parent->showStaff($id);
    }
    
    if($method == "dashboard") {
        $Parent->dashboard();
    }
    if($method == "getNotifications") {
        $Parent->showNotifications();
    }
    if($method == 'addpayment') {
        $id = $_GET['id'];
        $Parent->addpayment($id);
    }
    if($method == 'addPaymentToAllKids') {   
        $Parent->addPaymentToAllKids();
    }
    if($method == "storePayment") {
        $Parent->storePayment();
    }
    if($method == "showAllPayments") {
        $Parent->showAllPayments();
    }
    if($method == "addevaluation") {
        $Parent->addevaluation();
    }
    if($method == "storeEvaluation") {
        $Parent->storeEvaluation();
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
                $captcha = trim($_POST['captcha']);
                $data = [
                    'username'=>$username,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($username)) {
                    array_push($error,"username required");
                } 
                if ($_SESSION['CAPTCHA_CODE'] != $captcha) {
                    array_push($error,"Captcha Not Matched");
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
             //   header('location: ../');
                $_SESSION['msg'] = "Parent Login Successfuly";
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
            if(isset($_POST['parent_register'])) {
                $name=trim($_POST['name']);
                $username = trim($_POST['username']);
                $ssn = trim($_POST['ssn']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $captcha = trim($_POST['captcha']);
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
                    array_push($error,"Civil Id required");
                } 
                if (strlen($ssn) !=12 ) {
                    array_push($error,"Civil Id Must be 12 digit");
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
                if ($_SESSION['CAPTCHA_CODE'] != $captcha) {
                    array_push($error,"Captcha Not Matched");
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
                        $_SESSION['msg'] = "Parent Register Successfuly";
                        $this->dashboard();
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
                    $_SESSION['msg'] = "Password chenged Successfully";
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
                        $_SESSION['msg'] = "Profile Updated Successfully";
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
    

    public function showNotifications() {
        $parent_id=$_SESSION['parent']['id'];
        $notifications= selectAll('notifications.*','notifications,parent,kids',"notifications.kid_id=kids.id AND
        kids.parent_id =parent.id AND
        notifications.message_to ='parent' AND
        parent.id={$parent_id}","id DESC");
        $_SESSION['notifications']=$notifications;
        header('location: ../parent/notifications.php');
    }

    public function showProfile() {
        header('location: '.$this->Path);
    }
    

    public function logout(){
        unset($_SESSION['parent']);
        unset($_SESSION['username']);
        header('location: ../');

    }

    public function showAllKids() {
        $parent_id=$_SESSION['parent']['id'];
        $kids= selectAll('*','kids',"kids.parent_id={$parent_id}");
        $_SESSION['allkids']=$kids;
        header('location: ../parent/allkids.php');
    }
    public function showKidsAdvisors()
    {
        $parent_id=$_SESSION['parent']['id'];
        $kids= selectAll('kids.*,staff.name AS staff_name','kids,staff,parent',"kids.staff_id =staff.id AND kids.parent_id=parent.id AND parent.id={$parent_id}");
        $_SESSION['kids_advisors']=$kids;
        header('location: ../parent/kidsadvisors.php');
    }

    public function showKid($id)
    {
        if(isset($_SESSION['kid']))
        {
            unset($_SESSION['kid']);
        }
        $kid_id=$id;
        $kid= selectOne('*','kids',"id={$kid_id}");
        $_SESSION['kid']=$kid;
        header('location: ../parent/kidsinfo.php');
    }
    public function showStaff($id)
    {
        if(isset($_SESSION['staff_info']))
        {
            unset($_SESSION['staff_info']);
        }
        $staff_id=$id;
        $staff_info= selectOne('*','staff',"id={$staff_id}");
        $_SESSION['staff_info']=$staff_info;
        header('location: ../parent/staffinfo.php');
    }
    public function addKid()
    {
        header('location: ../parent/addkid.php');
    }
    public function storeKid()
    {   
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_kid'])) {
                $fname=trim($_POST['fname']);
                $lname=trim($_POST['lname']);
                $vaccination = trim($_POST['vaccination']);
                $class = trim($_POST['class']);
                $birth_date = trim($_POST['birth_date']);
                $description = trim($_POST['description']);
                $parent_id=$_SESSION['parent']['id'];
                $data = [
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'vaccination'=>$vaccination,
                    'class'=>$class,
                    'birth_date'=>$birth_date,
                    'description'=>$description,
                    'parent_id'=>$parent_id

                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($fname)) {
                    array_push($error,"fname required");
                } 
                if (empty($lname)) {
                    array_push($error,"lname required");
                } 
                if (empty($vaccination)) {
                    array_push($error,"vaccination required");
                } 
                if (empty($class)) {
                    array_push($error,"class required");
                }   
                if (empty($birth_date)) {
                    array_push($error,"birthdate required");
                } 
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../parent/addkid.php');
                    exit();
                }
                $keys=join(',',array_keys($data));
                $inserted=array_values($data);
                $allstaff=selectAll('*','staff',"role='staff'");
                if(!empty($allstaff))
                {
                    $kid_id = insert($keys,'kids','?,?,?,?,?,?,?',$inserted);
                    if($kid_id) 
                    { 
                        foreach ($allstaff as $s)
                        {
                        
                            $data = [
                                'message'=>'New kids added',
                                'message_to'=>'staff',
                                'staff_id'=>$s['id'],
                                'kid_id'=>$kid_id
                            ];
                            $keys=join(',',array_keys($data));
                            $inserted=array_values($data);
                            insertAll($keys,'notifications','?,?,?,?',$inserted);
                        }
                        $_SESSION['msg'] = "Kid Added Successfully";
                        $this->showAllKids();
                    }
                }
                else
                {
                    header('location: ../errors/KidsError.php');
                }
            }
        }
    }
    public function editKid($id)
    {   
        if(isset($_SESSION['kid']))
        {
            unset($_SESSION['kid']);
        }
        $kid_id=$id;
        $kid= selectOne('*','kids',"id={$kid_id}");
        $_SESSION['kid']=$kid;
        header('location: ../parent/editkid.php');
    }
    public function updateKid()
    {   
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['update_kid'])) {
                $fname=trim($_POST['fname']);
                $lname=trim($_POST['lname']);
                $vaccination = trim($_POST['vaccination']);
                $class = trim($_POST['class']);
                $birth_date = trim($_POST['birth_date']);
                $description = trim($_POST['description']);
                $kid_id=trim($_POST['kid_id']);
                $data = [
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'vaccination'=>$vaccination,
                    'class'=>$class,
                    'birth_date'=>$birth_date,
                    'description'=>$description

                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($fname)) {
                    array_push($error,"fname required");
                } 
                if (empty($lname)) {
                    array_push($error,"lname required");
                } 
                if (empty($vaccination)) {
                    array_push($error,"vaccination required");
                } 
                if (empty($class)) {
                    array_push($error,"class required");
                }   
                if (empty($birth_date)) {
                    array_push($error,"birthdate required");
                } 
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../parent/editkid.php');
                    exit();
                }                                              
                $data = [
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'vaccination'=>$vaccination,
                    'class'=>$class,
                    'birth_date'=>$birth_date,
                    'description'=>$description,
                    'id' => $kid_id
                ];
                $success = update('fname = ? , lname = ? , vaccination = ? , class = ?, birth_date = ? , description = ?','kids',array_values($data),'id = ?');
                if($success) { 
                        unset($_SESSION['kid']);
                        $_SESSION['msg'] = "Kid Updated Successfully";
                        $this->showAllKids();
                    }
                
            }
        }
    }
    public function deleteKid($id)
    {
        $data=[$id];
        delete('notifications',"kid_id= ?",$data) ;
        delete('payments',"kids_id= ?",$data) ;
        delete('kids',"id= ?",$data) ;
        $_SESSION['msg'] = "Kid Deleted Successfully";
        $this->showAllKids();
    }

    public function dashboard() {
        header('location: '.$this->Path.'dashboard.php');
    }

    public function addpayment($id)
    {
        $_SESSION['kid_id']=$id;
        header('location: '.$this->Path.'addpayment.php');
    }

    public function addPaymentToAllKids()
    {
        $parent_id=$_SESSION['parent']['id'];
        $kids= selectAll('*','kids',"kids.parent_id={$parent_id}");
        $_SESSION['kids']=$kids;
        header('location: '.$this->Path.'addpaymentallkids.php');
    }

    public function storePayment()
    {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['store_payment'])) {
                $description=trim($_POST['description']);
                $amount=trim($_POST['amount']);
                $kid_id = trim($_POST['kid_id']);
                $data = [
                    'description'=>$description,
                    'amount'=>$amount,
                    'kids_id'=>$kid_id,
                ];
                $_SESSION['oldData'] = $data;
                $error=[];
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                if (empty($amount)) {
                    array_push($error,"amount required");
                } 
                if (empty($amount) || !is_numeric($amount)) {
                    if(empty($amount))
                    {
                        array_push($error,"amount required");
                    }
                    else if(!is_numeric($amount)){ 
                        array_push($error,"amount contains numbers only");
                    }
                }
                if (empty($kid_id)) {
                    array_push($error,"kid required");
                } 
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: ../parent/addpayment.php');
                    exit();
                }
                $keys=join(',',array_keys($data));
                $inserted=array_values($data);
                    $payment_id = insert($keys,'payments','?,?,?',$inserted);
                    if($payment_id) 
                    {   
                        $kid= selectOne('*','kids',"id={$kid_id}");
                            $data = [
                                'message'=>'Payment Done successfuly',
                                'message_to'=>'staff',
                                'staff_id'=>$kid['staff_id'],
                                'kid_id'=>$kid_id
                            ];
                            $keys=join(',',array_keys($data));
                            $inserted=array_values($data);
                            insertAll($keys,'notifications','?,?,?,?',$inserted);
                        $_SESSION['msg'] = "Payment Done Successfully";
                        $this->showAllPayments();
                    }
                    }
            }
    }


    public function showAllPayments()
    {
        $parent_id=$_SESSION['parent']['id'];
        $payments= selectAll('payments.*,kids.id AS k_id,kids.fname,kids.lname','payments,parent,kids',"kids.parent_id=parent.id AND payments.kids_id =kids.id AND parent.id={$parent_id}");
        $_SESSION['allpayments']=$payments;
        header('location: ../parent/allpayments.php');
    }

    public function addevaluation()
    {
        $parent_id=$_SESSION['parent']['id'];
        $advisors= selectAll('DISTINCT staff.*','kids,staff,parent',"kids.staff_id =staff.id AND kids.parent_id=parent.id AND parent.id={$parent_id}");
        $_SESSION['advisors']=$advisors;
        header('location: '.$this->Path.'addevaluate.php');
    }
   
    public function storeEvaluation() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['parent-evaluate'])) { 
                $advisor_id = trim($_POST['advisor_id']);
                $parent_id = $_SESSION['parent']['id'];
                $type = 'parent';
                $ev = 0;
                for($i = 1 ; $i< 7 ; $i++) {
                    $ev +=  $_POST['ev-'.$i];
                }
                $result = $ev*100/24;
                $evaluation = selectOne('*','evaluation',"evaluate_id = {$advisor_id} and type = '{$type}' and parent_id = {$parent_id}");
                $flag = false;
                if(!empty($evaluation)) {
                    $id = $evaluation['id'];
                    $data = [$result,$id];
                    $success = update('result = ?','evaluation',$data,'id = ?');
                    if($success)
                        $flag = true;
                } else {
                    $data = [
                        'result' => $ev,
                        'type' => $type,
                        'parent_id' => $parent_id,
                        'evaluate_id' => $advisor_id
                    ];
                    $keys = join(',',array_keys($data));
                    $values = array_values($data);
                    $insert_id = insert($keys,'evaluation','?,?,?,?',$values);
                    if($insert_id)
                        $flag = true;
                }

                if($flag == true) {
                    $ev_manager_count = selectOne('count(*) as count','evaluation',"type = 'manager' evaluate_id = {$advisor_id}");
                    $count_m = $ev_manager_count['count'];
                    $m_avg = 0;
                    if($count_m > 0) {
                        $ev_manager = selectAll('*','evaluation',"type = 'manager' evaluate_id = {$advisor_id}");
                        $m_sum = 0;
                        foreach($ev_manager as $ev_m) {
                            $m_sum += $ev_m['result'];
                        }
                        $m_avg = $m_sum/$count_m;
                    }

                    $ev_parent_count = selectOne('count(*) as count','evaluation',"type = 'parent' evaluate_id = {$advisor_id}");
                    $count_p = $ev_parent_count['count'];
                    $p_avg = 0;
                    if($count_p > 0) {
                        $ev_parent = selectAll('*','evaluation',"type = 'parent' evaluate_id = {$advisor_id}");
                        $p_sum = 0;
                        foreach($ev_parent as $ev_p) {
                            $p_sum += $ev_p['result'];
                        }
                        $p_avg = $p_sum/$count_p;
                    }
                    $avgResult = ( $m_avg + $p_avg ) / 2 ;
                    if($avgResult >= 75) {
                        $review = 'Excellent';
                    } else if ($avgResult < 75 && $avgResult >= 50) {
                        $review = 'Very Good';
                    } else if ($avgResult < 50 && $avgResult >= 25) {
                        $review = 'Good';
                    } else  {
                        $review = 'Bad';
                    }
                    $data = [$review,$advisor_id];
                    $success = update('review = ?','staff',$data,'id = ?');
                    if($success) {
                        $_SESSION['msg'] = "Evaluation Done Successfuly";
                        $this->showKidsAdvisors();
                    }

                }
            }
        }
    }
}


