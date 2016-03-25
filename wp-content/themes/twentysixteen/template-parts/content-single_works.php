<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">

	<?php
		$area = get_field('works_description');
		if($area){
			?><p><? echo $area; ?></p><?
		}
		$photo01 = get_field('works_photo01');
		$imgurl01 = wp_get_attachment_image_src($photo01, 'full');
		$attachment01 = get_post( get_field('works_photo01') );
		$alt01 = get_post_meta($attachment01->ID, '_wp_attachment_image_alt', true);
		if($imgurl01){
			?><p><img src="<? echo $imgurl01[0]; ?>" alt="<? echo $alt01; ?>"></p><?
		}
		$photo02 = get_field('works_photo02');
		$imgurl02 = wp_get_attachment_image_src($photo02, 'full');
		$attachment02 = get_post( get_field('works_photo02') );
		$alt02 = get_post_meta($attachment02->ID, '_wp_attachment_image_alt', true);
		if($imgurl02){
			?><p><img src="<? echo $imgurl02[0]; ?>" alt="<? echo $alt02; ?>"></p><?
		}
		$photo03 = get_field('works_photo03');
		$imgurl03 = wp_get_attachment_image_src($photo03, 'full');
		$attachment03 = get_post( get_field('works_photo03') );
		$alt03 = get_post_meta($attachment03->ID, '_wp_attachment_image_alt', true);
		if($imgurl03){
			?><p><img src="<? echo $imgurl03[0]; ?>" alt="<? echo $alt03; ?>"></p><?
		}
	?>
		<?php
			

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
