<?php
/**
 * Product-screenshot shortcode
 *
 * Necessary Shortcode of the plugin.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Prscrt_Shortcode{

   public function __construct() {
        add_shortcode( 'prscrt-screenshot', array( $this,'prscrt_shortcode' ) );
    }

    function prscrt_shortcode( $atts ) {
        $options = get_option( 'prscrt_option_fields', array() );
        $title_link_view = isset( $options['title_link_view'] ) ? sanitize_text_field( $options['title_link_view'] ) : false;
        $opt_column = ( !empty( $options['column'] ) ) ? absint( $options['column'] ) : 4;
        $opt_show_item = ( !empty( $options['show_item'] ) ) ? absint( $options['show_item'] ) : 8;
        $opt_load_item = !empty( $options['load_item'] ) ? absint( $options['load_item'] ) : 4;
        $opt_gutter = isset( $options['gutter'] ) ? absint( $options['gutter'] ) : 15;
        $opt_margin_bottom = isset( $options['margin_bottom'] ) ? absint( $options['margin_bottom'] ): 15;
        $opt_image_box_height = isset( $options['image_box_height'] ) ? absint( $options['image_box_height'] ) : 250;
        $opt_title_show_hide = isset( $options['title_show_hide'] ) ? absint( $options['title_show_hide'] ) : true;
        $opt_title_show_hide = ( $opt_title_show_hide == 1) ? 'true' : 'false';
        $opt_title_typography = isset( $options['title_typography'] ) ? sanitize_text_field( $options['title_typography'] ) : '';
        $load_more_btn = isset( $options['load_more_btn'] ) ? sanitize_text_field( $options['load_more_btn'] ) : esc_html__( 'Load More','product-screenshot' );
        $load_more_color = !empty( $options['load_more_color'] ) ? sanitize_text_field( $options['load_more_color'] ) : '#ffffff';
        $load_more_bg = !empty( $options['load_more_bg'] ) ? sanitize_text_field( $options['load_more_bg'] ) : '#7456f1';
        $load_more_hover_color = !empty( $options['load_more_hover_color'] ) ? sanitize_text_field( $options['load_more_hover_color'] ) : '#7456f1';
        $load_more_border_color = !empty( $options['load_more_border_color'] ) ? sanitize_text_field( $options['load_more_border_color'] ) : '#7456f1';

        $att_array = shortcode_atts( array(
        'id'             => '',
        'column'         => '',
        'gutter'         => '',
        'title'          => '',
        'margin-bottom'  => '',
        'show-item'      => '',
        'load-item'      => '',
        'image-height'   => '',
        ), $atts );

        $post_id = absint( $att_array['id'] );
        if( !empty( $post_id ) && 'prscrt' === get_post_type( $post_id ) ){
            $meta_fields = get_post_meta( $att_array['id'],'prscrt_meta_fields',true);
            $sec_id ="secid".uniqid();
            $col_count = !empty( $att_array['column'] ) ? absint( $att_array['column'] ) : $opt_column;
            $gutter =  ( '' != $att_array['gutter'] ) ? absint( $att_array['gutter'] ) : $opt_gutter;
            $title_show_hide = !empty( $att_array['title'] ) ? sanitize_text_field( $att_array['title'] ) : $opt_title_show_hide;
            $margin_bottom =  ('' != $att_array['margin-bottom']) ?absint( $att_array['margin-bottom'] ) : $opt_margin_bottom;
            $image_height =  !empty( $att_array['image-height'] ) ? absint( $att_array['image-height'] ) : $opt_image_box_height;
            $show_item = !empty( $att_array['show-item'] ) ? absint( $att_array['show-item'] ) : $opt_show_item;
            $load_item = !empty( $att_array['load-item'] ) ? absint( $att_array['load-item'] ) : $opt_load_item;
            $data_attr = array();
            $data_attr['sec_id']    = $sec_id;
            $data_attr['show_item'] = $show_item;
            $data_attr['load_item'] = $load_item;
            $data_attr = wp_json_encode( $data_attr );

            // responsive controller tablet
            $responsive_options = $options['responsive_options'];
            $t_item_column = isset( $responsive_options ['t_item_column'] ) ? absint( $responsive_options ['t_item_column'] ) : 3;
            $t_image_box_height = isset( $responsive_options ['t_image_box_height'] ) ? absint( $responsive_options ['t_image_box_height'] ) : 200;

            // responsive large Mobile
            $lm_item_column = isset( $responsive_options ['lm_item_column'] ) ? absint( $responsive_options ['lm_item_column'] ) : 2;
            $lm_image_box_height = isset( $responsive_options ['lm_image_box_height'] ) ? absint( $responsive_options ['lm_image_box_height'] ) : 200;
            
            // responsive Mobile
            $m_item_column = isset( $responsive_options ['m_item_column'] ) ? absint( $responsive_options ['m_item_column'] ) : 1;
            $m_image_box_height = isset( $responsive_options ['m_image_box_height'] ) ? absint( $responsive_options ['m_image_box_height'] ) : 180;     
            if( $meta_fields && $meta_fields['screenshot-list'] ){
                ob_start(); ?>
                <div class='prscrt-gallary-page-area <?php esc_attr_e( $sec_id ); ?>' data-secid='<?php echo esc_attr( $data_attr ); ?>'>
                    <div class="prscrt-container">
                        <div class="prscrt-preloader-wrap">
                            <div class="preloader">
                                <span class="dot"></span>
                                <div class="dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class='prscrt-gallary-box prscrt-popup-images <?php esc_attr_e( $sec_id); ?>'>
                            <?php
                            $screenshot_not_found = false;
                            foreach( $meta_fields['screenshot-list'] as $meta_key ){
                                $link = isset( $meta_key['screenshot-link'] )? $meta_key['screenshot-link']:array();
                                $link_title = !empty( $link['text'] )?sanitize_text_field( $link['text'] ) : '';
                                $link_target = !empty( $link['target'] )?sanitize_text_field( $link['target'] ) : '';
                               

                                $img_url = !empty( $meta_key['screenshot-img']['url'] )?filter_var( $meta_key['screenshot-img']['url'], FILTER_VALIDATE_URL) : '';
                                $img_alt = !empty( $meta_key['screenshot-img']['alt'] )?sanitize_text_field( $meta_key['screenshot-img']['alt'] ) : '';
                                $title = !empty( $meta_key['screenshot-title'] )?sanitize_text_field( $meta_key['screenshot-title'] ) : '';
                                $external_link = !empty( $link['url'] ) ? filter_var( $link['url'], FILTER_VALIDATE_URL) : '';
                                if( !empty( $img_url ) ){
                                    
                                    ?>
                                    <div class="prscrt-single-gallary-item">
                                        <a href='<?php echo esc_url( $img_url ); ?>' class="prscrt-active-item" title='<?php esc_attr_e( $title ); ?>' data-elementor-open-lightbox ='no'>
                                            <div class="prscrt-single-image popup-images">
                                                <img src = "<?php echo esc_url( $img_url ); ?>" alt = "<?php echo esc_attr( $img_alt ); ?>">
                                            </div>
                                            <?php if( !empty( $title ) && 'true' == $title_show_hide && ( false == $title_link_view || '' == $external_link ) ): ?>
                                                <span class = 'prscrt-gallery-caption'>  <?php esc_html_e( $title ); ?> </span>
                                            <?php endif; ?>
                                            </a>
                                            <?php if( !empty( $title ) && 'true' == $title_show_hide && true == $title_link_view  && '' !== $external_link): ?>
                                            <a href="<?php echo esc_url( $external_link ); ?>" <?php if($link_target){echo "target='".esc_attr( $link_target )."'";} ?> class ='prscrt-gallery-caption' title="<?php echo esc_attr( $link_title ); ?>"> <?php esc_html_e( $title ); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php 
                                    $screenshot_not_found = true;
                                }
                            }
                            if( $screenshot_not_found == false ){
                                echo "<div class = 'prscrt-not-found'><p>".esc_html__('No Screenshot Found','product-screenshot')."</p></div>";
                            }
                            
                            ?>
                        </div>
                        <?php
                        if( count( $meta_fields['screenshot-list'] ) > $show_item && !empty( $load_more_btn ) ){ ?>
                            <div class="<?php esc_attr_e( $sec_id ); ?> prscrt-loadMore"><?php esc_html_e( $load_more_btn ); ?></div>
                        <?php } ?>
                    </div> 
                </div>
                <!-- Custom style -->
                <?php
                $css_print = "";
                if( 'true' != $title_show_hide ){ 
                    $css_print.= ".lg-sub-html{ display: none; }";
                }
                $css_print .= ".{$sec_id} .prscrt-single-image img { height: 100%; object-fit: cover; }";
                if( $image_height ){
                    $css_print .= ".{$sec_id} .prscrt-single-image{ height: {$image_height}px; }";
                } 
                if( $col_count ){
                    $col_count = 100/$col_count;
                }
                if( $gutter>0 ){
                    $gutter_margin =  $gutter/2;
                }else{
                    $gutter = 0;
                    $gutter_margin = 0;
                }
                $css_print .= ".prscrt-gallary-box.{$sec_id} { margin-left: -{$gutter_margin}px; margin-right: -{$gutter_margin}px;}";
                $css_print .= ".{$sec_id} .prscrt-single-gallary-item { margin-left: {$gutter_margin}px; margin-right: {$gutter_margin}px; flex: 1 0 {$col_count}%; max-width:calc({$col_count}% - {$gutter}px);}";
                $css_print .= ".{$sec_id} .prscrt-single-gallary-item{ margin-bottom:{$margin_bottom}px;}";

                $load_more_p ='';
                if( !empty( $load_more_color ) ){
                    $load_more_p = "color:{$load_more_color};";
                }
                if( !empty( $load_more_bg ) ){
                    $load_more_p .=  "background:{$load_more_bg};"; 
                }
                $css_print.= ".prscrt-loadMore.{$sec_id} { {$load_more_p} }";

                $load_more_ph ='';
                if( !empty( $load_more_hover_color ) ){
                    $load_more_ph = "color:$load_more_hover_color;";
                }
                if( !empty( $load_more_border_color ) ){
                    $load_more_ph .= "background-color:transparent; border-color:{$load_more_border_color};";
                }
                $css_print.= ".prscrt-loadMore.{$sec_id}:hover{ {$load_more_ph} }";

                /* tablet */
                $media_qry_tablate ='';   
                    if( $t_item_column ){
                    $t_item_column = 100/$t_item_column;
                        $media_qry_tablate = ".{$sec_id} .prscrt-single-gallary-item { flex: 1 0 {$t_item_column}%; max-width:calc({$t_item_column}% - {$gutter}px);}";
                    }
                    if( $t_image_box_height ){
                    $media_qry_tablate .= ".{$sec_id} .prscrt-single-image{ height: {$t_image_box_height}px; }";
                }
                if( !empty( $media_qry_tablate ) ){
                    $css_print .=  " @media only screen and (max-width: 992px){ {$media_qry_tablate} }";
                }
                /* Large Mobile */
                $media_qry_large_mobile ='';   
                    if( $lm_item_column ){
                    $lm_item_column = 100/$lm_item_column;
                        $media_qry_large_mobile = ".{$sec_id} .prscrt-single-gallary-item { flex: 1 0 {$lm_item_column}%; max-width:calc({$lm_item_column}% - {$gutter}px);}";
                }
                if( $lm_image_box_height ){
                    $media_qry_large_mobile .= ".{$sec_id} .prscrt-single-image{ height: {$lm_image_box_height}px; }";
                }
                if( !empty( $media_qry_large_mobile ) ){
                    $css_print .=  " @media only screen and (max-width: 760px){ {$media_qry_large_mobile} }";
                }
                /* Mobile */
                $media_qry_mobile ='';   
                    if( $m_item_column ){
                    $m_item_column = 100/$m_item_column;
                    $media_qry_mobile = ".{$sec_id} .prscrt-single-gallary-item { flex: 1 0 {$m_item_column}%; max-width:calc({$m_item_column}% - {$gutter}px);}";
                }
                if( $m_image_box_height ){
                    $media_qry_mobile .= ".{$sec_id} .prscrt-single-image{ height: {$m_image_box_height}px; }";
                }
                if( !empty( $media_qry_mobile ) ){
                    $css_print .=  " @media only screen and (max-width: 400px){ {$media_qry_mobile} }";
                }
                ?>
                <style>
                    <?php esc_html_e( $css_print ); ?>            
                </style>
                <?php
                $output = ob_get_clean();
                return $output;
            }else{
                $output = "<div class='prscrt-not-found'><p>".esc_html__('No Screenshot Found','product-screenshot')."</p></div>";
                return $output;
            }
        }else{
            $output = "<div class='prscrt-not-found'><p>".esc_html__('Insert the vaild ID. Example: [prscrt-screenshot id=125]','product-screenshot')."</p></div>";
            return $output;
        }
    }
}