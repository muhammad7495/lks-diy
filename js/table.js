$(document).ready(function(){
	//pagination
	var url = window.location.href;
	var url_split = url.split('/');
	var url_length = url_split.length;
	var url_parameter = url_split[url_length-1];
	var i = 0;
	//search
	$('a#previous,a#next').on('click', function(){
		var id = $('input[name="table_count"]').val();
		var search = $('input[name="search"]').val()!=""?$('input[name="search"]').val():'';
		if($(this).attr('id') == "previous")
		{
			i--;
		}
		else if(i < Math.floor(id/10)){
			i++;
		}
			
		if(i <= 0)
		{
			$('#previous').attr('href', '#');
			$('#next').attr('href', 1); 
			i=0;
		}
		else
		{
			$('#previous').attr('href', i);
			$('#next').attr('href', i+1); 
		}
		$('#table').load('../php/getTable'+url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase()+'.php', {'filter':i,'search':search});
		return false;
	});
	$('input[name="search"]').keyup(function(){
		$('#table').load('../php/getTable'+url_parameter.charAt(0).toUpperCase() + url_parameter.slice(1).toLowerCase()+'.php', {'search':$(this).val()}, function(){
			var id = $('input[name="table_count"]').val();
			if(id<=10)
			{
				$('#next').attr('href', '#');
			}
			else
			{
				$('#next').attr('href', 1); 
			}
		});
	});
});