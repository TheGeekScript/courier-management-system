<?php include("includes/header.php");
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if (!empty($_SESSION['session']))	{ 
	
	$manage_shipping = $db->query("SELECT * FROM shipping WHERE `id` = '{$_GET['id']}'")->fetch();
	require 'vendor/autoload.php';
	$generator = new Picqer\Barcode\BarcodeGeneratorPNG();?>	
	<style>.table-bordered td {border: 2px solid #000 !important;}</style>
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-10 col-12 mx-auto">
				<input type="button" onclick="printDiv('printableArea')" value="PRINT" /><br><br>
					<div class="" id="printableArea">
                                        <table class="table table-bordered mb-4 table-responsive-sm">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><img src="assets/img/omega-logo.png" width="150"></td>
                                                    <td colspan="2" style="text-align:center">AWB NUMBER<br><h6><?php echo $manage_shipping['awb']; ?></h6>
													<?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($manage_shipping['awb'], $generator::TYPE_CODE_128)) . '">';?> </td>
                                                    <td colspan="1"><b>SHIPPER COPY</b></td>
                                                </tr>
												<tr>
													<td><b>SERVICE: </b><?php echo $manage_shipping['service_type']; ?></td>
													<td><b>ORIGIN: </b><?php echo $manage_shipping['consignor_country']; ?></td>
													<td><b>DESTINATION: </b><?php echo $manage_shipping['consignee_country']; ?></td>
													<td><b>PIECES: </b><?php echo $manage_shipping['pieces']; ?></td>
													<td><b>FORWARDING NO.: </b><?php echo $manage_shipping['forwarding']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Sender's Name : </b><?php echo $manage_shipping['consignor_name']; ?></td>
													<td colspan="2"><b>Recipient's Name: </b><?php echo $manage_shipping['consignee_name']; ?></td>
													<td rowspan="3" style="vertical-align: baseline;"><b>Content Type: </b><br><?php echo $manage_shipping['content_type']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Address : </b><?php echo $manage_shipping['consignor_address']; ?><br><?php echo $manage_shipping['consignor_address2']; ?><br><?php echo $manage_shipping['consignor_address3']; ?></td>
													<td colspan="2"><b>Address : </b><?php echo $manage_shipping['consignee_address']; ?><br><?php echo $manage_shipping['consignee_address2']; ?><br><?php echo $manage_shipping['consignee_address3']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Pincode : </b><?php echo $manage_shipping['consignor_zip']; ?></td>
													<td colspan="2"><b>Pincode : </b><?php echo $manage_shipping['consignee_zip']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Phone : </b><?php echo $manage_shipping['consignor_phone']; ?></td>
													<td colspan="2"><b>Phone : </b><?php echo $manage_shipping['consignee_phone']; ?></td>
													<td rowspan="4" style="vertical-align: baseline;"><b>Content Description: </b><br><?php echo $manage_shipping['content_desc']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>City : </b><?php echo $manage_shipping['consignor_city']; ?></td>
													<td colspan="2"><b>City : </b><?php echo $manage_shipping['consignee_city']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>State : </b><?php echo $manage_shipping['consignor_state']; ?></td>
													<td colspan="2"><b>State : </b><?php echo $manage_shipping['consignee_state']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Country : </b><?php echo $manage_shipping['consignor_country']; ?></td>
													<td colspan="2"><b>Country : </b><?php echo $manage_shipping['consignee_country']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Shipper Agreement : </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Pickup: </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Received in good order & condition: </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b><small>All Cheques/DD should be drawn in favour of</small><br>OMEGA Enterprises</td>
													<td><b>Base: </b>₹<?php echo $manage_shipping['base_rate']; ?></td>
												</tr>
												<tr>
													<td><b>ESS: </b>₹<?php echo $manage_shipping['covid_rate']; ?></td>
												</tr>
												<tr>
													<td><b>Fuel: </b>₹<?php echo $manage_shipping['fuel_rate']; ?></td>
												</tr>
												<tr>
													<td><b>Extra: </b>₹<?php echo $manage_shipping['extra_charge']; ?></td>
												</tr>
												<tr>
													<td><b>Total Charge: </b>₹<?php echo $manage_shipping['total_charge']; ?></td>
												</tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered mb-4 table-responsive-sm">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><img src="assets/img/omega-logo.png" width="150"></td>
                                                    <td colspan="2" style="text-align:center">AWB NUMBER<br><h6><?php echo $manage_shipping['awb']; ?></h6>
													<?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($manage_shipping['awb'], $generator::TYPE_CODE_128)) . '">';?> </td>
                                                    <td colspan="1"><b>CONSIGNEE COPY</b></td>
                                                </tr>
												<tr>
													<td><b>SERVICE: </b><?php echo $manage_shipping['service_type']; ?></td>
													<td><b>ORIGIN: </b><?php echo $manage_shipping['consignor_country']; ?></td>
													<td><b>DESTINATION: </b><?php echo $manage_shipping['consignee_country']; ?></td>
													<td><b>PIECES: </b><?php echo $manage_shipping['pieces']; ?></td>
													<td><b>FORWARDING NO.: </b><?php echo $manage_shipping['forwarding']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Sender's Name : </b><?php echo $manage_shipping['consignor_name']; ?></td>
													<td colspan="2"><b>Recipient's Name: </b><?php echo $manage_shipping['consignee_name']; ?></td>
													<td rowspan="3" style="vertical-align: baseline;"><b>Content Type: </b><br><?php echo $manage_shipping['content_type']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Address : </b><?php echo $manage_shipping['consignor_address']; ?><br><?php echo $manage_shipping['consignor_address2']; ?><br><?php echo $manage_shipping['consignor_address3']; ?></td>
													<td colspan="2"><b>Address : </b><?php echo $manage_shipping['consignee_address']; ?><br><?php echo $manage_shipping['consignee_address2']; ?><br><?php echo $manage_shipping['consignee_address3']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Pincode : </b><?php echo $manage_shipping['consignor_zip']; ?></td>
													<td colspan="2"><b>Pincode : </b><?php echo $manage_shipping['consignee_zip']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Phone : </b><?php echo $manage_shipping['consignor_phone']; ?></td>
													<td colspan="2"><b>Phone : </b><?php echo $manage_shipping['consignee_phone']; ?></td>
													<td rowspan="4" style="vertical-align: baseline;"><b>Content Description: </b><br><?php echo $manage_shipping['content_desc']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>City : </b><?php echo $manage_shipping['consignor_city']; ?></td>
													<td colspan="2"><b>City : </b><?php echo $manage_shipping['consignee_city']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>State : </b><?php echo $manage_shipping['consignor_state']; ?></td>
													<td colspan="2"><b>State : </b><?php echo $manage_shipping['consignee_state']; ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Country : </b><?php echo $manage_shipping['consignor_country']; ?></td>
													<td colspan="2"><b>Country : </b><?php echo $manage_shipping['consignee_country']; ?></td>
												</tr>
												<tr>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Shipper Agreement : </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Pickup: </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b>Received in good order & condition: </b><br>Name & Sign</td>
													<td rowspan="5" width="20%" style="vertical-align: baseline;"><b><small>All Cheques/DD should be drawn in favour of</small><br>OMEGA Enterprises</td>
													<td><b>Base: </b>₹<?php echo $manage_shipping['base_rate']; ?></td>
												</tr>
												<tr>
													<td><b>ESS: </b>₹<?php echo $manage_shipping['covid_rate']; ?></td>
												</tr>
												<tr>
													<td><b>Fuel: </b>₹<?php echo $manage_shipping['fuel_rate']; ?></td>
												</tr>
												<tr>
													<td><b>Extra: </b>₹<?php echo $manage_shipping['extra_charge']; ?></td>
												</tr>
												<tr>
													<td><b>Total Charge: </b>₹<?php echo $manage_shipping['total_charge']; ?></td>
												</tr>
                                            </tbody>
                                        </table>
                                    </div>
				</div>                                        
            </div>
		</div>
    </div>
	<script>
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
	</script>
<?php } } include("includes/footer.php"); ?>