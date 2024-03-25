jQuery(document).ready(function($) {
	  
     $('.header_search_link').click(function(e) {
         e.preventDefault();
         $('.header_search .search-form').animate({
              // right: '-18px',
              left: '-180px',
              opacity: '1'
          });
         // $('.header_search .search-submit').animate({
         //    opacity: '1'
         // });
     });

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


  $("#search_testimonials").on("input.highlight", function() {
    // Determine specified search term
    var searchTerm = $(this).val();
    console.log();
    // Highlight search term inside a specific context
    $(".profile_testimonials_post_wrap").unmark().mark(searchTerm);
  }).trigger("input.highlight").focus();

    $('.project-reviews').each(function(index, el) {
        var budget = $(el).find('.project_budget').attr('data-val');
        var present = $(el).find('.project_present').attr('data-val');
        //console.log(budget);
        $(el).attr('data-budget', budget);
        $(el).attr('data-present', present);
        $(el).attr('data-relevance', index);
    });

    

    //free
    $('#acf-field_5c653bd362c8a').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
    });

    //silver
    $('#acf-field_5c654f08ba383').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
    });

    //gold
    $('#acf-field_5c65595a0262a').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
    });

    //gold 2
    $('#acf-field_5c656a72dcf26').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
    });

    //premium
    $('#acf-field_5c657779b5f07').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
    });


    $(document).on('change', '#sort_testimonials', function(e) {
            e.preventDefault();
            var sort = jQuery('#sort_testimonials').val();
            console.log(sort);
            if(sort == 'budget'){

                var sortedDivs = jQuery(".profile_testimonials_post_wrap").find(".project-reviews").toArray().sort(function(a, b){return parseInt(b.getAttribute('data-budget')) - parseInt(a.getAttribute('data-budget'))});
                //console.log(sortedDivs);

                jQuery.each(sortedDivs, function(index, value) {
                  jQuery(".profile_testimonials_post_wrap").append(value);
                });

            } else if(sort == 'present'){

                var sortedDivs = jQuery(".profile_testimonials_post_wrap").find(".project-reviews").toArray().sort(function(a, b){return parseInt(b.getAttribute('data-present')) - parseInt(a.getAttribute('data-present'))});
                //console.log(sortedDivs);

                jQuery.each(sortedDivs, function(index, value) {
                  jQuery(".profile_testimonials_post_wrap").append(value);
                });

            } else if(sort == 'relevance'){

                var sortedDivs = jQuery(".profile_testimonials_post_wrap").find(".project-reviews").toArray().sort(function(a, b){return parseInt(b.getAttribute('data-relevance')) - parseInt(a.getAttribute('data-relevance'))});
                //console.log(sortedDivs);

                jQuery.each(sortedDivs.reverse(), function(index, value) {
                  jQuery(".profile_testimonials_post_wrap").append(value);
                });

            }

    });

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