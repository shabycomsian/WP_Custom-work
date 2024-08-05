<?php
/**
* Template Name: Project
*/
?>
<style>
.main-content {
    padding: 50px;
}
</style>

<?php get_header(); ?>
<div class="main-content">
<div class="projects-archive">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 6,
        'paged' => $paged,
    );
    $projects_query = new WP_Query($args);
    ?>
<h1>Project Posts</h1>
    <?php if ($projects_query->have_posts()) : ?>
        <ul>
            <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>

        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $projects_query->max_num_pages,
                'prev_text' => 'Previous',
                'next_text' => 'Next',
            ));
            ?>
        </div>
    <?php else : ?>
        <p>No projects found</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</div>
    </br>
    <h1>Random coffee API</h1>
<?php echo do_shortcode("[random_coffee]"); ?>

</br>
    <h1>Kanye Quotes  API</h1>
<?php echo do_shortcode("[kanye_quotes]"); ?>




    </div>
    <script>
    jQuery(document).ready(function($) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'fetch_projects',
            security: ajax_object.ajax_nonce
        },
        success: function(response) {
            if(response.success) {
                console.log(response.data);
            }
        }
    });
});
</script>
<?php get_footer(); ?>