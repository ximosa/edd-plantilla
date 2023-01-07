<?php
/**
 * Template for displaying search forms in Eidmart
 *
 * @package WordPress
 * @subpackage Eidmart
 * @since 1.0
 * @version 1.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<span class="input-group">
		<input type="text" class="form-control search-field" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr__( 'Search...', 'eidmart' ); ?>">
		<span class="input-group-append">
			<button class="btn btn-search" type="submit"><i class="las la-search"></i></button>
		</span>
	</span>
</form>