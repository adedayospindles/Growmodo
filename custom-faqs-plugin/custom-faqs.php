<?php
/**
 * Plugin Name: Custom FAQs Plugin
 * Description: Displays a styled FAQ section with a shortcode and uses a custom post type for management.
 * Version: 1.1
 * Author: Adedayo Agboola
 */

if (!defined('ABSPATH')) exit;

class CustomFAQsPlugin {
    public function __construct() {
        add_action('init', [$this, 'register_faq_post_type']);
        add_action('init', [$this, 'register_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function register_faq_post_type() {
        $labels = [
            'name'               => 'FAQs',
            'singular_name'      => 'FAQ',
            'menu_name'          => 'FAQs',
            'name_admin_bar'     => 'FAQ',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New FAQ',
            'new_item'           => 'New FAQ',
            'edit_item'          => 'Edit FAQ',
            'view_item'          => 'View FAQ',
            'all_items'          => 'All FAQs',
            'search_items'       => 'Search FAQs',
            'not_found'          => 'No FAQs found.',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'show_in_menu'       => true,
            'menu_icon'          => 'dashicons-editor-help',
            'supports'           => ['title', 'editor'],
            'has_archive'        => false,
            'rewrite'            => ['slug' => 'faqs'],
            'publicly_queryable' => false,
        ];

        register_post_type('faq', $args);
    }

    public function enqueue_assets() {
        wp_enqueue_style('custom-faqs-style', plugin_dir_url(__FILE__) . 'assets/style.css', [], '1.0');
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
        wp_enqueue_script('custom-faqs-js', plugin_dir_url(__FILE__) . 'assets/custom-faqs.js', ['swiper-js'], '1.0', true);
    }

    public function register_shortcode() {
        add_shortcode('custom_faqs', [$this, 'render_faqs']);
    }

    public function render_faqs($atts = []) {
        $faq_query = new WP_Query([
            'post_type'      => 'faq',
            'posts_per_page' => 10,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        ob_start(); ?>
        <div class="faq-section">
            <!--<div class="faq-header">
                <h2>Frequently Asked Questions</h2>
                <p>Find answers to common questions about Estatein's services, property listings, and the real estate process. We're here to provide clarity and assist you every step of the way.</p>
                <a href="#" class="faq-btn">View All FAQs</a>
            </div>-->

            <div class="swiper faq-swiper">
                <div class="swiper-wrapper">
                    <?php if ($faq_query->have_posts()) : ?>
                        <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                            <div class="swiper-slide faq-card">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_content(), 25, '...'); ?></p>
                                <a class="faq-readmore" href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <div class="swiper-slide">
                            <p>No FAQs available.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="faq-pagination swiper-pagination"></div>
                <div class="faq-nav-buttons">
                    <div class="faq-prev swiper-button-prev">←</div>
                    <div class="faq-next swiper-button-next">→</div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

new CustomFAQsPlugin();
