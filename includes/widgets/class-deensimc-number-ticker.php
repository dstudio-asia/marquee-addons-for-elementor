<?php

if (! defined('ABSPATH')) {
    exit;
}

// Elementor Classes

use Elementor\Icons_Manager;
use \Elementor\Widget_Base;


class Deensimc_Number_Ticker extends Widget_Base
{
    use NumberTickerContentControls;
    use NumberTickerStylesControls;

    public function get_style_depends()
    {
        return ['deensimc-number-ticker-style'];
    }

    public function get_script_depends()
    {
        return ['deensimc-number-ticker-script'];
    }

    public function get_name()
    {
        return 'deensimc-number-ticker';
    }

    public function get_title()
    {
        return esc_html__('Number Ticker', 'marquee-addons-for-elementor');
    }

    public function get_icon()
    {
        return 'deensimc-number-ticker-icon eicon-counter eicon-deensimc';
    }

    public function get_categories()
    {
        return ['deensimc_smooth_marquee'];
    }

    public function get_keywords()
    {
        return ['marquee', 'deen', 'smooth', 'number', 'ticker'];
    }

    protected function register_controls(): void
    {
        $this->content_section_control();
        $this->style_section_control();
    }


    /**
     * Renders news ticker widget.
     * @return void
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number = $settings['deensimc_nt_number'];
        $duration = $settings['deensimc_nt_duration'];
        $direction = $settings['deensimc_nt_direction'];
?>
        <div class="deensimc-number-ticker">
            <div class="deensimc-number-wrapper">
                <div class="deensimc-number"
                    data-number="<?php echo esc_attr($number) ?>"
                    data-duration="<?php echo esc_attr($duration) ?>"
                    data-direction="<?php echo esc_attr($direction) ?>">
                    <?php echo esc_html($number) ?>
                </div>
                <?php
                if (! empty($settings['deensimc_nt_icon']['value'])) {
                ?>
                    <div class="deensimc-number-ticker-icon">
                        <?php
                        Icons_Manager::render_icon(
                            $settings['deensimc_nt_icon'],
                            ['aria-hidden' => 'true']
                        );
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
}
?>