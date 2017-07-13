<?php defined('ABSPATH') or die(); ?>


<div class="ad-acf-builder">

<?php if ( have_rows('page_builder') ) : ?>
<?php while ( have_rows('page_builder') ) : the_row(); ?>


<?php // Text Section ///////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php if ( get_row_layout() == 'text_block' ): ?>
	
	<div class="pb-block--text">
		<?php 
			$layout = get_sub_field('text_block_layout');
			$text1 = get_sub_field('text_block_area1');
			$text2 = get_sub_field('text_block_area2');
			$text3 = get_sub_field('text_block_area3');
		?>
		<div class="row inner nested">
		<?php if ( $layout == '1col' ) { ?>
        	
        	<div class="col-12">
	        	<?php echo $text1;?>
        	</div>
        	
		<?php } elseif ( $layout == '2col' ) { ?>
      
        	<div class="col-6">
	        	<?php echo $text1;?>
        	</div>
        	<div class="col-6">
	        	<?php echo $text2;?>
        	</div>

		<?php } elseif ( $layout == '3col' ) { ?>
		
			<div class="col-4">
	        	<?php echo $text1;?>
        	</div>
        	<div class="col-4">
	        	<?php echo $text2;?>
        	</div>
        	<div class="col-4">
	        	<?php echo $text3;?>
        	</div>
        	
		<?php } ?>
		</div>
	
	</div>	

	
	
<?php // Gallery (Content) ///////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ( get_row_layout() == 'content_gallery_block' ): ?>	
	
	<div class="pb-block--content-gallery">
		<?php 
			$title = get_sub_field('content_gallery_block_title');
			$content = get_sub_field('content_gallery_block_content');
			$cols = get_sub_field('content_gallery_block_cols');					
		?>
		
		<?php if( $title ) { ?>
		<div class="row inner">
			<h2><?php echo $title; ?></h2>
		</div>
		<?php } ?>
		
		<?php if( $content ): ?>
		<div class="row inner nested">
			
		<?php foreach( $content as $content_object): ?>
			<div class="<?php echo $cols; ?> mid-6 small-6">
		        <figure class="gallery-figure">
		            <a href="<?php echo get_permalink($content_object->ID); ?>">
			            <?php if ( has_post_thumbnail( $content_object->ID ) ) { 
			            	echo get_the_post_thumbnail($content_object->ID, 'thumbnail'); 
			            } else { ?>
				            <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/fallback-image.png" alt="image de remplacement"> 
			           <?php } ?>
						<figcaption class="gallery-caption">
							<span class="gallery-title"><?php echo get_the_title($content_object->ID); ?></span>
							<?php echo get_the_excerpt($content_object->ID); ?>
						</figcaption>
			        </a>
			    </figure>
			</div>
		<?php endforeach; ?>
		
		</div>
		<?php endif; ?>							

	</div>



<?php // Gallery (Images) ///////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ( get_row_layout() == 'gallery_block' ): ?>								
	
	<div class="pb-block--gallery">
		<?php 
			$title = get_sub_field('gallery_block_title');
			$images = get_sub_field('gallery_block_img');
			$cols = get_sub_field('gallery_block_cols');
		?>

		<?php if( $title ) { ?>
		<div class="row inner">
			<h2><?php echo $title; ?></h2>
		</div>
		<?php } ?>
		
		<?php if( $images ): ?>
		<div class="row inner nested">
			
	        <?php foreach( $images as $image ): ?>
	        <div class="<?php echo $cols; ?> mid-6 small-6">
		        <figure class="gallery-figure">
		            <a href="<?php echo $image['url']; ?>" class="simplelightbox">
			            <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
						<?php if ( $image['caption'] ) { ?>
						<figcaption class="gallery-caption">
							<?php echo $image['caption']; ?>
						</figcaption>
						<?php } ?>
			        </a>
			    </figure>
	        </div>
	        <?php endforeach; ?>
	        
		</div>
		<?php endif; ?>							
	
	</div>
	
		
	
<?php // CTA Section ///////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ( get_row_layout() == 'cta_block' ): ?>	

		<?php 
			$text = get_sub_field('cta_block_text');
			$link = get_sub_field('cta_block_link', false, false);
			$url = get_sub_field('cta_block_url');
			$btntext = get_sub_field('cta_block_link_title');
			$bg = get_sub_field('cta_block_bg');
			$color = get_sub_field('cta_block_color');
		?>
	<?php if( $bg ) { ?>
	<div class="pb-block--cta<?php if( $color && in_array('white_text', $color) ) { echo ' white'; } ?>" style="background-image: url(<?php echo $bg['url']; ?>);">
	<?php } else { ?>
	<div class="pb-block--cta">						
	<?php } ?>
	
		<div class="row inner x-center">
			<div class="col-8">
				
				<div class="cta-text">
					<?php echo $text; ?>
					
					<?php if( $link ) { ?>
						<a href="<?php echo get_the_permalink($link); ?>" class="action-btn">
							<?php if( $btntext ) {
								echo $btntext;
							} else {
								echo get_the_title($link);	
							} ?>
						</a>
					<?php } ?>
					
					<?php if( $url ) { ?>
						<a href="<?php echo $url; ?>" class="action-btn">
							<?php if( $btntext ) {
								echo $btntext;
							} else {
								_e('Read more', 'ad-acfb');	
							} ?>
						</a>
					<?php } ?>
				</div>

			</div>
		</div>
									
	</div>	


<?php // Map Section ///////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ( get_row_layout() == 'gmap_block' ): ?>	
	
	<div class="pb-block--map">
		<?php 
		
		$location = get_sub_field('gmap_block_map');
		
		if( !empty($location) ):
		?>
		<div class="acf-map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
		<?php get_template_part( 'template-parts/gmap' ); ?>
		<?php endif; ?>							
		
	</div>						
	
	<?php endif; ?>
	
	
	
	
<?php endwhile; ?>
<?php endif; ?>

</div>