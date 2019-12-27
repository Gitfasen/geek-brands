<?php
/**
 * Footer file
 *
 * @package animo
 * @since 1.0
 */
?>
	
  <?php animo_footer_template(animo_get_opt('footer-template')); ?>
  <div class="bottom-footer">
    <div class="container">
      <div class="row">
          <div class="col-6 col-sm-6 col-md-6">
          <div class="copyright">© <?php echo date("Y"); ?>, <?php bloginfo( 'name' ); ?></div>
        </div><!-- /col-md-12 -->
        <!-- <div class="col-6 col-sm-6 col-md-6">
          <div class="developing">
          <a href="https://lpunity.com" rel="noopener" target="_blank" class="lp">Разработка</a>
          </div>
        </div>/col-md-12 -->
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /bottom-footer -->
  
  <?php if(animo_get_opt('scroll-to-top')): ?>
  <a href="javascript:" id="return-to-top"><span class="icon-chevron-up"></span></a>
  <?php endif;?>
	</div> <!--end of wrapper-->
  <?php wp_footer(); ?>
  </body>
</html>
