$(document).ready(function(){
	var url = window.location.href;
	var url_split = url.split('/');
	var url_length = url_split.length;
	var url_parameter = url_split[url_length-1];
	if(url_parameter == ""){
		$('.sidenav a[href="dashboard"]').children('li').addClass('active');
		$('#content-admin').load('page/dashboard.php');
	}else if(url_parameter == "logout"){
		$.ajax({
			url: '../php/logout.php',
			type: 'POST',
			dataType: 'json',
			data: {'logout':'admin'},
			success: function(response){
				if(response.success)
					window.location.href = '../';
			}
		});
	}else{
		$('.sidenav a[href="'+url_parameter+'"]').children('li').addClass('active');
		$('#content-admin').load('page/'+url_parameter+'.php', function( response, status, xhr ) {
			if ( status == "error" ) {
				var msg = "404 Error Page Not Found!!!";
				$('#content-admin').html(msg);
			}
			else
			{
				$('#table').load('../php/getTable'+url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase()+'.php', function(){
					var i = 0;
					var rows = $('input[name="table_count"]').val();
					if(i == 0)
					{
						$('#previous').attr('href', '#');
						if(rows <= 10){
							$('#next').attr('href', '#');
						}else { 
							$('#next').attr('href', i+1); 
						}
					}
				});
				$('#content-admin').append('<script src="../js/modal.js"></script>');
				$('#content-admin').append('<script src="../js/modify.js"></script>');
			}
		});
		$(document).prop('title', url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase()+' - LKS DIY Admin Panel');
	}
	
	$('.sidenav a').on('click', function(){
		var filename = $(this).attr('href');
		$('.sidenav a li').removeClass('active');
		$('#content-admin').load('page/'+filename+'.php', function(){
			$('#table').load('../php/getTable'+filename.charAt(0).toUpperCase() + filename.slice(1).toLowerCase()+'.php', function(){
				var i = 0;
				var rows = $('input[name="table_count"]').val();
				if(i == 0)
				{
					$('#previous').attr('href', '#');
					if(rows <= 10){
						$('#next').attr('href', '#');
					}else { 
						$('#next').attr('href', i+1); 
					}
				}
				$('#content-admin').append('<script src="../js/modal.js"></script>');
				$('#content-admin').append('<script src="../js/modify.js"></script>');
			});
		});
		$(this).children('li').addClass('active');
		window.history.pushState(null, null, filename);
		$(document).prop('title', filename.charAt(0).toUpperCase() + filename.slice(1).toLowerCase()+' - LKS DIY Admin Panel');
		return false;
	});
});