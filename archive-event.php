<?php
get_header();
pageBanner(array(
  'title' => 'All Event',
  'subtitle' => 'See what is going on in our world'
));
?>

  <div class="container container--narrow page-section">
    <?php
      while(have_posts())
      {
        the_post();
        get_template_part('template_parts/content', 'event');
      }
    ?>
    <?php echo paginate_links() ?>
    <hr class="section-break">
    <p>Looking for a recap of past events? <a href="<?php echo site_url('past-event')?>">check out our past event archive</a></p>
  </div>
<?php
get_footer();
?>