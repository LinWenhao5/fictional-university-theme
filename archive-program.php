<?php
get_header();
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone. Have a look around'
));
?>
  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
    <?php
      while(have_posts())
      {
        the_post();
      ?>
        <li><a href="<?php permalink_link() ?>"><?php the_title() ?></a></li>
    <?php  
      }
    ?>
    </ul>
    <?php echo paginate_links() ?>
  </div>
<?php
get_footer();
?>