$(function() {
$('.my_message_btn').tipsy({gravity: 'w'});
$('.my_notification_btn').tipsy({gravity: 'w'});
$('.my_calendar_btn').tipsy({gravity: 'w'});
/* Alertify settings */
alertify.set({
	labels: {
    	ok: "OK",
    	cancel: "Отмена"
	},
	buttonReverse: true
});

/*
$("#left_menu a").on("click", function() {
if ($(this).attr('href').match('#')) {

return false;
}
});
*/
$(document).on({
    mouseenter: function(eventObject) { 
$('.help_box_vk').show();
},
    mouseleave: function(eventObject) { 
$('.help_box_vk').hide();
}
}, '.vk_group_button');

$(document).on({
    mouseenter: function(eventObject) {
        $data_tooltip = $(this).attr("data-tooltip2");
 $("#tooltip2").html($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY + 10,
                        "left" : eventObject.pageX + 10
                     })
                     .show();
    },
    mouseleave: function(eventObject) {
        $("#tooltip2").hide().text("").css({"top" : 0,"left" : 0});
    }
}, '[data-tooltip2]');

$('body').on('click', '.tel_icon', function(e) { 
$text = $(this).attr('data-tooltip2');
$('#tooltip_crm').html('<h3>Телефон:<br><b>'+$text+'</b></h3>');
        $.fancybox({
		type: 'inline',
		href: '#tooltip_crm',
		loop: false,
		'arrows': false,
		'hideOnOverlayClick': false,
		'closeClick'  : false
		});
});
$('body').on('click', '.email_icon', function(e) { 
$text = $(this).attr('data-tooltip2');
$('#tooltip_crm').html('<h3>Email:<br><b>'+$text+'</b></h3>');
        $.fancybox({
		type: 'inline',
		href: '#tooltip_crm',
		loop: false,
		'arrows': false,
		'hideOnOverlayClick': false,
		'closeClick'  : false
		});
});
//------------ ОБЩАЯ ФОРМА
$(".ajax_form").submit(function(e){
e.preventDefault();
var m_method=$(this).attr("method");
var m_action=$(this).attr("action");
var m_data=$(this).serialize();
$.ajax({
type: m_method,
url: m_action,
data: m_data,
success: function(result){
if(result.indexOf('location') + 1) {
$query = result.split("#");
$url = $query[1];
document.location.href = $url;
} else {
alertify.error(result);
$('.restore_pass').show();

}
}
});
});

$(".restore_pass").on("click", function() {
        $.fancybox({
		type: 'inline',
		href: '.restore_pass_form',
		loop: false,
		'arrows': false,
		'hideOnOverlayClick': false,
		'closeClick'  : false
		});
});

//--------------------
$(".submit_lost_pass").click(function() {
$email = $(this).parent('.lost_pass_form').children('input').val();	
//$email = $('#email_lost_input').val();
console.log($email);
if ($email!='') {
$.ajax({
type: "POST",
url: '/cont/lost_pass.php',
data: 'email='+$email,
beforeSend: function() {
$('#err_lost_pass').html('<div class="loading"></div>');
},
success: function(html){ 
//$("#err_lost_pass").html(html); 
$('#error').text(html);
        $.fancybox({
		type: 'inline',
		href: '#error',
		loop: false,
		'arrows': false,
		 helpers: {
		  overlay : {closeClick: false}
    },
		'hideOnOverlayClick': false,
		'closeClick'  : false
		});
alertify.error(html);

}  
});
} else {
//alertify.error('Вы не заполнили все поля!');
alert('Вы не заполнили все поля!');
}
  return false; //exit
});
/*
$(".close_helper").on("click", function() {
$data = $(this).attr('data');
if($data=='9') {
$.cookie('help', '10', { expires: 7 });
}
$('.help_'+$data).hide();
});
*/
//-----------КЛИК ПО ЛЕВОМ МЕНЮ
$("#left_menu a[href='#']").on("click", function() {
return false;
});
//-----------
$(".my_sponsor_btn").on("click", function() {
$(this).attr('style', '');
$('.help_5').hide();
$id = $(this).attr('data');
$ref_id = $(this).attr('data2');

      $.ajax({
				type: "POST",
				url: '../cont/ajax_sponsor.php',
				data: 'id='+$id+'&ref_id='+$ref_id,
				success: function(result){			
				$('#popup_box').html(result);
				openPopup('#popup_box');
}
 });
 
 return false;
});



//-------------------------
$(".close_menu_0_0").on("click", function() {
alertify.error('Активируйте аккаунт в профиле');
});
$(".close_menu_1_0").on("click", function() {
alertify.error('Ожидайте подтверждения');
});
$(".close_menu_2_0").on("click", function() {
alertify.error('Оплатите аккаунт');
});


$(".close_menu_1_1").on("click", function() {
alertify.error('Вы были перенесены к другому спонсору, согласно вашим данным. Ожидайте подтверждения');
});
$(".close_menu_1_2").on("click", function() {
alertify.error('Ваш спонсор в системе не зарегистрирован. Ожидайте связи');
});

//----------ВСПЛЫВАЮЩЕЕ ОКНО
	  function openPopup(url) {
        $.fancybox({
		type: 'inline',
		href: url,
		loop: false,
	//	'width': 970,
	//	'height': 800,
		'arrows': false,
		 helpers: {
		  overlay : {closeClick: false}
    },
		'hideOnOverlayClick': false,
		'closeClick'  : false
	//	'autoSize' : false
		});
    };
//----------ОЧИСТКА ВСПЛЫВАЮЩЕГО ОКНА
$('body').on('click', '.fancybox-close', function() {
$('#popup_box').html('');
});
//----------ПОКАЗ СЕМЬИ
$('body').on('click', '#show_full_data', function() {
$('#full_data_box').slideToggle();
$.ajax({
				type: "POST",
				url: '../cont/ajax_sponsor_family.php',
				success: function(result){			
				$('#full_data_box').html(result);				
}
 });
});
//----------ОТПРАВКА СООБЩЕНИЯ СПОНСОРУ
$('body').on('click', '#show_send_sponsor', function() {
$('#send_sponsor_box').slideToggle();
});
$('body').on('click', '.send_msg_button', function() {
var m_method=$('.send_sponsor_msg').attr("method");
var m_action=$('.send_sponsor_msg').attr("action");
var m_data=$('.send_sponsor_msg').serialize();
$.ajax({
type: m_method,
url: m_action,
data: m_data,
success: function(result){
alertify.error(result); 
$('.send_msg_button').hide();
}
});
});
$('body').on('click', '.send_msg_button2', function() {
var m_method=$('.send_sponsor_msg2').attr("method");
var m_action=$('.send_sponsor_msg2').attr("action");
var m_data=$('.send_sponsor_msg2').serialize();
$.ajax({
type: m_method,
url: m_action,
data: m_data,
success: function(result){
alertify.error(result); 
$('.send_msg_button2').hide();
}
});
});
//-----------МОИ ССЫЛКИ
$("#left_menu_7").on("click", function() {
//var className = $(this).attr('class');

if ($(this).attr('class').match('close_menu')) {
//alertify.error('Активируйте аккаунт в профиле');
} else {
openPopup('#my_url_window');
}


return false;
});

$(".activate_acc h4 span").on("click", function() {
        $.fancybox({
		type: 'inline',
		href: '#aktiv_help_text',
		loop: false,
	//	'width': 970,
	//	'height': 800,
		'arrows': false,
		 helpers: {
		//  overlay : {closeClick: false}
    },
		'hideOnOverlayClick': false,
		'closeClick'  : false,
	//	'autoSize' : false
		});
});


//----------КОПИРОВАНИЕ В БУЧЕР МОИХ ССЫЛОК
var client = new ZeroClipboard($(".copy_my_url"), {
  moviePath: "../js/ZeroClipboard.swf"
});
client.on("load", function(client) {  
  client.on("complete", function(client, args) {
	$(this).fadeOut().fadeIn();
    $(this).html('Скопировано');	
  });
});
//---------ДИАГРАММА
function isCanvasSupported() {
  var elem = document.createElement('canvas');
  return !!(elem.getContext && elem.getContext('2d'));
}
	if (isCanvasSupported()) {
		var partnersPieData = [
			{value: $("#partners-transit").data("value"), color: '#7471cf'},
			{value: $("#partners-all").data("value"), color: '#ff7f27'},
			{value: $("#partners-pay").data("value"), color: '#0aa4ee'}
		];
		var partnersPieOptions = {
			animation: false,
			segmentShowStroke: false
		};
		var partnersPie = new Chart($("#partners-pie").get(0).getContext("2d")).Pie(partnersPieData, partnersPieOptions);
	}
//---------КНОПКА РЕДАКТИРОВАНИЯ
$(".redactor-btn").on("click", function() {
$(".redactor").slideToggle("slow");
});

$(".redactor-btn2").on("click", function() {
$(".redactor2").slideToggle("slow");
});
//---------СОХРАНИТЬ СТРАНИЦУ
$("#save_page").on("click", function() {
$id_page = $(this).attr('data');
$text = CKEDITOR.instances["ckeditor"].getData();
$text = encodeURIComponent($text);
 $.ajax({
				type: "POST",
				url: "../cont/ajax_edit_pages.php",
				data: 'id='+$id_page+'&text='+$text,
				success: function(result){
				$(".page_text").html(CKEDITOR.instances["ckeditor"].getData());	
				alertify.error(result);
}
 });
});
//------------ ФОРМА СОХРАНЕНИЯ ВЕБИНАРОВ
$("#webinars_form").submit(function(e){
e.preventDefault();
var m_method=$(this).attr("method");
var m_action=$(this).attr("action");
var m_data=$(this).serialize();
$src_ava = $('#croppic_webinar > img').attr('src');
console.log($src_ava);
$arr = $src_ava.split('/');
$.ajax({
type: m_method,
url: m_action,
data: m_data+'&ava='+$arr[$arr.length-1],
success: function(result){
alertify.error('Вебинар добавлен');
$('#webinars_form')[0].reset();
$('#croppic_webinar > .croppedImg').remove();
$('#cropContainerHeaderButton').show();
$('.cropControlRemoveCroppedImage').hide();
}
}); 
});
$('body').on('click', '.cropControlRemoveCroppedImage', function() {
$('#cropContainerHeaderButton').show();
});
//-------------------------------------------
//------------
$('body').on('click', '.task_video', function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'			: 640,
			'height'		: 385,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'iframe',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});

		return false;
	});
});
//-------------------------
//-------------------------
/*
$('body').on('click', '.save_sup_btn', function() {
$name = $('#sup_name').val();
$email = $('#sup_email').val();
$text = $('#sup_text').val();
var m_data=$('#sup_form').serialize();
if($name!='' && $email!='' && $text!='') {
$.ajax({
type: 'POST',
url: '../cont/support.php',
data: m_data,
success: function(result){
alertify.error(result); 
$('#sup_form')[0].reset();
}
});
} else {
alertify.error('Вы не заполнили необходимые поля');
}
});
*/
$('body').on('click', '.save_sup_btn', function() {
$text = $('#sup_text').val();
var m_data=$('#sup_form').serialize();
if($text!='') {
$.ajax({
type: 'POST',
url: '../cont/support.php',
data: m_data,
success: function(result){
$.fancybox.close();
alertify.error(result); 
$('#sup_form')[0].reset();

}
});
} else {
alertify.error('Вы не заполнили необходимые поля');
}
});

/*
$('body').on('click', '.help_clicks', function(e) {
$id = $(this).attr('data');
$helper = $(this).attr('data2');
if($helper=='0') {
e.preventDefault();
$go = document.location.href = '../profile'; }
if($helper=='5') { 
$('.help_6').hide();
$('.help_1').hide();
$('.help_7').show();
$('.my_profile_btn').attr('style', 'border: 3px solid #FD0000;');
$('.my_profile_btn').addClass('help_clicks');
$('.my_profile_btn').attr('data2', '6');
$go = '';
 }
 if($helper=='6') { 
e.preventDefault();
$go = document.location.href = '../profile';
 }
      $.ajax({
				type: "POST",
				url: '../cont/helpers.php',
				data: 'id='+$id+'&helper='+$helper,
				success: function(result){			
		$go;
}
 });
// return false;
});
*/

jQuery(document).ready(function ($)  {
$('a[rel="fancybox"]').fancybox({
fitToView: false, // add this
	scrolling: 'yes',
		"imageScale"             : false,
            "zoomOpacity"			: true,
            "overlayShow"			: false,
            "zoomSpeedIn"			: 500,
            "zoomSpeedOut"			: 500
}); 
});
$('body').on('click', '.close_help', function(e) { 
$(this).parent('.help_box').hide();
});
$('body').on('click', '.help_box > button', function(e) { 
$step = $(this).attr('data');
$id = $(this).attr('data2');
console.log($step);
      $.ajax({
				type: "POST",
				url: '../cont/helpers.php',
				data: 'id='+$id+'&helper='+$step,
				success: function(result){			
		//$('.help_box').hide();
		location.reload();
}
});
});

$('body').on('click', '.reg_form_first_step, .tiade_button', function(e) { 
$step = $(this).attr('data');
$id = $(this).attr('data2');
      $.ajax({
				type: "POST",
				url: '../cont/helpers.php',
				data: 'id='+$id+'&helper='+$step,
				success: function(result){		
location.reload();				
}
});
});

$('body').on('click', '.my_profile_btn', function(e) { 
$step = $(this).attr('data');
$id = $(this).attr('data2');
      $.ajax({
				type: "POST",
				url: '../cont/helpers.php',
				data: 'id='+$id+'&helper='+$step,
				success: function(result){		
			
}
});
});
//-------------------------------------------



$('body').on('click', '.bay_mag', function(e) { 
$id = $(this).attr('data');
$bulls = $(this).attr('data2');
alertify.set({ buttonFocus: "cancel", labels: {ok: "Да", cancel: "Нет"} });
$text = 'Вы действительно желаете активировать данный товар?<br>';
$text = $text+'С вашего счета будет снято '+$bulls+'  бонусов<br><br>';
		alertify.confirm($text, function(e) {
if (e) {
console.log($id);
$tek = $('.bulls_icon').text();
$ostatok = parseFloat($tek)-parseFloat($bulls);
if($ostatok>=0) {
$('.bulls_icon').text($ostatok);	
}

$.ajax({
type: 'POST',
url: '../cont/bay_mag.php',
data: 'id='+$id,
success: function(result){
alertify.error(result); 

}
});
}
});
});
$(document).on("click", ".downloads_xls", function(e) {
$.ajax({
type: 'POST',
url: '../cont/crm/download-xls.php',
success: function(result){
alertify.error(result);
}
});
});
