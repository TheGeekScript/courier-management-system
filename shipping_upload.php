<?php include("includes/header.php"); 
if (empty($_SESSION['session'])) {  
	    header("Location:index.php");
	} else {

	//actions
	if (!empty($_SESSION['session']))	{	
		?>
                    <div class="row layout-top-spacing">
                    
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area">
										<h3 class="text-center mt-4 mb-4">Upload Shipping Data</h3>
										
							<div class="row">
                                        <div class="col-lg-9 col-12 mx-auto">
									<span id="message"></span>
									  <form method="post" id="import_excel_form" enctype="multipart/form-data">
									  <div class="form-group mb-4 mt-3">
										<table class="table">
										  <tr>
											<td width="25%" align="right">Select Excel File</td>
											<td width="50%"><input type="file" name="import_excel" required class="form-control-file"/></td>
											<td width="25%"><input type="submit" name="import" id="import" class="mt-4 mb-4 btn btn-primary" value="Import" /></td>
										  </tr>
										</table>
										</div>
									  </form>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>

                    </div>
				
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#import_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"import.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_form')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });
});
</script>
<?php } } include("includes/footer.php"); ?>