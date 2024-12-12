<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	header("Location:index.php");
} else { ?>
<link href="assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components/timeline/custom-timeline.css" rel="stylesheet" type="text/css" />
<div class="row layout-top-spacing">
	<div class="col-lg-8 mx-auto layout-spacing">
        <div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area br-6">
				<?php //$awb_id = ['16127836601', '16127362362', '16127361671', '16118398085', '16106246545'];
				$awb_id = array($_POST['trackingid']);
				$query = $db->prepare("SELECT * FROM shipping WHERE awb IN (".implode(",", $awb_id).") and status = 1");
                $query->execute(); 
				if ($query->rowCount()) {?>
				<div id="iconsAccordion" class="accordion-icons">
                    <?php $count = 0;
					foreach ($query as $row) { 
					$count++;?>
					<div class="card">
                        <div class="card-header" id="heading<?php echo $row['id']; ?>">
                            <section class="mb-0 mt-0">
                                <div role="menu" class="<?php if($count != 1){echo 'collapsed';} ?>" data-toggle="collapse" data-target="#iconAccordion<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="iconAccordion<?php echo $row['id']; ?>">
									<div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                                    AirWaybill: #<?php echo $row['awb']; ?> <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                 </div>
                            </section>
                        </div>
                        <div id="iconAccordion<?php echo $row['id']; ?>" class="collapse <?php if($count == 1){echo 'show';} ?>" aria-labelledby="heading<?php echo $row['id']; ?>" data-parent="#iconsAccordion">
                            <div class="card-body">
								<table class="display responsive nowrap" width="100%">
									<tr>
										<td><?php switch ($row['service_type']) {
													case 'DHL':
														$url = 'https://www.dhl.com/en/express/tracking.html?AWB='.$row['forwarding'].'&brand=DHL';
														break;
													case 'Fedex':
														$url = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$row['forwarding'];
														break;
													case 'Aramex':
														$url = 'https://www.aramex.com/us/en';
														break;
													case 'TNT':
														$url = 'https://www.tnt.com/express/en_in/site/shipping-tools/tracking.html?searchType=CON&cons='.$row['forwarding'];
														break;
													case 'DPD':
														$url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
														break;
													case 'PACIFIC':
														$url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
														break;
													case 'Elite Airborne Express':
														$url = 'https://www.eliteairborne.com/';
														break;
													case 'DHL Parcel':
														$url = 'https://track.dhlparcel.co.uk/';
														break;
													default:
														$url = 'http://track.omegaentp.com/404.php';
														} ?>
											<b>FORWARDING NO.:</b> <a href="<?php echo $url; ?>" target="_blank" style="text-decoration: underline;color: #007bff;"><?php echo $row['forwarding']; ?></a>
										</td>
										<td><b>REFERENCE:</b> <?php echo $row['ref']; ?></td>
									</tr>
									<tr>
										<td><b>CONSIGNEE:</b> <?php echo $row['consignee_name']; ?></td>
										<td><b>SERVICE:</b> <?php echo $row['service_type']; ?></td>
									</tr>
									<tr>
										<td><b>ORIGIN:</b> <?php echo $row['consignor_city'];?>,&nbsp;<?php echo $row['consignor_state'];?>,&nbsp;<?php echo $row['consignor_country'];?></td>
										<td><b>DESTINATION:</b> <?php echo $row['consignee_city'];?>,&nbsp;<?php echo $row['consignee_state'];?>,&nbsp;<?php echo $row['consignee_country'];?></td>
									</tr>
								</table>
                                <?php $sql2 = "SELECT * FROM shipping_progress WHERE shipping_id = '".$row['id']."' and status = 1";
								$query2 = $db->query($sql2);
								if ($query2->rowCount()) { ?>
								<hr>
								<div id="timelineBasic" class="col-lg-12 layout-spacing">
									<h5>Shipment progress (in courier's local time)</h5>
										<div class="timeline-line">
												<?php foreach ($query2 as $row2) { ?>
												<div class="item-timeline">
													<p class="t-time"><?php echo  date('M jS Y', strtotime($row2['progress_date'])); ?></p>
													<div class="t-dot t-dot-primary"></div>
													<div class="t-text">
														<p><?php echo $row2['progress_details']; ?></p>
														<p class="t-meta-time">
															<b>Location: </b><?php echo $row2['progress_location']; ?>
															<br>
															<b>Time: <?php echo $row2['progress_time']; ?></b>
														</p>
													</div>
												</div>
											<?php } ?>
										</div>      
								</div>
								<?php } ?>
                             </div>
                        </div>
                    </div>
					<?php } ?>
				</div>
				<?php } else { ?>
                <p class="mb-3">Result Summary: There were no results</p>
				<?php } ?>
            </div>					
        </div>
    </div>
 </div>

<?php } include("includes/footer.php"); ?>