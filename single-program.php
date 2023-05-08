<?php
    get_header();

    while(have_posts())
    {
        the_post(); 
        pageBanner();
        ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>">
            <i class="fa fa-home" aria-hidden="true"></i> All Programs</a> 
            <span class="metabox__main">
                <?php the_title() ?>
            </span></p>
        </div>
        <div class="generic-content">
            <div class="row-group">
                <div class="one-third">
                    <?php the_post_thumbnail() ?>
                </div>
                <div class="two_thirds">
                    <?php the_content() ?>
                </div>
              </div>
        </div>
        <!-- professor -->
        <?php

        $relatedProfessors = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'professor',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            )
          )
        ));
        if ($relatedProfessors->have_posts()) { 
            echo '<hr class="section-break" hr>';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
            while ($relatedProfessors->have_posts())
            {
            $relatedProfessors->the_post();
            ?>
            <li class="professor-card__list-item">
              <a class="professor-card" href="<?php echo the_permalink() ?>">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
                <span class="professor-card_name"><?php echo the_title() ?></span>
              </a>
            </li>
            <?php
            }
            ?>
        <?php
        }
        ?>
    <!-- event -->
        <?php
        wp_reset_postdata();
        $today = date('Ymd');
        $relatedEvents = new WP_Query(array(
          'posts_per_page' => 2,
          'post_type' => 'event',
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numric'
            ),
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"',
            )
          )
        ));
        if ($relatedEvents->have_posts()) { 
            echo '<hr class="section-break" hr>';
            echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Event</h2>';

            while ($relatedEvents->have_posts())
            {
            $relatedEvents->the_post();
            get_template_part('template_parts/content', 'event');
            ?>
            </div>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </div>
    </div>
    <?php }

    get_footer();
?>