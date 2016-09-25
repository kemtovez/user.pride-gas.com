jQuery(document).ready(function ($)  {
//----------ВСПЛЫВАЮЩЕЕ ОКНО
	function openPopup(url) {
		$.fancybox({
			type: 'inline',
			href: url,
			loop: false,
			'arrows': false,
			helpers: {
				overlay : {closeClick: false}
			},
			'hideOnOverlayClick': false,
			'closeClick'  : false
		});
	};
//------------ ОБЩАЯ ФОРМА
	var requestSent = false;

	$(".ajax_form").submit(function(e){
	if(!requestSent) {
		requestSent = true;
		e.preventDefault();
		var m_method = $(this).attr("method");
		var m_action = $(this).attr("action");
		var m_data = $(this).serialize();
		console.log(m_data);
		$.ajax({
			type: m_method,
			url: m_action,
			dataType: 'json',
			data: m_data,
			beforeSend: function(data) {
				$(".ajax_form").find('button[type="submit"]').hide();
			},
			success: function (result) {
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				}
				;
				if (result.result) {
					if (result.result.status == 'ok') {
						alertify.success(result.result.text);
						if (result.result.do == 'go_url') {
							document.location.href = result.result.url;
						}
						if (result.result.do == 'close_modal') {
							$("#" + result.result.url).removeClass("md-show");
						}
					}
				}
				requestSent = false;
			},
			complete: function () {
				requestSent = false;
				$(".ajax_form").find('button[type="submit"]').show();
			}
		});
	}
});
//----------ОЧИСТКА ВСПЛЫВАЮЩЕГО ОКНА
$('body').on('click', '.fancybox-close', function() {
$('#popup_box').html('');
});
//----------
// Header
	$('.shuse_car_block > select').on('change', function() {
		if (this.value == 'add') {
			document.location.href = '/add_car';
		} else {
			$.ajax({
				type: 'POST',
				url: '../cont/change_car.php',
				data: 'id='+this.value,
				success: function(result){
					alertify.success(result);
					location.reload();
				}
			});
		}
	});
// Edit profile
	$('body').on('click', '.edit_profile', function() {
		$('.user_data > ul > li').children('.edit_line_pr').remove();
		$('.user_data > ul > li').each(function(elem) {
			$val = $(this).children('span').text();
			$name = $(this).children('span').attr('name');
			$table = $(this).children('span').attr('data');
			$html = '<div class="edit_line_pr"><input name="'+$name+'" data="'+$table+'" value="'+$val+'"><span class="save_line_profile"><i class="fa fa-check" aria-hidden="true"></i></span><span class="dell_line_profile"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$(this).append($html);
		});
	});
	$('body').on('click', '.dell_line_profile', function() {
		$(this).parent('.edit_line_pr').remove();
	});
	$('body').on('click', '.save_line_profile', function() {
		$name = $(this).parent('.edit_line_pr').children('input').attr('name');
		$value = $(this).parent('.edit_line_pr').children('input').val();
		$table = $(this).parent('.edit_line_pr').children('input').attr('data');
		if($value!='') {
			$(this).parent('.edit_line_pr').parent('li').children('span[name="'+$name+'"]').text($value);
			$.ajax({
				type: 'POST',
				url: '../cont/edit_profile.php',
				data: 'name='+$name+'&value='+$value+'&table='+$table,
				success: function(result){
					alertify.success(result);

					}
			});
		}
	});
// Checkbox
	$('.list_send_settings > .checkbox_box > input').on('change', function() {
		$name = $(this).attr('id');
		if ($(this).is(':checked')) {
			console.log('check');
			$value = 1;
		} else {
			console.log('no check');
			$value = 0;
		}
		console.log('name='+$name+'&value='+$value+'&table=users');
		$.ajax({
			type: 'POST',
			url: '../cont/edit_profile.php',
			data: 'name='+$name+'&value='+$value+'&table=users',
			success: function(result){
				alertify.success(result);

			}
		});
	});
//------------------ DAte
	$.datetimepicker.setLocale('ru');
	$('.data_time').datetimepicker({
		format:'d.m.Y H:i',
		formatTime:'H:i',
		formatDate:'d.m.Y',
		timepickerScrollbar:false
	});

//------------------- Rayting
	$('.radio_raitings > input[type="checkbox"]').on('change', function() {
		$id = $(this).val();
		$(this).parent('.radio_raitings').parent('td').parent('tr').find('input[type="checkbox"]').prop( "checked", false );
		$(this).parent('.radio_raitings').parent('td').parent('tr').children('td').each(function (i, elem) {
			if($(this).children('.radio_raitings').children('input[type="checkbox"]').val()<=$id) {
				$(this).children('.radio_raitings').children('input[type="checkbox"]').prop("checked", true);
			}
		});
	});
//------------------- Work table detail
	$('body').on('click', '.detail_work_table', function() {
		$id = $(this).attr('data');
		if($('#hidden_data_'+$id).css('display') == 'none') {
			$('#hidden_data_'+$id).show();
			$(this).addClass('hide_detail_work_table').text('Свернуть');
		} else {
			$('#hidden_data_'+$id).hide();
			$(this).removeClass('hide_detail_work_table').text('Детальнее');
		}
	});

	$('body').on('click', '.ajax_detail_work', function() {
		$id = $(this).attr('data');
		$.ajax({
			type: 'POST',
			url: '../cont/ajax_detail_work.php',
			data: 'id='+$id,
			dataType: 'json',
			success: function(result){
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				}
				;
				if (result.result) {
					if (result.result.status == 'ok') {
						$('#ajax_other_work').html('');
						$('#ajax_data_last_work').html(result.result.data.data_last_work);
						$('#ajax_name_work').html(result.result.data.name_work);
						$('#ajax_name_sto').html(result.result.data.name_sto);
						$('#ajax_global_gar').html(result.result.data.global_gar);
						$.each(result.result.data.other_work, function(i, elem) {
							$('#ajax_other_work').append('<li>'+elem[0]+'</li>');
						});

						$("#modal-5").addClass("md-show");
					}
				}

			}
		});

	});
	$('body').on('click', '#modal-5 > .md-content > .md-content-header > .md-close', function() {
		$("#modal-5").removeClass("md-show");
	});


});
