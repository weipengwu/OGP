//init

$(document).ready(function(){
	
	$('body').on('click', '.post_like', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var that = $(this);
		var pid = $(this).data('post-id');
		var uid = $(this).data('author-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/post/like",
			data: "post-id="+pid+'&author-id='+uid
		}).done(function(response){
			that.removeClass('post_like');
			that.addClass('post_unlike');
			that.html('<img src="../img/already_likes_icon.png" width="16">');
			that.parent().next().html(response);
		})
	})
	$('body').on('click', '.post_unlike', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var that = $(this);
		var pid = $(this).data('post-id');
		var uid = $(this).data('author-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/post/unlike",
			data: "post-id="+pid+'&author-id='+uid
		}).done(function(response){
			that.removeClass('post_unlike');
			that.addClass('post_like');
			that.html('<img src="../img/likes_icon.png" width="16">');
			that.parent().next().html(response);
		})
	})
	// $('body').on('click', '.follow_user', function(e){
	// 	e.preventDefault();
	// 	$.ajaxSetup({
	// 	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	// 	});
	// 	var myid = $(this).data('my-id');
	// 	var toid = $(this).data('to-id');
	// 	$.ajax({
	// 		type: "POST",
	// 		url: window.location.origin+"/profiles/follow",
	// 		data: "my-id="+myid+'&to-id='+toid
	// 	}).done(function(response){
	// 		if(response == 'success'){
	// 			$('.follow_btn').removeClass('follow_user');
	// 			$('.follow_btn').addClass('unfollow_user');
	// 			$('.follow_btn').html('Following');
	// 		}
	// 	})
	// })
	// $('body').on('click', '.unfollow_user', function(e){
	// 	e.preventDefault();
	// 	$.ajaxSetup({
	// 	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	// 	});
	// 	var myid = $(this).data('my-id');
	// 	var toid = $(this).data('to-id');
	// 	$.ajax({
	// 		type: "POST",
	// 		url: window.location.origin+"/profiles/unfollow",
	// 		data: "my-id="+myid+'&to-id='+toid
	// 	}).done(function(response){
	// 		if(response == 'success'){
	// 			$('.follow_btn').removeClass('unfollow_user');
	// 			$('.follow_btn').addClass('follow_user');
	// 			$('.follow_btn').html('Follow');
	// 		}
	// 	})
	// })
	
	$('.groupfollow span a').tooltip({
		placement: 'left'
	});
	$('.share_btn').tooltip({
		placement: 'left'
	});
	$('.like_btn').tooltip({
		placement: 'left'
	});
	$('.create_btn').tooltip({
		placement: 'left'
	});
	$('.shareto a').tooltip({
		placement: 'left'
	})
	$('.postcomments a').tooltip({
		placement: 'left'
	})
	$('.postlikes a').tooltip({
		placement: 'left'
	})

	$('#postimage1').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img1",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i> ",
	})
	$('#postimage1').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img1').hide();
	 	$('.form-img2').show();
	});
	$('#postimage1').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img1').show();
	});

	$('#postimage2').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img2",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	})
	$('#postimage2').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img2').hide();
	 	$('.form-img3').show();
	});
	$('#postimage2').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img2').show();
	});
	$('#postimage3').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img3",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	});
	$('#postimage3').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img3').hide();
	 	$('.form-img4').show();
	});
	$('#postimage3').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img3').show();
	});
	$('#postimage4').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img4",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	});
	$('#postimage4').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img4').hide();
	    $('.form-img5').show();
	});
	$('#postimage4').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img4').show();
	});
	$('#postimage5').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img5",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	});
	$('#postimage5').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img5').hide();
	    $('.form-img6').show();
	});
	$('#postimage5').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img5').show();
	});
	$('#postimage6').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-primary btn-block btn-img6",
        showCaption: false,
        showRemove: false,
        showUpload: false,
		browseLabel: "",
		browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	});
	$('#postimage6').on('fileloaded', function(event, file, previewId, index, reader) {
	    $('.btn-img6').hide();
	    // $('.form-img7').show();
	});
	$('#postimage6').on('filecleared', function(event, file, previewId, index, reader) {
	    $('.btn-img6').show();
	});
	// $('#postimage7').fileinput({
	// 	previewFileType: "image",
	// 	browseClass: "btn btn-primary btn-block btn-img7",
 //        showCaption: false,
 //        showRemove: false,
 //        showUpload: false,
	// 	browseLabel: "",
	// 	browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	// });
	// $('#postimage7').on('fileloaded', function(event, file, previewId, index, reader) {
	//     $('.btn-img7').hide();
	//     $('.form-img8').show();
	// });
	// $('#postimage7').on('filecleared', function(event, file, previewId, index, reader) {
	//     $('.btn-img7').show();
	// });
	// $('#postimage8').fileinput({
	// 	previewFileType: "image",
	// 	browseClass: "btn btn-primary btn-block btn-img8",
 //        showCaption: false,
 //        showRemove: false,
 //        showUpload: false,
	// 	browseLabel: "",
	// 	browseIcon: "<i class=\"glyphicon glyphicon-plus\"></i>",
	// });
	// $('#postimage8').on('fileloaded', function(event, file, previewId, index, reader) {
	//     $('.btn-img8').hide();
	// });
	// $('#postimage8').on('filecleared', function(event, file, previewId, index, reader) {
	//     $('.btn-img8').show();
	// });
	$('.form_datetime').datetimepicker({
        	weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	        showMeridian: 1,
	        pickerPosition: 'bottom-left'
    	});
    // $('input[name="applytojoin"]').bootstrapSwitch('state', false, true);
    // $('input[name="applyswitch"]').bootstrapSwitch('state', false, true);

	$('.dash-btn').on('click', function(e){
		e.preventDefault();
		$('.dash-main').hide();
		var panel = $(this).data('id');
		$('#'+panel).fadeIn();
	})

	$('.profile .tab_btn').on('click', function(e){
		e.preventDefault();
		var id = $(this).data('index');
		$('.tab_btn').removeClass('active');
		$(this).addClass('active');
		$('.tab-content').removeClass('active');
		$('#'+id).addClass('active');
	})

	// $('.bootstrap-switch').on('click', function(){
	// 	if($(this).hasClass('bootstrap-switch-off')){
	// 		$('input[name="resume"]').val('off');
	// 		$('#linkresume').hide();
	// 		$('#noresume').show();
	// 	}else{
	// 		$('input[name="resume"]').val('on');
	// 		$('#linkresume').show();
	// 		$('#noresume').hide();
	// 	}
	// })
	$('#category').on('change', function(){
		var cat = $('#category').val();	
		if( cat == ""){
			window.location.href =  window.location.origin+'/events';
		}else{
			window.location.href =  window.location.origin+'/events?category='+cat;
		}
	})
	$('#eventtime').on('change', function(){
		var eventtime = $('#eventtime').val();	
		if( eventtime == ""){
			window.location.href =  window.location.origin+'/events';
		}else{
			window.location.href =  window.location.origin+'/events?time='+eventtime;
		}
	})
	$('body').on('click', '.shareto a', function(e){
		e.preventDefault();
		if($(this).parent().prev().is(":visible")){
			$('.sharebox').hide();
			$(this).parent().prev().hide();
		}else{
			$('.sharebox').hide();
			$(this).parent().prev().show();
		}
	})
	

	$(".various").fancybox({
		fitToView	: false,
		width		: 400,
		height		: 200,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		closeBtn    : false
	});
	$(".confirmdelete .close_btn").on('click', function(e){
		e.preventDefault();
		$.fancybox.close();
	})
	$('.bxslider').bxSlider({
	  adaptiveHeight: true,
	  mode: 'fade',
	  auto: false,
	  pager: false,
	  nextText: '<i class="fa fa-angle-right"></i>',
	  prevText: '<i class="fa fa-angle-left"></i>'
	});

	$('#selectprice').on('change', function(){
		if($(this).val() == 'Paid'){
			$('#fee').show();
		}else{
			$('#fee').hide();
		}
	})

	if($('#selectprice option:selected').val() == 'Paid'){
		$('#fee').show();
	}else{
		$('#fee').hide();
	}
	

	$('.translation .radio input').on('change', function(){
		if($('.translation input#yestranslate').is(':checked')){
			$('.trlanguages').show();
		}else{
			$('.trlanguages').hide();
		}
	})
	$('#createBrand #brandname').on('blur', function(){
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var bname = $(this).val();
		if(bname !== ''){
			$.ajax({
				type: "POST",
				url: window.location.origin+"/brands/checkBrandname",
				data: "checkbrandname="+bname
			}).done(function(response){
				if (response == 'duplicated') {
					$('.checknamefail').show();
					$('.checknamepass').hide();
				}
				else if(response == 'pass'){
					$('.checknamefail').hide();
					$('.checknamepass').show();
					$('.checknameerror').hide();
				}
			})
		}
	})

	$('#createBrand').validate({
		submitHandler: function(form) {
			if($('.checknamepass').is(':visible')){
				form.submit();
			}else{
				$('#createBrand #brandname').focus();
				$('.checknameerror').show();
			}
		}
	});
	$('#leavecomments form').validate();
	$('#createPost').validate();
	$('#newevent').validate();

	$('a.showSelect').on('click', function(e){
		e.preventDefault();
		$('.selectorigin').show();
	})

	function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0; i<ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1);
	        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	    }
	    return "";
	}
	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+d.toUTCString();
	    document.cookie = cname + "=" + cvalue + "; " + expires;
	}
	if(!getCookie('ogphint')){
		$('.hint').fadeIn();
		$('.hint a').on('click', function(e){
			e.preventDefault();
			$('.hint').fadeOut();
			$('.hint2').fadeIn();
		})
		$('.hint2 a').on('click', function(){
			$('.hint2').fadeOut();
		})
		setCookie('ogphint', '1', 60);
	}
	// Dropzone.options.createpost = { // The camelized version of the ID of the form element

	//   // The configuration we've talked about above
	//   autoProcessQueue: false,
	//   uploadMultiple: true,
	//   parallelUploads: 100,
	//   maxFiles: 8,
	//   clickable:'#dropzonePreview',

	//   // The setting up of the dropzone
	//   init: function() {
	//     var myDropzone = this;

	//     // First change the button to actually tell Dropzone to process the queue.
	//     this.element.querySelector("input[type=submit]").addEventListener("click", function(e) {
	//       // Make sure that the form isn't actually being sent.
	//       e.preventDefault();
	//       e.stopPropagation();
	//       myDropzone.processQueue();
	//     });

	//     // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
	//     // of the sending event because uploadMultiple is set to true.
	//     this.on("sendingmultiple", function() {
	//       // Gets triggered when the form is actually being sent.
	//       // Hide the success button or the complete form.
	//     });
	//     this.on("successmultiple", function(files, response) {
	//       // Gets triggered when the files have successfully been sent.
	//       // Redirect user or notify of success.
	//     });
	//     this.on("errormultiple", function(files, response) {
	//       // Gets triggered when there was an error sending the files.
	//       // Maybe show form again, and notify user of error
	//     });
	//   }

	// }
})