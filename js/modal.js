$(document).ready(function(){
	var url = window.location.href;
	var url_split = url.split('/');
	var url_length = url_split.length;
	var url_parent = url_split[url_length-2];
	var url_parameter = url_split[url_length-1];
	$(document).on('click', 'a[modal-toggle]', function(){
		var id = $(this).attr('modal-toggle');
		$(id).show();
		$('body').css('overflow','hidden');
		if(url_parent == 'admin'){
			if(url_parameter == 'peserta'){
				$('form input[name="no_peserta"]').val($(this).attr('data-no-peserta'));
				$('form input[name="name"]').val($(this).attr('data-name'));
				$('form input[name="username"]').val($(this).attr('data-username'));
				$('form input[name="birthdate"]').val($(this).attr('data-birthdate'));
				$('form select[name="school"]').val($(this).attr('data-school'));
				$('form select[name="class"]').val($(this).attr('data-class'));
				$('form select[name="competition"]').val($(this).attr('data-competition'));
				$('form input[name="id"]').val($(this).attr('data-id'));
				$('.modal-header').html('Detil Data Peserta');
				$('form input,form select').removeAttr('required');
				$('form input,form select').attr('disabled', '');
				$('button#edit').show();
				$('#detailPeserta button[type="submit"]').hide();
			}
			else if(url_parameter == 'panitia'){
				$('form input[name="id"]').val($(this).attr('data-id'));
				$('form input[name="name"]').val($(this).attr('data-name'));
				$('form input[name="email"]').val($(this).attr('data-email'));
				$('form input[name="username"]').val($(this).attr('data-username'));
				$('form input[name="birthdate"]').val($(this).attr('data-birthdate'));
				$('.modal-header').html('Detil Data Panitia');
				$('form input,form select').removeAttr('required');
				$('form input,form select').attr('disabled', '');
				$('button#edit').show();
				$('#detailPanitia button[type="submit"]').hide();
			}
			else if(url_parameter == 'juri'){
				$('form input[name="id"]').val($(this).attr('data-id'));
				$('form input[name="name"]').val($(this).attr('data-name'));
				$('form input[name="email"]').val($(this).attr('data-email'));
				$('form input[name="username"]').val($(this).attr('data-username'));
				$('form input[name="birthdate"]').val($(this).attr('data-birthdate'));
				$('form select[name="competition"]').val($(this).attr('data-competition'));
				$('.modal-header').html('Detil Data Juri');
				$('form input,form select').removeAttr('required');
				$('form input,form select').attr('disabled', '');
				$('button#edit').show();
				$('#detailJuri button[type="submit"]').hide();
			}
			else if(url_parameter == 'nilai'){
				$('form input[name="id"]').val($(this).attr('data-id'));
				$('form select[name="name"]').val($(this).attr('data-name'));
				$('form input[name="no_peserta"]').val($(this).attr('data-no-peserta'));
				$('form select[name="competition"]').val($(this).attr('data-competition'));
				$('form input[name="mark"]').val($(this).attr('data-mark'));
				$('.modal-header').html('Detil Data Nilai');
				$('form input,form select').removeAttr('required');
				$('form input,form select').attr('disabled', '');
				$('button#edit').show();
				$('#detailNilai button[type="submit"]').hide();
			}
		}else{
			
		}
		return false;
	});
	$('body').on('click', function(e){
		var target = $(e.target), article;
		if(target.is('.modal'))
		{
			$('.modal').hide();
			$('body').css('overflow','');
		}
	});
});