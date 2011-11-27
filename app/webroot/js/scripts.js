/*var MyManager = MyManager || {};
MyManager.remove = function(selector, transition){
	if(true === transition)
	{
		$(selector).fadeOut("slow", function(){
			$(this).remove();	
		})
	}else
	{
		$(selector).remove();	
	}	
}
MyManager.autohide = function(selector, elapsed){

	var elapsed = elapsed || 5000;
	setTimeout('MyManager.remove("' + selector + '", true)', elapsed);
}


//MyManager.validated = MyManager.validated || {};
//MyManager.validated.rules = {};

MyManager.validated = function(form, rules, callback){
	$(form).validate({
  		rules: rules,
  		submitHandler: function(form){
  			//console.log(form);
  			var form = $(form);

  			//console.log(form.find('div.error'));


  			var errors = form.find('.alert-message').size();
  			if(errors >= 1)
  			{
  				form.find('.alert-message').remove();
  			}
  			//console.log(errors);

  			$.ajax({
	  			type: form.attr('method'),
	  			dataType: "json",
	  			url: form.attr('action'),
	  			cache: false,
	  			data: form.serialize(),
	  			beforeSend: function(){
	  				//console.log("Sending form...");	
	  				$.mobile.showPageLoadingMsg();	
	  			},
	  			success: function(data){
	  				$.mobile.hidePageLoadingMsg();	

	  				//console.log(data);

	  				data.form = form;

	  				callback(data);
	  				//data = $.parseJSON(data);

	  			}
	  		})
  		}
  	})
}

$(document).ready(function(){
	$("#submit").bind('mouseover', function(){
		$("#submit").removeClass("howOff").addClass("howOn");
		$("#find").removeClass("howOn").addClass("howOff");
		$("#ping").removeClass("howOn").addClass("howOff");
		$("#code").show();
		$("#best").hide();
		$("#delivery").hide();
	});
	$("#find").bind('mouseover', function(){
		$("#submit").removeClass("howOn").addClass("howOff");
		$("#find").removeClass("howOff").addClass("howOn");
		$("#ping").removeClass("howOn").addClass("howOff");
		$("#code").hide();
		$("#best").show();
		$("#delivery").hide();
	});
	$("#ping").bind('mouseover', function(){
		$("#submit").removeClass("howOn").addClass("howOff");
		$("#find").removeClass("howOn").addClass("howOff");
		$("#ping").removeClass("howOff").addClass("howOn");
		$("#code").hide();
		$("#best").hide();
		$("#delivery").show();
	});

	MyManager.validated.rules = {
		"data[User][voice_types][]": {
			required: true,
			minlength: 1
		},
		confirm_password: {	
			equalTo: "#password"
		}
	}


	MyManager.validated('#form-user-signin', {confirm_password: {equalTo: "#password"}}, function(response){
		//console.log(response.form);
		if(false === response.status)
		{
			var html = '<div class="alert-message error">';
			html += '<p>';
			html += '<strong>' + response.data[0].message  + '</strong>  <small><a href="" class="ui-link">What\'s this?</a></small>';
			html += '</p>'
			html += '</div>'; 
			response.form.find("input:eq(" + response.data[0].field + ")").parent().append(html);
		}else{
			top.location.href = data.redirect;
		}
	})

	MyManager.validated('#form-user-signup', {"data[User][voice_types][]": {required: true, minlength: 1 }}, function(data){
		//console.log("Hola mundo dos...");

		if(false === data.response)
		{
			for (i in data.data)
			{
				console.log(i);
				var html = '<div class="alert-message error">';
				html += '<p>';
				html += '<strong>' + data.data[i]  + '</strong>  <small><a href="" class="ui-link">What\'s this?</a></small>';
				html += '</p>'
				html += '</div>'; 

				$('#' + i).parent().append(html);
			}  		
			
			$('html, body').animate({scrollTop: '0px'}, 800);			
		}else{
			top.location.href = data.redirect;
		}
	})

	MyManager.validated('#form-user-forgot', {}, function(data){
		
	})
  	
  	MyManager.validated('#form-user-reset_password', {}, function(data){
		
	})
})*/
 
$(document).ready(function() {
	$("#submitBtn").click(function(){
		var formData = $("#messageForm").serialize();
		$.ajax({
			type: "POST",
			url: "/messages/send",
			cache: false,
			data: formData,
			success: function(data, status){
				$.mobile.hidePageLoadingMsg();
				data = $.trim(data);
				console.log(data);
				console.log(status);				
			},
			error: function(data,status){
				$.mobile.hidePageLoadingMsg();
				console.log('error',data,status);
			},
			beforeSend: function(){
				$.mobile.showPageLoadingMsg();	
			}
		});
		return false;
	});
});

//jQuery Mobile Init
$(document).bind("mobileinit", function(){
	$.mobile.ajaxEnabled = false;
});