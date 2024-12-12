<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	header("Location:index.php");
} else { ?>
<link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
<div class="row layout-top-spacing">
    <div id="basic" class="mt-4 col-lg-12 layout-spacing">
		<div class="row">
            <div class="col-lg-6 col-12 mx-auto">
                  <!--<form method="post" action="tracking.php" enctype="multipart/form-data">
						<p class="">Track your shipping here...</p>
                        <div class="input-group">
                            <input type="text" class="form-control" name="trackingid[]" placeholder="Tracking Number">
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" value="TRACK">
                            </div>
                        </div>
                    </form>-->
				<form method="post" action="t.php" enctype="multipart/form-data">
					<p class="">Track your shipping here...</p>
                    <div class="input-group">
                        <input type="text" class="form-control" name="trackingid" placeholder="Tracking Number">
                        <div class="input-group-append">
                            <input class="btn btn-primary btn-sm" type="submit" value="TRACK">
                        </div>
                    </div>
				</form>
            </div>                                        
        </div>
    </div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div id="card_7" class="col-lg-12 layout-spacing">
        <div class="">
            <div class="">
				<div class="row mt-4 mb-4">
					<?php if ($_SESSION['type'] == "ADM") {
						
					$items_nr = $db->prepare("SELECT COUNT(*) FROM shipping WHERE status = 1 and shipping_status = 'Not Received'");
					$items_nr->execute();
					$ship_count_nr = $items_nr->fetchColumn();

					$items_r = $db->prepare("SELECT COUNT(*) FROM shipping WHERE status = 1 and shipping_status = 'Received'");
					$items_r->execute();
					$ship_count_r = $items_r->fetchColumn();

					$items_c = $db->prepare("SELECT COUNT(*) FROM shipping WHERE status = 1");
					$items_c->execute();
					$ship_count = $items_c->fetchColumn();

					$build_form = $db->prepare("SELECT COUNT(*) FROM master_admin WHERE is_active = 1");
					$build_form->execute();
					$build_form_count = $build_form->fetchColumn();
					?>
                    <div class="col-lg-3">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">New Shipping</h5>
                                <h6 class="rating-count">(<?php echo $ship_count_nr; ?>)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">Received at Omega</h5>
                                <h6 class="rating-count">(<?php echo $ship_count_r; ?>)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">Total Shipping</h5>
                                <h6 class="rating-count">(<?php echo $ship_count; ?>)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">Total Users</h5>
                                <h6 class="rating-count">(<?php echo $build_form_count; ?>)</h6>
                            </div>
						</div>
                    </div>
					<?php }else{ 
					$items_nr = $db->prepare("SELECT COUNT(*) FROM shipping WHERE user_id = '".$_SESSION['master_id']."' and status = 1 and shipping_status = 'Not Received'");
					$items_nr->execute();
					$ship_count_nr = $items_nr->fetchColumn();

					$items_r = $db->prepare("SELECT COUNT(*) FROM shipping WHERE user_id = '".$_SESSION['master_id']."' and status = 1 and shipping_status = 'Received'");
					$items_r->execute();
					$ship_count_r = $items_r->fetchColumn();

					$items_c = $db->prepare("SELECT COUNT(*) FROM shipping WHERE user_id = '".$_SESSION['master_id']."' and status = 1");
					$items_c->execute();
					$ship_count = $items_c->fetchColumn();
					?>
					<div class="col-lg-4">
                        <div class="card component-card_7">
							<div class="card-body">
                                <h5 class="card-text">New Shipping</h5>
                                <h6 class="rating-count">(<?php echo $ship_count_nr; ?>)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">Received at Omega</h5>
                                <h6 class="rating-count">(<?php echo $ship_count_r; ?>)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card component-card_7">
                            <div class="card-body">
                                <h5 class="card-text">Total Shipping</h5>
                                <h6 class="rating-count">(<?php echo $ship_count; ?>)</h6>
                            </div>
                        </div>
                    </div>
					<?php } ?>
                </div>
			</div>
		</div>
    </div>
</div>
<?php } include("includes/footer.php"); ?>