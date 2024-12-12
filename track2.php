<?php 
require_once('includes/config-admin.php');
$track = $db -> query("SELECT * FROM shipping WHERE awb = '".$_POST['trackingid']."'")->fetch();
if (!empty($_POST['trackingid'])) {
    
    switch ($track['shipper']) {
        case 'dhl':
            $url = 'https://www.dhl.com/en/express/tracking.html?AWB='.$_POST['trackingid'].'&brand=DHL';
            break;
        case 'fedex':
			$url = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$track['awb'];
			break;
		case 'aramex':
			$url = 'https://www.aramex.com/us/en';
			break;
		case 'tnt':
			$url = 'https://www.tnt.com/express/en_in/site/shipping-tools/tracking.html?searchType=CON&cons='.$track['awb'];
			break;
		case 'dpd':
			$url = 'https://www.dpd.co.uk/apps/tracking/?reference='.$track['awb'].'#results';
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
    header('Location: '.$url);
}
?>
<form method="post" action="http://track.omegaentp.com/tracking.php">
<div class="row vc_col-md-9">
<input type="text" name="trackingid[]" class="track-input" required placeholder="Tracking Number">
</div>
<div class="row vc_col-md-3">
<input type="submit" name="track" value="TRACK" class="track-button">
</div>
</form>