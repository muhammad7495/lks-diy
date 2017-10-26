$(document).ready(function(){
	var url = window.location.href;
	var url_split = url.split('/');
	var url_length = url_split.length;
	var url_parameter = url_split[url_length-1];
	if(url_parameter == ""){
		$('#content').load('page/home.php');
	}else if(url_parameter == "logout"){
		$.ajax({
			url: 'php/logout.php',
			type: 'POST',
			dataType: 'json',
			data: {'logout':'user'},
			success: function(response){
				window.history.pushState(null, null, './');
				$(document).prop('title', 'LKS DIY - Home');
				$('#content').load('page/home.php');
			}
		});
	}else{
		$('#content').load('page/'+url_parameter+'.php', function( response, status, xhr ) {
			if ( status == "error" ) {
				var msg = "<h1 class='error'>404 Error Page Not Found!!!</span>";
				$('#content').html(msg);
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
			}
		});
		$(document).prop('title', 'LKS DIY - '+url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase());
	}
	
	$('.sidenav a').on('click', function(){
		var filename = $(this).attr('href');
		$('.sidenav a li').removeClass('active');
		$('#content').load('page/'+filename+'.php', function(){
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
			});
		});
		$(this).children('li').addClass('active');
		window.history.pushState(null, null, filename);
		$(document).prop('title', filename.charAt(0).toUpperCase() + filename.slice(1).toLowerCase()+' - LKS DIY Admin Panel');
		return false;
	});
});