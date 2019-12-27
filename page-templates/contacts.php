<?php
/**
 * Template Name: Контакты
 *
 * @package lptheme
*/
get_header();
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);
?>

<div class="page-content-wrapper">
  <div class="container">

    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="w-box contacts">

          <div class="phones-area cont_item">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path data-name="layer1" d="M48.5 40.2a4.8 4.8 0 0 0-6.5 1.3c-2.4 2.9-5.3 7.7-16.2-3.2S19.6 24.4 22.5 22a4.8 4.8 0 0 0 1.3-6.5L17 5.1c-.9-1.3-2.1-3.4-4.9-3S2 6.6 2 15.6s7.1 20 16.8 29.7S39.5 62 48.4 62s13.2-8 13.5-10-1.7-4-3-4.9z"
                  fill="#222222"></path>
              </svg>
              <span class="label">Телефоны</span></span>
            <a href="tel:+<?php $phone = get_field('phone_1', 'option'); $phone = preg_replace('![^0-9]+!', '', $phone);echo $phone;?>"
              class="tel">
              <?php the_field('phone_1', 'option'); ?></a>
            <a href="tel:+<?php $phone = get_field('phone_2', 'option'); $phone = preg_replace('![^0-9]+!', '', $phone);echo $phone;?>"
              class="tel">
              <?php the_field('phone_2', 'option'); ?></a>
            <a href="tel:+<?php $phone = get_field('phone_3', 'option'); $phone = preg_replace('![^0-9]+!', '', $phone);echo $phone;?>"
              class="tel">
              <?php the_field('phone_3', 'option'); ?></a>
            <a href="tel:+<?php $phone = get_field('phone_4', 'option'); $phone = preg_replace('![^0-9]+!', '', $phone);echo $phone;?>"
              class="tel">
              <?php the_field('phone_4', 'option'); ?></a>
          </div>


          <div class="email-area cont_item">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path data-name="layer1" fill="#222222" d="M2 14.7v34.4l17.2-17.5L2 14.7zm42.8 16.9L62 49.1V14.7L44.8 31.6z"></path>
                <path data-name="layer2" fill="#222222" d="M59.1 12H5l27 26.6L59.1 12z"></path>
                <path data-name="layer1" fill="#222222" d="M32 44.2l-10-9.8L4.7 52h54.6L42 34.4l-10 9.8z"></path>
              </svg>
              <span class="label">Наш e-mail</span></span>
            <a href="mailto:<?php the_field('email', 'option'); ?>" class="email-link"><?php the_field('email', 'option'); ?></a>
          </div>

          <div class="address-area cont_item">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path data-name="layer1" d="M32 2a20 20 0 0 0-20 20c0 18 20 40 20 40s20-22 20-40A20 20 0 0 0 32 2zm0 28a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"
                  fill="#222222"></path>
              </svg>
              <span class="label">Адрес</span></span>
            <div class="addres">
              <p><?php the_field('address', 'option'); ?></p>    
            </div>
          </div>

        </div>

        <div class="btn-block row">
            <div class="col-12">
              <a href="javascript:;" data-fancybox="" data-src="#vopros" class="map__btn btn-blue">Написать нам</a>
            </div>
          </div>

      </div><!-- /col-md-6 -->

      <div class="col-12 col-md-6 col-lg-8">
        <div class="w-box">
					<?php 	
					$location = get_field('acf_map', 'option');
					if( $location ): ?>
						<div id="map" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					<?php endif; ?>
        </div>
      </div>


    </div>
  </div><!-- /container -->

  <?php if (have_posts()): the_post();  the_content(); endif;  ?> 
  <?php get_template_part('templates/global/page-after-content');?>
</div>
</div>


<?php get_footer();
