<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
	    <div id="woks">
	        <?php
			    $myQuery = new WP_Query(); // WP_Queryオブジェクト生成
			    $param = array( //パラメータ。
			        'posts_per_page' => '10', //（整数）- 1ページに表示する記事数。-1 ならすべての投稿を取得。
			        'post_type' => 'works', //カスタム投稿タイプのみを指定。
			        'post_status' => 'publish', //取得するステータスを指定：publish（公開済み）
			        'orderby' => 'ID',
			        'order' => 'DESC' //降順。大きい値から小さい値の順。
			    );
			    $myQuery->query($param);  // クエリにパラメータを渡す
			?>
			<ul>
				<?php if($myQuery->have_posts()): while($myQuery->have_posts()) : $myQuery->the_post(); ?>
			        <li>
			        	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>の詳細へ">
			        		<?php the_title(); ?>
			        		<?php 
				        		$area = get_field('works_description');
				        		if($area){
				        			?><p>テキストエリア：<? echo $area; ?></p><?
				        		}
			        		?>
			        	</a>
			        	<?php
			        		if (has_post_thumbnail() ) {
			        			//アイキャッチがあれば img タグの画像を返す。
			        			//画像サイズは medium で出力しています。
			        			echo get_the_post_thumbnail($post->ID, 'medium');
			        		} else {
			        			//アイキャッチがない場合は代替画像を表示。
			        			echo '<img src="代替画像のURL">';
			        		}
			        	?>
			        </li>
				<?php endwhile; endif; ?>
			</ul>
	    </div>
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
