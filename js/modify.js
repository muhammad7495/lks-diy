$(document).ready(function(){
	var url = window.location.href;
	var url_split = url.split('/');
	var url_length = url_split.length;
	var url_parent = url_split[url_length-2];
	var url_parameter = url_split[url_length-1];
	$(document).on('click', 'button#edit', function(){
		$(this).hide();
		var page = url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase();
		$('#detail'+page+' button[type="submit"]').show();
		$('.modal-header').html('Ubah Data '+page+'');
		$('form input[name!="username"],form select[name!="username"]').removeAttr('disabled');
		$('form input[name!="username"],form select[name!="username"]').attr('required', '');
		$('#frmNilai input[name="no_peserta"],#frmNilai select[name="competition"]').removeAttr('required');
		$('#frmNilai input[name="no_peserta"],#frmNilai select[name="competition"]').attr('disabled', '');
		$('#frm'+page+'').unbind('submit').bind('submit', function(){
			$.ajax({
				url: '../php/edit'+page+'.php',
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),
				success: function(response){
					if(response.success)
					{
						$('.message').html('Pembaharuan Data Berhasil').removeClass('danger').addClass('success').show();
						$('.message').fadeTo(1500, 500).slideUp(function(){
							$('.modal').hide();
							$('#table').load('../php/getTable'+page+'.php');
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
		return false;
	});
	$('#frmSettings').unbind('submit').bind('submit', function(){
		$.ajax({
			url: 'php/settings.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response){
				if(response.success)
				{
					$('.message').html('Pembaharuan Data Berhasil').removeClass('danger').addClass('success').show();
					$('.message').fadeTo(1500, 500).slideUp(function(){
						$('.modal').hide();
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
	$(document).on('click', 'button#rank', function(){
		var page = url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase();
		var id = $('input[name="id"]').val();
		$.ajax({
			url: '../php/edit'+page+'.php',
			type: 'POST',
			dataType: 'json',
			data: {'id': id},
			success: function(response){
				if(response.success)
				{
					$('.message').html('Pembaharuan Data Berhasil').removeClass('danger').addClass('success').show();
					$('.message').fadeTo(1500, 500).slideUp(function(){
						$('.modal').hide();
						$('#table').load('../php/getTable'+page+'.php');
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