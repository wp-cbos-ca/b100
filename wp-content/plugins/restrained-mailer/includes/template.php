<?php
 
defined( 'ABSPATH' ) || die();

function get_contact_form() {
    $items = get_contact_form_data();
    $meta = get_contact_form_data_meta();
    $response = process_contact_form();
    $str = '<div class="contact-form">' . PHP_EOL;
    $str .= sprintf( '<form action="" method="post">%s', PHP_EOL );
    $str .= wp_nonce_field( 'contact-form', 'contact-form', true, false ) . PHP_EOL;
    foreach ( $items as $item ) {
        if ( $item['display'] ) {
            $required = $item['required'] ? 'required' : '';
            $placeholder = ! empty( $item['placeholder'] ) ? 'placeholder="%s"' : '';
            switch( $item['type'] ) {
                case 'text' :
                $str .= sprintf('<p>%s<br /><input type="text" name="contact_%s" %s maxlength="%s" %s value="%s" /></p>%s', $item['label'], $item['name'], $required, $item['maxlength'], $placeholder, $response[$item['name']]['response'], PHP_EOL );    
                break;
                case 'textarea' : 
                $str .= sprintf('<p>%s<br /><textarea name="contact_%s" %s maxlength="%s" %s>%s</textarea></p>%s', $item['label'], $item['name'], $required, $items['maxlength'], $placeholder, $response[$item['name']]['response'], PHP_EOL );
                break;
                default:
            }            
        }
    }
    $str .= '<input type="hidden" name="contact_best_time" maxlength="40" placeholder="Best time to call..." value="" />' . PHP_EOL;
    $str .= $meta['submit']['display'] ? sprintf('<button id="contact-submit" type="submit" class="button button-primary" disabled="true">%s</button><br />%s', $meta['submit']['title'] ,PHP_EOL ) : '';
    $str .= sprintf('<div class="contact-response">%s</div><!-- .contact-response -->%s', $response['message'], PHP_EOL );
    $str .= '</form>' . PHP_EOL;
    $str .= '</div><!-- .contact-form -->' . PHP_EOL; 
    return $str;
}