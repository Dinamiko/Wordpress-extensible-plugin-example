<?php
/**
 * Plugin Name: Addon Extensible Plugin 
 * Description: Un ejemplo que modifica la funcionalidad de Extensible Plugin
 */

/**
* Modifica argumentos de WP_Query
*/
add_filter( 'ep_args', 'custom_ep_args' );

function custom_ep_args( $args ) {

	$args['posts_per_page'] = 10;
	$args['order'] = 'ASC';
	$args['orderby'] = 'author';	
 
	return $args;

}

/**
* Añade contenido antes de la lista
*/
add_action( 'ep_before_list', 'custom_ep_before_list' );

function custom_ep_before_list() { ?>

	<h3><?php _e('Últimas entradas', 'text-domain');?></h3>

<?php }

/**
* Añade contenido después de la lista
*/
add_action( 'ep_after_list', 'custom_ep_after_list' );

function custom_ep_after_list() { ?>

	<p><?php _e('Última modificación: ', 'text-domain') . the_modified_date( 'd-m-Y g:i a' );?></p>

<?php }