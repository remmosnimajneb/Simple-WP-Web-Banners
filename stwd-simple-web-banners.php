<?php
/**
 * Plugin Name: Simple Web Banners
 * Plugin URI: https://sommertechs.com
 * Description: A simple plugin for making website banners.
 * Version: 1.0
 * Author: Sommer Technologies
 * Author URI: https://sommertechs.com
 * License: GPL3
 */

    /*
    * Require ABSPATH
    */
        if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


    /*
    * Enqueue Styles
    */
        wp_enqueue_style('stwd-wb-styles', plugin_dir_url(__FILE__) . 'style.css', array(), false);

    /**
     * Setup Settings Page
     * ---------------------------------------------------------------------------------------
     *
     * This sets up our custom WP Settings Page.
     *
     */

        /*
        * Setup Settings Page
        */
            add_action( 'admin_init', 'stwd_wb_settings_init' );
            function stwd_wb_settings_init() {
                register_setting( 'stwd_wb', 'stwd_wb_options' );
                add_settings_section(
                    'stwd_wb_section_settings',
                    __( 'Settings', 'stwd_wb' ), 
                    'stwd_wb_section_settings_callback',
                    'stwd_wb'
                );

                add_settings_field(                                         // Field 1
                    'stwd_wb_field_marquee',
                    __( 'Use Marquee for scrolling?', 'stwd_wb' ),
                    'stwd_wb_field_marquee_cb',
                    'stwd_wb',
                    'stwd_wb_section_settings',
                    array(
                        'label_for'         => 'stwd_wb_field_marquee',
                        'class'             => 'stwd_wb_row',
                    )
                );

                add_settings_field(                                         // Field 2
                    'stwd_wb_field_marquee_scroll_format',
                    __( 'Marquee Scroll Direction', 'stwd_wb' ),
                    'stwd_wb_field_marquee_scroll_format_cb',
                    'stwd_wb',
                    'stwd_wb_section_settings',
                    array(
                        'label_for'         => 'stwd_wb_field_marquee_scroll_format',
                        'class'             => 'stwd_wb_row',
                    )
                );

                add_settings_field(                                         // Field 3
                    'stwd_wb_field_default_bkcolor',
                    __( 'Default Banner Background Color', 'stwd_wb' ),
                    'stwd_wb_field_default_bkcolor_cb',
                    'stwd_wb',
                    'stwd_wb_section_settings',
                    array(
                        'label_for'         => 'stwd_wb_field_default_bkcolor',
                        'class'             => 'stwd_wb_row',
                    )
                );

                add_settings_field(                                         // Field 4
                    'stwd_wb_field_default_color',
                    __( 'Default Banner Text Color', 'stwd_wb' ),
                    'stwd_wb_field_default_color_cb',
                    'stwd_wb',
                    'stwd_wb_section_settings',
                    array(
                        'label_for'         => 'stwd_wb_field_default_color',
                        'class'             => 'stwd_wb_row',
                    )
                );


            }

        /*
        * Section CB
        */
            function stwd_wb_section_settings_callback(){}

        /*
        * Callback for Field 1 - 'stwd_wb_field_marquee_cb'
        */
            function stwd_wb_field_marquee_cb( $args ) {
                $options = get_option( 'stwd_wb_options' );
            ?>
            <select
                    id="<?php echo esc_attr( $args['label_for'] ); ?>"
                    name="stwd_wb_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
                <option value="No" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'No', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'No', 'stwd_wb' ); ?>
                </option>
                <option value="Yes" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'Yes', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'Yes', 'stwd_wb' ); ?>
                </option>
            </select>
            <p class="description">
                <?php esc_html_e( 'Do you want the alerts to scroll on one line? If scroll is selected, default color is used for all alerts.', 'stwd_wb' ); ?>
            </p>
            <?php
        }

        /*
        * Callback for Field 2 - 'stwd_wb_field_marquee_scroll_format_cb'
        */
            function stwd_wb_field_marquee_scroll_format_cb( $args ) {
                $options = get_option( 'stwd_wb_options' );
            ?>
            <select
                    id="<?php echo esc_attr( $args['label_for'] ); ?>"
                    name="stwd_wb_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
                <option value="up" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'up', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'Up', 'stwd_wb' ); ?>
                </option>
                <option value="down" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'down', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'Down', 'stwd_wb' ); ?>
                </option>
                <option value="left" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'left', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'Left', 'stwd_wb' ); ?>
                </option>
                <option value="right" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'right', false ) ) : ( '' ); ?>>
                    <?php esc_html_e( 'Right', 'stwd_wb' ); ?>
                </option>

            </select>
            <p class="description">
                <?php esc_html_e( 'Which direction do you want Marqueee to scroll in?', 'stwd_wb' ); ?>
            </p>
            <?php
        }

        /*
        * Callback for Field 3 - 'stwd_wb_field_default_bkcolor_cb'
        */
            function stwd_wb_field_default_bkcolor_cb( $args ) {
                $options = get_option( 'stwd_wb_options' );
            ?>
             <input type="color" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="stwd_wb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[ $args['label_for'] ]; ?>">
                <label for="<?php echo esc_attr( $args['label_for'] ); ?>">Background Color</label>
            <p class="description">
                <?php esc_html_e( 'Default Background Color to be used for Banners if no override selected', 'stwd_wb' ); ?>
            </p>
            <?php
        }

        /*
        * Callback for Field 4 - 'stwd_wb_field_default_color_cb'
        */
            function stwd_wb_field_default_color_cb( $args ) {
                $options = get_option( 'stwd_wb_options' );
            ?>
             <input type="color" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="stwd_wb_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[ $args['label_for'] ]; ?>">
                <label for="<?php echo esc_attr( $args['label_for'] ); ?>">Text Color</label>
            <p class="description">
                <?php esc_html_e( 'Default Text Color to be used for Banners if no override selected', 'stwd_wb' ); ?>
            </p>
            <?php
        }

        /**
        * Add the top level menu page.
        */
            add_action( 'admin_menu', 'stwd_wb_options_page' );
            function stwd_wb_options_page() {
                add_submenu_page(
                    'options-general.php',
                    'Simple Web Banners - General Settings',
                    'Web Banners Options',
                    'administrator',
                    'stwd_wb_options',
                    'stwd_wb_options_page_html' 
                );
            }

        /*
        * Callback for Options Page
        */
            function stwd_wb_options_page_html() {
                if ( ! current_user_can( 'manage_options' ) ) {
                    return;
                }
         
            if ( isset( $_GET['settings-updated'] ) ) {
                add_settings_error( 'stwd_wb_messages', 'stwd_wb_message', __( 'Settings Saved', 'stwd_wb' ), 'updated' );
            }
         
            settings_errors( 'stwd_wb_messages' );
            ?>
            <div class="wrap">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <form action="options.php" method="post">
                    <?php
                    settings_fields( 'stwd_wb' );
                    do_settings_sections( 'stwd_wb' );
                    submit_button( 'Save Settings' );
                    ?>
                </form>
            </div>
            <?php
        }


    /**
     * Setup Custom Post Type
     * ---------------------------------------------------------------------------------------
     *
     * This sets up our custom post type and the
     * custom fields which go along with it.
     * We will work on the output later down the file.
     *
     */

        /*
        * Setup Custom Post Type
        */
            function stwd_create_web_banner_post_type() {
                register_post_type( 'stwd_web_banners',
                    array(
                        'labels' => array(
                            'name' => __( 'Website Banners' ),
                            'singular_name' => __( 'Website Banners' )
                        ),
                        'public' => true,
                        'has_archive' => false,
                        'menu_icon' => 'dashicons-welcome-widgets-menus',
                    )
                );
            }
            add_action( 'init', 'stwd_create_web_banner_post_type' );

        /*
        * Custom Fields for Post Type
        */

            add_action( 'add_meta_boxes', 'stwd_wb_add_meta_box' );
            function stwd_wb_add_meta_box() {
                add_meta_box(
                    'stwd_wb_section',
                    __( 'Options', 'stwd_web_banners' ),
                    'stwd_wb_metabox_cb',
                    'stwd_web_banners'
                );
            }
                

                /*
                * Callback for Meta Box
                */
                function stwd_wb_metabox_cb( $post ) {

                // Add a nonce field so we can check for it later.
                    wp_nonce_field( 'stwd_wb_save_meta_box_data', 'stwd_wb_meta_box_nonce' );

                    // Start Date
                        echo '<label for="_stwd_wb_meta_startdate">';
                            _e( 'Start Date', 'stwd_web_banners' );
                        echo '</label> ';
                        echo '<input type="date" id="_stwd_wb_meta_startdate" name="_stwd_wb_meta_startdate" value="' . get_post_meta( $post->ID, '_stwd_wb_meta_startdate', true ) . '" required="required" /><br><br>';

                    // End Date
                        echo '<label for="_stwd_wb_meta_enddate">';
                            _e( 'End Date', 'stwd_web_banners' );
                        echo '</label> ';
                        echo '<input type="date" id="_stwd_wb_meta_enddate" name="_stwd_wb_meta_enddate" value="' . get_post_meta( $post->ID, '_stwd_wb_meta_enddate', true ) . '" required="required" /><br><br>';

                    // BK Color
                        echo '<label for="_stwd_wb_meta_bk_colorpicker">';
                            _e( 'Background Color', 'stwd_web_banners' );
                        echo '</label> ';
                        echo '<input type="color" id="_stwd_wb_meta_bk_colorpicker" name="_stwd_wb_meta_bk_colorpicker" value="' . get_post_meta( $post->ID, '_stwd_wb_meta_bk_colorpicker', true ) . '" /><br><br>';

                    // Color
                        echo '<label for="_stwd_wb_meta_colorpicker">';
                            _e( 'Text Color', 'stwd_web_banners' );
                        echo '</label> ';
                        echo '<input type="color" id="_stwd_wb_meta_colorpicker" name="_stwd_wb_meta_colorpicker" value="' . get_post_meta( $post->ID, '_stwd_wb_meta_colorpicker', true ) . '" /><br><br>';
                }


            /**
             * When the post is saved, saves our custom data.
             *
             * @param int $post_id The ID of the post being saved.
             */
            add_action( 'save_post', 'stwd_wb_save_meta_box_data' );
            function stwd_wb_save_meta_box_data( $post_id ) {

                // Sanity Check
                if ( (! isset( $_POST['stwd_wb_meta_box_nonce'] )) || (! wp_verify_nonce( $_POST['stwd_wb_meta_box_nonce'], 'stwd_wb_save_meta_box_data' )) || (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) ) {
                    return;
                }

                // Check the user's permissions.
                if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

                    if ( ! current_user_can( 'edit_page', $post_id ) ) {
                        return;
                    }

                } else {

                    if ( ! current_user_can( 'edit_post', $post_id ) ) {
                        return;
                    }
                }

                // Update each field if it's set

                    // Start Date
                        if ( isset( $_POST['_stwd_wb_meta_startdate'] ) ) {
                            update_post_meta( $post_id, '_stwd_wb_meta_startdate', sanitize_text_field( $_POST['_stwd_wb_meta_startdate'] ) );
                        }

                    // End Date
                        if ( isset( $_POST['_stwd_wb_meta_enddate'] ) ) {
                            update_post_meta( $post_id, '_stwd_wb_meta_enddate', sanitize_text_field( $_POST['_stwd_wb_meta_enddate'] ) );
                        }

                    // BK Color
                        if ( isset( $_POST['_stwd_wb_meta_bk_colorpicker'] ) ) {
                            update_post_meta( $post_id, '_stwd_wb_meta_bk_colorpicker', sanitize_text_field( $_POST['_stwd_wb_meta_bk_colorpicker'] ) );
                        }

                    // Color
                        if ( isset( $_POST['_stwd_wb_meta_colorpicker'] ) ) {
                            update_post_meta( $post_id, '_stwd_wb_meta_colorpicker', sanitize_text_field( $_POST['_stwd_wb_meta_colorpicker'] ) );
                        }
                
            }
            
    /**
     * Setup Frontend Display
     * ---------------------------------------------------------------------------------------
     *
     * Finally we setup the actual display to show the alerts on the right dates with 'wp_body_open'
     *
     */

        /*
        * Main Trigger
        */
            add_action('wp_body_open', 'stwd_wb_display_banners');
            function stwd_wb_display_banners(){
                /*
                * Get Global Options
                */
                    $Options = get_option( 'stwd_wb_options' );

                        $UseMarquee = $Options['stwd_wb_field_marquee'];
                        $MarqueeDirection = $Options['stwd_wb_field_marquee_scroll_format'];
                        $DefaultBKColor = $Options['stwd_wb_field_default_bkcolor'];
                        $DefaultColor = $Options['stwd_wb_field_default_color'];

                /*
                * WP Args
                */
                    $date_now = date('Y-m-d');
                    $args = array( 
                        'post_type' => 'stwd_web_banners',
                        'order_by'  => 'date',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key'     => '_stwd_wb_meta_startdate',
                                'value'   => date("Y-m-d"),
                                'compare' => '<=',
                                'type'    => 'DATE'
                            ),
                            array(
                                'key'     => '_stwd_wb_meta_enddate',
                                'value'   => date("Y-m-d"),
                                'compare' => '>=',
                                'type'    => 'DATE'
                            )
                        ),
                        
                    );      
                /*
                * Get Alert Contents Concated together
                */
                    $Alerts_Content = "";
                    $loop = new WP_Query( $args );
                        if ( $loop->have_posts() ) {
                            
                            while ( $loop->have_posts() ) : $loop->the_post();

                                if($UseMarquee == "Yes"){
                                    $Alerts_Content .= wp_strip_all_tags(get_the_content()) . (($MarqueeDirection == "up" || $MarqueeDirection == "down") ? "<br>" : "&nbsp;-&nbsp;");
                                } else {
                                    $Alerts_Content .= "<div class=\"stwd_wb_alert stwd_wb_" . get_the_ID() . "\" style=\"background-color:" . get_post_meta(get_the_ID(), '_stwd_wb_meta_bk_colorpicker', true ) . "!important;color:" . get_post_meta(get_the_ID(), '_stwd_wb_meta_colorpicker', true ) . "!important;\">" . get_the_content() . "</div>";
                                }

                            endwhile;

                        }
                    
                    wp_reset_postdata(); // Reset POSTDATA

                /*
                * Finally bring it all together now!
                */
                ob_start();

                    ?>
                        <section class="stwd_wb_alerts_wrapper" style="background-color: <?php echo $DefaultBKColor; ?>;color:<?php echo $DefaultColor; ?>;">
                            
                            <?php
                                if($UseMarquee == "Yes"){
                                    ?><section class="stwd_wb_alert"><marquee direction="<?php echo $MarqueeDirection; ?>"><?php echo rtrim($Alerts_Content,"&nbsp;-&nbsp;"); ?></marquee></section><?php
                                } else {
                                    echo $Alerts_Content;
                                }
                            ?>

                        </section>

                    <?php                
                
                echo ob_get_clean();
            }