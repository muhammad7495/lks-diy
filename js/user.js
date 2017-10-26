$(document).ready(function(){
	load_menu();
	function load_menu(){
		$('.nav-right').load('php/getMenuPeserta.php');
	}
	//permissions on register
	$('select[name="permissions"]').on('click', function(){
		var rank = $(this).val();
		if(rank == 0)
		{
			if(!$('input[name="no_peserta"]').length)
			{
				$.get('php/getRegisterPeserta.php', function(data){
					$(data).insertBefore('button[name="register"]');
				});
			}
		}
		else
		{
			$('input[name="no_peserta"]').remove();
			$('select[name="school"]').remove();
			$('select[name="class"]').remove();
			$('select[name="competition"]').remove();
		}
	});
	//register ajax
	$('#register form').unbind('submit').bind('submit',function(){
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			dataType: 'json',
			data: form.serialize(),
			success: function(response){
				if(response.success)
				{
					$(location).href = response.url;
					$('.message').html('Pendaftaran Berhasil').removeClass('danger').addClass('success').show();
					$('.message').fadeTo(1500, 500).slideUp(function(){
					});
				}
				else
				{
					$('.message').html(response.message).removeClass('success').addClass('danger').show();
					$('.message').fadeTo(1500, 500).slideUp();
				}
			}
		});
		return false;
	});
	//login ajax
	$('#login form').unbind('submit').bind('submit',function(){
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			dataType: 'json',
			data: form.serialize(),
			success: function(response){
				if(response.success)
				{
					window.location.href = response.url;
					$('.message').html('Login Berhasil').removeClass('danger').addClass('success').show();
					$('.message').fadeTo(1500, 500).slideUp(function(){
						
					});
				}
				else
				{
					$('.message').html(response.message).removeClass('success').addClass('danger').show();
					$('.message').fadeTo(1500, 500).slideUp();
				}
			}
		});
		return false;
	});
});