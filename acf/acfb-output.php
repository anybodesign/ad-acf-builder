<?php 
	defined('ABSPATH') or die(); 
	function acfb_ouput() { 
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
			?>
			
		<?php if( $bg ) { ?>
		<div class="acfb-block--cta<?php if( $color && in_array('white_text', $color) ) { echo ' white'; } ?>" style="background-image: url(<?php echo $bg['url']; ?>); background-color: <?php echo $bgcolor; ?>;">
		<?php } else { ?>
		<div class="acfb-block--cta" style="background-color: <?php echo $bgcolor; ?>;">						
		<?php } ?>
		
			<div class="acfb-row">
					
					<div class="cta-text">
						<?php echo $text; ?>
						
						<?php if( $link ) { ?>
							<a href="<?php echo $link['url']; ?>" class="cta-btn" target="<?php echo $link['target']; ?>" style="color:<?php echo $btncolor; ?>; background-color: <?php echo $btnbg; ?>">
								<?php echo $link['title']; ?>
							</a>
						<?php } ?>
						
						
					</div>
			</div>
										
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
				$images = get_sub_field('gallery_block_img');
				$cols = get_sub_field('gallery_block_cols');
			?>
	
			<?php if( $title ) { ?>
			<div class="acfb-row">
				<h2><?php echo $title; ?></h2>
			</div>
			<?php } ?>
			
			<?php if( $images ): ?>
			<div class="acfb-row">
				
		        <?php foreach( $images as $image ): ?>
		        <div class="acfb-<?php echo $cols; ?>">
			        
			        <figure class="gallery-figure">
			            <a href="<?php echo $image['url']; ?>" title="<?php _e('Enlarge picture', 'ad-acfb'); ?>">
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
			<div class="acfb-row">
				
			<?php foreach( $content as $c ): ?>
				<div class="<?php echo $cols; ?> mid-6 small-6">
			        
			        <figure class="gallery-figure">
			            <a href="<?php echo get_permalink( $c->ID ); ?>">
				            <?php echo get_the_post_thumbnail( $c->ID, 'thumbnail' ); ?>
							<figcaption class="gallery-caption">
								<span class="gallery-title"><?php echo get_the_title( $c->ID ); ?></span>
								<?php //echo get_the_excerpt( $c->ID ); ?>
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

<?php }