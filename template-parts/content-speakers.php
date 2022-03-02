<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tech_Task
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="/speakers/" class="all-speakers-btn"><img src="/wp-content/uploads/2022/03/back-arrow.png"> All speakers</a>
	<div class="entry-wrapper">
		<div class="entry-copy">
		<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>

		<?php
		// entry content
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tech-task' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tech-task' ),
					'after'  => '</div>',
				)
			);
		?>
		</div>
		<div class="entry-thumbnail"><?php tech_task_post_thumbnail(); ?></div>
	</div>

	<div class="entry-cpt-sessions">
		<?php 
		$projectsLoop = new WP_Query(array('post_type' => 'sessions', 'posts_per_page' => -1));
		echo '<h2 class="sessions-heading"> Sessions: </h2>';
		echo '<ol class="sessions-list">';
			while ($projectsLoop->have_posts()) : $projectsLoop->the_post();
				$title = get_the_title();
				$href = get_the_permalink();
				echo "<li><a href='$href'>$title</a></li>";
			endwhile;
		echo '</ol>';
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
