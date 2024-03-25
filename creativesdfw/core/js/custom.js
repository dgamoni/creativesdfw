jQuery(document).ready(function($) {
	  
	  $('.bxslider').bxSlider({
	    slideWidth: 400,
	    minSlides: 2,
	    maxSlides: 3,
	    slideMargin: 10,
	     pager: false
	  });

	  // $('.image-link').magnificPopup({
	  // 	  type:'image',
  	// 	  gallery:{enabled:true},
	  // });


    $(document).on('change', '#sort_profile,#search_profile', function(e) {

    	//console.log('change');
        e.preventDefault();

        // Data for AJAX
        var sort = jQuery('#sort_profile').val();
        var tax = jQuery('#sort_profile').attr('data-tax');
        var term = jQuery('#sort_profile').attr('data-term');
        var search_profile = jQuery('#search_profile').val();
        var search_query = '';
        if( search_profile.length > 2 ) {
        	search_query = "&search_query="+search_profile;
        } else {
        	search_query = "&search_query=";
        }

		$('#profile-loop-wrap').css({
			'opacity': 0.3
		});

        $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=sort_profile&sort=" + sort+"&tax="+tax+"&term="+term + search_query,
                success : function (a) {
                    console.log(a);
                    console.log(a.out);
                    jQuery('#profile-loop-wrap').html(a.out).css({
						'opacity': ''
					});
                    var destination = $('#profile-loop-wrap').offset().top - 50;
					$('body,html').animate({scrollTop: destination}, 400);
					$('.countvalue').text(a.countvalue);

                }
            }); //end ajax  

    });



});