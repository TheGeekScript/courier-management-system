<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{ ?>
<div class="row layout-top-spacing">
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">										
				<div class="row">
                    <div class="col-lg-10 col-12 mx-auto">
						<?php if (!empty($successMSG)) {
							echo '<div class="alert alert-success mb-4 alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$successMSG.'</div>';
							}
							if (!empty($errMSGs)) {
							echo '<div class="alert alert-danger mb-4 alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$errMSGs.'</div>';
							} 
						?>
						<form method="POST" action="shipping-statement.php">
							<h5>Generate Statement</h5>
                            <div class="row mb-4">
                                <div class="col">
									<label>Select User *</label>												
									<select name="user_id" class="selectpicker form-control" data-live-search="true" required>
										<option value="">Choose...</option>
										<?php $usr = $db->prepare("SELECT master_id, type, f_name, l_name FROM master_admin where type = 'CUST' and is_active = '1'");	
										$usr->execute();if($usr->rowCount()) {
										foreach($usr as $usr_row) { ?>
										<option value="<?php echo $usr_row['master_id']; ?>"><?php echo $usr_row['f_name']; ?>&nbsp;<?php echo $usr_row['l_name']; ?></option>
										<?php } } ?>
									</select>
                                </div>
                                <div class="col">
									<label>Start Date *</label>
                                    <input type="date" class="form-control" name="start_date" max="<?php echo date("Y-m-d");?>" required>
                                </div>
                                <div class="col">
                                    <label>End Date *</label>
                                    <input type="date" class="form-control" name="end_date" max="<?php echo date("Y-m-d");?>" required>
                                </div>
                            </div>
										<input type="submit" name="gen-statement" class="btn btn-primary btn-sm">
                                    </form>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
						

                    </div>
<?php } } include("includes/footer.php"); ?>