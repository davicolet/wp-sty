<?php
add_action('after_setup_theme', 'ondaweb_setup');

if (!function_exists('ondaweb_setup')){

	function ondaweb_setup(){

		add_theme_support('post-thumbnails');

		@ini_set( 'upload_max_size' , '64M' );
		@ini_set( 'post_max_size', '64M');
		@ini_set( 'max_execution_time', '300' );

		// add_image_size('small-feature', 500, 300, true);

		function ondaweb_excerpt_length($length) {
			return 40;
		}
		add_filter('excerpt_length', 'ondaweb_excerpt_length');

		function ondaweb_continue_reading_link() {
			return ' <a href="'. esc_url( get_permalink() ) . '">' . __('Continue Lendo <span class="meta-nav">&rarr;</span>', 'ondaweb' ) . '</a>';
		}

		function ondaweb_auto_excerpt_more($more) {
			if (!is_admin()) {
				return ' &hellip;' . ondaweb_continue_reading_link();
			}
			return $more;
		}
		add_filter('excerpt_more', 'ondaweb_auto_excerpt_more' );

		function ondaweb_custom_excerpt_more( $output ) {
			if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
				$output .= ondaweb_continue_reading_link();
			}
			return $output;
		}
		add_filter('get_the_excerpt', 'ondaweb_custom_excerpt_more' );

		function ondaweb_widgets_init() {
			register_sidebar( array(
				'name' => __('Main Sidebar', 'ondaweb' ),
				'id' => 'sidebar-1',
			));
		}
		add_action('widgets_init', 'ondaweb_widgets_init' );

		function rw_title( $title, $sep, $seplocation ) {
			global $page, $paged;

			if(is_feed()) return $title;

			if('right' == $seplocation){
				$title .= get_bloginfo('name' );
			} else {
				$title = get_bloginfo('name').$title;
			}

			$site_description = get_bloginfo('description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) ) {
				$title .= " {$sep} {$site_description}";
			}

			if ( $paged >= 2 || $page >= 2 ) {
				$title .= " {$sep} " . sprintf( __('Página %s', 'dbt' ), max( $paged, $page ) );
			}

			return $title;
		}
		add_filter('wp_title', 'rw_title', 10, 3);

		// Paginação
		function paginacao() {

			if( is_singular() )
				return;

			global $wp_query;

			/** Stop execution if there's only 1 page */
			if( $wp_query->max_num_pages <= 1 )
				return;

			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			$max   = intval( $wp_query->max_num_pages );

			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;

			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}

			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}

			echo '<div class="paginacao"><ul>' . "\n";

			/**	Previous Post Link */
			if ( get_previous_posts_link() )
				printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

			/**	Link to first page, plus ellipses if necessary */
			if ( ! in_array( 1, $links ) ) {
				$class = 1 == $paged ? ' class="active"' : '';

				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

				if ( ! in_array( 2, $links ) )
					echo '<li>…</li>';
			}

			/**	Link to current page, plus 2 pages in either direction if necessary */
			sort( $links );
			foreach ( (array) $links as $link ) {
				$class = $paged == $link ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
			}

			/**	Link to last page, plus ellipses if necessary */
			if ( ! in_array( $max, $links ) ) {
				if ( ! in_array( $max - 1, $links ) )
					echo '<li>…</li>' . "\n";

				$class = $paged == $max ? ' class="active"' : '';
				printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
			}

			/**	Next Post Link */
			if ( get_next_posts_link() ) printf( '<li>%s</li>' . "\n", get_next_posts_link() );
			echo '</ul></div>' . "\n";
		}
		add_filter('paginacao', 'paginacao' );

		// Desativa alguns itens da sidebar
		function remover_itens_menu() {
			remove_menu_page('index.php');
			remove_menu_page('edit.php');
			remove_menu_page('edit-comments.php');
		}
		add_action('admin_menu', 'remover_itens_menu');


	}
}
?>
