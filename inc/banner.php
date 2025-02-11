<?php
/**
 * Banner template part for displaying banners, sliders, and titles.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

// Determine banner layout classes based on active sidebars.
$banner_layout = [
    'main' => 'gwt-large-12',
    'section_1' => '',
    'section_2' => '',
];

if (is_active_sidebar('banner-section-1') && is_active_sidebar('banner-section-2')) {
    $banner_layout['main'] = 'gwt-large-6';
    $banner_layout['section_1'] = 'gwt-large-3';
    $banner_layout['section_2'] = 'gwt-large-3';
} elseif (is_active_sidebar('banner-section-1') && !is_active_sidebar('banner-section-2')) {
    $banner_layout['main'] = 'gwt-large-8';
    $banner_layout['section_1'] = 'gwt-large-4';
} elseif (!is_active_sidebar('banner-section-1') && is_active_sidebar('banner-section-2')) {
    $banner_layout['main'] = 'gwt-large-8';
    $banner_layout['section_2'] = 'gwt-large-4';
}

// Determine container and line classes.
$container_class = is_home() ? '' : 'gwt-banner-pads';
$line_class = is_home() ? 'gwt-line' : '';
?>
<!-- Auxiliary Navigation -->
<div id="gwt-auxiliary" class="gwt-show-for-large">
    <div class="gwt-row">
        <div class="gwt-small-12 gwt-large-12 gwt-columns gwt-toplayer">
            <nav id="gwt-aux-main" class="gwt-nomargin gwt-show-for-medium-up" data-dropdown-content>
                <ul class="gwt-dropdown gwt-menu" data-dropdown-menu>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'aux_nav',
                        'items_wrap' => '%3$s',
                        'container' => false,
                        'fallback_cb' => false,
                        'walker' => new Topbar_Nav_Menu(),
                    ]);
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Banner Section -->
<div class="gwt-container-banner <?php echo esc_attr($container_class); ?>">
    <?php govph_displayoptions('govph_slider_start'); ?>

    <?php if (is_home()) : ?>
        <!-- Slider -->
        <?php if ($banner_slider = efs_get_slider()) : ?>
            <div id="gwt-banner-slider" class="<?php echo esc_attr($banner_layout['main']); ?>">
                <?php echo $banner_slider; ?>
            </div>
        <?php endif; ?>

        <!-- Banner Section 1 -->
        <?php if (is_active_sidebar('banner-section-1')) : ?>
            <div id="gwt-banner-section-1" class="<?php echo esc_attr($banner_layout['section_1']); ?>">
                <?php do_action('before_sidebar'); ?>
                <?php dynamic_sidebar('banner-section-1'); ?>
            </div>
        <?php endif; ?>

        <!-- Banner Section 2 -->
        <?php if (is_active_sidebar('banner-section-2')) : ?>
            <div id="gwt-banner-section-2" class="<?php echo esc_attr($banner_layout['section_2']); ?>">
                <?php do_action('before_sidebar'); ?>
                <?php dynamic_sidebar('banner-section-2'); ?>
            </div>
        <?php endif; ?>

    <?php else : ?>
        <!-- Page-Specific Titles -->
        <?php govph_displayoptions('govph_banner_title_start'); ?>
        <div class="gwt-large-9 gwt-columns gwt-container-main">
            <header>
                <?php if (is_404()) : ?>
                    <h1 class="gwt-page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'gwt-wordpress'); ?></h1>
                <?php elseif (is_search()) : ?>
                    <h1 class="gwt-page-title">
                        <?php
                        printf(
                            /* translators: %s: Search query. */
                            esc_html__('Search Results for: %s', 'gwt-wordpress'),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                <?php elseif (is_archive()) : ?>
                    <h1 class="gwt-page-title"><?php the_archive_title(); ?></h1>
                <?php else : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <h1 class="gwt-entry-title"><?php the_title(); ?></h1>
                    <?php endwhile; ?>
                <?php endif; ?>
            </header>
        </div>
        <?php govph_displayoptions('govph_banner_title_end'); ?>
    <?php endif; ?>

    <?php govph_displayoptions('govph_slider_end'); ?>
</div>

<!-- Separator Line -->
<span class="<?php echo esc_attr($line_class); ?>"></span>

<!-- Breadcrumbs -->
<?php include_once('breadcrumbs.php'); ?>
