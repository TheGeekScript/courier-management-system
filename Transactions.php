<?php  
require_once 'includes/config-admin.php';
 
$do = @$_GET['do'];
Switch($do){
	
    //Signin
	case'Signin';
	if($_POST){
		
		if(trim($_POST['email'])=='' OR empty($_POST)) { 
	         echo "Email empty!";

	    } elseif(trim($_POST['password'])=='' OR empty($_POST)) {
		    echo "Password empty!";

	    } else { 
		
		$email = $_POST['email'];
		$password = md5($_POST['password']);

	    $login = $db->prepare("Select * from master_admin where email = ? and password = ? and is_active = 1");
		$login->execute(array($email,$password));
		if($login->rowCount()){
	
			$row = $login->fetch(PDO::FETCH_ASSOC);
			$_SESSION['session'] = TRUE;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			$_SESSION['master_id'] = $row['master_id'];
			$_SESSION['type'] = $row['type'];
			$_SESSION['is_active'] = $row['is_active'];
			echo '1';
		}else{
			echo 'Email or password is incorrect!';
		}
	}
	break;
	}


	// Logout
	case'Logout';
	if (isset($_SESSION['session'])) {
		//session_start();
		session_destroy();
		session_unset();
		header("Location:index.php");
		setcookie("email",$_SESSION['email'],time()-3600);
		setcookie("password",$_SESSION['password'],time()-3600);
	} else {
		header("Location:index.php");
	}
	break;
	
}