<?php get_header(); ?>

		<?php if (have_posts()) : ?>
		<div class="archive content grid_12 clearfix">

 			
            
            <div class="results widget_siteorigin-panels-postloop">

                    <?php while (have_posts()) : the_post(); ?>
                                
                    <div class="post">
                        <a class="image" href="<?php the_permalink(); ?>">
                        <div class="post-image" style="background: url('<?php the_post_thumbnail_url(); ?>');background-position: 50% 50%;
                            background-color: #F5F5F5;
                            background-repeat: no-repeat;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;"></div>            
                        </a>
                        <span class="post-tags">Kategorier:
                            <?php 
                                $taxonomy = 'category';

                                // get the term IDs assigned to post.
                                $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
                                // separator between links
                                $separator = ' · ';
                                $categories = get_the_category();
                                $parentid = $categories[0]->category_parent;

                                if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {

                                    $term_ids = implode( ',' , $post_terms );
                                    $terms = wp_list_categories( 'title_li=&style=none&echo=0&child_of=' . $parentid . '&taxonomy=' . $taxonomy . '&include=' . $term_ids );
                                    $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

                                    // display post categories
                                    echo  $terms;
                                }
                            ?>
                        </span>
                        <a href="<?php the_permalink(); ?>">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                        </a>

                        <p class="text">
                            <?php truncate(get_the_excerpt(), 180) ?>
                        </p>
                    </div>          
                
                    <?php endwhile; ?>

                    <div class="paging clearfix"><?php wp_pagenavi(); ?></div>
            </div>

	<?php else : ?>

		<h2>Intet fundet</h2>
	</div>

	<?php endif; ?>

</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	    lastBlock = $("#nav4 div.tabOpen");
	});
</script>
<?php get_footer(); ?>
