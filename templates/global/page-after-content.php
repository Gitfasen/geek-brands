<?php
/**
 * After Loop. ( page.php )
 *
 * @package animo
 */
$layout = animo_get_opt('main-layout');
if ($layout == 'left_sidebar'): ?>
    </div>
<?php elseif ($layout == 'right_sidebar'): ?>
    </div>
    <?php get_sidebar(); ?>
<?php else: ?>

<?php endif; ?>
