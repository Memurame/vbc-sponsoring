	/*#############################################
	* Function
	#############################################*/
  function calc() {
    var data = $("#sponsorForm").serializeArray();
        data.push({name: "action", value: "sponsor_calcPrice"});
    $.ajax({
    	type: "POST",
    	data: data,
    	url: the_ajax_script.ajaxurl,
    	dataType: "json",
    	success: function(json){
    		$("#sponsor-sponsoringStufe").html(json["typ"]);	
    		$("#sponsor-sponsoringTotal").html(json["total"]);
    	}

    });		
  }



/*########################################################################
########################################################################*/


$(function(){
	/*#############################################
	* AGB
	#############################################*/
	$("#agb").click(function(){
		if($(this).is(":checked")){
			$("#sponsor-btn-senden").prop("disabled", false);
		} else {
			$("#sponsor-btn-senden").prop("disabled", true);
		}
	});





	/*#############################################
	* Berechnung des Preises
	#############################################*/

	var priceArray = new Array();
	$(".sponsor-row input:checkbox").click(function(){
		calc();
	});	

	$(".sponsor-price").change(function(){
		var input = $(this).val();
		var id = $(this).attr("post");
		priceArray.splice($.inArray(id, priceArray),1);
		if(input.length){
			$(".sponsor-row [value="+id+"]").prop("checked", true);
			calc();

			
		}
	});



	/*#############################################
	* Formular senden 
	#############################################*/
	var firma = $("#sponsor-input-firma");
	var adresse1 = $("#sponsor-input-adresse1");
	var telefon = $("#sponsor-input-telefon");
	var mail = $("#sponsor-input-mail");

	$("#sponsor-btn-senden").click(function(e){
		e.preventDefault();

		var data = $("#sponsorForm").serializeArray();
        data.push({name: "action", value: "sponsor_sendmail"});
    $.ajax({
    	type: "POST",
    	data: data,
    	//
    	url: the_ajax_script.ajaxurl,
    	dataType: "json",
    	success: function(json){
    		firma.removeClass("sponsor-haserror");
				adresse1.removeClass("sponsor-haserror");
				telefon.removeClass("sponsor-haserror");
				mail.removeClass("sponsor-haserror");

    		if(json['status']){
    			$("#sponsor-alert")
					.html(json['meldung'])
					.removeClass("alert-error")
					.addClass("alert-success")
					.slideDown("500");

    			$("#sponsorForm")[0].reset();
					$('body').animate({ scrollTop: ($("#sponsor-alert").offset().top)}, 'fast');
    		} else {
					$("#sponsor-alert")
						.html(json['meldung'])
						.removeClass("alert-success")
						.addClass("alert-error")
						.slideDown("500");

					if(!json['firma']){ firma.addClass("sponsor-haserror"); }
					if(!json['adresse1']){ adresse1.addClass("sponsor-haserror"); }
					if(!json['tel']){ telefon.addClass("sponsor-haserror"); }
					if(!json['mail']){ mail.addClass("sponsor-haserror"); }
					$('body').animate({ scrollTop: ($("#sponsor-alert").offset().top)}, 'fast');

    		}
    		
    	}

    });		
 		
	});

});