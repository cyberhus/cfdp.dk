<?php
/*
Template Name: Oversigt foredrag
*/
?>

    <?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <div <?php post_class() ?> id="post-
        <?php the_ID(); ?>">
        <div class="content grid_12 clearfix">
            <div class="entry">

                <?php the_content(); ?>

            </div>

        </div>

        <div class="lectures-archive-intro">
            <h2>
                <?php the_field('archive_titel'); ?>
            </h2>
            <p>
                <?php the_field('archive_content'); ?>
            </p>
        </div>

        <ul id="filters" class="clearfix">
            <?php
                $terms = get_terms('foredrag_kategori');
                $count = count($terms);
                    echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">Vis alle</a></li>';
                if ( $count > 0 ){

                    foreach ( $terms as $term ) {

                        $termname = strtolower($term->name);
                        $termname = str_replace(' ', '-', $termname);
                        echo '<li><a href="javascript:void(0)" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
                    }
                }
            ?>
        </ul>

        <div class="lectures">

            <?php
          /* 
          Query the post 
          */
          $args = array( 'post_type' => 'foredrag', 'posts_per_page' => -1 );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); 

             /* 
             Pull category for each unique post using the ID 
             */
             $terms = get_the_terms( $post->ID, 'foredrag_kategori' );	
             if ( $terms && ! is_wp_error( $terms ) ) : 

                 $links = array();

                 foreach ( $terms as $term ) {
                     $links[] = $term->name;
                 }

                 $tax_links = join( " ", str_replace(' ', '-', $links));          
                 $tax = strtolower($tax_links);
             else :	
             $tax = '';					
             endif; 
                        
             echo '<div class="all lecture-item '. $tax .'">';
             echo '<a class="image" href="'. get_permalink() .'" title="'. get_the_title() .'">';
             echo '<div class="post-image" style="background: url(' . get_the_post_thumbnail_url() .');background-position: 50% 50%;background-color: #F5F5F5;background-repeat: no-repeat;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;"></div>';
             echo '</a>'; 
             echo '<span class="price">Fra ';
             echo the_field('price');
             echo ' kr.</span>';
             echo '<a class="image" href="'. get_permalink() .'" title="'. get_the_title() .'"><h3>'. get_the_title() .'</h3></a>';
             echo '</div>'; 
          endwhile; ?>

        </div>

    </div>
    <?php endwhile; endif; ?>


    <?php get_footer(); ?>
