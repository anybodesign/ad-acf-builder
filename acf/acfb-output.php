<?php 
	defined('ABSPATH') or die(); 
	function acfb_ouput() {
		
		
	if (function_exists('have_rows')) {	 
?>
	
	<div class="ad-acf-builder">
	
	<?php if ( have_rows('page_builder') ) : ?>
	<?php while ( have_rows('page_builder') ) : the_row(); ?>
	
	
	<?php
			/* - - - - - - - - - -
			//
			// Text Section
			// 		
			// - - - - - - - - - - */
	?>
		
		<?php if ( get_row_layout() == 'text_block' ): ?>
		
		<div class="acfb-block--text">
			<?php 
				$layout = get_sub_field('text_block_layout');
				$content = get_sub_field('text_block_group');
				
				$text1 = $content['text_block_area1'];
				$text2 = $content['text_block_area2'];
				$text3 = $content['text_block_area3'];
			?>
			<div class="acfb-row">
			<?php if ( $layout == '1col' ) { ?>
	        	
	        	<div class="acfb-column">
		        	<?php echo $text1;?>
	        	</div>
	        	
			<?php } elseif ( $layout == '2col' ) { ?>
	      
	        	<div class="acfb-column">
		        	<?php echo $text1;?>
	        	</div>
	        	<div class="acfb-column">
		        	<?php echo $text2;?>
	        	</div>
	
			<?php } elseif ( $layout == '3col' ) { ?>
			
				<div class="acfb-column">
		        	<?php echo $text1;?>
	        	</div>
	        	<div class="acfb-column">
		        	<?php echo $text2;?>
	        	</div>
	        	<div class="acfb-column">
		        	<?php echo $text3;?>
	        	</div>
	        	
			<?php } ?>
			</div>
		
		</div>	
	
	
			
	<?php
			/* - - - - - - - - - -
			//
			// CTA Section
			// 		
			// - - - - - - - - - - */
	?>
			
		<?php elseif ( get_row_layout() == 'cta_block' ): ?>	
	
			<?php 
				$text = get_sub_field('cta_block_text');
				$link = get_sub_field('cta_block_link');
				
				$style = get_sub_field('cta_block_style');
				
				$btncolor = $style['cta_block_btncolor'];			
				$btnbg = $style['cta_block_btnbg'];			
				$color = $style['cta_block_color'];
				$bg = $style['cta_block_bg'];
				$bgcolor = $style['cta_block_bgcolor'];
				$blkover = $style['cta_block_overlay'];
			?>
			
		<?php if( $bg ) { ?>
		<div class="acfb-block--cta acfb-block--cta-img<?php if( $color && in_array('white_text', $color) ) { echo ' acfb-white'; } ?><?php if( $blkover && in_array('balck_overlay', $blkover) ) { echo ' acfb-overlay'; } ?>" style="background-image: url(<?php echo $bg['url']; ?>); background-color: <?php echo $bgcolor; ?>;">
		<?php } else { ?>
		<div class="acfb-block--cta<?php if( $color && in_array('white_text', $color) ) { echo ' acfb-white'; } ?>" style="background-color: <?php echo $bgcolor; ?>;">						
		<?php } ?>
			
			<?php if( $text ) { ?>
			<div class="acfb-cta-text">
				<?php echo $text; ?>
			</div>
			<?php } ?>

			<?php if( $link ) : ?>
			<a href="<?php echo $link['url']; ?>" class="acfb-cta-btn" target="<?php echo $link['target']; ?>" style="color:<?php echo $btncolor; ?>; background-color: <?php echo $btnbg; ?>">
				<?php echo $link['title']; ?>
			</a>
			<?php endif; ?>
										
		</div>	
	
		
		
	<?php
			/* - - - - - - - - - -
			//
			// Photo Gallery
			// 		
			// - - - - - - - - - - */
	?>
		
		<?php elseif ( get_row_layout() == 'gallery_block' ): ?>								
		
		<div class="acfb-block--gallery">
			<?php 
				$title = get_sub_field('gallery_block_title');
				$cols = get_sub_field('gallery_block_cols');
				$images = get_sub_field('gallery_block_img');
			?>
	
			<?php if( $title ) { ?>
			<div class="acfb-row">
				<h2><?php echo $title; ?></h2>
			</div>
			<?php } ?>
			
			<?php if( $images ): ?>
			<div class="acfb-gallery-row">
				
		        <?php foreach( $images as $image ): ?>
		        <div class="acfb-<?php echo $cols; ?>">
			        
			        <figure class="acfb-gallery-figure">
			            <a href="<?php echo $image['url']; ?>" title="<?php _e('Enlarge picture', 'ad-acfb'); ?>">
				            <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
							<?php if ( $image['caption'] ) { ?>
							<figcaption class="acfb-gallery-caption">
								<span class="acfb-caption-title"><?php echo $image['caption']; ?></span>
							</figcaption>
							<?php } ?>
				        </a>
				    </figure>
				    
		        </div>
		        <?php endforeach; ?>
		        
			</div>
			<?php endif; ?>							
		
		</div>
	
	

	<?php
			/* - - - - - - - - - -
			//
			// Content Gallery
			// 		
			// - - - - - - - - - - */
	?>
		
		<?php elseif ( get_row_layout() == 'content_gallery_block' ): ?>	
		
		<div class="acfb-block--content-gallery">
			<?php 
				$title = get_sub_field('content_gallery_block_title');
				$cols = get_sub_field('content_gallery_block_cols');					
				$content = get_sub_field('content_gallery_block_content');
			?>
			
			<?php if( $title ) { ?>
			<div class="acfb-row">
				<h2><?php echo $title; ?></h2>
			</div>
			<?php } ?>
			
			<?php if( $content ): ?>
			<div class="acfb-gallery-row">
				
			<?php foreach( $content as $c ): ?>
				<div class="acfb-<?php echo $cols; ?>">
			        
			        <figure class="acfb-gallery-figure">
			            <a href="<?php echo get_permalink( $c->ID ); ?>">
				            
				            <?php //echo get_the_post_thumbnail( $c->ID, 'thumbnail' ); ?>
				            
				            <?php if ( has_post_thumbnail( $c->ID ) ) { 
				            	echo get_the_post_thumbnail( $c->ID, 'thumbnail'); 
				            } else { ?>

							<?php echo '<img src="' . ACFB_PATH .'/img/fallback.png" alt="no picture">'; ?> 
					             
				           <?php } ?>
				            
							<figcaption class="acfb-gallery-caption">
								<span class="acfb-caption-title"><?php echo get_the_title( $c->ID ); ?></span>
							</figcaption>
				        </a>
				    </figure>
				    
				</div>
			<?php endforeach; ?>
			
			</div>
			<?php endif; ?>							
	
		</div>
		


	
		<?php endif; // BUILDER Layouts End Here ?>
		
	<?php endwhile; ?>
	<?php endif; ?>
	
	</div>

<?php } }