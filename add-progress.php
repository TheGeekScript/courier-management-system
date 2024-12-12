<?php include("includes/header.php");
    $sql = "SELECT * FROM shipping_progress WHERE shipping_id = '".$_GET['id']."' and status = '1'";
    $query = $db->query($sql);
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if(!empty($_SESSION['type'] == "CUST")){
		header("Location:dashboard.php");
	}
		
	if (!empty($_SESSION['session']))	{	
		
	//delete
	if (!empty($_GET['del'])) { 
     $query = $db->prepare("delete from shipping_progress WHERE id = :dl");
     $delete = $query->execute(array('dl' => $_GET['del']));
		header("Location: add-progress.php?id=" . $_GET['id']);
	}
	
	//update
	if (!empty($_POST['add_progress'])) {
		
		$add_progress = $db->prepare("INSERT INTO shipping_progress SET shipping_id = ?, progress_date = ?, progress_location = ?, progress_time = ?, progress_details = ?");
		$add_progress->execute(array($_POST['shipping_id'],$_POST['progress_date'],$_POST['progress_location'],$_POST['progress_time'],$_POST['progress_details']));
		if ($add_progress->rowCount()) {	
			header("Location: add-progress.php?id=" . $_GET['id']);
		} else {
			$errMSGs = "An error occurred!";
		}
	} else {}
		
		
		//edit
		if (!empty($_POST['edit_progress'])) {
				
		$update = "UPDATE shipping_progress SET shipping_id = :shipid, progress_date = :pdate, progress_location = :ploc, progress_time = :ptime, progress_details = :pdet WHERE id = :d";
		$stmt = $db->prepare($update);
		$stmt->bindParam(':shipid', $_GET['id'], PDO::PARAM_INT);
		$stmt->bindParam(':pdate', $_POST['progress_date'], PDO::PARAM_STR);
		$stmt->bindParam(':ploc', $_POST['progress_location'], PDO::PARAM_STR);
		$stmt->bindParam(':ptime', $_POST['progress_time'], PDO::PARAM_STR);
		$stmt->bindParam(':pdet', $_POST['progress_details'], PDO::PARAM_STR);
		$stmt->bindParam(':d', $_POST['id'], PDO::PARAM_INT);	
			if ($stmt->execute()) {
				//$successMSG = "Lead has been successfully updated.";
				header("Location: add-progress.php?id=" . $_GET['id']);
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
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole">Add Progress</button>
			
			<!-- Add Modal -->
			<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addModal">Add Progress</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label>Date</label>
										<input type="date" class="form-control" name="progress_date">
									</div>
									<div class="form-group col-md-4">
										<label>Location</label>
										<input type="text" class="form-control" name="progress_location">
									</div>
									<div class="form-group col-md-4">
										<label>Time</label>
										<input type="text" class="form-control" name="progress_time">
									</div>
								</div>
								<div class="form-group">
									<label>Details</label>
									<textarea type="text" class="form-control" name="progress_details"></textarea>
								</div>
								<input type="hidden" name="shipping_id" value="<?php echo $_GET['id'];?>">
								<input type="submit" class="btn btn-primary mt-3" value="Add" name="add_progress">
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
                            <th>ID</th>
                            <th>Date</th>
                            <th>Location</th>
							<th>Time</th>
							<th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($query as $row) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['progress_date']; ?></td>
                            <td><?php echo $row['progress_location']; ?></td>
                            <td><?php echo $row['progress_time']; ?></td>
                            <td><?php echo $row['progress_details']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editProgress<?php echo $row['id']; ?>">Edit</a>
                                        <a class="dropdown-item" href="add-progress.php?del=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </div>
								</div>
								<!-- Edit Modal -->
								<div class="modal fade" id="editProgress<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editingModal<?php echo $row['master_id']; ?>" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editingModal<?php echo $row['id']; ?>">Edit Progress #<?php echo $row['id']; ?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST">
													<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
													<div class="form-row">
														<div class="form-group col-md-4">
															<label>Date</label>
															<input type="date" class="form-control" name="progress_date" value="<?php echo $row['progress_date']; ?>">
														</div>
														<div class="form-group col-md-4">
															<label>Location</label>
															<input type="text" class="form-control" name="progress_location" value="<?php echo $row['progress_location']; ?>">
														</div>
														<div class="form-group col-md-4">
															<label>Time</label>
															<input type="text" class="form-control" name="progress_time" value="<?php echo $row['progress_time']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label>Details</label>
														<textarea type="text" class="form-control" name="progress_details"><?php echo $row['progress_details']; ?></textarea>
													</div>
													<input type="submit" class="btn btn-primary mt-3" value="Update" name="edit_progress">
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
                            <th>ID</th>
                            <th>Date</th>
                            <th>Location</th>
							<th>Time</th>
							<th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <?php } else { echo '<br><p>There were no results</p>'; } ?>
			</div>
        </div>
    </div>
</div>
<?php } } include("includes/footer.php"); ?>