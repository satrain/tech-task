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
                <a class="btn" href="<?php the_field('hero_button_link'); ?>"><?php the_field('hero_button_text'); ?></a>
            </div>
        </div>
    </div>

    <div class="container welcome-wrapper">
        <div class="welcome">
            <div class="welcome-mock">
                <img src="<?php the_field('welcome_image'); ?>" alt="Address of Welcome image">
            </div>
            <div class="welcome-copy">
                <h2><?php the_field('welcome_heading'); ?></h2>
                <p><?php the_field('welcome_text'); ?></p>
                <a class="welcome-btn" href="<?php the_field('welcome_button_link'); ?>"><img src="/wp-content/uploads/2022/03/arrow-btn.png"> <?php the_field('welcome_button_text'); ?></a>
            </div>
        </div>
    </div>

</main>
<?php get_footer(); ?>