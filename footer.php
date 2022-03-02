<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tech_Task
 */

?>
	<div class="footer-cta container">
		<h2>Do you have any <span>questions?</span></h2>
		<a href="#" class="welcome-btn"><img src="/wp-content/uploads/2022/03/arrow-btn.png"> Contact us</a>
	</div>
	<div class="footer-wrapper container">
		<footer id="colophon" class="site-footer">
			<div class="site-info">
				<a href="/"><img src="/wp-content/uploads/2022/03/footer-logo.png"></a>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
				<a href="#" class="welcome-btn"><img src="/wp-content/uploads/2022/03/arrow-btn.png"> Register</a>
			</div><!-- .site-info -->
			<div class="footer-congress">
				<img src="/wp-content/uploads/2022/03/footer-congress-image.png">
			</div>
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
