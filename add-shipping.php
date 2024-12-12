<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{
		
	
		//$awb_no=rand(1000000000, 9999999999);
		//insert user
		if (!empty($_POST['packet-booking-submit'])) {
			$b_time = date('H:i:s');
	$awb_no = time().$_POST['pieces'];
		
		

		$add_user = $db->prepare("INSERT INTO shipping SET user_id = ?, b_date = ?, b_time = ?, awb = ?, forwarding = ?, ref = ?, service_type = ?, content_type = ?, content_desc = ?, base_rate = ?, covid_rate = ?, fuel_rate = ?, extra_charge = ?, select_gst = ?, gst_rate = ?, total_charge = ?, consignor_name = ?, consignor_cperson = ?, consignor_email = ?, consignor_phone = ?, consignor_address = ?, consignor_country = ?, consignor_state = ?, consignor_city = ?, consignor_zip = ?, consignor_doc_type = ?, consignor_doc = ?, consignee_name = ?, consignee_cperson = ?, consignee_email = ?, consignee_phone = ?, consignee_address = ?, consignee_country = ?, consignee_state = ?, consignee_city = ?, consignee_zip = ?, pieces = ?, remarks = ?");
		
		$add_user->execute(array($_POST['user_id'],$_POST['b_date'],$b_time,$awb_no,$_POST['forwarding_no'],$_POST['ref_no'],$_POST['service_type'],$_POST['content_type'],$_POST['content_desc'],$_POST['base_rate'],$_POST['covid_rate'],$_POST['fuel_rate'],$_POST['extra_charge'],$_POST['select_gst'],$_POST['gst_rate'],$_POST['total_charge'],$_POST['consignor_name'],$_POST['consignor_cperson'],$_POST['consignor_email'],$_POST['consignor_phone'],$_POST['consignor_address'],$_POST['consignor_country'],$_POST['consignor_state'],$_POST['consignor_city'],$_POST['consignor_zip'],$_POST['consignor_doc_type'],$_POST['consignor_doc'],$_POST['consignee_name'],$_POST['consignee_cperson'],$_POST['consignee_email'],$_POST['consignee_phone'],$_POST['consignee_address'],$_POST['consignee_country'],$_POST['consignee_state'],$_POST['consignee_city'],$_POST['consignee_zip'],$_POST['pieces'],$_POST['remarks']));
		if ($add_user->rowCount()) {
			
			$piece_no=$_POST['piece_no'];
			$last_id = $db->lastInsertId();
			 
			 for($i=0;$i<count($piece_no);$i++)
			 {
				$add_weight = $db->prepare("INSERT INTO shipping_parcel SET awb_no = ?, piece_no = ?, actual_weight = ?, length = ?, breadth = ?, height = ?, volume_weight = ?, charge_weight = ?, total_weight = ?");
				$add_weight->execute(array($awb_no,$_POST['piece_no'][$i],$_POST['actual_weight'][$i],$_POST['length'][$i],$_POST['breadth'][$i],$_POST['height'][$i],$_POST['volume_weight'][$i],$_POST['charge_weight'][$i],$_POST['total_weight'][$i]));
				if ($add_weight->rowCount()) {
					header("Location: shipping-label.php?id=".$last_id);
					//$successMSG = "<strong>Success!</strong> New Packet Added.";
				} else {
					$errMSGs = "Cannot Insert Details! Contact your service provider.";
				}
			 }
 
					
							
			
		} else {
			$errMSGs = "Cannot Insert Details! Contact your service provider.";
		}
		} else {}		
		?>
    <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
						<?php if (!empty($successMSG)) {
							echo '<br><div class="alert alert-success mb-4 alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$successMSG.'</div>';
							}
							if (!empty($errMSGs)) {
							echo '<br><div class="alert alert-danger mb-4 alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$errMSGs.'</div>';
							}
						?>
						<form method="POST" action="" id="dynamic">
<div class="row layout-top-spacing">

	<div class="col-lg-4 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area" style="height:343px">										
				<div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
							<h6>Package Details</h6><hr>
                            <div class="row">
								<?php if ($_SESSION['type'] == 'ADM') {?>
                                <div class="col-lg-12 mb-2">
									<!--<label>Select User</label>-->												
									<select name="user_id" class="selectpicker form-control" data-live-search="true" required>
										<option value="">Select User *</option>
										<?php $usr = $db->prepare("SELECT master_id, type, f_name, l_name FROM master_admin where is_active = '1'");	
										$usr->execute();if($usr->rowCount()) {
										foreach($usr as $usr_row) { ?>
										<option value="<?php echo $usr_row['master_id']; ?>"><?php echo $usr_row['type']; ?> - <?php echo $usr_row['f_name']; ?>&nbsp;<?php echo $usr_row['l_name']; ?></option>
										<?php } } ?>
									</select>
                                </div>
								<?php }else{ ?>
                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['master_id']; ?>">
								<?php } ?>
                                <div class="col-lg-12 mb-2">
									<!--<label>Ref No.</label>-->
                                    <input type="text" class="form-control" name="ref_no" placeholder="Reference No.">
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Booking Date *</label>-->
                                    <input type="text" class="form-control" name="b_date" placeholder="Booking Date *" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
								<?php if (($_SESSION['type'] == 'ADM') || ($_SESSION['type'] == 'EMP')) {?>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Forwarding No</label>-->
									<input type="text" class="form-control" name="forwarding_no" placeholder="Forwarding No.">
								</div>
								<?php }else{ ?>
                                    <input type="hidden" class="form-control" name="forwarding_no" value="">
								<?php } ?>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Pieces *</label>-->
                                    <input type="text" class="form-control" name="pieces" placeholder="Pieces *" required>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Service Type *</label>-->												
									<select name="service_type" class="selectpicker form-control" data-live-search="true" required>
										<option value="">Service Type *</option>
										<?php $couriers = $db->prepare("SELECT courier_name FROM couriers");	
										$couriers->execute();if($couriers->rowCount()) {
										foreach($couriers as $couriers_row) { ?>
										<option value="<?php echo $couriers_row['courier_name']; ?>"><?php echo $couriers_row['courier_name']; ?></option>
										<?php } } ?>
									</select>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Content Type *</label>-->
									<select name="content_type" class="selectpicker form-control" required>
										<option value="">Content Type *</option>
										<option value="Document">Document</option>
										<option value="Parcel">Parcel</option>
									</select>
                                </div>
                                <div class="col-lg-12">
                                    <!--<label>Content Description</label>-->
                                    <input type="text" class="form-control" name="content_desc" placeholder="Content Description">
                                </div>
							</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">										
				<div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
							<h6>Consignor Details</h6><hr>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Consignor *</label>-->
                                    <input type="text" class="form-control" name="consignor_name" placeholder="Consignor *" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>CPerson *</label>-->
                                    <input type="text" class="form-control" name="consignor_cperson" placeholder="CPerson">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Email</label>-->
                                    <input type="text" class="form-control" name="consignor_email" placeholder="Email Address">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Phone</label>-->
                                    <input type="text" class="form-control" name="consignor_phone" placeholder="Phone *" required>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <!--<label>Address</label>-->
                                    <textarea class="form-control" name="consignor_address" placeholder="Address *" required></textarea>
                                </div>
                                <!--<div class="col-lg-6 mb-4">
                                    <label>Address 2</label>
                                    <input type="text" class="form-control" name="consignor_address2">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label>Address 3</label>
                                    <input type="text" class="form-control" name="consignor_address3">
                                </div>-->
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Country *</label>-->
									<select name="consignor_country" class="selectpicker form-control" data-live-search="true">
										<option value="">Country *</option>
										<?php $consignor_countries = $db->prepare("SELECT country_name FROM countries");	
										$consignor_countries->execute();if($consignor_countries->rowCount()) {
										foreach($consignor_countries as $consignor_countries_row) { ?>
										<option value="<?php echo $consignor_countries_row['country_name']; ?>" <?php if($consignor_countries_row['country_name'] == 'India'){echo 'selected';}?>><?php echo $consignor_countries_row['country_name']; ?></option>
										<?php } } ?>
									</select>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>State *</label>-->
                                    <input type="text" class="form-control" name="consignor_state" placeholder="State">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>City *</label>-->
                                    <input type="text" class="form-control" name="consignor_city" placeholder="City">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Zip</label>-->
                                    <input type="text" class="form-control" name="consignor_zip" placeholder="Zip">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <!--<label>Select ID Proof *</label>-->												
									<select name="consignor_doc_type" class="selectpicker form-control" required id="seeAnotherFieldGroup">
										<option value="Pan Card" selected>Pan Card</option>
										<option value="Aadhar Card">Aadhar Card</option>
										<option value="GST">GST No.</option>
										<option value="IEC">IEC No.</option>
									</select>
                                </div>
                                <div class="col-lg-6" id="otherFieldGroupDiv">
                                    <!--<label>ID Proof *</label>-->
                                    <input type="text" class="form-control" id="static-mask-pan" value="XXXXX0000X">
                                    <input type="text" class="form-control" id="static-mask-aadhar">
                                    <input type="text" class="form-control" id="static-mask-gst">
                                    <input type="text" class="form-control" id="static-mask-iec">
                                </div>
                                <div class="col-lg-12 mb-2">
								<small>If <b>Content Type</b> is <b>Document</b>, then leave this field as it is.</small>
								</div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-lg-4 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">										
				<div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
										<h6>Consignee Details</h6><hr>
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                            <!--<label for="formGroupExampleInput">Consignee *</label>-->
                                                <input type="text" class="form-control" name="consignee_name" placeholder="Consignee *" required>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                            <!--<label for="formGroupExampleInput">CPerson *</label>-->
                                                <input type="text" class="form-control" name="consignee_cperson" placeholder="CPerson">
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                            <!--<label for="formGroupExampleInput">Email</label>-->
                                                <input type="text" class="form-control" name="consignee_email" placeholder="Email">
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                            <!--<label for="formGroupExampleInput">Phone</label>-->
                                                <input type="text" class="form-control" name="consignee_phone" placeholder="Phone *" required>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                            <!--<label for="formGroupExampleInput">Address 1</label>-->
                                                <textarea class="form-control" name="consignee_address" placeholder="Address *" required></textarea>
                                            </div>
                                            <!--<div class="col-lg-6 mb-4">
                                            <label for="formGroupExampleInput">Address 2</label>
                                                <input type="text" class="form-control" name="consignee_address2">
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                            <label for="formGroupExampleInput">Address 3</label>
                                                <input type="text" class="form-control" name="consignee_address3">
                                            </div>-->
                                            <div class="col-lg-12 mb-2">
                                            <!--<label for="formGroupExampleInput">Country *</label>-->
												<select name="consignee_country" class="selectpicker form-control" data-live-search="true" required>
													<option value="">Country *</option>
													<?php $consignee_countries = $db->prepare("SELECT country_name FROM countries");	
														$consignee_countries->execute();
														if($consignee_countries->rowCount()) {
														foreach($consignee_countries as $consignee_countries_row) { ?>
														<option value="<?php echo $consignee_countries_row['country_name']; ?>" <?php if($consignee_countries_row['country_name'] == 'India'){echo 'selected';}?>><?php echo $consignee_countries_row['country_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                            <!--<label for="formGroupExampleInput">State *</label>-->
                                                <input type="text" class="form-control" name="consignee_state" placeholder="State">
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                            <!--<label for="formGroupExampleInput">City *</label>-->
                                                <input type="text" class="form-control" name="consignee_city" placeholder="City">
                                            </div>
                                            <div class="col-lg-12">
                                            <!--<label for="formGroupExampleInput">Zip</label>-->
                                                <input type="text" class="form-control" name="consignee_zip" placeholder="Zip">
                                            </div>
                                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
						
						
						
						
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">										
				<div class="row">
                    <div class="col-lg-112 col-12 mx-auto">
							<?php if ($_SESSION['type'] == 'ADM') {?>
										<h6>Billing Rate</h6>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Base*</label>
                                                <input type="number" step="0.01" class="form-control" name="base_rate" id="base_rate" value="0.00" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">ESS</label>
                                                <input type="number" step="0.01" class="form-control" name="covid_rate" id="covid_rate" value="0.00" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Fuel</label>
                                                <input type="number" step="0.01" class="form-control" name="fuel_rate" id="fuel_rate" value="0.00" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Extra</label>
                                                <input type="number" step="0.01" class="form-control" name="extra_charge" id="extra_charge" value="0.00" onchange="doRate(this.value);" required>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Select GST</label>							
												<select name="select_gst" id="select_gst" class="selectpicker form-control" onchange="doRate(this.value);" required>
													<option value="18" selected>Yes</option>
													<option value="0">No</option>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">GST (18%)</label>
                                                <input type="number" step="0.01" class="form-control" name="gst_rate" id="gst_rate" placeholder="0.00" onchange="doRate(this.value);" readonly>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Total Charge</label>
                                                <input type="number" step="0.01" class="form-control" name="total_charge" id="total_charge" placeholder="0.00" onchange="doRate(this.value);" readonly>
                                            </div>
										</div>
										<?php }else{ ?>
                                            <input type="hidden" name="base_rate" value="0">
                                            <input type="hidden" name="covid_rate" value="0">
                                            <input type="hidden" name="fuel_rate" value="0">
                                            <input type="hidden" name="extra_charge" value="0">
                                            <input type="hidden" name="gst_rate" value="0">
                                            <input type="hidden" name="total_charge" value="0">
                                            <input type="hidden" name="select_gst" value="0">
										<?php } ?>
										
										<h6>Weight Detail</h6>
                                        <div class="row">
											<table class="table table-responsive-sm">
                                <thead>
													<th><div class="col">Piece No. *</div></th>
													<th><div class="col">Act Wt. (Kg) *</div></th>
													<th><div class="col">Length (cm)</div></th>
													<th><div class="col">Breadth (cm)</div></th>
													<th><div class="col">Height (cm)</div></th>
													<th><div class="col">Vol Wt. (Kg)</div></th>
													<th><div class="col">Chrg Wt. (Kg)</div></th>
													<th><div class="col">Tot Wt. (Kg)</div></th>
                                </thead>
                                <tbody id="itemlist">
                                    <tr>
                                        <td><div class="col"><input class="form-control input-sm text-right" required name="piece_no[]" data-cell="A1" data-format="0"></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" required name="actual_weight[]" data-cell="B1" data-format="0,0[.]00"></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" name="length[]" data-cell="C1" data-format="0,0[.]00"></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" name="breadth[]" data-cell="D1" data-format="0,0[.]00"></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" name="height[]" data-cell="E1" data-format="0,0[.]00"></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" required name="volume_weight[]" data-cell="F1" data-format="0,0[.]00" data-formula="(C1*D1*E1)/5000" readonly></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" required name="charge_weight[]" data-cell="G1" data-format="0,0[.]00" data-formula="IF(B1 > F1, B1, F1)" readonly></div></td>
                                        <td><div class="col"><input class="form-control input-sm text-right" required name="total_weight[]" data-cell="H1" data-format="0,0[.]00" data-formula="IF(B1 > G1, B1, G1)" readonly></div></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="margin-top:30px">
                                        <td>
                                            <div class="col"><button id="add_item" class="btn-success btn-sm">ADD ROW</button></div>
                                        </td>
                                        <td colspan="6" class="text-right">
                                            <div class="col"><label for="total">Grand Total :</label></div>
                                        </td>
                                        <td class="text-right">
                                           <div class="col"><label data-cell="I1" data-format="0,0[.]00" data-formula="SUM(H1:H1)"></label></div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        
                                        </div>
										<!--<h6>Remarks</h6>-->
                                        <div class="row mb-2">
                                            <div class="col">
                                                <textarea class="form-control" name="remarks" placeholder="Any Remarks"></textarea>
                                            </div>
                                        </div>
										<input type="submit" name="packet-booking-submit" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
		
                    </div>				
</form>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$("#seeAnotherFieldGroup").change(function() {
  if ($(this).val() == "Pan Card") {
	
    $('#static-mask-pan').show();
    $('#static-mask-pan').attr('required', '');
    $('#static-mask-pan').attr('data-error', 'This field is required.');
    $('#static-mask-pan').attr('name', 'consignor_doc');
	
    $('#static-mask-aadhar').hide();
    $('#static-mask-aadhar').removeAttr('required');
    $('#static-mask-aadhar').removeAttr('data-error');
    $('#static-mask-aadhar').removeAttr('name');
    $('#static-mask-gst').hide();
    $('#static-mask-gst').removeAttr('required');
    $('#static-mask-gst').removeAttr('data-error');
    $('#static-mask-gst').removeAttr('name');
    $('#static-mask-iec').hide();
    $('#static-mask-iec').removeAttr('required');
    $('#static-mask-iec').removeAttr('data-error');
    $('#static-mask-iec').removeAttr('name');
	
  } else if ($(this).val() == "Aadhar Card") {
	  
    $('#static-mask-aadhar').show();
    $('#static-mask-aadhar').attr('required', '');
    $('#static-mask-aadhar').attr('data-error', 'This field is required.');
    $('#static-mask-aadhar').attr('name', 'consignor_doc');
	
    $('#static-mask-pan').hide();
    $('#static-mask-pan').removeAttr('required');
    $('#static-mask-pan').removeAttr('data-error');
    $('#static-mask-pan').removeAttr('name');
    $('#static-mask-gst').hide();
    $('#static-mask-gst').removeAttr('required');
    $('#static-mask-gst').removeAttr('data-error');
    $('#static-mask-gst').removeAttr('name');
    $('#static-mask-iec').hide();
    $('#static-mask-iec').removeAttr('required');
    $('#static-mask-iec').removeAttr('data-error');
    $('#static-mask-iec').removeAttr('name');
	
  } else if ($(this).val() == "GST") {
	  
    $('#static-mask-gst').show();
    $('#static-mask-gst').attr('required', '');
    $('#static-mask-gst').attr('data-error', 'This field is required.');
    $('#static-mask-gst').attr('name', 'consignor_doc');
	
    $('#static-mask-pan').hide();
    $('#static-mask-pan').removeAttr('required');
    $('#static-mask-pan').removeAttr('data-error');
    $('#static-mask-pan').removeAttr('name');
    $('#static-mask-aadhar').hide();
    $('#static-mask-aadhar').removeAttr('required');
    $('#static-mask-aadhar').removeAttr('data-error');
    $('#static-mask-aadhar').removeAttr('name');
    $('#static-mask-iec').hide();
    $('#static-mask-iec').removeAttr('required');
    $('#static-mask-iec').removeAttr('data-error');
    $('#static-mask-iec').removeAttr('name');
	
  } else if ($(this).val() == "IEC") {
	  
    $('#static-mask-iec').show();
    $('#static-mask-iec').attr('required', '');
    $('#static-mask-iec').attr('data-error', 'This field is required.');
    $('#static-mask-iec').attr('name', 'consignor_doc');
	
    $('#static-mask-pan').hide();
    $('#static-mask-pan').removeAttr('required');
    $('#static-mask-pan').removeAttr('data-error');
    $('#static-mask-pan').removeAttr('name');
    $('#static-mask-aadhar').hide();
    $('#static-mask-aadhar').removeAttr('required');
    $('#static-mask-aadhar').removeAttr('data-error');
    $('#static-mask-aadhar').removeAttr('name');
    $('#static-mask-gst').hide();
    $('#static-mask-gst').removeAttr('required');
    $('#static-mask-gst').removeAttr('data-error');
    $('#static-mask-gst').removeAttr('name');
	
  } else {
	$('#otherFieldGroupDiv').hide();
    $('#static-mask-pan').hide();
    $('#static-mask-pan').removeAttr('required');
    $('#static-mask-pan').removeAttr('data-error');
    $('#static-mask-pan').removeAttr('name');
    $('#static-mask-aadhar').hide();
    $('#static-mask-aadhar').removeAttr('required');
    $('#static-mask-aadhar').removeAttr('data-error');
    $('#static-mask-aadhar').removeAttr('name');
    $('#static-mask-gst').hide();
    $('#static-mask-gst').removeAttr('required');
    $('#static-mask-gst').removeAttr('data-error');
    $('#static-mask-gst').removeAttr('name');
    $('#static-mask-iec').hide();
    $('#static-mask-iec').removeAttr('required');
    $('#static-mask-iec').removeAttr('data-error');
    $('#static-mask-iec').removeAttr('name');
  }
});
$("#seeAnotherFieldGroup").trigger("change");
</script>
<script>
function doRate(val) {
    var base_rate = parseInt(document.getElementById('base_rate').value);
    var covid_rate = parseInt(document.getElementById('covid_rate').value);
    var fuel_rate = parseInt(document.getElementById('fuel_rate').value);
    var extra_charge = parseInt(document.getElementById('extra_charge').value);
    var select_gst = parseInt(document.getElementById('select_gst').value);
    var gst_rate = (base_rate + covid_rate + fuel_rate) * select_gst / 100;
	var default_gst = 0.00;
    var total_charge = base_rate + covid_rate + fuel_rate + extra_charge + gst_rate;
	
	var divobj2 = document.getElementById('total_charge');
        divobj2.value = total_charge;
		
	var divobj3 = document.getElementById('gst_rate');
        divobj3.value = gst_rate;
}
</script>
<script src="calx/jquery-calx-sample-2.2.8.min.js" type="text/javascript"></script>
<script>
    $form = $('#dynamic').calx();
    $itemlist = $('#itemlist');
    $counter = 1;

    $('#add_item').click(function(e){
        e.preventDefault();
        var i = ++$counter;
        $itemlist.append(
            '<tr>\
                <td><div class="col"><input class="form-control input-sm text-right" required name="piece_no[]" data-cell="A'+i+'" data-format="0"></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" required name="actual_weight[]" data-cell="B'+i+'" data-format="0,0[.]00"></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" name="length[]" data-cell="C'+i+'" data-format="0,0[.]00"></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" name="breadth[]" data-cell="D'+i+'" data-format="0,0[.]00"></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" name="height[]" data-cell="E'+i+'" data-format="0,0[.]00"></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" required name="volume_weight[]" data-cell="F'+i+'" data-format="0,0[.]00" data-formula="(C'+i+'*D'+i+'*E'+i+')/5000" readonly></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" required name="charge_weight[]" data-cell="G'+i+'" data-format="0,0[.]00" data-formula="IF(B'+i+' > F'+i+', B'+i+', F'+i+')" readonly></div></td>\
                <td><div class="col"><input class="form-control input-sm text-right" required name="total_weight[]" data-cell="H'+i+'" data-format="0,0[.]00" data-formula="IF(B'+i+' > G'+i+', B'+i+', G'+i+')" readonly></div></td>\
                <td class="text-center"><button class="btn-remove btn btn-danger rounded-circle2">X</button></td>\
            </tr>'
        );
        //console.log('new row appended');

        $form.calx('update');
        $form.calx('getCell', 'I1').setFormula('SUM(H1:H'+i+')');
    });

    $('#itemlist').on('click', '.btn-remove', function(){
        $(this).parent().parent().remove();
        $form.calx('update');
        $form.calx('getCell', 'I1').calculate();
    });
</script>   
<?php } } include("includes/footer.php"); ?>
<script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="plugins/input-mask/input-mask.js"></script>
    <script src="plugins/select2/select2.min.js"></script>
    <script src="plugins/select2/custom-select2.js"></script>