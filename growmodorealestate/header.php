<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
$banner_text = get_theme_mod('top_banner_text');
$banner_bg = get_theme_mod('top_banner_bg', get_template_directory_uri() . '/assets/images/abstract-design.png');

if (!empty($banner_text)) : ?>
    <div id="top-banner" class="top-banner" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
        <div class="banner-overlay">
            <div class="banner-content container">
                <?php echo wp_kses_post($banner_text); ?>
                <button id="close-banner" class="banner-close" aria-label="Close">&times;</button>
            </div>
        </div>
    </div>
<?php endif; ?>
