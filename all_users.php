<?php include("includes/header.php");
    $sql = "SELECT * FROM master_admin WHERE is_active = '1'";
    $query = $db->query($sql);
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if(!empty($_SESSION['type'] != "ADM")){
		header("Location:dashboard.php");
	}
		
	if (!empty($_SESSION['session']))	{	
	if (!empty($_SESSION['type'] == "ADM"))	{
		
	//delete
	if (!empty($_GET['del'])) { 
     $query = $db->prepare("delete from master_admin WHERE master_id = :dl");
     $delete = $query->execute(array('dl' => $_GET['del']));		
        header("Location: all_users.php");
	}
	
	//activate
	if (!empty($_GET['ac'])) { 
     $query = $db->prepare("update master_admin set access_status = '1' WHERE master_id = :ac");
     $delete = $query->execute(array('ac' => $_GET['ac']));		
        header("Location: all_users.php");
	}
	//deactivate
	if (!empty($_GET['dac'])) { 
     $query = $db->prepare("update master_admin set access_status = '0' WHERE master_id = :dac");
     $delete = $query->execute(array('dac' => $_GET['dac']));		
        header("Location: all_users.php");
	}
	
	//insert
	if (!empty($_POST['add_user'])) {
		if(trim($_POST['password'])=='' OR empty($_POST)) {
		    echo "Password empty!";
			
		} elseif (strlen($_POST['password']) < 5) {
			$errMSGs = "<strong>Error!</strong> The password must be at least 5 characters.";
			
		} elseif ( ! preg_match('#[0-9]+#', $_POST['password'])) {
			$errMSGs = "<strong>Error!</strong> The password must contain at least 1 number.";
			
		} elseif ( ! preg_match('#[A-Z]+#', $_POST['password'])) {
			$errMSGs = "<strong>Error!</strong> The password should contain at least 1 uppercase character.";
			
		} elseif ( ! preg_match('#[a-z]+#', $_POST['password'])) {
			$errMSGs = "<strong>Error!</strong> The password must contain at least 1 lowercase letter.";
		
		} else {

		$password = md5($_POST['password']);
		$reg_date = date('Y-m-d H:i:s');
		$control = $db->prepare("Select * from master_admin where email = ? or phone = ? ");
		$control->execute(array($_POST['email'], $_POST['phone']));
		
		if($control->rowCount()){
			$errMSGs = "<strong>Truncate!</strong> This email or phone has already been used.";
		} else {
		$add_role = $db->prepare("INSERT INTO master_admin SET type = ?, f_name = ?, l_name = ?, email = ?, phone = ?, password = ?, gender = ?, gst = ?, company_name = ?, address = ?, reg_date = ?");
		$add_role->execute(array($_POST['user_type'],$_POST['f_name'],$_POST['l_name'],$_POST['email'],$_POST['phone'],md5($_POST['password']),$_POST['gender'],$_POST['gst'],$_POST['company_name'],$_POST['address'],$reg_date));
		if ($add_role->rowCount()) {
			
			$fname = trim($_POST["f_name"]);
			$lname = trim($_POST["l_name"]);
			$phone = trim($_POST["phone"]);
			$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
			$password = $_POST["password"];
			
			//email
			$mail_to = $email;
			
			# Sender Data
			$subject = "Welcome | Omega Enterprises";
				
			# Mail Content
			$content = "Your Login Details are below:\n";
			$content .= "Email: $email\n";
			$content .= "Password: $password\n";
				
			# email headers.
			$headers = "From: $fname $lname <$email>" . "\r\n";
			
			# Send the email.
			$success = mail($mail_to, $subject, $content, $headers);
			if ($success) {
				# Set a 200 (okay) response code.
				http_response_code(200);
				$successMSG = "<strong>Success!</strong> New User Added. Relaod Page.";
				header("Location: all_users.php");
			} else {
				# Set a 500 (internal server error) response code.
				http_response_code(500);
				$errMSGs = "User was added but could not send Email Notification! Contact your service provider.";
			}
			
		} else {
			$errMSGs = "Cannot Update! Contact your service provider.";
		}
		}
		}
	} else {}
	
	
	//update
	if (!empty($_POST['edit_user'])) {			
			
		$update = "UPDATE master_admin SET type = :typ, f_name =:fnm, l_name =:lmn, phone = :ph, gender =:gn, gst =:gt, company_name =:cname, address =:add WHERE master_id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':typ', $_POST['user_type'], PDO::PARAM_STR);  
		$stmt->bindParam(':fnm', $_POST['f_name'], PDO::PARAM_STR);  
		$stmt->bindParam(':lmn', $_POST['l_name'], PDO::PARAM_STR);  
		$stmt->bindParam(':ph', $_POST['phone'], PDO::PARAM_STR);   
		$stmt->bindParam(':gn', $_POST['gender'], PDO::PARAM_STR);  
		$stmt->bindParam(':gt', $_POST['gst'], PDO::PARAM_STR);  
		$stmt->bindParam(':cname', $_POST['company_name'], PDO::PARAM_STR);  
		$stmt->bindParam(':add', $_POST['address'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['master_id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
				$successMSG = "User Updated Successfully. Relaod Page.";
				header("Location: all_users.php");
			} else {
				$errMSGs = "Cannot Update! Contact your service provider.";
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
	
	}
?>
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-8 col-12 mx-auto">
					<?php if (!empty($successMSG)) {
						echo '<div class="alert alert-success mb-4 alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$successMSG.'</div>';
						}

						if (!empty($errMSGs)) {
						echo '<div class="alert alert-danger mb-4 alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$errMSGs.'</div>';
					} ?>
				</div>
			</div>
			<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole">Add New User</button>-->
			
			<!-- Add Modal -->
			<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addModal">Add New User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label>User Role *</label>
										<select name="user_type" class="selectpicker form-control" required>
											<option value="">Choose...</option>
											<option value="ADM">Admin</option>
											<option value="EMP">Employee</option>
											<option value="CUST">Customer</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label>First Name *</label>
										<input type="text" class="form-control" name="f_name" required>
									</div>
									<div class="form-group col-md-4">
										<label>Last Name *</label>
										<input type="text" class="form-control" name="l_name" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Email *</label>
										<input type="email" class="form-control" name="email" required>
									</div>
									<div class="form-group col-md-6">
										<label>Password *</label>
										<input type="password" class="form-control" name="password" required>
									</div>
									<div class="mt-1 col-md-12 mb-4">
										<span class="badge badge-primary w-100">
										<small id="sh-text7" class="form-text mt-0 text-left">The password must be at least 5 characters.</small>
										<small id="sh-text7" class="form-text mt-0 text-left">The password must contain at least 1 number.</small>
										<small id="sh-text7" class="form-text mt-0 text-left">The password should contain at least 1 uppercase character.</small>
										<small id="sh-text7" class="form-text mt-0 text-left">The password should contain at least 1 lowercase character.</small>
										</span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Phone *</label>
										<input type="text" class="form-control" name="phone" required>
									</div>
									<div class="form-group col-md-6">
										<label>Gender *</label>
										<select type="text" class="selectpicker form-control" name="gender" required>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Company Name</label>
										<input type="text" class="form-control" name="company_name">
									</div>
									<div class="form-group col-md-6">
										<label>GST No.</label>
										<input type="text" class="form-control" name="gst">
									</div>
								</div>
								<div class="form-group">
									<label>Address *</label>
									<textarea type="text" class="form-control" name="address" required ></textarea>
								</div>
								<input type="submit" class="btn btn-primary btn-sm mt-3" value="Add" name="add_user">
							</form>
						</div>
					</div>
				</div>
			</div>
													
            <div class="table-responsive">
				<?php if ($query->rowCount()) { ?>
                <table id="zero-config-users" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reg. Date</th>
                            <th>Type</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Gender</th>
                            <th>Company Name</th>
                            <th>GST</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($query as $row) { ?>
                        <tr>
                            <td><?php echo $row['master_id']; ?></td>
                            <td><?php echo $row['reg_date']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['f_name']; ?>&nbsp;<?php echo $row['l_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['gst']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
								<?php if($row['type'] == 'ADM'){}else{
								if($row['access_status'] == '1'){?>
									<a href="all_users.php?dac=<?php echo $row['master_id']; ?>" onClick="return confirm('Are you sure?');" class="badge badge-danger">Deactivate</a>
								<?php } else { ?>
									<a href="all_users.php?ac=<?php echo $row['master_id']; ?>" onClick="return confirm('Are you sure?');" class="badge badge-success">Activate</a>
								<?php } }?>
							</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editUser<?php echo $row['master_id']; ?>">Edit Details</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editPassword<?php echo $row['master_id']; ?>">Reset Password</a>
                                        <a class="dropdown-item" href="all_users.php?del=<?php echo $row['master_id']; ?>" onClick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </div>
								</div>
								<!-- Edit Modal -->
								<div class="modal fade" id="editUser<?php echo $row['master_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editingModal<?php echo $row['master_id']; ?>" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editingModal<?php echo $row['master_id']; ?>">Edit User #<?php echo $row['master_id']; ?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST">
													<input type="hidden" name="master_id" value="<?php echo $row['master_id']; ?>">
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>User Role *</label>
															<select name="user_type" class="form-control" required>
																<option value="ADM" <?php if($row['type'] == "ADM"){echo'selected';}?>>Admin</option>
																<option value="EMP" <?php if($row['type'] == "EMP"){echo'selected';}?>>Employee</option>
																<option value="CUST" <?php if($row['type'] == "CUST"){echo'selected';}?>>Customer</option>
															</select>
														</div>
														<div class="form-group col-md-4">
															<label>First Name *</label>
															<input type="text" class="form-control" name="f_name" value="<?php echo $row['f_name']; ?>" required>
														</div>
														<div class="form-group col-md-4">
															<label>Last Name *</label>
															<input type="text" class="form-control" name="l_name" value="<?php echo $row['l_name']; ?>" required>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-6">
															<label>Phone *</label>
															<input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" required>
														</div>
														<div class="form-group col-md-6">
															<label>Gender *</label>
															<select type="text" class="form-control" name="gender" required>
																<option value="Male" <?php if($madmin['gender'] == 'Male'){ echo 'selected="selected"';}else{} ?>>Male</option>
																<option value="Female" <?php if($madmin['gender'] == 'Female'){ echo 'selected="selected"';}else{} ?>>Female</option>
															</select>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-6">
															<label>Company Name</label>
															<input type="text" class="form-control" name="company_name" value="<?php echo $row['company_name']; ?>">
														</div>
														<div class="form-group col-md-6">
															<label>GST No.</label>
															<input type="text" class="form-control" name="gst" value="<?php echo $row['gst']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label>Address *</label>
														<textarea type="text" class="form-control" name="address" required ><?php echo $row['address']; ?></textarea>
													</div>
													<input type="submit" class="btn btn-primary mt-3" value="Update" name="edit_user">
												</form>
											</div>
										</div>
									</div>
								</div>
							
							<!-- Edit Modal -->
								<div class="modal fade" id="editPassword<?php echo $row['master_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editingModal2<?php echo $row['master_id']; ?>" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editingModal2<?php echo $row['master_id']; ?>">Reset Password #<?php echo $row['master_id']; ?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
												</button>
											</div>
											<div class="modal-body">
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
													<input type="submit" class="btn btn-primary mt-3" value="Update" name="change_pass">
												</form>
												<div class="mt-4 mb-1">
													<span class="badge badge-info w-100">
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
							
							</td>
                        </tr>
						<?php } ?>
                    </tbody>
                </table>
                <?php } else { echo '<br><p>There were no results</p>'; } ?>
			</div>
        </div>
    </div>
</div>

<?php } } include("includes/footer.php"); ?>