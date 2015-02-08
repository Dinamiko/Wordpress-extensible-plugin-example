<?php
/**
 * Plugin Name: Extensible Plugin
 * Description: Un ejemplo de plugin extensible
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Muestra los últimos 5 posts después de the_content, excluye de la lista el post actual
*/
add_filter('the_content', 'ep_after_content');

function ep_after_content( $content ) {

	global $post;
  
  	if( $post && $post->post_type == 'post' && is_singular( 'post' ) && is_main_query() ) {

  		$id = $post->ID;
 
		ob_start(); ?>

		<?php do_action( 'ep_before_list' );?>

		<div style="width:100%;float:left;">
			<ul>

			<?php
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'post__not_in' => array( $id ),
					'posts_per_page' => 5
				);

				$the_query = new WP_Query( apply_filters( 'ep_args', $args ) );

				if ( $the_query->have_posts() ) {

				   	while ( $the_query->have_posts() ) {
				        $the_query->the_post(); ?>

				        <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>

					<?php }

				} 

				wp_reset_postdata();
			?>

			</ul>
		</div>

		<?php do_action( 'ep_after_list' );?>

		<?php $content .= ob_get_clean();

	}

	return $content;

}
