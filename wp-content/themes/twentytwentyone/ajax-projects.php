<?php
/**
 * Template Name: Ajax Project
 */
get_header();
?>
<div class="container">
            <div class="center-content">
<div id="projects-list">
</div>
</div>
</div>

<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
    // Make the Ajax request
    $.ajax({
        url: ajaxurl, // WordPress Ajax URL
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'custom_get_projects', // The action you defined in your PHP code
        },
        success: function(response) {
            if (response.success) {
                // Clear previous data
                $('#projects-list').empty();
                
                // Process the data and append to the list
                response.data.forEach(function(project) {
                    $('#projects-list').append(
                        '<div class="project">' +
                        '<h2>' + project.title + '</h2>' +
                        '<p>ID: ' + project.id + '</p>' +
                        '<p><a href="' + project.link + '">View Project</a></p>' +
                        '</div>'
                    );
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
});

</script>