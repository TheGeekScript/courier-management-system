<?php $sql = "SELECT * FROM shipping WHERE status = '1' and user_id = ".$_SESSION['master_id']." order by id desc";
    $query = $db->query($sql);
	
	//delete
	if (!empty($_GET['del'])) { 
     $query = $db->prepare("delete from shipping WHERE id = :dl");
     $delete = $query->execute(array('dl' => $_GET['del']));		
        header("Location: shipping.php");
	}
				
?>

	<div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
				
					<?php
						if (!empty($errMSGs)) {
							echo '<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									'.$errMSGs.'.
								</div>';
					} ?>
					<form name="multipledeletion" method="post" novalidate>
							<?php if ($query->rowCount()) { ?>
                                <table id="zero-config" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
											<th>
												<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
												<input type="checkbox" class="new-control-input chk-parent" id="select_all">
												<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
												</label>
											</th>
                                            <th>Date</th>
                                            <th>AWB</th>
                                            <th>Forwarding</th>
                                            <th>Reference</th>
                                            <th>Service Type</th>
                                            <th>Content Type</th>
                                            <th>Content Desc</th>
                                            <th>Pieces</th>
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
									<?php foreach ($query as $row) { ?>
                                        <tr>
											<td>
												<label class="new-control new-checkbox checkbox-outline-primary  m-auto">
												<input type="checkbox" class="checkbox new-control-input child-chk" name="ids[]" value="<?php echo htmlentities($row['id']);?>">
												<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
												</label>
											</td>
                                            <td><?php echo date("Y-m-d", strtotime($row['b_date'])); ?> <?php echo $row['b_time'];?></td>
											<td><?php echo $row['awb']; ?></td>
											<td><?php echo $row['forwarding']; ?></td>
                                            <td><?php echo $row['ref']; ?></td>
											<td><?php echo $row['service_type']; ?></td>
											<td><?php echo $row['content_type']; ?></td>
											<td><?php echo $row['content_desc']; ?></td>
											<td><?php echo $row['pieces']; ?></td>
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
											<td><?php echo $row['shipping_status']; ?></td>	
                                            <td>
												<?php if($row['shipping_status'] == "Received"){ ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm" disabled>Open</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent" disabled>
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                  </div>
												<?php }else{ ?>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                      <a class="dropdown-item" href="edit-shipping-cust.php?id=<?php echo $row['id']; ?>">Edit Shipping</a>
                                                      <a class="dropdown-item" href="edit-parcel.php?awb=<?php echo $row['awb']; ?>">Edit Parcel</a>
													  <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="shipping.php?del=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete?');">Delete</a>
                                                    </div>
                                                  </div>													
												<?php } ?>
                                            </td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>AWB</th>
                                            <th>Forwarding</th>
                                            <th>Reference</th>
                                            <th>Service Type</th>
                                            <th>Content Type</th>
                                            <th>Content Desc</th>
                                            <th>Pieces</th>
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