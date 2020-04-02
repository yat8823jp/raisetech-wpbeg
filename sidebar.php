<div class="p-sidebar">
	<?php if ( is_active_sidebar( 'category_widget' ) ) { dynamic_sidebar( 'category_widget' ); } ?>
	<?php if ( is_active_sidebar( 'tag_widget' ) ) { dynamic_sidebar( 'tag_widget' ); } ?>
	<?php if ( is_active_sidebar( 'archive_widget' ) ) { dynamic_sidebar( 'archive_widget' ); } ?>
	<?php if ( is_active_sidebar( 'freedom_widget' ) ) { dynamic_sidebar( 'freedom_widget' ); } ?>
	<?php
		the_terms( 5, 'genre' );
		if( $terms = get_the_terms( 5, 'genre' ) ) {
			foreach( $terms as $term ) {
				echo esc_html( $term -> name );
			}
		}
	?>
</div>
