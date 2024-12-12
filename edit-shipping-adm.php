<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{
		
	$shipping = $db->query("SELECT * FROM shipping WHERE `id` = '{$_GET['id']}' and status = 1")->fetch();
		
		//insert user
		if (!empty($_POST['packet-booking-submit'])) {
				
		$update = "UPDATE shipping SET b_date = :bdate, awb = :awb, forwarding = :fwd, ref = :rf, service_type = :stype, content_type = :ctype, content_desc = :cdesc, pieces = :piec, base_rate = :br, covid_rate = :cr, fuel_rate = :fr, 	extra_charge = :exchrg, gst_rate = :gr, total_charge = :totchrg, consignor_name = :crname, consignor_cperson = :crcp, consignor_email = :cre, consignor_phone = :crp, consignor_address = :cradd, consignor_address2 = :cradd2, consignor_address3 = :cradd3, consignor_country = :crco, consignor_state = :crst, consignor_city = :crci, consignor_zip = :crz, consignor_doc_type = :crdt, consignor_doc = :crd, consignee_name = :cename, consignee_cperson = :cecp, consignee_email = :cee, consignee_phone = :cep, consignee_address = :ceadd, consignee_address2 = :ceadd2, consignee_address3 = :ceadd3, consignee_country = :ceco, consignee_state  = :cest, consignee_city  = :ceci, consignee_zip = :cez, remarks = :rmrk, shipping_status = :ss WHERE id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':bdate', $_POST['b_date'], PDO::PARAM_STR);
		$stmt->bindParam(':awb', $_POST['awb'], PDO::PARAM_STR);
		$stmt->bindParam(':fwd', $_POST['forwarding'], PDO::PARAM_STR);
		$stmt->bindParam(':rf', $_POST['ref'], PDO::PARAM_STR);
		$stmt->bindParam(':stype', $_POST['service_type'], PDO::PARAM_STR);
		$stmt->bindParam(':ctype', $_POST['content_type'], PDO::PARAM_STR);
		$stmt->bindParam(':cdesc', $_POST['content_desc'], PDO::PARAM_STR);
		$stmt->bindParam(':piec', $_POST['pieces'], PDO::PARAM_INT);
		$stmt->bindParam(':br', $_POST['base_rate'], PDO::PARAM_STR);
		$stmt->bindParam(':cr', $_POST['covid_rate'], PDO::PARAM_STR);
		$stmt->bindParam(':fr', $_POST['fuel_rate'], PDO::PARAM_STR);
		$stmt->bindParam(':exchrg', $_POST['extra_charge'], PDO::PARAM_STR);
		$stmt->bindParam(':gr', $_POST['gst_rate'], PDO::PARAM_STR);
		$stmt->bindParam(':totchrg', $_POST['total_charge'], PDO::PARAM_STR);
		$stmt->bindParam(':crname', $_POST['consignor_name'], PDO::PARAM_STR);
		$stmt->bindParam(':crcp', $_POST['consignor_cperson'], PDO::PARAM_STR);
		$stmt->bindParam(':cre', $_POST['consignor_email'], PDO::PARAM_STR);
		$stmt->bindParam(':crp', $_POST['consignor_phone'], PDO::PARAM_STR);
		$stmt->bindParam(':cradd', $_POST['consignor_address'], PDO::PARAM_STR);
		$stmt->bindParam(':cradd2', $_POST['consignor_address2'], PDO::PARAM_STR);
		$stmt->bindParam(':cradd3', $_POST['consignor_address3'], PDO::PARAM_STR);
		$stmt->bindParam(':crco', $_POST['consignor_country'], PDO::PARAM_STR);
		$stmt->bindParam(':crst', $_POST['consignor_state'], PDO::PARAM_STR);
		$stmt->bindParam(':crci', $_POST['consignor_city'], PDO::PARAM_STR);
		$stmt->bindParam(':crz', $_POST['consignor_zip'], PDO::PARAM_STR);
		$stmt->bindParam(':crdt', $_POST['consignor_doc_type'], PDO::PARAM_STR);
		$stmt->bindParam(':crd', $_POST['consignor_doc'], PDO::PARAM_STR);
		$stmt->bindParam(':cename', $_POST['consignee_name'], PDO::PARAM_STR);
		$stmt->bindParam(':cecp', $_POST['consignee_cperson'], PDO::PARAM_STR);
		$stmt->bindParam(':cee', $_POST['consignee_email'], PDO::PARAM_STR);
		$stmt->bindParam(':cep', $_POST['consignee_phone'], PDO::PARAM_STR);
		$stmt->bindParam(':ceadd', $_POST['consignee_address'], PDO::PARAM_STR);
		$stmt->bindParam(':ceadd2', $_POST['consignee_address2'], PDO::PARAM_STR);
		$stmt->bindParam(':ceadd3', $_POST['consignee_address3'], PDO::PARAM_STR);
		$stmt->bindParam(':ceco', $_POST['consignee_country'], PDO::PARAM_STR);
		$stmt->bindParam(':cest', $_POST['consignee_state'], PDO::PARAM_STR);
		$stmt->bindParam(':ceci', $_POST['consignee_city'], PDO::PARAM_STR);
		$stmt->bindParam(':cez', $_POST['consignee_zip'], PDO::PARAM_STR);
		$stmt->bindParam(':rmrk', $_POST['remarks'], PDO::PARAM_STR);
		$stmt->bindParam(':ss', $_POST['shipping_status'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
				//$successMSG = "Lead has been successfully updated.";
				header("Location: edit-shipping-adm.php?id=" . $_GET['id']);
			} else {
				$errMSGs = "An error occurred!";
			}
			
		
		} else {}		
		?>

                    <div class="row layout-top-spacing">
                    
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area">										
							<div class="row">
                                <div class="col-lg-10 col-12 mx-auto">
								<?php
										  if (!empty($successMSG)) {
											echo '<div class="alert alert-success mb-4 alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
												'.$successMSG.'
											</div>';
											}

											if (!empty($errMSGs)) {
											echo '<div class="alert alert-danger mb-4 alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
												'.$errMSGs.'
											</div>';
											}
										  ?>
									<form method="POST" action="">
										<h5>Package Details</h5>
                                        <input type="hidden" name="id" value="<?php echo $shipping['id']; ?>">
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Status *</label>
												<select name="shipping_status" class="form-control" required>
													<option value="">Choose...</option>
													<option value="Not Received" <?php if($shipping['shipping_status'] == "Not Received"){echo'selected';}?>>Not Received</option>
													<option value="Received" <?php if($shipping['shipping_status'] == "Received"){echo'selected';}?>>Received</option>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">AWB No. *</label>
                                                <input type="text" class="form-control" name="awb" readonly value="<?php echo $shipping['awb']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Ref No.</label>
                                                <input type="text" class="form-control" name="ref" placeholder="Reference Number" value="<?php echo $shipping['ref']; ?>">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Forwarding No.</label>
                                                <input type="text" class="form-control" name="forwarding" placeholder="Forwarding No" value="<?php echo $shipping['forwarding']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Booking Date *</label>
                                                <input type="date" class="form-control" name="b_date" placeholder="Booking Date" value="<?php echo $shipping['b_date']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Pieces *</label>
                                                <input type="text" class="form-control" name="pieces" placeholder="Pieces" value="<?php echo $shipping['pieces']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Service Type *</label>												
												<select name="service_type" class="selectpicker form-control" data-live-search="true" required>
													<option value="">Choose...</option>
													<?php $couriers = $db->prepare("SELECT courier_name FROM couriers");	
														$couriers->execute();if($couriers->rowCount()) {
														foreach($couriers as $couriers_row) { ?>
														<option <?php if($shipping['service_type'] == $couriers_row['courier_name']){echo'selected';}?> value="<?php echo $couriers_row['courier_name']; ?>"><?php echo $couriers_row['courier_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Content Type *</label>
												<select name="content_type" class="form-control" required>
													<option value="">Choose...</option>
														<option value="Document" <?php if($shipping['content_type'] == "Document"){echo'selected';}?>>Document</option>
														<option value="Parcel" <?php if($shipping['content_type'] == "Parcel"){echo'selected';}?>>Parcel</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Content Description</label>
                                                <input type="text" class="form-control" name="content_desc" value="<?php echo $shipping['content_desc']; ?>">
                                            </div>
										</div>
										<hr>
										<h5>Consignor Details</h5>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Consignor Name*</label>
                                                <input type="text" class="form-control" name="consignor_name" value="<?php echo $shipping['consignor_name']; ?>" required placeholder="Consignor Name">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">CPerson *</label>
                                                <input type="text" class="form-control" name="consignor_cperson" value="<?php echo $shipping['consignor_cperson']; ?>" required placeholder="CPerson">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Email</label>
                                                <input type="email" class="form-control" name="consignor_email" value="<?php echo $shipping['consignor_email']; ?>" placeholder="Email">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Phone</label>
                                                <input type="text" class="form-control" name="consignor_phone" value="<?php echo $shipping['consignor_phone']; ?>" placeholder="Phone">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address 1*</label>
                                                <input type="text" class="form-control" name="consignor_address" value="<?php echo $shipping['consignor_address']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address 2</label>
                                                <input type="text" class="form-control" name="consignor_address2" value="<?php echo $shipping['consignor_address2']; ?>">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address 3</label>
                                                <input type="text" class="form-control" name="consignor_address3" value="<?php echo $shipping['consignor_address3']; ?>">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Country *</label>
												<select name="consignor_country" class="selectpicker form-control" data-live-search="true" required>
													<option value="">Choose...</option>
													<?php $consignor_countries = $db->prepare("SELECT country_name FROM countries");	
														$consignor_countries->execute();if($consignor_countries->rowCount()) {
														foreach($consignor_countries as $consignor_countries_row) { ?>
														<option <?php if($shipping['consignor_country'] == $consignor_countries_row['country_name']){echo'selected';}?> value="<?php echo $consignor_countries_row['country_name']; ?>"><?php echo $consignor_countries_row['country_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">State *</label>
                                                <input type="text" class="form-control" name="consignor_state" placeholder="State" value="<?php echo $shipping['consignor_state']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">City *</label>
                                                <input type="text" class="form-control" name="consignor_city" placeholder="City" value="<?php echo $shipping['consignor_city']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Zip *</label>
                                                <input type="text" class="form-control" name="consignor_zip" placeholder="Zip" value="<?php echo $shipping['consignor_zip']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
									
                                            <div class="col-3">
                                            <label for="formGroupExampleInput">Select ID Proof *</label>												
												<select name="consignor_doc_type" class="form-control" required>
													<option value="">Choose...</option>
													<option value="Pan Card" <?php if($shipping['consignor_doc_type'] == "Pan Card"){echo'selected';}?>>Pan Card</option>
													<option value="Aadhar Card" <?php if($shipping['consignor_doc_type'] == "Aadhar Card"){echo'selected';}?>>Aadhar Card</option>
													<option value="GST No." <?php if($shipping['consignor_doc_type'] == "GST No."){echo'selected';}?>>GST No.</option>
													<option value="IEC No." <?php if($shipping['consignor_doc_type'] == "IEC No."){echo'selected';}?>>IEC No.</option>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">ID Proof *</label>
                                                <input type="text" class="form-control" name="consignor_doc" value="<?php echo $shipping['consignor_doc']; ?>" required>
                                            </div>
                                        </div>
										<hr>
										<h5>Consignee Details</h5>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Consignee Name *</label>
                                                <input type="text" class="form-control" name="consignee_name" placeholder="Consignee Name" value="<?php echo $shipping['consignee_name']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">CPerson *</label>
                                                <input type="text" class="form-control" name="consignee_cperson" placeholder="CPerson" value="<?php echo $shipping['consignee_cperson']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Email</label>
                                                <input type="email" class="form-control" name="consignee_email" placeholder="Email" value="<?php echo $shipping['consignee_email']; ?>">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Phone</label>
                                                <input type="text" class="form-control" name="consignee_phone" placeholder="Phone" value="<?php echo $shipping['consignee_phone']; ?>">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address *</label>
                                                <input type="text" class="form-control" name="consignee_address" value="<?php echo $shipping['consignee_address']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address 2</label>
                                                <input type="text" class="form-control" name="consignee_address2" value="<?php echo $shipping['consignee_address2']; ?>">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address 3</label>
                                                <input type="text" class="form-control" name="consignee_address3" value="<?php echo $shipping['consignee_address3']; ?>">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Country *</label>
												<select name="consignee_country" class="selectpicker form-control" data-live-search="true" required>
													<option value="">Choose...</option>
													<?php $consignee_countries = $db->prepare("SELECT country_name FROM countries");	
														$consignee_countries->execute();
														if($consignee_countries->rowCount()) {
														foreach($consignee_countries as $consignee_countries_row) { ?>
														<option <?php if($shipping['consignee_country'] == $consignee_countries_row['country_name']){echo'selected';}?> value="<?php echo $consignee_countries_row['country_name']; ?>"><?php echo $consignee_countries_row['country_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">State *</label>
                                                <input type="text" class="form-control" name="consignee_state" placeholder="State" value="<?php echo $shipping['consignee_state']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">City *</label>
                                                <input type="text" class="form-control" name="consignee_city" placeholder="City" value="<?php echo $shipping['consignee_city']; ?>" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Zip *</label>
                                                <input type="text" class="form-control" name="consignee_zip" placeholder="Zip" value="<?php echo $shipping['consignee_zip']; ?>" required>
                                            </div>
                                        </div>
										<hr>
										<h5>Billing Rate</h5>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Base*</label>
                                                <input type="number" step="0.01" class="form-control" name="base_rate" id="base_rate" value="<?php echo $shipping['base_rate']; ?>" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">ESS</label>
                                                <input type="number" step="0.01" class="form-control" name="covid_rate" id="covid_rate" value="<?php echo $shipping['covid_rate']; ?>" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Fuel</label>
                                                <input type="number" step="0.01" class="form-control" name="fuel_rate" id="fuel_rate" value="<?php echo $shipping['fuel_rate']; ?>" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Extra</label>
                                                <input type="number" step="0.01" class="form-control" name="extra_charge" id="extra_charge" value="<?php echo $shipping['extra_charge']; ?>" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">GST (18%) *</label>
                                                <input type="number" step="0.01" class="form-control" name="gst_rate" id="gst_rate" value="<?php echo $shipping['gst_rate']; ?>" onchange="doRate(this.value);" readonly required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Total Charge</label>
                                                <input type="number" step="0.01" class="form-control" name="total_charge" id="total_charge" value="<?php echo $shipping['total_charge']; ?>" onchange="doRate(this.value);" readonly required>
                                            </div>
                                        </div>
										<hr>
										<h5>Remarks</h5>
                                        <div class="row mb-4">
                                            <div class="col">
												<textarea class="form-control" name="remarks"><?php echo $shipping['remarks']; ?></textarea>
                                            </div>
                                        </div>
										<input type="submit" name="packet-booking-submit" class="mt-4 btn btn-primary">
                                    </form>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
						

                    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function doRate(val) {
    var base_rate = parseInt(document.getElementById('base_rate').value);
    var covid_rate = parseInt(document.getElementById('covid_rate').value);
    var fuel_rate = parseInt(document.getElementById('fuel_rate').value);
    var extra_charge = parseInt(document.getElementById('extra_charge').value);
    var gst_rate = (base_rate + covid_rate + fuel_rate) * 18 / 100;
    var total_charge = base_rate + covid_rate + fuel_rate + extra_charge + gst_rate;
	
	var divobj2 = document.getElementById('total_charge');
        divobj2.value = total_charge;
		
	var divobj3 = document.getElementById('gst_rate');
        divobj3.value = gst_rate;
}
</script>
<?php } } include("includes/footer.php"); ?>