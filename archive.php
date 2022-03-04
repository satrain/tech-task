<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tech_Task
 */

get_header();
?>
	<main id="primary" class="site-main">


	<?php 
	
	$args = array(
        'post_type' => 'speakers',
        'post_status' => 'publish',
        'posts_per_page' => '20',
		'order' => 'ASC',
      );
      $cpt = new WP_Query( $args ); ?>


		<?php if ( $cpt->have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				// the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="archive-main-wrapper">
				<div class="archive-sidebar-filter">
				<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

					<div>
						<h3>Position</h3>
						<?php
						if( $groups = get_terms( array( 'taxonomy' => 'positions' ) ) ) :
							echo '<ul class="groups-list">';
							foreach( $groups as $group ) :
							echo '<input type="checkbox" class="" id="positions_' . $group->term_id . '" name="positions_' . $group->term_id . '" /><label for="positions_' . $group->term_id . '">' . $group->name . '</label><br>';
							endforeach;
							echo '</ul>';
						endif;
						?>
					</div>
						<br>
					<div>
						<h3>Country</h3>
						<?php
						if( $teachers = get_terms( array( 'taxonomy' => 'countries' ) ) ) :
							echo '<ul class="teachers-list">';
							foreach( $teachers as $teacher ) :
							echo '<input type="checkbox" class="" id="countries_' . $teacher->term_id . '" name="countries_' . $teacher->term_id . '" /><label for="countries_' . $teacher->term_id . '">' . $teacher->name . '</label><br>';
												
							endforeach;
							echo '</ul>';
						endif;
						?>
					</div>

					<input type="hidden" name="action" value="myfilter">
				</form>
				</div>
				<div class="archive-list-wrapper">
				<?php
				/* Start the Loop */
				while ( $cpt->have_posts() ) :
					$cpt->the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content-all-speakers', get_post_type() );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
			</div>
		</div>

		<button id="more_posts" class="btn">Load More</button>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
