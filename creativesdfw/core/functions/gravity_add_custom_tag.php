<?php 


// add_filter( 'gform_replace_merge_tags', function ( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {
//     $merge_tag = '{entry_time}';
 
//     if ( strpos( $text, $merge_tag ) === false || empty( $entry ) || empty( $form ) ) {
//         return $text;
//     }
 
//     return str_replace( $merge_tag, GFCommon::format_date( rgar( $entry, 'date_created' ), false, 'Y/m/d' ), $text );
// }, 10, 7 );

add_filter('gform_custom_merge_tags', 'wpse_121476_custom_merge_tags', 10, 4);
add_filter('gform_replace_merge_tags', 'wpse_121476_replace_merge_tags', 10, 7);
add_filter('gform_field_content', 'wpse_121476_field_content', 10, 5);

/**
* add custom merge tags
* @param array $merge_tags
* @param int $form_id
* @param array $fields
* @param int $element_id
* @return array
*/
function wpse_121476_custom_merge_tags($merge_tags, $form_id, $fields, $element_id) {
    $merge_tags[] = array('label' => 'Expired date', 'tag' => '{expired_date}');

    return $merge_tags;
}

/**
* replace custom merge tags in notifications
* @param string $text
* @param array $form
* @param array $lead
* @param bool $url_encode
* @param bool $esc_html
* @param bool $nl2br
* @param string $format
* @return string
*/
function wpse_121476_replace_merge_tags($text, $form, $lead, $url_encode, $esc_html, $nl2br, $format) {

    $expiryDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($lead['date_created'])) . " + 1 year"));
    $text = str_replace('{expired_date}', $expiryDate, $text);

    return $text;
}

/**
* replace custom merge tags in field content
* @param string $field_content
* @param array $field
* @param string $value
* @param int $lead_id
* @param int $form_id
* @return string
*/
function wpse_121476_field_content($field_content, $field, $value, $lead_id, $form_id) {
    if (strpos($field_content, '{expired_date}') !== false) {
		$expiryDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($lead['date_created'])) . " + 1 year"));
        $field_content = str_replace('{expired_date}', $expiryDate, $field_content);
    }

    return $field_content;
}