<?php include("includes/header.php");
	$row = $db->query("SELECT * FROM master_admin WHERE `master_id` = '{$_SESSION['master_id']}'")->fetch();
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if (!empty($_SESSION['session']))	{	
		
	//update
	if (!empty($_POST['edit_user'])) {
		$control = $db->prepare("Select * from master_admin where phone = ? ");
		$control->execute(array($_POST['phone']));
		
		if($control->rowCount()){
			$errMSGs2 = "<strong>Truncate!</strong> This phone has already been used.";
		} else {
		$update = "UPDATE master_admin SET f_name =:fnm, l_name =:lmn, phone = :ph, gender =:gn, gst =:gt, company_name = :cname, address =:add WHERE master_id = :d";
		$stmt = $db->prepare($update); 
		$stmt->bindParam(':fnm', $_POST['f_name'], PDO::PARAM_STR);  
		$stmt->bindParam(':lmn', $_POST['l_name'], PDO::PARAM_STR); 
		$stmt->bindParam(':ph', $_POST['phone'], PDO::PARAM_STR);  
		$stmt->bindParam(':gn', $_POST['gender'], PDO::PARAM_STR);  
		$stmt->bindParam(':gt', $_POST['gst'], PDO::PARAM_STR);  
		$stmt->bindParam(':cname', $_POST['company_name'], PDO::PARAM_STR);   
		$stmt->bindParam(':add', $_POST['address'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['master_id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
				$successMSG2 = "Details Updated Successfully";
				header("Location: profile.php");
			} else {
				$errMSGs2 = "Cannot Update! Contact your service provider.";
			}
		}
	}else{}
	//update end
	
	if(isset($_POST['change_pass'])){
			if(trim($_POST['new_password'])==''OR empty($_POST)) { 
				$errMSGs = "New password empty!";
				
			} elseif(trim($_POST['confirm_new_password'])=='' OR empty($_POST)) {
				$errMSGs = "Confirm new password empty!";
			
			} elseif (strlen($_POST['new_password']) < 5) {
				$errMSGs = "The new password must be at least 5 characters!";
			
			} elseif (strlen($_POST['confirm_new_password']) < 5) {
				$errMSGs = "The confirm new password must be at least 5 characters!";
			
			} elseif ( ! preg_match('#[0-9]+#', $_POST['new_password'])) {
				$errMSGs = "The new password must contain at least 1 number!";
			
			} elseif ( ! preg_match('#[0-9]+#', $_POST['confirm_new_password'])) {
				$errMSGs = "The confirm new password must contain at least 1 number!";
			
			} elseif ( ! preg_match('#[A-Z]+#', $_POST['new_password'])) {
				$errMSGs = "The new password should contain at least 1 uppercase character!";
			
			} elseif ( ! preg_match('#[A-Z]+#', $_POST['confirm_new_password'])) {
				$errMSGs = "The confirm new password should contain at least 1 uppercase character!";
			
			} elseif ( ! preg_match('#[a-z]+#', $_POST['new_password'])) {
				$errMSGs = "The new password must contain at least 1 lowercase letter!";
			
			} elseif ( ! preg_match('#[a-z]+#', $_POST['confirm_new_password'])) {
				$errMSGs = "The confirm new password must contain at least 1 lowercase letter!";
			
			} else {
			if (md5($_POST['new_password']) != md5($_POST['confirm_new_password'])) { 
				$errMSGs = "New passwords are not equal!";
			} else { 
						
			$new_password =  md5($_POST['new_password']);
						
			$updater = "UPDATE master_admin SET password = :password WHERE master_id = :d";
			$passwo = $db->prepare($updater);                                  
			$passwo->bindParam(':password', $new_password, PDO::PARAM_STR);       
			$passwo->bindParam(':d', $_POST['master_id'], PDO::PARAM_INT);   

			if($passwo->execute()) {
				$successMSG = "Password Changed Successfully";
			} else  {
				$errMSGs = "Try again later!";
			}
			}
			} 
	}

//echo $message;
	
	}
?>
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-8 col-lg-8 col-sm-8  layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-12 col-12 mx-auto">
					<h5>Profile Details</h5>
						<?php if (!empty($successMSG2)) {
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$successMSG2.'.</div>';
							}
							if (!empty($errMSGs2)) {
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$errMSGs2.'.</div>';
							}
						?>
                        <form method="POST">
							<input type="hidden" name="master_id" value="<?php echo $row['master_id']; ?>">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label>First Name *</label>
									<input type="text" class="form-control" name="f_name" value="<?php echo $row['f_name']; ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label>Last Name *</label>
									<input type="text" class="form-control" name="l_name" value="<?php echo $row['l_name']; ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label>Email *</label>
									<input type="email" class="form-control" disabled value="<?php echo $row['email']; ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label>Phone *</label>
									<input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Gender *</label>
									<select type="text" class="selectpicker form-control" name="gender" required>
										<option value="Male" <?php if($row['gender'] == 'Male'){ echo 'selected="selected"';}else{} ?>>Male</option>
										<option value="Female" <?php if($row['gender'] == 'Female'){ echo 'selected="selected"';}else{} ?>>Female</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Company Name</label>
									<input type="text" class="form-control" name="company_name" value="<?php echo $row['company_name']; ?>">
								</div>
    							<div class="form-group col-md-4">
    								<label>GST No.</label>
    								<input type="text" class="form-control" name="gst" value="<?php echo $row['gst']; ?>">
    							</div>
							</div>
							<div class="form-group">
								<label>Address</label>
								<textarea type="text" class="form-control" name="address" required><?php echo $row['address']; ?></textarea>
							</div>
							<input type="submit" class="btn btn-primary btn-sm" value="Update" name="edit_user">
						</form>
				</div>                                        
            </div>
		</div>
    </div>
	<div class="col-xl-4 col-lg-4 col-sm-4  layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-10 col-12 mx-auto">
					<h5>Change Password</h5>
					<?php if (!empty($successMSG)) {
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$successMSG.'.</div>';
						}
						if (!empty($errMSGs)) {
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$errMSGs.'.</div>';
						}
					?>
					<form method="POST">
						<input type="hidden" name="master_id" value="<?php echo $row['master_id']; ?>">
						<div class="form-group">
							<label>New Password *</label>
							<input type="password" name="new_password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Confirm Password *</label>
							<input type="password" name="confirm_new_password" class="form-control" required>
						</div>
						<div class="form-group">       
							<input type="submit" value="Change Password" name="change_pass" class="btn btn-primary btn-sm">
						</div>
					</form>
					<div class="mt-1 mb-4">
                        <span class="badge badge-primary w-100">
                            <small id="sh-text7" class="form-text mt-0 text-left">The new password must be at least 5 characters.</small>
                            <small id="sh-text7" class="form-text mt-0 text-left">The new password must contain at least 1 number.</small>
                            <small id="sh-text7" class="form-text mt-0 text-left">The new password should contain at least 1 uppercase character.</small>
                            <small id="sh-text7" class="form-text mt-0 text-left">The new password should contain at least 1 lowercase character.</small>
                        </span>
                    </div>                                        
                </div>
			</div>
        </div>
	</div>
<?php } include("includes/footer.php"); ?>