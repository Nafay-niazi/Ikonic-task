<?php

/**
 * Template Name: Coffee Page
 */
get_header();
?>
<div class="container">
    <div class="center-content">
        <h2>Coffee image link:</h2>

        <?php
        $coffee_link = hs_give_me_coffee();
        echo '<img style="height:300px;object-fit:cover; margin-top:30px;" src="' . esc_url($coffee_link) . '" alt="Random Coffee">';
        ?>
    </div>
</div>

<?php
get_footer();
