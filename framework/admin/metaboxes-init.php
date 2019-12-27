<?php

$redux_opt_name = REDUX_OPT_NAME;

function animo_redux_add_metaboxes($metaboxes) {

  // Variable used to store the configuration array of metaboxes
  $metaboxes = array();

  $metaboxes[] = animo_redux_get_page_template_blog_metaboxes();
  $metaboxes[] = animo_redux_get_page_metaboxes();
  $metaboxes[] = animo_redux_get_video_post_metaboxes();
  $metaboxes[] = animo_redux_get_gallery_post_metaboxes();
  $metaboxes[] = animo_redux_get_post_adv_metaboxes();


  return $metaboxes;
}
add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'animo_redux_add_metaboxes');

function animo_redux_get_page_template_blog_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/page-template-blog.php';
  return array(
    'id' => 'animo-template-blog-options',
    'title' => esc_html__('Blog Options', 'animo'),
    'post_types' => array('page'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'page_template' => array(
      'page-templates/blog-classic.php',
    )
  );
}

function animo_redux_get_page_template_portfolio_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/page-template-portfolio.php';
  return array(
    'id' => 'animo-template-portfolio-options',
    'title' => esc_html__('Portfolio Options', 'animo'),
    'post_types' => array('page'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'page_template' => array(
      'page-templates/portfolio.php',
    )
  );
}

function animo_redux_get_page_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/metadata.php';
  require get_template_directory() . '/framework/admin/metaboxes/layout.php';
  require get_template_directory() . '/framework/admin/metaboxes/header.php';
  require get_template_directory() . '/framework/admin/metaboxes/title-wrapper.php';
  require get_template_directory() . '/framework/admin/metaboxes/footer.php';
  require get_template_directory() . '/framework/admin/metaboxes/sidebar.php';

  return array(
    'id' => 'animo-page-options',
    'title' => esc_html__('Options', 'animo'),
    'post_types' => array('page'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections
  );
}

function animo_redux_get_video_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/post-video.php';

  return array(
    'id' => 'animo-video-post-options',
    'title' => esc_html__('Video Post Options', 'animo'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('video')
  );
}

function animo_redux_get_gallery_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/post-gallery.php';

  return array(
    'id' => 'animo-gallery-post-options',
    'title' => esc_html__('Gallery Post Options', 'animo'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('gallery')
  );
}

function animo_redux_get_post_adv_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_template_directory() . '/framework/admin/metaboxes/metadata.php';
  require get_template_directory() . '/framework/admin/metaboxes/header.php';
  require get_template_directory() . '/framework/admin/metaboxes/title-wrapper.php';
  require get_template_directory() . '/framework/admin/metaboxes/sidebar.php';
  require get_template_directory() . '/framework/admin/metaboxes/footer.php';

  return array(
    'id' => 'animo-post-adv-options',
    'title' => esc_html__('Options', 'animo'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections
  );
}
