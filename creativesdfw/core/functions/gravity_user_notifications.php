<?php 

//add_filter( 'gform_pre_send_email', 'before_email_user_notifications', 10, 4 );
function before_email_user_notifications( $email, $message_format, $notification, $entry ) {

    $email['subject'] = 'Subscription expired';
    return $email;
}
