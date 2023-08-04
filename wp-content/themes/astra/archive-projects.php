<?php get_header(); ?>
<div id="primary">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><?php the_title(); ?></h2>
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'project_type');
                    if ($categories && !is_wp_error($categories)) {
                        echo '<div class="category-list">';
                        foreach ($categories as $category) {
                            echo '<span class="category"> Type: <small><i>' . esc_html($category->name) . '</i></small></span>';
                        }
                        echo '</div>';
                    }
                    ?>                    <?php the_content(); ?>
                </article>
            <?php endwhile; ?>

            <div class="pagination">
                <?php
                $pagination_args = array(
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                );
                echo paginate_links($pagination_args);
                ?>
            </div>

        <?php else : ?>
            <p>No projects found.</p>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>
