<div class="p-sidebar">
	<?php
		$args = array(
			'post_type' => 'book',
			'no_found_rows' => true
		);
		$wp_query = new WP_Query( $args );
	?>
	<div class="widget widget_categories">
		<h2><i class="fa fa-folder-open" aria-hidden="true"></i>Book</h2>
		<ul>
			<?php
				if( $wp_query -> have_posts() ) :
					while ( $wp_query -> have_posts() ) :
						$wp_query -> the_post();
						?>
							<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
						<?php
					endwhile;
				else :
					?><li>投稿がないよ</li><?php
				endif;
				wp_reset_postdata();
			?>
		</ul>
	</div>

	<?php if ( is_active_sidebar( 'category_widget' ) ) { dynamic_sidebar( 'category_widget' ); } ?>
	<?php if ( is_active_sidebar( 'tag_widget' ) ) { dynamic_sidebar( 'tag_widget' ); } ?>
	<?php if ( is_active_sidebar( 'archive_widget' ) ) { dynamic_sidebar( 'archive_widget' ); } ?>
	<?php if ( is_active_sidebar( 'freedom_widget' ) ) { dynamic_sidebar( 'freedom_widget' ); } ?>
	<?php
		// the_terms( 5, 'genre' );
		// if( $terms = get_the_terms( 5, 'genre' ) ) {
		// 	foreach( $terms as $term ) {
		// 		echo esc_html( $term -> name );
		// 	}
		// }
	?>
	<?php if( is_home() ) : ?>
		<div class="widget widget_categories">
			<?php
				//$argsのプロパティを変更することでカスタマイズ
				$args = array(
					'post_type' => 'book',
					'no_found_rows'  => true
				);
				$wp_query = new WP_Query( $args );
			?>
			<ul>
				<?php
					if ( $wp_query -> have_posts() ) :
						while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
							/* ループ内の記述 */
							?>
								<li><a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a></li>
							<?php
						endwhile;
					endif;
					wp_reset_postdata();
				?>
			</ul>
		</div>
	<?php endif; ?>
</div>
