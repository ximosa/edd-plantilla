<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

?>

<div class="col-md-12">

	<section class="no-results not-found text-center">
		<header class="page-header">
			<h1><?php esc_html_e( 'Nothing Found', 'eidmart' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf(
					'<p>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
						esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eidmart' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p><br>',
					esc_url( admin_url( 'post-new.php' ) )
				);

			elseif ( is_search() ) :
				?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eidmart' ); ?></p><br>
				<?php
				get_search_form();

			else :
				?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eidmart' ); ?></p>
				<?php
				get_search_form();

			endif;
			?>
		</div><!-- .page-content -->
	</section><!-- .no-results -->

</div>
