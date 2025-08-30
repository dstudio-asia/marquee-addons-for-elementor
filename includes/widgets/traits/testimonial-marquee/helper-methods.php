<?php

use Elementor\Icons_Manager;

if (! defined('ABSPATH')) {
    exit;
}

trait Testimonial_Marquee_Helper_Methods
{

    /**
     * Ensure we always have at least 8 testimonials by duplicating.
     */
    private function prepare_testimonials(array $testimonials): array
    {
        $count = count($testimonials);
        if ($count > 0 && $count < 8) {
            $i = 0;
            while (count($testimonials) < 8) {
                $duplicate            = $testimonials[$i % $count];
                $duplicate['_is_dup'] = true;
                $testimonials[]       = $duplicate;
                $i++;
            }
        }
        return $testimonials;
    }

    /**
     * Renders the testimonial rating.
     *
     * This function outputs the rating stars, including full, half, and empty stars based on the rating value.
     *
     * @param array $testimonial The testimonial data, including the rating and rating counter.
     */
    protected function render_ratings($testimonial)
    {
?>
        <div class="deensimc-tes-ratings deensimc-testimonial-ratings">
            <div class="deensimc-tes-star-icon fs-6">
                <?php
                $deensimc_rating = $testimonial['deensimc_testimonial_rating_num'];
                $deensimc_full_stars = floor($deensimc_rating);
                $deensimc_half_star = $deensimc_rating - $deensimc_full_stars;

                // Render full stars
                for ($k = 0; $k < $deensimc_full_stars; $k++) { ?>
                    <span class="deensimc-tes-icons"><i class="fa fa-star"></i></span>
                <?php }

                // Render half star
                if ($deensimc_half_star >= 0.5) { ?>
                    <span class="deensimc-tes-icons-half"><i class="fa fa-star"></i></span>
                <?php }

                // Render remaining empty stars
                for ($j = 0; $j < 5 - ceil($testimonial['deensimc_testimonial_rating_num']); $j++) { ?>
                    <span class="deensimc-tes-icons-none"><i class="fa fa-star"></i></span>
                <?php } ?>
                <?php
                if ('yes' === $testimonial['deensimc_testimonial_rating_in_text']) {
                ?>
                    <small class="deensimc-tes-review-text">
                        <?php echo esc_html__('(', 'marquee-addons-for-elementor') . esc_html($deensimc_rating) . esc_html__(')', 'marquee-addons-for-elementor'); ?>
                    </small>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }

    /**
     * Render a single testimonial item.
     */
    private function render_single_testimonial(
        $settings,
        $testimonial,
        $visible_word_length,
        $fold_text,
        $unfold_text,
        $is_cloned
    ) {
        $testimonial_text = $testimonial['deensimc_testimonial_content'];
        $author_image_url = empty($testimonial['deensimc_testimonial_image']['url']) ? 'no-image' : '';
        $is_dup           = $is_cloned || !empty($testimonial['_is_dup']);
        $word_count       = str_word_count(wp_strip_all_tags($testimonial_text));

    ?>
        <li class="deensimc-tes-item deensimc-tes-wrapper"
            aria-hidden="<?php echo esc_attr($is_dup ? 'true' : 'false') ?>">
            <figure class="deensimc-tes-main">

                <?php if (!empty($testimonial_text)) : ?>
                    <blockquote class="deensimc-tes-text">
                        <div class="contents-wrapper" data-visible-length="<?php echo esc_attr($visible_word_length) ?>">

                            <?php if (! empty($settings['deensimc_testimonial_quote_left_icon']['value'])) : ?>
                                <span class="quote-left"><?php Icons_Manager::render_icon($settings['deensimc_testimonial_quote_left_icon'], ['aria-hidden' => 'true']); ?></span>
                            <?php endif; ?>

                            <span class="deensimc-contents">
                                <?php echo esc_html($testimonial_text); ?>
                            </span>

                            <?php if ($visible_word_length && $word_count > $visible_word_length) : ?>
                                <button type="button" class="deensimc-toggle" <?php if ($is_dup): ?>
                                    tabindex="-1" aria-hidden="true"
                                    <?php endif; ?>>
                                    <span class="fold-text"><?php echo esc_html($fold_text); ?></span>
                                    <span class="unfold-text"><?php echo esc_html($unfold_text); ?></span>
                                </button>
                            <?php endif; ?>

                            <?php if (! empty($settings['deensimc_testimonial_quote_right_icon']['value'])) : ?>
                                <span class="quote-right">
                                    <?php Icons_Manager::render_icon($settings['deensimc_testimonial_quote_right_icon'], ['aria-hidden' => 'true']);
                                    ?>
                                </span>
                            <?php endif; ?>

                        </div>
                        <div class="deensimc-tes-bg-overlay"></div>
                    </blockquote>
                <?php endif; ?>

                <?php $this->render_author_section($testimonial, $author_image_url); ?>

            </figure>
        </li>
    <?php
    }

    /**
     * Render author image, name, title, and ratings.
     */
    private function render_author_section($testimonial, $author_image_url)
    {
    ?>
        <div class="deensimc-tes-author <?php echo esc_attr($author_image_url); ?>">
            <?php if (!empty($testimonial['deensimc_testimonial_image']['url'])) : ?>
                <img src="<?php echo esc_url($testimonial['deensimc_testimonial_image']['url']); ?>"
                    alt="<?php esc_attr_e('Author image', 'marquee-addons-for-elementor'); ?>" />
            <?php endif; ?>
            <?php if (!empty($testimonial['deensimc_testimonial_name']) || !empty($testimonial['deensimc_testimonial_title'])) : ?>
                <h5 class="deensimc-tes-heading">
                    <?php if (!empty($testimonial['deensimc_testimonial_name'])) : ?>
                        <span class="deensimc-tes-name">
                            <?php echo esc_html($testimonial['deensimc_testimonial_name']); ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($testimonial['deensimc_testimonial_title'])) : ?>
                        <span class="deensimc-tes-title">
                            <?php echo esc_html($testimonial['deensimc_testimonial_title']); ?>
                        </span>
                    <?php endif; ?>
                </h5>
            <?php endif; ?>
            <?php
            if (
                isset($testimonial['deensimc_testimonial_show_rating']) &&
                $testimonial['deensimc_testimonial_show_rating'] === 'yes' &&
                !empty($testimonial['deensimc_testimonial_rating_num'])
            ) {
                $this->render_ratings($testimonial);
            }
            ?>
        </div>
<?php
    }


    protected function render_testimonial(
        $settings,
        $is_cloned
    ) {
        $testimonials = $this->prepare_testimonials($settings['deensimc_repeater_testimonial_main'] ?? []);
        $visible_word_length = $settings['deensimc_tesimonial_excerpt_length'];
        $fold_text           = $settings['deensimc_tesimonial_excerpt_title'];
        $unfold_text         = $settings['deensimc_tesimonial_excerpt_title_less'];

        foreach ($testimonials as $testimonial) {
            $this->render_single_testimonial(
                $settings,
                $testimonial,
                $visible_word_length,
                $fold_text,
                $unfold_text,
                $is_cloned
            );
        }
    }
}
