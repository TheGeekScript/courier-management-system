<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	header("Location:index.php");
} else { ?>

<link href="assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components/timeline/custom-timeline.css" rel="stylesheet" type="text/css" />

<?php $service_type = $db->query("SELECT service_type FROM shipping WHERE `forwarding` = '{$_POST['trackingid']}' and status = 1")->fetch();

if($service_type['service_type'] == 'DHL'){

//dhl
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api-eu.dhl.com/track/shipments?trackingNumber=".$_POST['trackingid'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "dhl-api-key: DCdG7nlkaVrYnTKV00NVJFFt1ATpHIyQ",
    "postman-token: 560f3e1f-27f6-eb02-de04-d931200b8657"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}
$array_output_result = json_decode($response, TRUE);
?>
                    <div class="row layout-top-spacing">
                        <div class="col-lg-8 mx-auto layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area br-6">
									<h4>Waybill: <?php echo $array_output_result['shipments'][0]['id'];?> </h4>
									<hr>
                                    <p class="mb-3"><b>Service:</b> <?php echo $array_output_result['shipments'][0]['service'];?></p>
                                    <p class="mb-3"><b>Origin:</b> <?php echo $array_output_result['shipments'][0]['origin']['address']['addressLocality'];?></p>
                                    <p class="mb-3"><b>Destination:</b> <?php echo $array_output_result['shipments'][0]['destination']['address']['addressLocality'];?></p>
									<hr>
									<h5>Status</h5>
                                    <p class="mb-3"><b>Time:</b> <?php echo $array_output_result['shipments'][0]['status']['timestamp'];?></p>
                                    <p class="mb-3"><b>Location:</b> <?php echo $array_output_result['shipments'][0]['status']['location']['address']['addressLocality'];?></p>
                                    <p class="mb-3"><b>Status:</b> <?php echo $array_output_result['shipments'][0]['status']['status'];?></p>
                                    <p class="mb-3"><b>Description:</b> <?php echo $array_output_result['shipments'][0]['status']['description'];?></p>
									
									<hr>
									<div id="timelineBasic" class="col-lg-12 layout-spacing">
										<h5>Shipment progress (in courier's local time)</h5>
                                        <div class="timeline-line">
                                            
										<?php for($i = 0; $i < COUNT($array_output_result['shipments'][0]['events']); $i++) { ?>
                                            <div class="item-timeline">
                                                <p class="t-time"><?php echo  date('M jS Y', strtotime($array_output_result['shipments'][0]['events'][$i]['timestamp'])); ?></p>
                                                <div class="t-dot t-dot-primary">
                                                </div>
                                                <div class="t-text">
                                                    <p><?php echo $array_output_result['shipments'][0]['events'][$i]['description'];?></p>
                                                    <p class="t-meta-time">
														<b>Location: </b><?php echo $array_output_result['shipments'][0]['events'][$i]['location']['address']['addressLocality'];?>
														<br>
														<b>Time: <?php echo date('h:i A', strtotime($array_output_result['shipments'][0]['events'][$i]['timestamp'])); ?></b>
													</p>
                                                </div>
                                            </div>
										<?php } ?>

                                        </div>      
									</div>
                        
						
						
						
                                    <div id="iconsAccordion" class="accordion-icons">
										<div class="card">
                                            <div class="card-header" id="headingtnc">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordiontnc" aria-expanded="false" aria-controls="iconAccordiontnc">
                                                        <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                                                        Terms & Conditions <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div id="iconAccordiontnc" class="collapse" aria-labelledby="headingtnc" data-parent="#iconsAccordion">
                                            <div class="card-body">
                                                <p>You are authorized to use this tracking system solely to track shipments tendered via DHL by, for, or to you. No other use may be made of the tracking system and information without DHL's written consent.</p>
                                            </div>
                                            </div>
                                        </div>
										
									</div>
                                </div>
                            </div>
                        </div>

                    </div>

<?php 
} elseif($service_type['service_type'] == 'Fedex'){
	header("Location: https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=" . $_POST['trackingid']);
}elseif($service_type['service_type'] == 'Aramex'){
	header("Location: https://www.aramex.com/us/en");
}elseif($service_type['service_type'] == 'DPD'){
	header("Location: https://www.dpd.co.uk/apps/tracking/?reference=" . $row['forwarding'] . "#results");
}elseif($service_type['service_type'] == 'Elite Airborne'){
	header("Location: https://www.eliteairborne.com/");
}elseif($service_type['service_type'] == 'TNT'){
	header("Location: https://www.tnt.com/express/en_in/site/shipping-tools/tracking.html?searchType=CON&cons=".$row['forwarding']);
}elseif($service_type['service_type'] == 'DHL Parcel'){
	header("Location: ttps://track.dhlparcel.co.uk/");
}else{ ?>
<div class="row layout-top-spacing">
    <div class="col-lg-8 mx-auto layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area br-6">
				<h4>Not Found</h4>
            </div>
        </div>
    </div>
</div>
<?php }
} include("includes/footer.php"); ?>