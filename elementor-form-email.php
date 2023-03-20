<?php

/*
Plugin Name: Elementor Form Email
Plugin URI: https://github.com/rahneverd/elementor-form-email
Description: A plugin that adds a form to Elementor pages and sends an email to the admin email.
Version: 1.0.0
Author: Muhammad Owais
Author URI: https://github.com/rahneverd//
*/

  $output = '<form class="contactus_form">
  <div class="row">
     <div class="col-md-6">
        <div class="form-group">
           <label>Full Name</label>
           <input type="text" class="form-control">
        </div>
     </div>
     <div class="col-md-6">
        <div class="form-group">
           <label>Email address</label>
           <input type="email" class="form-control">
        </div>
     </div>
      <div class="col-md-12">
        <div class="form-group">
           <label>Contact number</label>
           <input type="text" class="form-control">
        </div>
     </div>
  </div>
  <div class="form-group">
     <label for="exampleFormControlTextarea1">Type your message</label>
     <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
    <button type="submit" class="btn btn-primary formsubmit_btn">Submit</button>
</form>';
  return $output;
}
add_shortcode( 'elementor_form_email', 'elementor_form_email_shortcode' );

function elementor_form_email_send() {
  if( isset( $_POST['submit'] ) ) {
    $to = get_option( 'admin_email' );
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = 'New form submission from ' . $name;
    $headers = array('Content-Type: text/html; charset=UTF-8');

    $body = '<p>Name: ' . $name . '</p>';
    $body .= '<p>Email: ' . $email . '</p>';
    $body .= '<p>Message: ' . $message . '</p>';

    wp_mail( $to, $subject, $body, $headers );
  }
}
add_action( 'init', 'elementor_form_email_send' );

function elementor_form_email_styles() {
    wp_enqueue_style( 'elementor-form-email', plugins_url( '/elementor-form-email.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'elementor_form_email_styles' );


?>