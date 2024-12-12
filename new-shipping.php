<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{
		
	$awb_no = time();
		//$awb_no=rand(1000000000, 9999999999);
		//insert user
		if (!empty($_POST['packet-booking-submit'])) {
		
		

		$add_user = $db->prepare("INSERT INTO shipping SET user_id = ?, b_date = ?, awb = ?, forwarding = ?, ref = ?, service_type = ?, packaging_type = ?, consignor_name = ?, consignor_cperson = ?, consignor_email = ?, consignor_phone = ?, consignor_address = ?, consignor_country = ?, consignor_state = ?, consignor_city = ?, consignor_zip = ?, consignor_doc_type = ?, consignor_doc = ?, consignee_name = ?, consignee_cperson = ?, consignee_email = ?, consignee_phone = ?, consignee_address = ?, consignee_country = ?, consignee_state = ?, consignee_city = ?, consignee_zip = ?, pieces = ?, remarks = ?");
		
		$add_user->execute(array($_SESSION['master_id'],$_POST['b_date'],$awb_no,$_POST['forwarding_no'],$_POST['ref_no'],$_POST['service_type'],$_POST['packaging_type'],$_POST['consignor_name'],$_POST['consignor_cperson'],$_POST['consignor_email'],$_POST['consignor_phone'],$_POST['consignor_address'],$_POST['consignor_country'],$_POST['consignor_state'],$_POST['consignor_city'],$_POST['consignor_zip'],$_POST['consignor_doc_type'],$_POST['consignor_doc'],$_POST['consignee_name'],$_POST['consignee_cperson'],$_POST['consignee_email'],$_POST['consignee_phone'],$_POST['consignee_address'],$_POST['consignee_country'],$_POST['consignee_state'],$_POST['consignee_city'],$_POST['consignee_zip'],$_POST['pieces'],$_POST['remarks']));
		if ($add_user->rowCount()) {
			
			$piece_no=$_POST['piece_no'];
			$actual_weight=$_POST['actual_weight'];
			 $length=$_POST['length'];
			 $breadth=$_POST['breadth'];
			 $height=$_POST['height'];
			 $volume_weight=$_POST['volume_weight'];
			 $charge_weight=$_POST['charge_weight'];
			 
			 for($i=0;$i<count($piece_no);$i++)
			 {
				$add_weight = $db->prepare("INSERT INTO shipping_weight SET awb_no = ?, piece_no = ?, actual_weight = ?, length = ?, breadth = ?, height = ?, volume_weight = ?, charge_weight = ?");
				$add_weight->execute(array($awb_no,$_POST['piece_no'][$i],$_POST['actual_weight'][$i],$_POST['length'][$i],$_POST['breadth'][$i],$_POST['height'][$i],$_POST['volume_weight'][$i],$_POST['charge_weight'][$i]));
				if ($add_weight->rowCount()) {
					$successMSG = "<strong>Success!</strong> New Packet Booking Added.";
				} else {
					$errMSGs = "Cannot Insert Details! Contact your service provider.";
				}
			 }
 
					
							
			
		} else {
			$errMSGs = "Cannot Insert Details! Contact your service provider.";
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
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">AWB No.</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $awb_no;?>">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Ref No.</label>
                                                <input type="text" class="form-control" name="ref_no" placeholder="Reference Number">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Booking Date</label>
                                                <input type="date" class="form-control" name="b_date" placeholder="Booking Date">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Forwarding No</label>
                                                <input type="text" class="form-control" name="forwarding_no" placeholder="Forwarding No">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Pieces</label>
                                                <input type="text" class="form-control" name="pieces" placeholder="Pieces">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Service Type</label>												
												<select name="service_type" class="selectpicker form-control" data-live-search="true" required>
													<option>Choose...</option>
													<?php $couriers = $db->prepare("SELECT courier_name FROM couriers");	
														$couriers->execute();if($couriers->rowCount()) {
														foreach($couriers as $couriers_row) { ?>
														<option value="<?php echo $couriers_row['courier_name']; ?>"><?php echo $couriers_row['courier_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Packaging Type</label>
												<select name="packaging_type" class="form-control" required>
													<option>Choose...</option>
														<option value="Document">Document</option>
														<option value="Parcel">Parcel</option>
												</select>
                                            </div>
                                        </div>
										<hr>
										<h5>Consignor Details</h5>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Consignor</label>
                                                <input type="text" class="form-control" name="consignor_name" placeholder="Consignor Name">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">CPerson</label>
                                                <input type="text" class="form-control" name="consignor_cperson" placeholder="CPerson">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Email</label>
                                                <input type="text" class="form-control" name="consignor_email" placeholder="Email">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Phone</label>
                                                <input type="text" class="form-control" name="consignor_phone" placeholder="Phone">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address</label>
												<textarea class="form-control" name="consignor_address"></textarea>
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Country</label>
												<select name="consignor_country" class="selectpicker form-control" data-live-search="true" required>
													<option>Choose...</option>
													<?php $consignor_countries = $db->prepare("SELECT country_name FROM countries");	
														$consignor_countries->execute();if($consignor_countries->rowCount()) {
														foreach($consignor_countries as $consignor_countries_row) { ?>
														<option value="<?php echo $consignor_countries_row['country_name']; ?>"><?php echo $consignor_countries_row['country_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">State</label>
                                                <input type="text" class="form-control" name="consignor_state" placeholder="State">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">City</label>
                                                <input type="text" class="form-control" name="consignor_city" placeholder="City">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Zip</label>
                                                <input type="text" class="form-control" name="consignor_zip" placeholder="Zip">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
									
                                            <div class="col-3">
                                            <label for="formGroupExampleInput">Select ID Proof</label>												
												<select name="consignor_doc_type" class="form-control" required>
													<option>Choose...</option>
													<option value="Pan Card">Pan Card</option>
													<option value="Aadhar Card">Aadhar Card</option>
													<option value="GST No.">GST No.</option>
													<option value="IEC No.">IEC No.</option>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">ID Proof</label>
                                                <input type="text" class="form-control" name="consignor_doc">
                                            </div>
                                        </div>
										<hr>
										<h5>Consignee Details</h5>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Consignee</label>
                                                <input type="text" class="form-control" name="consignee_name" placeholder="Consignee Name">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">CPerson</label>
                                                <input type="text" class="form-control" name="consignee_cperson" placeholder="CPerson">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Email</label>
                                                <input type="text" class="form-control" name="consignee_email" placeholder="Email">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Phone</label>
                                                <input type="text" class="form-control" name="consignee_phone" placeholder="Phone">
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Address</label>
												<textarea class="form-control" name="consignee_address"></textarea>
                                            </div>
										</div>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <label for="formGroupExampleInput">Country</label>
												<select name="consignee_country" class="selectpicker form-control" data-live-search="true" required>
													<option>Choose...</option>
													<?php $consignee_countries = $db->prepare("SELECT country_name FROM countries");	
														$consignee_countries->execute();
														if($consignee_countries->rowCount()) {
														foreach($consignee_countries as $consignee_countries_row) { ?>
														<option value="<?php echo $consignee_countries_row['country_name']; ?>"><?php echo $consignee_countries_row['country_name']; ?></option>
													<?php } } ?>
												</select>
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">State</label>
                                                <input type="text" class="form-control" name="consignee_state" placeholder="State">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">City</label>
                                                <input type="text" class="form-control" name="consignee_city" placeholder="City">
                                            </div>
                                            <div class="col">
                                            <label for="formGroupExampleInput">Zip</label>
                                                <input type="text" class="form-control" name="consignee_zip" placeholder="Zip">
                                            </div>
                                        </div>
										<hr>
										<h5>Weight Detail <input type="button" class="btn-success btn-sm ml-2" onclick="add_row();" value="ADD ROW"></h5>
										
                                        <div class="row mb-4">
											<table id="employee_table">
												<thead>
													<th><div class="col">Piece No.</div></th>
													<th><div class="col">Act Wt. (Kg)</div></th>
													<th><div class="col">Length (cm)</div></th>
													<th><div class="col">Breadth (cm)</div></th>
													<th><div class="col">Height (cm)</div></th>
													<th><div class="col">Vol Wt. (Kg)</div></th>
													<th><div class="col">Chrg Wt. (Kg)</div></th>
												</thead>
												<tbody>
												<tr id="row1">
													<td>
														<div class="col">
															<input type="text" class="form-control" name="piece_no[]" placeholder="Piece No.">
														</div>
													</td>
													<td>
														<div class="col">
															<input type="number" step="0.01" class="form-control" name="actual_weight[]" placeholder="0.00" id="actual_weight" onchange="doMath(this.value);" placeholder="Actual Weight">
														</div>
													</td>
											<td>
                                            <div class="col">
                                                <input type="number" step="0.01" class="form-control" name="length[]" id="length" placeholder="0.00" onchange="doMath(this.value);" required>
                                            </div>
											</td>
											<td>
                                            <div class="col">
                                                <input type="number" step="0.01" class="form-control" name="breadth[]" id="breadth" onchange="doMath(this.value);" placeholder="0.00" >
                                            </div>
											</td>
											<td>
                                            <div class="col">
                                                <input type="number" step="0.01" class="form-control" name="height[]" id="height" onchange="doMath(this.value);" placeholder="0.00" >
                                            </div>
											</td>
											<td>
                                            <div class="col">
                                                <input type="number" step="0.01" class="form-control" name="volume_weight[]" id="volume_weight" placeholder="0.00" readonly>
                                            </div>
											</td>
											<td>
                                            <div class="col">
                                                <input type="number" step="0.01" class="form-control" name="charge_weight[]" id="charge_weight" placeholder="0.00" readonly>
                                            </div>
											</td>
   </tr>
   </tbody>
  </table>
                                        </div>
										<hr>
										<h5>Remarks</h5>
                                        <div class="row mb-4">
                                            <div class="col">
												<textarea class="form-control" name="remarks"></textarea>
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
    var fuel_rate = (base_rate + covid_rate) * 10 / 100;
    var gst_rate = (base_rate + covid_rate + fuel_rate) * 18 / 100;
	
	var divobj2 = document.getElementById('fuel_rate');
        divobj2.value = fuel_rate;
		
	var divobj3 = document.getElementById('gst_rate');
        divobj3.value = gst_rate;
}

function doMath(val) {
    var length = parseInt(document.getElementById('length').value);
    var breadth = parseInt(document.getElementById('breadth').value);
    var height = parseInt(document.getElementById('height').value);
    var actual_weight = parseInt(document.getElementById('actual_weight').value);
    var volume_weight = (length * breadth * height) / 5000;
	
	var divobj4 = document.getElementById('volume_weight');
       divobj4.value = volume_weight;
	  		
	if(actual_weight > volume_weight){
		var divobj = document.getElementById('charge_weight');
        divobj.value = actual_weight;
		return false;
	}else{
		var divobj = document.getElementById('charge_weight');
        divobj.value = volume_weight;
		return false;
	}
}
</script>
<script type="text/javascript">
function add_row()
{
 $rowno=$("#employee_table tr").length;
 $rowno=$rowno+1;
 $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><div class='col'><input type='text' class='form-control' name='piece_no[]' placeholder='Piece No.'></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='actual_weight[]' id='actual_weight' value='0.00' onchange='doMath(this.value);' placeholder='Actual Weight'></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='length' id='length' value='0.00' onchange='doMath(this.value);' required></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='breadth' id='breadth' value='0.00' onchange='doMath(this.value);' placeholder='Breadth'></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='height' id='height' value='0.00' onchange='doMath(this.value);' placeholder='Height'></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='volume_weight' id='volume_weight' value='0.00' readonly></div></td><td><div class='col'><input type='number' step='0.01' class='form-control' name='charge_weight' id='charge_weight' value='0.00' readonly></div></td><td><input type='button' value='X' class='btn btn-danger rounded-circle2' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>
<?php } } include("includes/footer.php"); ?>