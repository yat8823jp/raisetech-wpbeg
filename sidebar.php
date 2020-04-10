<div class="p-sidebar">
	<!-- <?php if ( is_active_sidebar( 'category_widget' ) ) { dynamic_sidebar( 'category_widget' ); } ?>
	<?php if ( is_active_sidebar( 'tag_widget' ) ) { dynamic_sidebar( 'tag_widget' ); } ?>
	<?php if ( is_active_sidebar( 'archive_widget' ) ) { dynamic_sidebar( 'archive_widget' ); } ?>
	<?php if ( is_active_sidebar( 'freedom_widget' ) ) { dynamic_sidebar( 'freedom_widget' ); } ?> -->
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
					'no_found_rows'  => true,
					'meta_query' => array(                  //カスタムフィールドに関するパラメーターをまとめた配列
						'relation' => 'AND',                  //AND : 条件1,2をどちらも満たすもの

						//条件1 ( 'book_author' というカスタムフィールドが 'サンプル著者' のもの )
						array(
						  'key' => 'book_author',             //カスタムフィールドのキーの指定
						  'value' => array( 'サンプル著者' ),    //カスタムフィールドの値の指定
						  'type' => 'CHAR',                   //カスタムフィールドの値の型が何か教える
						  'compare' => 'IN'                   //IN : 'value'パラメータで指定した値のいずれかに一致
						),

						//条件2　（ 'book_price' の値が 0 以上で、かつ、'book_isbn' が '' と一致しないカスタムフィールドの値を持つもの）
						array(
							'relation' => 'AND',              //AND : 条件A,Bを両方満たすもの

							//条件2を形成する条件A (priceというカスタムフィールドの値が0以上)
							array(
							  'key' => 'book_price',
							  'value' => 0,
							  'type' => 'NUMERIC',
							  'compare' => '>'
							),

							//条件2を形成する条件B (sizeをいうカスタムフィールドの値が''と一致しない（空白でない） )
							array(
							  'key' => 'book_isbn',
							  'value' => '',
							  'compare' => '!='
							)
						)
					)
				);
				$wp_query = new WP_Query( $args );
				// $post_count  = $wp_query -> post_count;   //実際にそのページで取得した件数
				// $found_posts = $wp_query -> found_posts;  //条件に当てはまる全件数
				// echo "post_count" . $post_count . "<br>";
				// echo "found_posts" . $found_posts . "<br>";
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
