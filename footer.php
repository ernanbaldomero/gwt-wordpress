<?php
/**
 * The template for displaying the footer
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

?>

<!-- Agency Footer -->
<?php
$footer_sidebars = array('footer-1', 'footer-2', 'footer-3', 'footer-4');
$has_active_sidebar = false;

foreach ($footer_sidebars as $sidebar) {
    if (is_active_sidebar($sidebar)) {
        $has_active_sidebar = true;
        break;
    }
}

if ($has_active_sidebar) : ?>
    <div id="footer" class="anchor" name="agencyfooter" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
        <div id="supplementary" class="row">
            <?php foreach ($footer_sidebars as $sidebar) : ?>
                <?php if (is_active_sidebar($sidebar)) : ?>
                    <div class="<?php govph_displayoptions('govph_position_agency_footer'); ?>" role="complementary">
                        <?php do_action('before_sidebar'); ?>
                        <?php dynamic_sidebar($sidebar); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Standard Footer -->
<div id="gwt-standard-footer"></div>

<!-- Standard Footer Script -->
<script type="text/javascript">
(function(d, s, id) {
    var js, gjs = d.getElementById('gwt-standard-footer');
    js = d.createElement(s);
    js.id = id;
    js.src = "//gwhs.i.gov.ph/gwt-footer/footer.js";
    gjs.parentNode.insertBefore(js, gjs);
}(document, 'script', 'gwt-footer-jsdk'));
</script>

<!-- Philippine Standard Time Script -->
<script type="text/javascript" id="gwt-pst">
(function(d, eId) {
    var js, gjs = d.getElementById(eId);
    js = d.createElement('script');
    js.id = 'gwt-pst-jsdk';
    js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?" + new Date().getTime();
    gjs.parentNode.insertBefore(js, gjs);
}(document, 'gwt-pst'));

var gwtpstReady = function() {
    var firstPst = new gwtpstTime('pst-time');
}
</script>

<?php wp_footer(); ?>

<!-- Back-to-Top Button -->
<div><a href="#page" id="back-to-top"><i class="fa fa-arrow-circle-up fa-2x"></i></a></div>

</body>
</html>
