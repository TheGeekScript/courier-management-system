<?php include("includes/header.php");
    $sql = "SELECT * FROM shipping_parcel WHERE awb_no = '".$_GET['awb']."' and status = '1'";
    $query = $db->query($sql);
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
		
	if (!empty($_SESSION['session']))	{	
		
	//delete
	if (!empty($_GET['del'])) { 
     $query = $db->prepare("delete from shipping_parcel WHERE id = :dl");
     $delete = $query->execute(array('dl' => $_GET['del']));
		header("Location: edit-parcel.php?awb=" . $_GET['awb']);
	}
	
	//update
	if (!empty($_POST['add_parcel'])) {
		
		$add_progress = $db->prepare("INSERT INTO shipping_parcel SET awb_no = ?, piece_no = ?, actual_weight = ?, length = ?, breadth = ?, height = ?, volume_weight = ?, charge_weight = ?, total_weight = ?");
		$add_progress->execute(array($_POST['awb_no'],$_POST['piece_no'],$_POST['actual_weight'],$_POST['length'],$_POST['breadth'],$_POST['height'],$_POST['volume_weight'],$_POST['charge_weight'],$_POST['total_weight']));
		if ($add_progress->rowCount()) {	
			header("Location: edit-parcel.php?awb=" . $_GET['awb']);
		} else {
			$errMSGs = "An error occurred!";
		}
	} else {}
		
		
		//edit
		if (!empty($_POST['edit_parcel'])) {
				
		$update = "UPDATE shipping_parcel SET piece_no = :pno, actual_weight = :aw, length = :le, breadth = :br, height = :he, volume_weight = :vw, charge_weight = :cw, total_weight = :tw  WHERE id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':pno', $_POST['piece_no'], PDO::PARAM_STR);
		$stmt->bindParam(':aw', $_POST['actual_weight'], PDO::PARAM_STR);
		$stmt->bindParam(':le', $_POST['length'], PDO::PARAM_STR);
		$stmt->bindParam(':br', $_POST['breadth'], PDO::PARAM_STR);
		$stmt->bindParam(':he', $_POST['height'], PDO::PARAM_STR);
		$stmt->bindParam(':vw', $_POST['volume_weight'], PDO::PARAM_STR);
		$stmt->bindParam(':cw', $_POST['charge_weight'], PDO::PARAM_STR);
		$stmt->bindParam(':tw', $_POST['total_weight'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
				//$successMSG = "Lead has been successfully updated.";
				header("Location: edit-parcel.php?awb=" . $_GET['awb']);
			} else {
				$errMSGs = "An error occurred!";
			}
		} else {}
		

?>
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
			<div class="row">
                <div class="col-lg-8 col-12 mx-auto">
					<?php if (!empty($successMSG)) {
						echo '<div class="alert alert-success mb-4 alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$successMSG.'</div>';
						}

						if (!empty($errMSGs)) {
						echo '<div class="alert alert-danger mb-4 alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'.$errMSGs.'</div>';
					} ?>
				</div>
			</div>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole">Add Parcel</button>
			
			<!-- Add Modal -->
			<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addModal">Add Parcel</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" id="adddynamic">
								<div class="form-row">
														<div class="form-group col-md-6">
															<label>Piece No. *</label>
															<input type="text" class="form-control" name="piece_no" data-cell="A1" data-format="0" required>
														</div>
														<div class="form-group col-md-6">
															<label>Act Wt. (Kg) *</label>
															<input type="text" class="form-control" name="actual_weight" data-cell="B1" data-format="0,0[.]00" required>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>Length (cm)</label>
															<input type="text" class="form-control" name="length" data-cell="C1" data-format="0,0[.]00">
														</div>
														<div class="form-group col-md-4">
															<label>Breadth (cm)</label>
															<input type="text" class="form-control" name="breadth" data-cell="D1" data-format="0,0[.]00">
														</div>
														<div class="form-group col-md-4">
															<label>Height (cm)</label>
															<input type="text" class="form-control" name="height" data-cell="E1" data-format="0,0[.]00">
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>Vol Wt. (Kg)</label>
															<input type="text" class="form-control" name="volume_weight" data-cell="F1" data-format="0,0[.]00" data-formula="(C1*D1*E1)/5000" readonly>
														</div>
														<div class="form-group col-md-4">
															<label>Chrg Wt. (Kg)</label>
															<input type="text" class="form-control" name="charge_weight" data-cell="G1" data-format="0,0[.]00" data-formula="IF(B1 > F1, B1, F1)" readonly>
														</div>
														<div class="form-group col-md-4">
															<label>Tot Wt. (Kg)</label>
															<input type="text" class="form-control" name="total_weight" data-cell="H1" data-format="0,0[.]00" data-formula="IF(B1 > G1, B1, G1)" readonly>
														</div>
													</div>
								<input type="hidden" name="awb_no" value="<?php echo $_GET['awb'];?>">
								<input type="submit" class="btn btn-primary mt-3" value="Add" name="add_parcel">
							</form>
						</div>
					</div>
				</div>
			</div>
													
            <div class="table-responsive mb-4 mt-4">
				<?php if ($query->rowCount()) { ?>
                <table id="zero-config" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Piece No.</th>
                            <th>Act. Wt.</th>
                            <th>Length</th>
							<th>Breadth</th>
							<th>Height</th>
							<th>Vol. Wt.</th>
							<th>Chrg. Wt.</th>
							<th>Tot. Wt.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($query as $row) { ?>
                        <tr>
                            <td><?php echo $row['piece_no']; ?></td>
                            <td><?php echo $row['actual_weight']; ?></td>
                            <td><?php echo $row['length']; ?></td>
                            <td><?php echo $row['breadth']; ?></td>
                            <td><?php echo $row['height']; ?></td>
                            <td><?php echo $row['volume_weight']; ?></td>
                            <td><?php echo $row['charge_weight']; ?></td>
                            <td><?php echo $row['total_weight']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editProgress<?php echo $row['id']; ?>">Edit</a>
                                        <a class="dropdown-item" href="edit-parcel.php?del=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </div>
								</div>
								<!-- Edit Modal -->
								<div class="modal fade" id="editProgress<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editingModal<?php echo $row['master_id']; ?>" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editingModal<?php echo $row['id']; ?>">Edit Parcel #<?php echo $row['id']; ?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST" id="dynamic">
													<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label>Piece No. *</label>
															<input type="text" class="form-control" name="piece_no" value="<?php echo $row['piece_no']; ?>" data-cell="A1" data-format="0" required>
														</div>
														<div class="form-group col-md-6">
															<label>Act Wt. (Kg) *</label>
															<input type="text" class="form-control" name="actual_weight" value="<?php echo $row['actual_weight']; ?>" data-cell="B1" data-format="0,0[.]00" required>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>Length (cm)</label>
															<input type="text" class="form-control" name="length" value="<?php echo $row['length']; ?>" data-cell="C1" data-format="0,0[.]00">
														</div>
														<div class="form-group col-md-4">
															<label>Breadth (cm)</label>
															<input type="text" class="form-control" name="breadth" value="<?php echo $row['breadth']; ?>" data-cell="D1" data-format="0,0[.]00">
														</div>
														<div class="form-group col-md-4">
															<label>Height (cm)</label>
															<input type="text" class="form-control" name="height" value="<?php echo $row['height']; ?>" data-cell="E1" data-format="0,0[.]00">
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>Vol Wt. (Kg)</label>
															<input type="text" class="form-control" name="volume_weight" value="<?php echo $row['volume_weight']; ?>" data-cell="F1" data-format="0,0[.]00" data-formula="(C1*D1*E1)/5000" readonly>
														</div>
														<div class="form-group col-md-4">
															<label>Chrg Wt. (Kg)</label>
															<input type="text" class="form-control" name="charge_weight" value="<?php echo $row['charge_weight']; ?>" data-cell="G1" data-format="0,0[.]00" data-formula="IF(B1 > F1, B1, F1)" readonly>
														</div>
														<div class="form-group col-md-4">
															<label>Tot Wt. (Kg)</label>
															<input type="text" class="form-control" name="total_weight" value="<?php echo $row['total_weight']; ?>" data-cell="H1" data-format="0,0[.]00" data-formula="IF(B1 > G1, B1, G1)" readonly>
														</div>
													</div>
													<input type="submit" class="btn btn-primary mt-3" value="Update" name="edit_parcel">
												</form>
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
                            <th>Piece No.</th>
                            <th>Act. Wt.</th>
                            <th>Length</th>
							<th>Breadth</th>
							<th>Height</th>
							<th>Vol. Wt.</th>
							<th>Chrg. Wt.</th>
							<th>Tot. Wt.</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <?php } else { echo '<br><p>There were no results</p>'; } ?>
			</div>
        </div>
    </div>
</div>
<script src="calx/jquery-calx-sample-2.2.8.min.js" type="text/javascript"></script>
<script>$form  = $('#dynamic').calx();</script>
<script>$form  = $('#adddynamic').calx();</script>
<?php } } include("includes/footer.php"); ?>