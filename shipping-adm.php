<?php $sql = "SELECT * FROM shipping WHERE status = '1' order by id desc";
	$query = $db->query($sql);
	
	//delete
	if (!empty($_GET['del'])) { 
     $query = $db->prepare("delete from shipping WHERE id = :dl");
     $delete = $query->execute(array('dl' => $_GET['del']));		
        header("Location: shipping.php");
	}
		
	//update status
	if (!empty($_POST['update-forwarding'])) {
		$update = "UPDATE shipping SET forwarding = :ls WHERE id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':ls', $_POST['forwarding'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['f_id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
					header("Location: shipping.php");
			} else {
					$errMSGs = "An error occurred!";
			}
	}else{}
	//update end
	
	
	//update status
	if (!empty($_POST['status_id'])) {
		$update = "UPDATE shipping SET shipping_status = :ls WHERE id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':ls', $_POST['lead_status'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['status_id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
					header("Location: shipping.php");
			} else {
					$errMSGs = "An error occurred!";
			}
	}else{}
	
	//bulk delete
	error_reporting(0);
	if (isset($_POST["bulk_delete"])) {
	$edittable=$_POST['ids'];
	$N = count($edittable);
		if ($N > 0 ) {
			for($i=0; $i < $N; $i++) {
				$result = $db->prepare("DELETE FROM shipping WHERE id= :memid");
				$result->bindParam(':memid', $edittable[$i]);
				if ($result->execute()) {
					header("Location: shipping.php");
				} else {
					$errMSGs = "<strong>Error!</strong> Error while deleting. Please Try again.";
				}
			}
		} else {
		$errMSGs = "<strong>No Selection!</strong> You need to select atleast one checkbox to delete.";
		}
	}
?>

	<div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive">
				
					<?php
						if (!empty($errMSGs)) {
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									'.$errMSGs.'.
								</div>';
					} ?>
					<form name="multipledeletion" method="post" novalidate>
							<?php if ($query->rowCount()) { ?>
							<!--<input type="submit" name="bulk_delete" value="Bulk Delete" class="btn btn-primary btn-md pull-left" onClick="return confirm('Are you sure you want to delete?');" >-->
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
											<th>
												<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
												<input type="checkbox" class="new-control-input chk-parent" id="select_all">
												<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
												</label>
											</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Company Name</th>
                                            <th>AWB</th>
                                            <th>Forwarding</th>
                                            <th>Reference</th>
                                            <th>Service Type</th>
                                            <th>Content Type</th>
                                            <th>Content Desc</th>
                                            <th>Pieces</th>
                                            <th>Base</th>
                                            <th>ESS</th>
                                            <th>Fuel</th>
                                            <th>Extra</th>
                                            <th>GST (18%)</th>
                                            <th>Total Charge</th>
                                            <th>Consignor Name</th>
                                            <th>Consignor CPerson</th>
                                            <th>Consignor Email</th>
                                            <th>Consignor Phone</th>
                                            <th>Consignor_Address</th>
                                            <th>Consignor Country</th>
                                            <th>Consignor State</th>
                                            <th>Consignor City</th>
                                            <th>Consignor Zip</th>
                                            <th>Consignor Document Type</th>
                                            <th>Consignor Document</th>
                                            <th>Consignee Name</th>
                                            <th>Consignee CPerson</th>
                                            <th>Consignee Email</th>
                                            <th>Consignee Phone</th>
                                            <th>Consignee_Address</th>
                                            <th>Consignee Country</th>
                                            <th>Consignee State</th>
                                            <th>Consignee City</th>
                                            <th>Consignee Zip</th>
                                            <th>Remarks</th>
                                            <th>Shipping Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach ($query as $row) { 
									$manage_users = $db->query("SELECT * FROM master_admin WHERE `master_id` = '{$row['user_id']}'")->fetch();?>
                                        <tr>
											<td>
												<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
												<input type="checkbox" class="checkbox new-control-input child-chk" name="ids[]" value="<?php echo htmlentities($row['id']);?>">
												<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
												</label>
											</td>
                                            <td><?php echo date("Y-m-d", strtotime($row['b_date'])); ?> <?php echo $row['b_time'];?></td>
											<td><?php echo $manage_users['f_name'];?> <?php echo $manage_users['l_name'];?></td>
											<td><?php echo $manage_users['company_name'];?></td>
											<td><?php echo $row['awb']; ?></td>
											<td><?php /*echo $row['forwarding'];*/ ?>
											<form method="post" action="">
													<input type="text" name="forwarding" value="<?php echo $row['forwarding']; ?>">
													<input type="hidden" name="f_id" value="<?php echo $row['id'];?>">
													<input type="submit" name="update-forwarding" value="Update">
												</form>
											</td>
                                            <!--<td>
											<?php
											/*switch ($row['service_type']) {
												case 'DHL':
													$forwarding_url = 't.php';
													break;
												case 'fedex':
													$forwarding_url = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$row['forwarding'];
													break;
												case 'aramex':
													$forwarding_url = 'https://www.aramex.com/us/en';
													break;
												case 'tnt':
													$forwarding_url = 'https://www.tnt.com/express/en_in/site/shipping-tools/tracking.html?searchType=CON&cons='.$row['forwarding'];
													break;
												case 'dpd':
													$forwarding_url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
													break;
												case 'PACIFIC':
													$forwarding_url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$row['forwarding'].'#results';
													break;
												case 'eliteairborne':
													$forwarding_url = 'https://www.eliteairborne.com/';
													break;
												case 'dhlparcel':
													$forwarding_url = 'https://track.dhlparcel.co.uk/';
													break;
												default:
													$forwarding_url = 'http://track.omegaentp.com/404.php';
													}*/
											?>
											<a href="<?php echo $forwarding_url; ?>" target="_blank" style="text-decoration: underline"><?php echo $row['forwarding']; ?></a></td>-->
                                            <td><?php echo $row['ref']; ?></td>
											<td><?php echo $row['service_type']; ?></td>
											<td><?php echo $row['content_type']; ?></td>
											<td><?php echo $row['content_desc']; ?></td>
											<td><?php echo $row['pieces']; ?></td>
											<td><?php echo $row['base_rate']; ?></td>
											<td><?php echo $row['covid_rate']; ?></td>
											<td><?php echo $row['fuel_rate']; ?></td>
											<td><?php echo $row['extra_charge']; ?></td>
											<td><?php echo $row['gst_rate']; ?></td>
											<td><?php echo $row['total_charge']; ?></td>
											<td><?php echo $row['consignor_name']; ?></td>
											<td><?php echo $row['consignor_cperson']; ?></td>
											<td><?php echo $row['consignor_email']; ?></td>
											<td><?php echo $row['consignor_phone']; ?></td>
											<td><?php echo $row['consignor_address']; ?> <?php echo $row['consignor_address2']; ?> <?php echo $row['consignor_address3']; ?></td>
											<td><?php echo $row['consignor_country']; ?></td>
											<td><?php echo $row['consignor_state']; ?></td>
											<td><?php echo $row['consignor_city']; ?></td>
											<td><?php echo $row['consignor_zip']; ?></td>
											<td><?php echo $row['consignor_doc_type']; ?></td>
											<td><?php echo $row['consignor_doc']; ?></td>
											<td><?php echo $row['consignee_name']; ?></td>
											<td><?php echo $row['consignee_cperson']; ?></td>
											<td><?php echo $row['consignee_email']; ?></td>
											<td><?php echo $row['consignee_phone']; ?></td>
											<td><?php echo $row['consignee_address']; ?> <?php echo $row['consignee_address2']; ?> <?php echo $row['consignee_address3']; ?></td>
											<td><?php echo $row['consignee_country']; ?></td>
											<td><?php echo $row['consignee_state']; ?></td>
											<td><?php echo $row['consignee_city']; ?></td>
											<td><?php echo $row['consignee_zip']; ?></td>
											<td><?php echo $row['remarks']; ?></td>											
                                            <td>
												<form method="post" action="">
													<select name='lead_status' onchange='this.form.submit()'>
														<option value="Not Received" <?php if($row['shipping_status'] == 'Not Received'){echo 'selected';}?>>Not Received</option>
														<option value="Received" <?php if($row['shipping_status'] == 'Received'){echo 'selected';}?>>Received</option>
													</select>
													<input type="hidden" name="status_id" value="<?php echo $row['id'];?>">
													<noscript><input type="submit" value="Submit"></noscript>
												</form>
											</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
													
                                                      <a class="dropdown-item" target="_blank" href="shipping-label.php?id=<?php echo $row['id']; ?>">Label</a>
                                                      <a class="dropdown-item" href="add-progress.php?id=<?php echo $row['id']; ?>">Progress Details</a>
                                                      <a class="dropdown-item" href="edit-shipping.php?id=<?php echo $row['id']; ?>">Edit Shipping</a>
                                                      <a class="dropdown-item" href="edit-parcel.php?awb=<?php echo $row['awb']; ?>">Edit Parcel</a>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewDetails<?php echo $row['user_id']; ?>">View User Details</a>
													  <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="shipping.php?del=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete?');">Delete</a>
                                                    </div>
                                                  </div>
												  
												  <!-- Modal View Details-->
													<div class="modal fade" id="viewDetails<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewAddressModal<?php echo $row['id']; ?>" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered modal-md" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="viewAddressModal<?php echo $row['user_id']; ?>">User Details #<?php echo $row['user_id']; ?></h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
																	</button>
																</div>
																<div class="modal-body">
																	<p><b>Name</b>: <?php echo $manage_users['f_name'];?> <?php echo $manage_users['l_name'];?></p>
																	<p><b>Email</b>: <?php echo $manage_users['email'];?></p>
																	<p><b>Phone</b>: <?php echo $manage_users['phone'];?></p>
																	<p><b>Gender</b>: <?php echo $manage_users['gender'];?></p>
																	<p><b>Company Name</b>: <?php echo $manage_users['company_name'];?></p>
																	<p><b>GST</b>: <?php echo $manage_users['gst'];?></p>
																	<p><b>Address</b>: <?php echo $manage_users['address'];?></p>
																</div>
															</div>
														</div>
													</div>
													
                                            </td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Company Name</th>
                                            <th>AWB</th>
                                            <th>Forwarding</th>
                                            <th>Reference</th>
                                            <th>Service Type</th>
                                            <th>Content Type</th>
                                            <th>Content Desc</th>
                                            <th>Pieces</th>
                                            <th>Base</th>
                                            <th>ESS</th>
                                            <th>Fuel</th>
                                            <th>Extra</th>
                                            <th>GST (18%)</th>
                                            <th>Total Charge</th>
                                            <th>Consignor Name</th>
                                            <th>Consignor CPerson</th>
                                            <th>Consignor Email</th>
                                            <th>Consignor Phone</th>
                                            <th>Consignor_Address</th>
                                            <th>Consignor Country</th>
                                            <th>Consignor State</th>
                                            <th>Consignor City</th>
                                            <th>Consignor Zip</th>
                                            <th>Consignor Document Type</th>
                                            <th>Consignor Document</th>
                                            <th>Consignee Name</th>
                                            <th>Consignee CPerson</th>
                                            <th>Consignee Email</th>
                                            <th>Consignee Phone</th>
                                            <th>Consignee_Address</th>
                                            <th>Consignee Country</th>
                                            <th>Consignee State</th>
                                            <th>Consignee City</th>
                                            <th>Consignee Zip</th>
                                            <th>Remarks</th>
                                            <th>Shipping Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { echo '<br><p>There were no results</p>'; } ?>
					</form>
							
				</div>
            </div>
        </div>

    </div>