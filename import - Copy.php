<?php
include 'vendor/autoload.php';
require_once('includes/config-admin.php');

if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{	
		
if($_FILES["import_excel"]["name"] != '')
{
	$allowed_extension = array('xls', 'csv', 'xlsx');
	$file_array = explode(".", $_FILES["import_excel"]["name"]);
	$file_extension = end($file_array);

	if(in_array($file_extension, $allowed_extension))
	{
		$target_dir = 'upload/';
		$file_name = $target_dir . time() . '.' . $file_extension;
		//$file_name = time() . '.' . $file_extension;
		
		move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();
		array_shift($data);	//line to skip 1st row
		foreach($data as $row)
		{
			$insert_data = array(
				':date'		=>	$row[0],
				':awb'		=>	$row[1],
				':forwarding'		=>	$row[2],
				':consignee'		=>	$row[3],
				':destination'		=>	$row[4],
				':cnts'		=>	$row[5],
				':weight'		=>	$row[6],
				':mode'		=>	$row[7],
				':shipper'		=>	$row[8],
				':ref'		=>	$row[9]
			);
			
			if(empty($data->$row[1])){
				
				$message = '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							column empty!</div>';
			}
			
			$check_duplicate_query = "SELECT awb FROM shipping WHERE awb = ".$row[1];
			$stmt = $db->prepare($check_duplicate_query);
			$result = $stmt->execute($insert_data);
			$rows = $stmt->fetch(PDO::FETCH_NUM);
			
			if($rows[0] > 0) {
    
				$message = '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							Duplicate entry exists!</div>';
			} else {

				$query = "
				INSERT INTO shipping 
				(date, awb, forwarding, consignee, destination, cnts, weight, mode, shipper, ref) 
				VALUES (:date, :awb, :forwarding, :consignee, :destination, :cnts, :weight, :mode, :shipper, :ref)
				";

				$statement = $db->prepare($query);
				$statement->execute($insert_data);
				$message = '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Data Imported Successfully</div>';
			}
		}
		
	}
	else
	{
		$message = '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					Only .xls .csv or .xlsx file allowed</div>';
	}
}
else
{
		$message = '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					Please Select File</div>';
}

echo $message;
} }
?>