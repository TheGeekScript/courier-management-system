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
		//array_shift($data);	//line to skip 1st row
		foreach($data as $row)
		{
			$insert_data = array(
				':uid'		=>	$row[0],
				':bdate'	=>	$row[1],
				':awb'		=>	$row[2],
				':fwd'		=>	$row[3],
				':rf'		=>	$row[4],
				':stype'	=>	$row[5],
				':ptype'	=>	$row[6],
				':piec'		=>	$row[7],
				':br'		=>	$row[8],
				':cr'		=>	$row[9],
				':fr'		=>	$row[10],
				':gr'		=>	$row[11],
				':crname'	=>	$row[12],
				':crcp'		=>	$row[13],
				':cre'		=>	$row[14],
				':crp'		=>	$row[15],
				':cradd'	=>	$row[16],
				':crco'		=>	$row[17],
				':crst'		=>	$row[18],
				':crci'		=>	$row[19],
				':crz'		=>	$row[20],
				':crdt'		=>	$row[21],
				':crd'		=>	$row[22],
				':cename'	=>	$row[23],
				':cecp'		=>	$row[24],
				':cee'		=>	$row[25],
				':cep'		=>	$row[26],
				':ceadd'	=>	$row[27],
				':ceco'		=>	$row[28],
				':cest'		=>	$row[29],
				':ceci'		=>	$row[30],
				':cez'		=>	$row[31],
				':rmrk'		=>	$row[32],
				':ss'		=>	$row[33],
			);
			
			$query = "
				UPDATE shipping SET user_id = :uid, b_date = :bdate, awb = :awb, forwarding = :fwd, ref = :rf, service_type = :stype, packaging_type = :ptype, pieces = :piec, base_rate = :br, covid_rate = :cr, fuel_rate = :fr, gst_rate = :gr, consignor_name = :crname, consignor_cperson = :crcp, consignor_email = :cre, consignor_phone = :crp, consignor_address = :cradd, consignor_country = :crco, consignor_state = :crst, consignor_city = :crci, consignor_zip = :crz, consignor_doc_type = :crdt, consignor_doc = :crd, consignee_name = :cename, consignee_cperson = :cecp, consignee_email = :cee, consignee_phone = :cep, consignee_address = :ceadd, consignee_country = :ceco, consignee_state  = :cest, consignee_city  = :ceci, consignee_zip = :cez, remarks = :rmrk, shipping_status = :ss WHERE awb = :awb
				";

				$statement = $db->prepare($query);
				$statement->execute($insert_data);
				$message = '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Data Imported Successfully</div>';
						
			//for($i=0;$i<count($row);$i++)
			 //{

				/*$query = "
				UPDATE shipping SET user_id = :uid, b_date = :bdate, forwarding = :fwd, ref = :rf, service_type = :stype, packaging_type = :ptype, pieces = :piec, base_rate = :br, covid_rate = :cr, fuel_rate = :fr, gst_rate = :gr, consignor_name = :crname, consignor_cperson = :crcp, consignor_email = :cre, consignor_phone = :crp, consignor_address = :cradd, consignor_country = :crco, consignor_state = :crst, consignor_city = :crci, consignor_zip = :crz, consignor_doc_type = :crdt, consignor_doc = :crd, consignee_name = :cename, consignee_cperson = :cecp, consignee_email = :cee, consignee_phone = :cep, consignee_address = :ceadd, consignee_country = :ceco, consignee_state  = :cest, consignee_city  = :ceci, consignee_zip = :cez, remarks = :rmrk, shipping_status = :ss WHERE awb = :awb
				";

				$stmt = $db->prepare($query);
				$stmt->bindParam(':uid', $row[0], PDO::PARAM_STR);
				$stmt->bindParam(':bdate', $row[1], PDO::PARAM_STR);
				$stmt->bindParam(':fwd', $row[3], PDO::PARAM_STR);
				$stmt->bindParam(':rf', $row[4], PDO::PARAM_STR);
				$stmt->bindParam(':stype', $row[5], PDO::PARAM_STR);
				$stmt->bindParam(':ptype', $row[6], PDO::PARAM_STR);
				$stmt->bindParam(':piec', $row[7], PDO::PARAM_INT);
				$stmt->bindParam(':br', $row[8], PDO::PARAM_STR);
				$stmt->bindParam(':cr', $row[9], PDO::PARAM_STR);
				$stmt->bindParam(':fr', $row[10], PDO::PARAM_STR);
				$stmt->bindParam(':gr', $row[11], PDO::PARAM_STR);
				$stmt->bindParam(':crname', $row[12], PDO::PARAM_STR);
				$stmt->bindParam(':crcp', $row[13], PDO::PARAM_STR);
				$stmt->bindParam(':cre', $row[14], PDO::PARAM_STR);
				$stmt->bindParam(':crp', $row[15], PDO::PARAM_STR);
				$stmt->bindParam(':cradd', $row[16], PDO::PARAM_STR);
				$stmt->bindParam(':crco', $row[17], PDO::PARAM_STR);
				$stmt->bindParam(':crst', $row[18], PDO::PARAM_STR);
				$stmt->bindParam(':crci', $row[19], PDO::PARAM_STR);
				$stmt->bindParam(':crz', $row[20], PDO::PARAM_STR);
				$stmt->bindParam(':crdt', $row[21], PDO::PARAM_STR);
				$stmt->bindParam(':crd', $row[22], PDO::PARAM_STR);
				$stmt->bindParam(':cename', $row[23], PDO::PARAM_STR);
				$stmt->bindParam(':cecp', $row[24], PDO::PARAM_STR);
				$stmt->bindParam(':cee', $row[25], PDO::PARAM_STR);
				$stmt->bindParam(':cep', $row[26], PDO::PARAM_STR);
				$stmt->bindParam(':ceadd', $row[27], PDO::PARAM_STR);
				$stmt->bindParam(':ceco', $row[28], PDO::PARAM_STR);
				$stmt->bindParam(':cest', $row[29], PDO::PARAM_STR);
				$stmt->bindParam(':ceci', $row[30], PDO::PARAM_STR);
				$stmt->bindParam(':cez', $row[31], PDO::PARAM_STR);
				$stmt->bindParam(':rmrk', $row[32], PDO::PARAM_STR);
				$stmt->bindParam(':ss', $row[33], PDO::PARAM_STR);
				$stmt->bindParam(':awb', $row[2], PDO::PARAM_STR);
				if ($stmt->execute()) {
				$message = '<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Data Imported Successfully</div>';
				} else {
					$message = '<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							Failed</div>';
				}*/
				
			 //}
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