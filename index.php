<?php
 
/*

 Plugin Name: VW Ecommerce Store Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Ecommerce Store Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/

*/

define( 'VW_ECOMMERCE_STORE_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'vw_ecommerce_store_pro_posttype_create_post_type' );

function vw_ecommerce_store_pro_posttype_create_post_type() {

  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonial','vw-ecommerce-store-pro-posttype' ),
        'singular_name' => __( 'Testimonial','vw-ecommerce-store-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-businessman',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
}

/*---------------------------------- Testimonial section -------------------------------------*/

/* Adds a meta box to the Testimonial editing screen */
function vw_ecommerce_store_pro_posttype_bn_testimonial_meta_box() {
  add_meta_box( 'vw-ecommerce-store-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-ecommerce-store-pro-posttype' ), 'vw_ecommerce_store_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_ecommerce_store_pro_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function vw_ecommerce_store_pro_posttype_bn_testimonial_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'vw_ecommerce_store_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory = get_post_meta( $post->ID, 'vw_ecommerce_store_pro_posttype_testimonial_desigstory', true );
  $test_facebook = get_post_meta( $post->ID, 'meta-tes-facebookurl', true );
  $test_linkedin = get_post_meta( $post->ID, 'meta-tes-linkdenurl', true );
  $test_twitter = get_post_meta( $post->ID, 'meta-tes-twitterurl', true );
  $test_gplus = get_post_meta( $post->ID, 'meta-tes-googleplusurl', true );
  $test_instagram = get_post_meta( $post->ID, 'meta-tes-instagram', true );
  $test_pinterest = get_post_meta( $post->ID, 'meta-tes-pinterest', true );
  ?>
  <div id="testimonials_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Designation', 'vw-ecommerce-store-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw_ecommerce_store_pro_posttype_testimonial_desigstory" id="vw_ecommerce_store_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php _e( 'Facebook Url', 'vw-ecommerce-store-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-facebookurl" id="meta-tes-facebookurl" value="<?php echo esc_html($test_facebook); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php _e( 'Linkedin Url', 'vw-ecommerce-store-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-linkdenurl" id="meta-tes-linkdenurl" value="<?php echo esc_html($test_linkedin); ?>" />
          </td>
        </tr>
        <tr id="meta-4">
          <td class="left">
            <?php _e( 'Twitter Url', 'vw-ecommerce-store-pro-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-twitterurl" id="meta-tes-twitterurl" value="<?php echo esc_html($test_twitter); ?>" />
          </td>
        </tr>
        <tr id="meta-5">
          <td class="left">
            <?php _e( 'GooglePlus Url', 'vw-ecommerce-store-pro-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-googleplusurl" id="meta-tes-googleplusurl" value="<?php echo esc_html($test_gplus); ?>" />
          </td>
        </tr>
        <tr id="meta-6">
          <td class="left">
            <?php _e( 'Instagram Url', 'vw-ecommerce-store-pro-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-instagram" id="meta-tes-instagram" value="<?php echo esc_html($test_instagram); ?>" />
          </td>
        </tr>
        <tr id="meta-7">
          <td class="left">
            <?php _e( 'Pinterest Url', 'vw-ecommerce-store-pro-posttype' ); ?>
          </td>
          <td class="left" >
            <input type="url" name="meta-tes-pinterest" id="meta-tes-pinterest" value="<?php echo esc_html($test_pinterest); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function vw_ecommerce_store_pro_posttype_bn_metadesig_save( $post_id ) {
  if (!isset($_POST['vw_ecommerce_store_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_ecommerce_store_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'vw_ecommerce_store_pro_posttype_testimonial_desigstory' ] ) ) {
    update_post_meta( $post_id, 'vw_ecommerce_store_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_ecommerce_store_pro_posttype_testimonial_desigstory']) );
  }
  // Save facebookurl
  if( isset( $_POST[ 'meta-tes-facebookurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-facebookurl', esc_url($_POST[ 'meta-tes-facebookurl' ]) );
  }
  // Save linkdenurl
  if( isset( $_POST[ 'meta-tes-linkdenurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-linkdenurl', esc_url($_POST[ 'meta-tes-linkdenurl' ]) );
  }
  if( isset( $_POST[ 'meta-tes-twitterurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-twitterurl', esc_url($_POST[ 'meta-tes-twitterurl' ]) );
  }
  // Save googleplusurl
  if( isset( $_POST[ 'meta-tes-googleplusurl' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-googleplusurl', esc_url($_POST[ 'meta-tes-googleplusurl' ]) );
  }

  // Save Instagram
  if( isset( $_POST[ 'meta-tes-instagram' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-instagram', esc_url($_POST[ 'meta-tes-instagram' ]) );
  }
  // Save Pinterest
  if( isset( $_POST[ 'meta-tes-pinterest' ] ) ) {
      update_post_meta( $post_id, 'meta-tes-pinterest', esc_url($_POST[ 'meta-tes-pinterest' ]) );
  }

}

add_action( 'save_post', 'vw_ecommerce_store_pro_posttype_bn_metadesig_save' );

/*---------------------------------- testimonials shortcode --------------------------------------*/
function vw_ecommerce_store_pro_posttype_testimonial_func( $atts ) {
  $testimonial = '';
  $testimonial = '<div class="row all-testimonial">';
  $query = new WP_Query( array( 'post_type' => 'testimonials') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=testimonials');
  while ($new->have_posts()) : $new->the_post();

        $post_id = get_the_ID();
         $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
        if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
        $url = $thumb['0'];
        $custom_url ='';
        
        $excerpt = wp_trim_words(get_the_excerpt(),15);
        $tdegignation= get_post_meta($post_id,'vw_ecommerce_store_pro_posttype_testimonial_desigstory',true);
        if(get_post_meta($post_id,'meta-testimonial-url',true !='')){$custom_url =get_post_meta($post_id,'meta-testimonial-url',true); } else{ $custom_url = get_permalink(); }
        $testimonial .= '

            <div class="our_testimonial_outer col-lg-4 col-md-6 col-sm-6">
              <div class="testimonial_inner">
                <div class="row hover_border">
                  <div class="col-md-12">
                     <img class="classes-img" src="'.esc_url($thumb_url).'" alt="attorney-thumbnail" />
                    <h5><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h5>
                    <div class="tdesig">'.$tdegignation.'</div>
                    <div class="short_text">'.$excerpt.'</div>
                  </div>
                </div>
              </div>
            </div>';
    if($k%2 == 0){
      $testimonial.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $testimonial = '<h2 class="center">'.esc_html__('Post Not Found','vw_ecommerce_store_pro_posttype').'</h2>';
  endif;
  return $testimonial;
}

add_shortcode( 'vw-ecommerce-store-pro-testimonials', 'vw_ecommerce_store_pro_posttype_testimonial_func' );

