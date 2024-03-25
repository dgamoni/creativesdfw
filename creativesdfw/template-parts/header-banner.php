        


<div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
    <div class="container">
        <h1>
            <?php
            if(get_theme_mod( 'header_banner_title_setting' )){
                echo get_theme_mod( 'header_banner_title_setting' );
            }else{
                //echo 'Wordpress + Bootstrap';
            }
            ?>
        </h1>
        <p class="header_banner_tagline">
            <?php
            if(get_theme_mod( 'header_banner_tagline_setting' )){
                echo get_theme_mod( 'header_banner_tagline_setting' );
        }else{
                echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','wp-bootstrap-starter');
            }
            ?>
        </p>
        <div class="btn-home-wrap">
	        <a href="/find-agencies/" class="btn btn-success btn-home fonticon walking"><span>Find an Agency</span></a>
	        <a href="/find-creatives/" class="btn btn-success btn-home fonticon walking"><span>Find other Creatives</span></a>
	    </div>

        <!-- <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a> -->
    </div>
</div>

