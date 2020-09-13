
<?php get_header(); 

$format = get_post_format();

?>
            <div class="inner-wrapper">
                <div id="post_<?php the_ID(); ?>" <?php echo post_class("content page-content"); ?>>
                    <div class="content-row">
                        <div class="col-sma-12">
                            <div class="content__body">
                                <?php while (have_posts()) : the_post(); //You need a while loop to call the_author(). ?>
                                <?php if( $format === "standard" || ( $format !== "image" && $format !== "video" ) ) { ?>
                                <div class="blog">
                                    <div class="blog__title"><?php the_title(); ?></div>
                                    <div class="blog__categories">
                                        <?php
                                        $categories = get_the_category();
                                        $h = 0;
                                        foreach ( $categories as $category ) {
                                            $h++;
                                        }
                                        $h = $h - 1;
                                        $i = 0;
                                        foreach ( $categories as $category ) {
                                            $result = "";
                                            if ( $i < $h ) {
                                                $result .= $category->name . ", ";
                                            } else {
                                                $result .= $category->name;
                                            }
                                            echo $result;
                                            $i++;
                                        }
                                    ?>
                                    </div>
                                    <div class="blog__tags"><?php the_tags(); ?></div>
                                    <div class="blog__author">By: <?php the_author(); ?></div>
                                    <div class="blog__date"><?php echo get_the_date(); ?></div>
                                    <div class="blog__content"><?php the_content(); ?></div>
                                    <?php if( has_post_thumbnail() ) { echo "<div class='blog__image' style=\"background-image: url('" . get_the_post_thumbnail_url() . "')\"></div>"; } ?>
                                    <?php 
                                        if( comments_open() ) {
                                            comments_template();
                                        } 
                                    ?>
                                </div>
                                <?php } else if( $format === "image" ) { ?>
                                <div class="blog">
                                    <div class="blog__title"><?php the_title(); ?></div>
                                    <?php if( has_post_thumbnail() ) { echo "<div class='blog__image' style=\"background-image: url('" . get_the_post_thumbnail_url() . "')\"></div>"; } ?>
                                    <div class="blog__author">By: <?php the_author(); ?></div>
                                    <div class="blog__date"><?php echo get_the_date(); ?></div>
                                    <div class="blog__categories">
                                        <?php
                                        $categories = get_the_category();
                                        $h = 0;
                                        foreach ( $categories as $category ) {
                                            $h++;
                                        }
                                        $h = $h - 1;
                                        $i = 0;
                                        foreach ( $categories as $category ) {
                                            $result = "";
                                            if ( $i < $h ) {
                                                $result .= $category->name . ", ";
                                            } else {
                                                $result .= $category->name;
                                            }
                                            echo $result;
                                            $i++;
                                        }
                                    ?>
                                    </div>
                                    <div class="blog__tags"><?php the_tags(); ?></div>
                                    <div class="blog__content"><?php the_content(); ?></div>                           
                                    <?php 
                                        if( comments_open() ) {
                                            comments_template();
                                        } 
                                    ?>
                                </div>
                                <?php } else if( $format === "video" ) { ?>
                                <div class="blog">
                                    <div class="blog__title"><?php the_title(); ?></div>
                                    <div class="blog__content"><?php the_content(); ?></div>  
                                    <div class="blog__author">By: <?php the_author(); ?></div>
                                    <div class="blog__date"><?php echo get_the_date(); ?></div>
                                    <div class="blog__categories">
                                        <?php
                                        $categories = get_the_category();
                                        $h = 0;
                                        foreach ( $categories as $category ) {
                                            $h++;
                                        }
                                        $h = $h - 1;
                                        $i = 0;
                                        foreach ( $categories as $category ) {
                                            $result = "";
                                            if ( $i < $h ) {
                                                $result .= $category->name . ", ";
                                            } else {
                                                $result .= $category->name;
                                            }
                                            echo $result;
                                            $i++;
                                        }
                                    ?>
                                    </div>
                                    <div class="blog__tags"><?php the_tags(); ?></div>
                                    <?php if( has_post_thumbnail() ) { echo "<div class='blog__image' style=\"background-image: url('" . get_the_post_thumbnail_url() . "')\"></div>"; } ?>
                                    <?php 
                                        if( comments_open() ) {
                                            comments_template();
                                        } 
                                    ?>
                                    <div class="clear-both"></div>
                                </div>
                                <?php } ?>
                                <?php wp_link_pages( array( 'before' => '<div class="post-nav-links"><span class="post-page-numbers">' . __( 'Pages:', 'bakery-morning') . '</span>', 'after' => '</div>' ) ); ?>
                                <?php endwhile; ?>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <?php get_footer(); ?>
