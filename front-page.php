<?php
/* Template Name: Homepage Template */
get_header();
?>
<main id="primary" class="site-main">

    <div class="container hero-wrapper">
        <div class="hero" style="background: url('<?php the_field('hero_background'); ?>');">
            <div class="hero-copy">
                <p class="hero-notification"><?php the_field('hero_notification'); ?></p>
                <h1><?php the_field('hero_heading'); ?></h1>
                <p class="hero-subheading"><?php the_field('hero_subheading'); ?></p>
                <a class="btn" href="#"><?php the_field('hero_button_text'); ?></a>
            </div>
        </div>
    </div>

</main>
<?php get_footer(); ?>