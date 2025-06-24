<div class="theme-offer">
	<?php 
    // Check if the demo import has been completed
    $florist_flower_shop_demo_import_completed = get_option('florist_flower_shop_demo_import_completed', false);

    // If the demo import is completed, display the "View Site" button
    if ($florist_flower_shop_demo_import_completed) {
      echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'florist-flower-shop') . '</p>';
      echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'florist-flower-shop') . '</a></span>';
    }

    if (isset($_POST['submit'])) {

        // Check if woocommerce is installed and activated
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
          // Install the plugin if it doesn't exist
          $florist_flower_shop_plugin_slug = 'woocommerce';
          $florist_flower_shop_plugin_file = 'woocommerce/woocommerce.php';

          // Check if plugin is installed
          $florist_flower_shop_installed_plugins = get_plugins();
          if (!isset($florist_flower_shop_installed_plugins[$florist_flower_shop_plugin_file])) {
              include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
              include_once(ABSPATH . 'wp-admin/includes/file.php');
              include_once(ABSPATH . 'wp-admin/includes/misc.php');
              include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

              // Install the plugin
              $florist_flower_shop_upgrader = new Plugin_Upgrader();
              $florist_flower_shop_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
          }
          // Activate the plugin
          activate_plugin($florist_flower_shop_plugin_file);
        }

        // Check if ibtana visual editor is installed and activated
        if (!is_plugin_active('ibtana-visual-editor/plugin.php')) {
          // Install the plugin if it doesn't exist
          $florist_flower_shop_plugin_slug = 'ibtana-visual-editor';
          $florist_flower_shop_plugin_file = 'ibtana-visual-editor/plugin.php';

          // Check if plugin is installed
          $florist_flower_shop_installed_plugins = get_plugins();
          if (!isset($florist_flower_shop_installed_plugins[$florist_flower_shop_plugin_file])) {
              include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
              include_once(ABSPATH . 'wp-admin/includes/file.php');
              include_once(ABSPATH . 'wp-admin/includes/misc.php');
              include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

              // Install the plugin
              $florist_flower_shop_upgrader = new Plugin_Upgrader();
              $florist_flower_shop_upgrader->install('https://downloads.wordpress.org/plugin/ibtana-visual-editor.latest-stable.zip');
          }
          // Activate the plugin
          activate_plugin($florist_flower_shop_plugin_file);
        }

            // ------- Create Nav Menu --------
            $florist_flower_shop_menuname = 'Main Menus';
            $florist_flower_shop_bpmenulocation = 'primary';
            $florist_flower_shop_menu_exists = wp_get_nav_menu_object($florist_flower_shop_menuname);

            if (!$florist_flower_shop_menu_exists) {
                $florist_flower_shop_menu_id = wp_create_nav_menu($florist_flower_shop_menuname);

                // Create Home Page
                $florist_flower_shop_home_title = 'Home';
                $florist_flower_shop_home = array(
                    'post_type' => 'page',
                    'post_title' => $florist_flower_shop_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $florist_flower_shop_home_id = wp_insert_post($florist_flower_shop_home);
                // Assign Home Page Template
                add_post_meta($florist_flower_shop_home_id, '_wp_page_template', 'page-template/custom-home-page.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $florist_flower_shop_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($florist_flower_shop_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'florist-flower-shop'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $florist_flower_shop_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Pages Page with Dummy Content
                $florist_flower_shop_pages_title = 'Pages';
                $florist_flower_shop_pages_content = '
                Explore all the pages we have on our website. Find information about our services, company, and more.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $florist_flower_shop_pages = array(
                    'post_type' => 'page',
                    'post_title' => $florist_flower_shop_pages_title,
                    'post_content' => $florist_flower_shop_pages_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'pages'
                );
                $florist_flower_shop_pages_id = wp_insert_post($florist_flower_shop_pages);
                // Add Pages Page to Menu
                wp_update_nav_menu_item($florist_flower_shop_menu_id, 0, array(
                    'menu-item-title' => __('Pages', 'florist-flower-shop'),
                    'menu-item-classes' => 'pages',
                    'menu-item-url' => home_url('/pages/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $florist_flower_shop_pages_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $florist_flower_shop_about_title = 'About Us';
                $florist_flower_shop_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br>
                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $florist_flower_shop_about = array(
                    'post_type' => 'page',
                    'post_title' => $florist_flower_shop_about_title,
                    'post_content' => $florist_flower_shop_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $florist_flower_shop_about_id = wp_insert_post($florist_flower_shop_about);
                // Add About Us Page to Menu
                wp_update_nav_menu_item($florist_flower_shop_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'florist-flower-shop'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $florist_flower_shop_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($florist_flower_shop_bpmenulocation)) {
                    $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($locations)) {
                        $locations = array();
                    }
                    $locations[$florist_flower_shop_bpmenulocation] = $florist_flower_shop_menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }

        }
            // Set the demo import completion flag
    		update_option('florist_flower_shop_demo_import_completed', true);

    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'florist-flower-shop') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'florist-flower-shop') . '</a></span>';

            //end 

        // topbar section start //         
        set_theme_mod( 'florist_flower_shop_top_bar_text', 'Lorem ipsum dolor sit amet ipsum dolor sit amet.' );
        set_theme_mod( 'florist_flower_shop_contact_us_text', 'Contact Us' );
        set_theme_mod( 'florist_flower_shop_contact_us_link', '#' );

        // slider section start //  
        set_theme_mod( 'florist_flower_shop_slider_button_text', 'SHOP NOW' );   
        set_theme_mod( 'florist_flower_shop_slider_button_link', '#' );

        for($florist_flower_shop_i=1;$florist_flower_shop_i<=3;$florist_flower_shop_i++){
               $florist_flower_shop_slider_title = 'Lorem ipsum dolor sit amet consectuar';
               $florist_flower_shop_slider_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.';
                  // Create post object
               $my_post = array(
               'post_title'    => wp_strip_all_tags( $florist_flower_shop_slider_title ),
               'post_content'  => $florist_flower_shop_slider_content,
               'post_status'   => 'publish',
               'post_type'     => 'page',
               );

               // Insert the post into the database
               $florist_flower_shop_post_id = wp_insert_post( $my_post );

               if ($florist_flower_shop_post_id) {
                 // Set the theme mod for the product page
                 set_theme_mod('florist_flower_shop_slider_page' . $florist_flower_shop_i, $florist_flower_shop_post_id);

                  $florist_flower_shop_image_url = get_template_directory_uri().'/assets/images/slider'.$florist_flower_shop_i.'.png';

                $florist_flower_shop_image_id = media_sideload_image($florist_flower_shop_image_url, $florist_flower_shop_post_id, null, 'id');

                    if (!is_wp_error($florist_flower_shop_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($florist_flower_shop_post_id, $florist_flower_shop_image_id);
                    }
                }
            }  

            // Popular Product Section //
            set_theme_mod('florist_flower_shop_product_slide', 'productcategory1');
            // Define product category names and product titles
            $florist_flower_shop_category_names = array('productcategory1', 'productcategory2');
            $florist_flower_shop_title_array = array(
                array("Lorem ipsum dolor sit amet consectuar", "Lorem ipsum dolor sit amet consectuar", "Lorem ipsum dolor sit amet consectuar"),
                array("Lorem ipsum dolor sit amet consectuar", "Lorem ipsum dolor sit amet consectuar", "Lorem ipsum dolor sit amet consectuar")
            );

            foreach ($florist_flower_shop_category_names as $florist_flower_shop_index => $florist_flower_shop_category_name) {
                // Create or retrieve the product category term ID
                $florist_flower_shop_term = term_exists($florist_flower_shop_category_name, 'product_cat');
                if ($florist_flower_shop_term === 0 || $florist_flower_shop_term === null) {
                    // If the term does not exist, create it
                    $florist_flower_shop_term = wp_insert_term($florist_flower_shop_category_name, 'product_cat');
                }

                if (is_wp_error($florist_flower_shop_term)) {
                    error_log('Error creating category: ' . $florist_flower_shop_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                // Loop to create 4 products for each category
                for ($florist_flower_shop_i = 0; $florist_flower_shop_i < 3; $florist_flower_shop_i++) {
                    // Create product content
                    $florist_flower_shop_title = $florist_flower_shop_title_array[$florist_flower_shop_index][$florist_flower_shop_i];
                    $florist_flower_shop_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.';

                    // Create product post object
                    $florist_flower_shop_my_post = array(
                        'post_title'    => wp_strip_all_tags($florist_flower_shop_title),
                        'post_content'  => $florist_flower_shop_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'product', // Post type set to 'product'
                    );

                    // Insert the product into the database
                    $florist_flower_shop_post_id = wp_insert_post($florist_flower_shop_my_post);

                    if (is_wp_error($florist_flower_shop_post_id)) {
                        error_log('Error creating product: ' . $florist_flower_shop_post_id->get_error_message());
                        continue; // Skip to the next product if creation fails
                    }

                    // Assign the category to the product
                    wp_set_object_terms($florist_flower_shop_post_id, (int)$florist_flower_shop_term['term_id'], 'product_cat');

                    // Add product meta (price, etc.)
                    update_post_meta($florist_flower_shop_post_id, '_regular_price', '400.00'); // Regular price
                    update_post_meta($florist_flower_shop_post_id, '_sale_price', '400.00'); // Sale price
                    update_post_meta($florist_flower_shop_post_id, '_price', '400.00'); // Active price

                    // Handle the featured image using media_sideload_image
                    $florist_flower_shop_image_url = get_template_directory_uri() . '/assets/images/banner-product' . ($florist_flower_shop_i + 1) . '.png';
                    $florist_flower_shop_image_id = media_sideload_image($florist_flower_shop_image_url, $florist_flower_shop_post_id, null, 'id');

                    if (is_wp_error($florist_flower_shop_image_id)) {
                        error_log('Error downloading image: ' . $florist_flower_shop_image_id->get_error_message());
                        continue; // Skip to the next product if image download fails
                    }
                    // Assign featured image to product
                    set_post_thumbnail($florist_flower_shop_post_id, $florist_flower_shop_image_id);

                }
            }


            // BestSelling Product Section //  

            $florist_flower_shop_title_array = array(
                array("Product Title Goes Here1",
                      "Product Title Goes Here2",
                      "Product Title Goes Here3",
                      "Product Title Goes Here4",
                      "Product Title Goes Here5")
            );

            foreach ($florist_flower_shop_title_array as $florist_flower_shop_titles) {
                // Loop to create only 3 products
                for ($florist_flower_shop_i = 0; $florist_flower_shop_i < 5; $florist_flower_shop_i++) {
                    // Create product content
                    $florist_flower_shop_title = $florist_flower_shop_titles[$florist_flower_shop_i];
                    $florist_flower_shop_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';

                    // Create product post object
                    $florist_flower_shop_my_post = array(
                        'post_title'    => wp_strip_all_tags($florist_flower_shop_title),
                        'post_content'  => $florist_flower_shop_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'product',
                    );
                    set_theme_mod('florist_flower_shop_product_settings', esc_url($florist_flower_shop_post_id));
                    // Insert the product into the database
                    $florist_flower_shop_post_id = wp_insert_post($florist_flower_shop_my_post);

                    if (is_wp_error($florist_flower_shop_post_id)) {
                        error_log('Error creating product: ' . $florist_flower_shop_post_id->get_error_message());
                        continue; // Skip to the next product if creation fails
                    }

                    // Add product meta (price, etc.)
                    update_post_meta($florist_flower_shop_post_id, '_regular_price', '400.00'); // Regular price
                    update_post_meta($florist_flower_shop_post_id, '_sale_price', '400.00'); // Sale price
                    update_post_meta($florist_flower_shop_post_id, '_price', '400.00'); // Active price

                    // Handle the featured image using media_sideload_image
                    $florist_flower_shop_image_url = get_template_directory_uri() . '/assets/images/product-img' . ($florist_flower_shop_i + 1) . '.png';
                    $florist_flower_shop_image_id = media_sideload_image($florist_flower_shop_image_url, $florist_flower_shop_post_id, null, 'id');

                    if (is_wp_error($florist_flower_shop_image_id)) {
                        error_log('Error downloading image: ' . $florist_flower_shop_image_id->get_error_message());
                        continue; // Skip to the next product if image download fails
                    }

                    // Assign featured image to product
                    set_post_thumbnail($florist_flower_shop_post_id, $florist_flower_shop_image_id);
                }
            }
        
            // Create the 'Products' page if it doesn't exist
            $florist_flower_shop_page_query = new WP_Query(array(
                'post_type'      => 'page',
                'title'          => 'Shop Best Sellers',
                'post_status'    => 'publish',
                'posts_per_page' => 1
            ));

            if (!$florist_flower_shop_page_query->have_posts()) {
                $florist_flower_shop_page_title = 'Shop Best Sellers';
                $productpage = '[products limit="5" columns="5"]';

                // Append the WooCommerce products shortcode to the content
                $florist_flower_shop_content = '';
                $florist_flower_shop_content .= do_shortcode($productpage);

                // Create the new page
                $florist_flower_shop_page = array(
                    'post_type'    => 'page',
                    'post_title'   => $florist_flower_shop_page_title,
                    'post_content' => $florist_flower_shop_content,
                    'post_status'  => 'publish',
                    'post_author'  => 1,
                    'post_slug'    => 'products'
                );

                // Insert the page and get its ID
                $florist_flower_shop_page_id = wp_insert_post($florist_flower_shop_page);

                // Store the page ID in theme mod
                if (!is_wp_error($florist_flower_shop_page_id)) {
                    set_theme_mod('florist_flower_shop_product_settings', $florist_flower_shop_page_id);
                }
            }
       
            //Copyright Text
            set_theme_mod( 'florist_flower_shop_footer_text', 'By VWThemes' );             
    }
  ?>
  
	<p><?php esc_html_e('Please back up your website if it’s already live with data. This importer will overwrite your existing settings with the new customizer values for Florist Flower Shop', 'florist-flower-shop'); ?></p>
    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=florist_flower_shop_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('florist_flower_shop_demo_import_completed')) : ?>
            <input class="run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer', 'florist-flower-shop'); ?>" class="button button-primary button-large">
        <?php endif; ?>
        <div id="spinner" style="display:none;">         
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/spinner.png" alt="" />
        </div>
    </form>
    <script type="text/javascript">
        function validate(form) {
            if (confirm("Do you really want to import the theme demo content?")) {
                // Show the spinner
                document.getElementById('spinner').style.display = 'block';
                // Allow the form to be submitted
                return true;
            } 
            else {
                return false;
            }
        }
    </script>
</div>

