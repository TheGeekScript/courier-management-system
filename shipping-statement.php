<?php include("includes/header.php");
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if (!empty($_SESSION['session']))	{ 
	
	$manage_ud = $db->query("SELECT * FROM master_admin WHERE `master_id` = '{$_POST['user_id']}'")->fetch();
	$sql = "SELECT * FROM shipping WHERE (b_date BETWEEN '".$_POST['start_date']."' AND '".$_POST['end_date']."') and user_id = '".$_POST['user_id']."' and status = '1'";
	//$manage_ud = $db->query("SELECT * FROM master_admin WHERE `master_id` = '6'")->fetch();
	//$sql = "SELECT * FROM shipping WHERE (b_date BETWEEN '2021-02-01' AND '2021-03-30') and user_id = '6' and status = '1' and select_gst = '18'";
	$query = $db->query($sql);
	
	
function number_to_word($n){
    $a=$n;
    $w="";
    $crore=(int)($n/10000000);
    $n=$n%10000000;
    $w.=get_word($crore,"Cror ");
    $lakh=(int)($n/100000);
    $n=$n%100000;
    $w.=get_word($lakh,"Lakh ");
    $thousand=(int)($n/1000);
    $n=$n%1000;
    $w.=get_word($thousand,"Thousand  ");
    $hundred=(int)($n/100);
    $w.=get_word($hundred,"Hundred ");
    $ten=$n%100;
    $w.=get_word($ten,"");
    $w.="Rupees ";
    $v=explode(".",$a);
    if(isset($v[1])){
      if(strlen($v[1])==1)
      {
         $v[1]=$v[1]*10;
      }
      $w.=" and ".get_word($v[1]," Paise");
    }
    return $w." Only";
  }
  
  function get_word($n,$txt){
    $t="";
    if($n<=19){
      $t=words_array($n);
    }else{
      $a=$n-($n%10);
      $b=$n%10;
      $t=words_array($a)." ".words_array($b);
    }
    if($n==0){
      $txt="";
    }
    return $t." ".$txt;
  }
  
  function words_array($num){
    $n=[0=>"", 1=>"One", 2=>"Two", 3=>"Three", 4=>"Four", 5=>"Five", 6=>"Six", 7=>"Seven", 8=>"Eight", 9=>"Nine", 10=>"Ten", 11=>"Eleven", 12=>"Twelve", 13=>"Thirteen", 14=>"Fourteen", 15=>"Fifteen", 16=>"Sixteen", 17=>"Seventeen", 18=>"Eighteen", 19=>"Nineteen", 20=>"Twenty", 30=>"Thirty", 40=>"Forty", 50=>"Fifty", 60=>"Sixty", 70=>"Seventy", 80=>"Eighty", 90=>"Ninety", 100=>"Hundred",];
    return $n[$num];
  }
	?>	
		<style>
		.table > thead > th, .table > tbody > tr > td {
		border: 2px solid #000 !important;}</style>
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-12 col-12 mx-auto">
					<input type="button" onclick="printDiv('printableArea')" value="PRINT" /><br><br>
					<div class="" id="printableArea">
                        <table class="table table-bordered table-responsive-sm mb-4">
                            <tbody>
								<tr>
                                    <td colspan="2" align="center"><img src="assets/img/omega-logo.png" width="150"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">ADDRESS: Omega Enterprises, Shop # 5, Bhakti Bldg, Jai Vidyadhani Society, Opp Jeena House, Om Nagar, Andheri East, Mumbai - 400099.<br>PHONE: 9820234535 | GST No: 27AADFO8525B1ZF</td>
                                </tr>
                                <tr>
                                    <td width="50%">
										<b>To,</b><br>
										<b>Company Name: </b><?php echo $manage_ud['company_name']; ?><br>
										<b>Address: </b><?php echo $manage_ud['address']; ?>
											<?php if($manage_ud['address2'] != '') {?><br><?php echo $manage_ud['address2']; }  if($manage_ud['address3'] != '') {?><br><?php echo $manage_ud['address3']; }?><br>
										<b>Contact Person: </b><?php echo $manage_ud['f_name']; ?> <?php echo $manage_ud['l_name']; ?><br>
										<b>GST: </b><?php echo $manage_ud['gst']; ?>
									</td>
                                    <td align="right"><b>STATEMENT DATE: </b><?php echo date('Y-m-d'); ?><br><b>PERIOID FROM: </b><?php echo $_POST['start_date']; ?><br><b>PERIOID TO: </b><?php echo $_POST['end_date']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                                        <table class="table table-bordered table-responsive-sm mb-4">
                                            <tbody>
                                            </tbody>
                                        </table>
										<?php if ($query->rowCount()) { ?>
                                        <table class="table table-bordered mb-4 table-responsive-sm">
											<thead>
                                            <th>Date</th>
                                            <th>AWB</th>
                                            <th>Consignee</th>
                                            <th>Destination</th>
                                            <th>Service</th>
                                            <th>Contents</th>
                                            <th>Base</th>
                                            <th>ESS</th>
                                            <th>Fuel</th>
                                            <th>GST</th>
                                            <th>Amount</th>
											</thead>
                                            <tbody>
											<?php foreach ($query as $row) { ?>
												<tr>
													<td><?php echo date("d-m-Y", strtotime($row['b_date'])); ?></td>
													<td><b><?php echo $row['awb']; ?></b></td>
													<td><?php echo $row['consignee_name']; ?></td>
													<td><?php echo $row['consignee_country']; ?></td>
													<td><?php echo $row['service_type']; ?></td>
													<td><?php echo $row['content_type']; ?></td>
													<td>₹<?php echo $row['base_rate']; ?></td>
													<td>₹<?php echo $row['covid_rate']; ?></td>
													<td>₹<?php echo $row['fuel_rate']; ?></td>
													<td>₹<?php if($row['select_gst'] == '18') { echo $row['gst_rate']; } else{ echo '0';} ?></td>
													<td>₹<?php echo $row['base_rate']+$row['covid_rate']+$row['fuel_rate']; ?></td>
												</tr>
											<?php }
											$sql2 = "SELECT sum(base_rate),sum(covid_rate),sum(fuel_rate) FROM shipping WHERE (b_date BETWEEN '".$_POST['start_date']."' AND '".$_POST['end_date']."') and user_id = '".$_POST['user_id']."' and status = '1'";
											$query2 = $db->query($sql2);
											if ($query2->rowCount()) {
												foreach ($query2 as $row2) { ?>
												<tr>
													<td colspan="9"></td>
													<td><b>TOTAL</b></td>
													<td>₹<?php  echo $tot_amt = $row2['sum(base_rate)'] + $row2['sum(covid_rate)'] + $row2['sum(fuel_rate)'];?></td>
												</tr>
											<?php } }?>
												<tr>
													<td colspan="11"><b>RUPEES :</b> <?php echo number_to_word($tot_amt);?></td>
												</tr>
                                            </tbody>
                                        </table>
						<p align="center">This is computer generated statement, hence signature is not required.</p>
                            <?php } else { echo '<br><p>There were no results</p>'; } ?>
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