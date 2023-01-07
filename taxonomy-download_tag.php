<?php
/**
 * The template for displaying tags pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eidmart
 */

get_header();

if( get_theme_mod( 'archive_type' ) == '1' ) { // Software Product Archive

/*
Archive header
 */
do_action( 'product_search' ); ?> 

<div class="course-header-1x">
	<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?>">
		<div class="row">

			<?php do_action( 'filter_sidebr' ); ?>

			<div class="col-md-9">
				<div class="course-header-right">
					<div class="row">
					
					<div class="col-md-12">
						<div class="course-tab">
							<p><?php echo esc_html( get_theme_mod( 'usd_price', __( 'All prices are in USD', 'eidmart' ) ) ); ?></p>                    
						</div>
					</div>

					</div>
				</div>

				<div class="course-grid-list">
					<div class="tab-content" id="myTabContent">                
						<div>
							<div class="course-grid-list">                                
							<div class="row">  
								<?php 
								if( get_theme_mod( 'product_view' ) =='grid' ):
								do_action( 'product_tag' );
								else:
								do_action( 'product_List_tag' ); 
								endif; ?>
							</div>
							</div> 
						</div>
					</div>
				</div>

			</div>

			<?php
			$page_object = get_queried_object();
			$current_cat_slug = isset( $page_object->slug ) ? $page_object->slug : '';
			$current_cat_desc = isset( $page_object->slug ) ? $page_object->description : '';

			if( $current_cat_desc ):
			?>			
			<div class="col-md-12">
				<br><br><br>
				<div class="term-description"><?php echo wp_kses_post( $current_cat_desc ); ?></div>
			</div>
			<?php endif; ?>
			
		</div>
	</div>
</div>

<?php } else if( get_theme_mod( 'archive_type' ) == '2' ) { // Photography Archive

/*
Archive header
 */
do_action( 'product_search' ); ?> 

<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one">
	<div class="row">
		<?php 
		// Photography top filter ( specific photography filter action "photography_filter_header" )
		do_action( 'eidmart_top_filter_header' ); ?>
		<div class="col-md-12">
			<h3 class="download-arc-title"><?php the_archive_title(); ?></h3>
			<?php do_action( 'photography_tag_quary' ); ?>
		</div>

		<?php
		$page_object = get_queried_object();
		$current_cat_slug = isset( $page_object->slug ) ? $page_object->slug : '';
		$current_cat_desc = isset( $page_object->slug ) ? $page_object->description : '';

		if( $current_cat_desc ):
		?>
		<div class="col-md-12">
			<div class="term-description"><?php echo wp_kses_post( $current_cat_desc ); ?></div>
			<br><br><br>
		</div>
		<?php endif; ?>

	</div>
</div>

<?php } else if( get_theme_mod( 'archive_type' ) == '3' ) { // Graphcs Archive

/*
Archive header
 */
do_action( 'product_search' ); ?>

<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style padding-bottom-large">
    <div class="col-md-12">
        <div class="row">
            <?php do_action( 'eidmart_top_filter_header' ); ?>
            <?php do_action( 'graphicland_tag_quary' ); ?>

			<?php
			$page_object = get_queried_object();
			$current_cat_slug = isset( $page_object->slug ) ? $page_object->slug : '';
			$current_cat_desc = isset( $page_object->slug ) ? $page_object->description : '';

			if( $current_cat_desc ):
			?>			
			<div class="col-md-12">
				<br><br><br>
				<div class="term-description"><?php echo wp_kses_post( $current_cat_desc ); ?></div>
			</div>
			<?php endif; ?>

        </div>
    </div>
</div>

<?php
} else if( get_theme_mod( 'archive_type' ) == '4' ) { // Audio Archive

	/*
	Archive header
	 */
	do_action( 'product_search' ); ?>
	
	<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style audio-version padding-bottom-large">
		<div class="col-md-12">
			<div class="row">
				<?php do_action( 'eidmart_top_filter_header' ); ?>
				<?php do_action( 'audio_tag_quary' ); ?>
				
				<?php
				$page_object = get_queried_object();
				$current_cat_slug = isset( $page_object->slug ) ? $page_object->slug : '';
				$current_cat_desc = isset( $page_object->slug ) ? $page_object->description : '';

				if( $current_cat_desc ):
				?>			
				<div class="col-md-12">
					<br><br><br>
					<div class="term-description"><?php echo wp_kses_post( $current_cat_desc ); ?></div>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	
<?php
} else if( get_theme_mod( 'archive_type' ) == '5' ) { // Video Archive

	/*
	Archive header
	 */
	do_action( 'product_search' ); ?>
	
	<div class="<?php if( get_theme_mod( 'ark_width' ) == '2' ){ echo "container-fluid"; } else { echo "container"; } ?> graphicland-one graphicland-style video-filter padding-bottom-large">
		<div class="col-md-12 photography-filter">
			<div class="row">
				<?php do_action( 'eidmart_top_filter_header' ); ?>
				<?php do_action( 'video_tag_quary' ); ?>
				
				<?php
				$page_object = get_queried_object();
				$current_cat_slug = isset( $page_object->slug ) ? $page_object->slug : '';
				$current_cat_desc = isset( $page_object->slug ) ? $page_object->description : '';

				if( $current_cat_desc ):
				?>			
				<div class="col-md-12">
					<br><br><br>
					<div class="term-description"><?php echo wp_kses_post( $current_cat_desc ); ?></div>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	
<?php
} // End condition

get_footer();