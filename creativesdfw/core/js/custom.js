jQuery(document).ready(function($) {


		// aCf Validate fields
		// $(document).on('acf/validate_field', function(e, field){

		// 	// vars
		// 	$field = $(field);
		// 	$business_name = $('#acf-field_5c656a72dcf26').val();
			
		// 	// set validation to false on this field
		// 	if(!$business_name) {
		// 		$field.data('validation', true);
		// 	}
				
		// });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var hash = $(e.target).attr('href');
        if (history.pushState) {
          history.pushState(null, null, hash);
        } else {
          location.hash = hash;
        }
      });

      var hash = window.location.hash;
      if (hash) {
        $('.nav-link[href="' + hash + '"]').tab('show');
      }
	  
     $('.header_search_link').click(function(e) {

         e.preventDefault();

         console.log( $(window).width() );
         var  ww = $(window).width();
         var ww_margin = '-180px';
         if(ww <= 768 && ww > 536) {
           ww_margin = '24px';
         } else if ( ww <= 536 ) {
           ww_margin = '0px';
         }

         $('.header_search .search-form').animate({
              // right: '-18px',
              left: ww_margin,
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
	    pager: false,
      infiniteLoop: false,
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

    // set default title
    $('#acf-_post_title').val('no-title');

    //free
    $('#acf-field_5c653bd362c8a').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
      if($(this).val() == '') {
         $('#acf-_post_title').val('no-title');
      }
    });

    //silver
    $('#acf-field_5c654f08ba383').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
      if($(this).val() == '') {
         $('#acf-_post_title').val('no-title');
      }      
    });

    //gold
    $('#acf-field_5c65595a0262a').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
      if($(this).val() == '') {
         $('#acf-_post_title').val('no-title');
      }      
    });

    //gold 2
    $('#acf-field_5c656a72dcf26').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
      if($(this).val() == '') {
         $('#acf-_post_title').val('no-title');
      }      
    });

    //premium
    $('#acf-field_5c657779b5f07').keyup(function() {
      //console.log($(this).val());
      $('#acf-_post_title').val( $(this).val() );
      if($(this).val() == '') {
         $('#acf-_post_title').val('no-title');
      }      
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



   $(document).on('click', '.set_primary', function(e) {
        e.preventDefault();
        var userid = jQuery(this).attr('data-userid');
        var level = jQuery(this).attr('data-level');
        var plan = jQuery(this).attr('data-plan');
        var gf_entries = jQuery(this).attr('data-gf_entries');
        // console.log(userid);
        // console.log(level);
        // console.log(plan);
        // console.log(gf_entries);


        $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=set_primary&userid=" + userid+"&level="+level+"&plan="+plan + "&gf_entries="+gf_entries,
                success : function (a) {
                    console.log(a);
                    console.log(a.data);
                    
                    if(a.success){
                      $('.primary_col .make_primary .active_primary').hide();
                      $('.primary_col .make_primary .set_primary').show();
                      $('#subscriptions #items tr').removeClass('primary_col');
                      $('.'+a.data.userid+'-'+a.data.level+'-'+a.data.plan+'-'+a.data.gf_entries+'').addClass('primary_col');
                      $('.'+a.data.userid+'-'+a.data.level+'-'+a.data.plan+'-'+a.data.gf_entries+' .make_primary .set_primary').hide();
                      $('.'+a.data.userid+'-'+a.data.level+'-'+a.data.plan+'-'+a.data.gf_entries+' .make_primary .active_primary').show();
                      $('.user_info_left .current_type').text(a.data.level);
                      $('.user_info_left .current_plan').text(a.data.plan);
                    }

                    //jQuery('#profile-loop-wrap').html(a.out).css({'opacity': ''});
                }
        }); //end ajax            

   });// end set_primary






}); //end ready