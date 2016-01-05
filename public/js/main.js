//init

$(document).ready(function(){
	$('body').on('click', '.event_like', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var that = $(this);
		var eid = $(this).data('event-id');
		var uid = $(this).data('author-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/event/like",
			data: "event-id="+eid+'&author-id='+uid
		}).done(function(response){
			that.removeClass('event_like');
			that.addClass('event_unlike');
			that.html('<img src="../img/already_likes_icon.png" width="16">');
			$('.leftlikenum').html(response+' Interested');
			$('.likenum').html(response);
		})
	})
	$('body').on('click', '.event_unlike', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var that = $(this);
		var eid = $(this).data('event-id');
		var uid = $(this).data('author-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/event/unlike",
			data: "event-id="+eid+'&author-id='+uid
		}).done(function(response){
			that.removeClass('event_unlike');
			that.addClass('event_like');
			that.html('<img src="../img/likes_icon.png" width="16">');
			$('.leftlikenum').html(response+' Interested');
			$('.likenum').html(response);
		})
	})
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
	$('body').on('click', '.follow_group', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var userid = $(this).data('user-id');
		var groupid = $(this).data('group-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/groups/follow",
			data: "uid="+userid+'&gid='+groupid
		}).done(function(response){
		
				$('.follow_btn').removeClass('follow_group');
				$('.follow_btn').addClass('unfollow_group');
				$('.follow_btn').html('Following');
				$('.groupfollow span a').removeClass('follow_group');
				$('.groupfollow span a').addClass('unfollow_group');
				$('.groupfollow span a').html('<img src="../img/unfollow_icon.png" width="20">');
				if(response > 1){
					$('.followerNumber').html(response+' Followers');
				}else{
					$('.followerNumber').html(response+' Follower');
				}
			
		})
	})
	$('body').on('click', '.unfollow_group', function(e){
		e.preventDefault();
		$.ajaxSetup({
		   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		var userid = $(this).data('user-id');
		var groupid = $(this).data('group-id');
		$.ajax({
			type: "POST",
			url: window.location.origin+"/groups/unfollow",
			data: "uid="+userid+'&gid='+groupid
		}).done(function(response){
			
				$('.follow_btn').removeClass('unfollow_group');
				$('.follow_btn').addClass('follow_group');
				$('.follow_btn').html('Follow');
				$('.groupfollow span a').removeClass('unfollow_group');
				$('.groupfollow span a').addClass('follow_group');
				$('.groupfollow span a').html('<img src="../img/follow_icon.png" width="20">');
				if(response > 1){
					$('.followerNumber').html(response+' Followers');
				}else{
					$('.followerNumber').html(response+' Follower');
				}
			
		})
	})
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

	$('#g-profile').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-success",
		browseLabel: "Pick Image",
		browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
		removeClass: "btn btn-danger",
		removeLabel: "Delete",
		removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false,
	});
	$('#u-profile').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-success",
		browseLabel: "Pick Image",
		browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
		removeClass: "btn btn-danger",
		removeLabel: "Delete",
		removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false,
	});
	$('#banner').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-success",
		browseLabel: "Pick Image",
		browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
		removeClass: "btn btn-danger",
		removeLabel: "Delete",
		removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false,
	});
	$('#g-banner').fileinput({
		previewFileType: "image",
		browseClass: "btn btn-success",
		browseLabel: "Pick Image",
		browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
		removeClass: "btn btn-danger",
		removeLabel: "Delete",
		removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false,
	});
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

	$('.bootstrap-switch').on('click', function(){
		if($(this).hasClass('bootstrap-switch-off')){
			$('input[name="resume"]').val('off');
			$('#linkresume').hide();
			$('#noresume').show();
		}else{
			$('input[name="resume"]').val('on');
			$('#linkresume').show();
			$('#noresume').hide();
		}
	})
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
	$('.shareto a').on('click', function(e){
		e.preventDefault();
		if($(this).parent().prev().is(":visible")){
			$(this).parent().prev().hide();
		}else{
			$(this).parent().prev().show();
		}
	})
	
	$(window).scroll(function(){
		if($(this).scrollTop() > 465){
			$('.navbar-defaul').addClass('whitebg');
			// $('.bannerwrapper').next().css('margin-top', '485px');
			$('.statusbar').addClass('locked');
		}else{
			$('.navbar-defaul').removeClass('whitebg');
			// $('.bannerwrapper').next().css('margin-top', '0');
			$('.statusbar').removeClass('locked');
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
	  pager: false
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
	
	$('.showall a').on('click', function(e){
		e.preventDefault();
		if($('.joinedgroups .groupsrow').hasClass('collapsed')){
			$('.joinedgroups .groupsrow').removeClass('collapsed');
			$('.joinedgroups .groupsrow').addClass('expanded');
			$(this).html('COLLAPSE ALL');
		}else{
			$('.joinedgroups .groupsrow').removeClass('expanded');
			$('.joinedgroups .groupsrow').addClass('collapsed');
			$(this).html('SHOW ALL');
		}
	})

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
				url: window.location.origin+"/groups/checkBrandname",
				data: "brandname="+bname
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
	$('#createPost').validate();

	$('a.showSelect').on('click', function(e){
		e.preventDefault();
		$('.selectorigin').show();
	})


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