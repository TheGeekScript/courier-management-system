  $(".signin").click(function(){
	
	var email=$("input[name='email']").val();
	var password=$("input[name='password']").val();
				
	$.ajax({
		
		type:"POST",
		url:"Transactions.php?do=Signin",
		data:{email,password},
		success:function(view) {
			
        if (view == "1") { 
		
		$("#view").css('color', '#4dccd3').css('background-color', '#d0fdff').css('border-color', '#b2fbff').css('text-align', '-webkit-center').css('display', 'block').text("You have successfully logged in!");

        setTimeout(function(){
        window.location.href=""; 
        }, 4000);
		
		$("#view").animate
        ({left: "0px", opacity: "1"}, 2000, function()
        {
        $("#view").fadeOut(2000);
        }
        );
		} else {
		
		$("#view").css('color', '#ff526c').css('background-color', '#ffe5e9').css('border-color', '#f9e0db').css('text-align', '-webkit-center').css('display', 'block').html(view);
		
		
		}
	}
});
})

function c_update() {
	var u_office_name_1=$("input[name='u_office_name_1']").val();
	var u_office_address_1=$("input[name='u_office_address_1']").val();
	var u_office_name_2=$("input[name='u_office_name_2']").val();
	var u_office_address_2=$("input[name='u_office_address_2']").val();
	var u_address=$("input[name='u_address']").val();
	var u_lat=$("input[name='u_lat']").val();
	var u_lon=$("input[name='u_lon']").val();
	var u_email=$("input[name='u_email']").val();
	var u_phone=$("input[name='u_phone']").val();
	var u_facebook=$("input[name='u_facebook']").val();
	var u_twitter=$("input[name='u_twitter']").val();
	var u_google=$("input[name='u_google']").val();
	var u_instagram=$("input[name='u_instagram']").val();
	var u_youtube=$("input[name='u_youtube']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=C_Update",
		data:{u_office_name_1,u_office_address_1,u_office_name_2,u_office_address_2,u_address,u_lat,u_lon,u_email,u_phone,u_facebook,u_twitter,u_google,u_instagram,u_youtube},
		success:function(c_update_alert) {
			
        if (c_update_alert == "2") { 
		
		$("#c_update_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Your communication settings have been updated");

		$("#c_update_alert").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#c_update_alert").fadeOut(2000);
        }
        );
		}else {
		$("#c_update_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(c_update_alert);
		}
	}
});

}

function s_update() {
	var host=$("input[name='host']").val();
	var port=$("input[name='port']").val();
	var smtp_secure=$("input[name='smtp_secure']").val();
	var username=$("input[name='username']").val();
	var password=$("input[name='password']").val();
	var site_name=$("input[name='site_name']").val();
	var site_title=$("input[name='site_title']").val();

	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=S_Update",
		data:{host,port,smtp_secure,username,password,site_name,site_title},
		success:function(s_update_alert) {
			
        if (s_update_alert == "3") { 
		
		$("#s_update_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Your smtp settings have been updated");

		$("#s_update_alert").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#s_update_alert").fadeOut(2000);
        }
        );
		}else {
		$("#s_update_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(s_update_alert);
		}
	}
});

}

function plan_update() {
	var p_title=$("input[name='p_title']").val();
	var p_description=$("[name='p_description']").val();
	var p_title_1=$("input[name='p_title_1']").val();
	var p_description_1=$("[name='p_description_1']").val();
	var p_title_2=$("input[name='p_title_2']").val();
	var p_description_2=$("[name='p_description_2']").val();
	var p_title_3=$("input[name='p_title_3']").val();
	var p_description_3=$("[name='p_description_3']").val();
	
	$.ajax({
		type:"POST",
		url:"Transactions.php?do=Plan_Update",
		data:{p_title,p_description,p_title_1,p_description_1,p_title_2,p_description_2,p_title_3,p_description_3},
		success:function(plan_update_alert) {
			
        if (plan_update_alert == "4") { 
		
		$("#plan_update_alert").css('background-color', 'rgba(177, 255, 190, 0.51)').css('border-color', 'rgb(201, 243, 208)').css('text-align', '-webkit-center').css('display', 'block').text("Descriptions successfully updated.");

		$("#plan_update_alert").animate
        ({left: "400px", opacity: "1"}, 2000, function()
        {
        $("#plan_update_alert").fadeOut(2000);
        }
        );
		}else {
		$("#plan_update_alert").css('background-color', 'rgb(255, 236, 236)').css('border-color', 'rgb(229, 229, 229)').css('text-align', '-webkit-center').css('display', 'block').html(plan_update_alert);
		}
	}
});

}
