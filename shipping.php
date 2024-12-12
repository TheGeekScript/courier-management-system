<?php include("includes/header.php");
	
	if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {
		
	if (!empty($_SESSION['session']))	{	
		
		
		
	if ($_SESSION['type'] == 'ADM') {
		include("shipping-adm.php");
	}elseif($_SESSION['type'] == 'EMP'){
		include("shipping-emp.php");
	}elseif($_SESSION['type'] == 'CUST'){
		include("shipping-cust.php");
	}else{}

} } include("includes/footer.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
$('#select_all').on('click',function(){
if(this.checked){
$('.checkbox').each(function(){
this.checked = true;
});
}else{
$('.checkbox').each(function(){
this.checked = false;
});
}
});
$('.checkbox').on('click',function(){
if($('.checkbox:checked').length == $('.checkbox').length){
$('#select_all').prop('checked',true);
}else{
$('#select_all').prop('checked',false);
}
});
});
</script>