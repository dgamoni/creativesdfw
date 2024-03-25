<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<div class="row customlog_wrap">

    	<div class="lwa lwa-default col-md-6"><?php //class must be here, and if this is a template, class name should be that of template directory ?>
            <h4><?php esc_html_e('Log in','login-with-ajax') ?></h4>
            <form class="lwa-form decomments-enter-row" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
            	<div>
            	<span class="lwa-status"></span>
                <!-- <table> -->
                    <div class="">
                        <p class="lwa-username cutom_input">
                            <label><?php esc_html_e( 'Username','login-with-ajax' ) ?></label>
                            <input type="text" name="log" />
                        </p>
                    </div>
                    <div class="">
                        <p class="lwa-username cutom_input">
                            <label><?php esc_html_e( 'Password','login-with-ajax' ) ?></label>
                            <input type="password" name="pwd" />
                        </p>
                    </div>
                    <span><span><?php do_action('login_form'); ?></span></span>

                    <span class="lwa-submit-links">
                        <span><input name="rememberme" type="checkbox" class="lwa-rememberme" value="forever" /> <?php esc_html_e( 'Remember Me','login-with-ajax' ) ?></span>
                        <!-- <br /> -->
                        <?php if( !empty($lwa_data['remember']) ): ?>
                        <a class="lwa-links-remember" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="<?php esc_attr_e('Password Lost and Found','login-with-ajax') ?>"><?php esc_attr_e('Lost your password?','login-with-ajax') ?></a>
                        <?php endif; ?>
                        <?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) ) : ?>
                        <!-- <br /> -->
                        <!-- <a href="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" class="lwa-links-register lwa-links-modal"><?php esc_html_e('Register','login-with-ajax') ?></a> -->
                        <?php endif; ?>
                    </span>

                    <span class="lwa-submit">



                        <span class="lwa-submit-button">
                            <input class="btn btn-outline-success btn-acf " type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php esc_attr_e('Log In', 'login-with-ajax'); ?>" tabindex="100" />
                            <input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>" />
                            <input type="hidden" name="login-with-ajax" value="login" />
                            <?php if( !empty($lwa_data['redirect']) ): ?>
                            <input type="hidden" name="redirect_to" value="<?php echo esc_url($lwa_data['redirect']); ?>" />
                            <?php endif; ?>
                        </span>

                    </span>
                <!-- </table> -->
                </div>
            </form>
            <?php if( !empty($lwa_data['remember']) && $lwa_data['remember'] == 1 ): ?>
            <form class="lwa-remember decomments-enter-row" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post" style="display:none;">
            	<div>
            	<span class="lwa-status"></span>

                    <strong><?php esc_html_e("Forgotten Password", 'login-with-ajax'); ?></strong>         

                    <div>
                        <p class="lwa-remember-email">  
                            <?php $msg = __("Enter username or email", 'login-with-ajax'); ?>
                            <input type="text" name="user_login" class="lwa-user-remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
                            <?php do_action('lostpassword_form'); ?>
                        </p>
                    </div>
                    <div>
                        <p class="lwa-remember-buttons">
                            <input class="btn btn-outline-success btn-acf" type="submit" value="<?php esc_attr_e("Get New Password", 'login-with-ajax'); ?>" class="lwa-button-remember" />
                            <!-- <a href="#" class="lwa-links-remember-cancel"><?php esc_html_e("Cancel", 'login-with-ajax'); ?></a> -->
                            <input type="hidden" name="login-with-ajax" value="remember" />
                        </p>
                    </div>

                </div>
            </form>
            <?php endif; ?>
        </div>

        <div class="lwa lwa-default col-md-6">    
    		<?php if( get_option('users_can_register') && !empty($lwa_data['registration']) && $lwa_data['registration'] == 1 ): ?>
            <?php //if  ( !is_user_logged_in() ) : ?>
        		<div class="lwa-register lwa-register-default _lwa-modal">
        			
                    <h4><?php esc_html_e('Register','login-with-ajax') ?></h4>
        			
        			<form class="lwa-register-form decomments-enter-row" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
        				<div>
        				<span class="lwa-status"></span>
        				<p class="lwa-username cutom_input">
        					<label><?php esc_html_e('Username','login-with-ajax') ?></label>
        					<input type="text" name="user_login" id="user_login" class="input" size="20" tabindex="10" />
        				</p>
        				<p class="lwa-email cutom_input">
        					<label><?php esc_html_e('E-mail','login-with-ajax') ?></label>
        					<input type="text" name="user_email" id="user_email" class="input" size="25" tabindex="20" />
        				</p>
        				<?php do_action('register_form'); ?>
        				<?php do_action('lwa_register_form'); ?>
                        <p><em class="lwa-register-tip"><?php esc_html_e('A password will be e-mailed to you.','login-with-ajax') ?></em></p>

        					<input class="btn btn-outline-success btn-acf" type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register', 'login-with-ajax'); ?>" tabindex="100" />

        		        <input type="hidden" name="login-with-ajax" value="register" />
        		        </div>
        			</form>
        		</div>
    		<?php endif; ?>
    	</div>

</div>