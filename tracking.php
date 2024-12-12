<?php include("includes/config-admin.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Omega Tracking</title>
    <link rel="icon" type="image/x-icon" href="assets/img/omega-favicon.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body>
    
    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <div class="nav-logo align-self-center">
                <a class="navbar-brand"><img alt="logo" src="assets/img/omega-logo.png"></a>
            </div>
		</header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="container">
                <div class="container">

                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div id="accordionIcons" class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Track Omega Shipments</h4>
                                        </div>
                                    </div>
                                </div> 
                                <div class="widget-content widget-content-area">
									<?php 
									//$awb_id = ['100000745', '390007377618', '31640507566'];
									//$awb_id = ['16144264761'];
									echo $awb_id = $_POST['trackingid'];
									$query = $db->prepare("SELECT * FROM shipping WHERE awb IN (".implode(",", $awb_id).")");
                                    $query->execute(); 
									if ($query->rowCount()) {?>
                                    <p class="mb-3">Result Summary</p>

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
												<td><b>DATE:</b> <?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
												<td>
												<?php
												switch ($row['mode']) {
													case 'dhl':
														$url = 'https://www.dhl.com/en/express/tracking.html?AWB='.$row['forwarding'].'&brand=DHL';
														break;
													case 'fedex':
														$url = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$row['forwarding'];
														break;
													case 'aramex':
														$url = 'https://www.aramex.com/us/en';
														break;
													case 'tnt':
														$url = 'https://www.tnt.com/express/en_in/site/shipping-tools/tracking.html?searchType=CON&cons='.$row['forwarding'];
														break;
													case 'dpd':
														$url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
														break;
													case 'PACIFIC':
														$url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
														break;
													case 'eliteairborne':
														$url = 'https://www.eliteairborne.com/';
														break;
													case 'dhlparcel':
														$url = 'https://track.dhlparcel.co.uk/';
														break;
													default:
														$url = 'http://track.omegaentp.com/404.php';
														}
												?>
												<b>FORWARDING NO.:</b> <a href="<?php echo $url; ?>" target="_blank" style="text-decoration: underline"><?php echo $row['forwarding']; ?></a></td>
												<td><b>CONSIGNEE:</b> <?php echo $row['consignee']; ?></td>
												</tr>
												<tr>
												<td><b>DESTINATION:</b> <?php echo $row['destination']; ?></td>
												<td><b>CNTS:</b> <?php echo $row['cnts']; ?></td>
												<td><b>WEIGHT:</b> <?php echo $row['weight']; ?></td>
												</tr>
												<tr>
												<td><b>MODE:</b> <?php echo $row['mode']; ?></td>
												<td><b>SHIPPER:</b> <?php echo $row['shipper']; ?></td>
												<td><b>REFERENCE:</b> <?php echo $row['ref']; ?></td>
												</tr>
												</table>
                                            </div>
                                            </div>
                                        </div>
										<?php } ?>
                                    
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

									<?php } else { ?>
                                    <p class="mb-3">Result Summary: There were no results</p>
									<?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                </div>
        <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © 2020 <a target="_blank" href="http://omegaentp.com/">Omega Enterprises</a>, All rights reserved.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> by <a target="_blank" href="http://hashtasy.com/">Hashtasy Digital</a></p>
                    </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/components/ui-accordions.js"></script>
</body>
</html>