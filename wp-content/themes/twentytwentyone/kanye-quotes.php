<?php

/**
 * Template Name: Quots Page
 */

get_header();
?>
<div class="container">
    <div class="center-content">
        <div class="kanye-quotes">
            <h2>Five Quots display:</h2>
            <?php
            $quotes = get_kanye_quotes(5);
            if (!empty($quotes)) {
                echo '<ul>';
                foreach ($quotes as $quote) {
                    echo '<li>' . esc_html($quote) . '</li>';
                }
                echo '</ul>';
            } else {
                echo 'Unable to fetch Kanye quotes at the moment.';
            }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
