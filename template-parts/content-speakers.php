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
        <h2 class="sessions-heading"> Sessions </h2>
        <?php 
		    $post_objects = get_field('sessions');

            if( $post_objects ): ?>
                <ol class="sessions-list">
                <?php foreach( $post_objects as $post_object): ?>
                    <li>
                        <a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
                    </li>
                <?php endforeach; ?>
                </ol>
            <?php endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
