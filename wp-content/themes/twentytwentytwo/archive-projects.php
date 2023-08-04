<?php get_header(); ?>
<div id="primary">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </article>
            <?php endwhile; ?>

            <div class="pagination">
                <div class="pagination__prev"><?php previous_posts_link('Previous'); ?></div>
                <div class="pagination__next"><?php next_posts_link('Next'); ?></div>
            </div>

        <?php else : ?>
            <p>No projects found.</p>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>
