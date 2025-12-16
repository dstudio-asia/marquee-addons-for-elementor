<?php
/**
 * Admin Settings Page View
 *
 * This file contains the HTML markup for the widget management page.
 *
 * @var array $categories The categories of widgets.
 * @var Deensimc_Marquee\Control_Manager $this The Control_Manager instance.
 */

if (!defined('ABSPATH')) exit;

?>
<div class="deensimc-addons-settings">
    <h1 class="deensimc-settings-header"><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="deensimc-settings-container">
        <!-- Tabs Navigation -->
        <div class="deensimc-tabs">
            <button class="deensimc-tab-btn active" data-tab="widgets">
                <span class="dashicons dashicons-admin-plugins"></span>
                <?php echo esc_html__('Widgets', 'marquee-addons-for-elementor'); ?>
            </button>
        </div>

        <!-- Widgets Tab -->
        <div class="deensimc-tab-content active" id="tab-widgets">
            <form method="post" action="options.php">
                <?php settings_fields('marquee_addons_settings'); ?>
                <input type="hidden" name="marquee_addons_widgets_submitted" value="1">
                <div class="deensimc-section">
                    <div class="deensimc-section-header">
                        <div>
                            <h2><?php echo esc_html__('Manage Widgets', 'marquee-addons-for-elementor'); ?></h2>
                            <p class="deensimc-description"></p>
                        </div>
                        <div class="deensimc-bulk-actions">
                            <button type="button" class="button deensimc-enable-btn" id="enable-all">
                                <?php echo esc_html__('Enable All', 'marquee-addons-for-elementor'); ?>
                            </button>
                            <button type="button" class="button deensimc-disable-btn" id="disable-all">
                                <?php echo esc_html__('Disable All', 'marquee-addons-for-elementor'); ?>
                            </button>
                        </div>
                    </div>

                    <?php foreach ($categories as $cat_key => $cat_info) :
                        $category_widgets = $this->get_widgets_by_category($cat_key);
                        if (empty($category_widgets)) continue;
                    ?>
                        <div class="deensimc-category-section">
                            <h3 class="deensimc-category-title">
                                <?php echo esc_html($cat_info['title']); ?>
                            </h3>

                            <div class="deensimc-widgets-grid">
                                <?php foreach ($category_widgets as $key => $widget) :
                                    $is_pro_locked = !empty($widget['is_pro']) && !$this->is_pro_active;
                                    $is_checked = $this->is_widget_enabled($key);
                                    $pro_url = isset($widget['pro_url']) ? $widget['pro_url'] : '';
                                ?>
                                    <div class="deensimc-widget-card <?php echo $is_pro_locked ? 'deensimc-pro-locked' : ''; ?>" data-pro-url="<?php echo esc_attr($pro_url); ?>" data-is-locked="<?php echo $is_pro_locked ? '1' : '0'; ?>">
                                        <?php if (!empty($widget['is_pro'])) : ?>
                                            <span class="deensimc-pro-badge"><?php echo esc_html__('PRO', 'marquee-addons-for-elementor'); ?></span>
                                        <?php endif; ?>
                                        <div class="deensimc-widget-header">
                                            <h3><?php echo esc_html($widget['title']); ?></h3>
                                        </div>
                                        <div class="deensimc-toggle-demo-wrapper">
                                            <div class="deensimc-widget-toggle">
                                                <label class="deensimc-switch <?php echo $is_pro_locked ? 'disabled' : ''; ?>">
                                                    <input type="checkbox" name="marquee_addons_widgets[<?php echo esc_attr($key); ?>]" <?php checked($is_checked, true); ?> <?php disabled($is_pro_locked); ?> value="on" data-is-pro="<?php echo !empty($widget['is_pro']) ? '1' : '0'; ?>">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            <a href="<?php echo esc_url($widget['demo']); ?>" class="deensimc-see-demo-btn" target="_blank" rel="nofollow">
                                                <?php echo esc_html__('Demo', 'marquee-addons-for-elementor'); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="deensimc-settings-footer">
                    <?php submit_button(__('Save Changes', 'marquee-addons-for-elementor'), 'primary', 'submit', false); ?>
                </div>
            </form>
        </div>
    </div>
</div>
