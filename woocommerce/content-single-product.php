<?php
/**
 * The template for displaying product content in the single-product.php template
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $product;
/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-12 col-lg-6">
        <?php if (wp_is_mobile()):?>
        <?php echo animo_breadcrumbs(); ?>
<?php do_action( 'woocommerce_new_title' ); ?>
<?php else:?>
<?php endif;?>
            <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
            ?>
        </div>

        <div class="col-12 col-lg-6">
<?php if (wp_is_mobile()):?>
<?php else:?>
<?php echo animo_breadcrumbs(); ?>
        <?php do_action( 'woocommerce_new_title' ); ?>
<?php endif;?>
       

            <?php
                /**
                 * Hook: Woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
            ?>
<?php $hasattributes = $product->get_attributes();
if( ! empty( $hasattributes ) ):?>

<div class="product-block__propertys-cont">
    <div class="footer-widget-title">Характеристики</div>
    <table class="prop-table width-full">
        <tbody>
            <?php foreach( $product->get_attributes() as $attr_name => $attr ) {?>
            <tr>
                <td class="prop-table__cell prop-table__cell--title">
                    <div class="prop-table__cell-crop">
                        <div class="prop-table__cell-wrap">
                            <div class="prop-table__cell-text">
                                <?php  echo wc_attribute_label( $attr_name );?>
                            </div>
                        </div>
                    </div>
                </td>

                <?php foreach( $attr->get_terms() as $term ){?>

                <td class="prop-table__cell prop-table__cell--val" align="right">
                    <div class="prop-table__cell-crop">
                        <div class="prop-table__cell-wrap">
                            <div class="prop-table__cell-text">
                                <?php echo $term->name; }?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php  } ?>
           
        </tbody>
    </table>
</div>

<?php else:?>
<?php endif;?>
 
<div class="btn-block row">
    <div class="col-6 col-sm-4 col-md-4">
<a href="#vopros" class="btn bordered">Задать вопрос <span class="icon-arrow-right"></span></a>
</div>
<div class="col-6 col-sm-4 col-md-4">
    <a href="#calc" class="btn orange">Расчет онлайн <span class="icon-calculator2"></span></a> 
    </div>
    <div class="col-12 col-sm-4 col-md-4">
<a href="#zamer" class="btn m-top">Вызвать замерщика <span class="icon-arrow-right"></span></a>
</div>
</div>

        </div>
    </div>

    <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
    ?>
</div><!-- product end -->

<?php do_action( 'woocommerce_after_single_product' ); ?>