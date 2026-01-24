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

                    <?php foreach ($categories as $deensimc_cat_key => $deensimc_cat_info) :
                        $deensimc_category_widgets = $this->get_widgets_by_category($deensimc_cat_key);
                        if (empty($deensimc_category_widgets)) continue;
                    ?>
                        <div class="deensimc-category-section">
                            <h3 class="deensimc-category-title">
                                <?php echo esc_html($deensimc_cat_info['title']); ?>
                            </h3>

                            <div class="deensimc-widgets-grid">
                                <?php foreach ($deensimc_category_widgets as $deensimc_cat_widget_key => $deensimc_widget) :
                                    $deensimc_is_pro_locked = !empty($deensimc_widget['is_pro']) && !$this->is_pro_active;
                                    $deensimc_is_checked = $this->is_widget_enabled($deensimc_cat_widget_key);
                                    $deensimc_pro_url = isset($deensimc_widget['pro_url']) ? $deensimc_widget['pro_url'] : '';
                                ?>
                                    <div class="deensimc-widget-card <?php echo $deensimc_is_pro_locked ? '' : ''; ?>" data-pro-url="<?php echo esc_attr($deensimc_pro_url); ?>" data-is-locked="<?php echo $deensimc_is_pro_locked ? '1' : '0'; ?>">
                                        <?php if (!empty($deensimc_widget['is_pro'])) : ?>
                                            <span class="deensimc-pro-badge"><?php echo esc_html__('PRO', 'marquee-addons-for-elementor'); ?></span>
                                        <?php endif; ?>
                                        <div class="deensimc-widget-header">
                                            <h3><?php echo esc_html($deensimc_widget['title']); ?></h3>
                                        </div>
                                        <div class="deensimc-toggle-demo-wrapper">
                                            <div class="deensimc-widget-toggle">
                                                <?php if ($deensimc_is_pro_locked): ?>

                                                    <a
                                                        href="<?php echo esc_url($deensimc_widget['pro_url']); ?>"
                                                        class="deensimc-switch deensimc-pro-locked"
                                                        target="_blank"
                                                        rel="noopener noreferrer">
                                                        <span class="slider" data-tooltip="Get Pro"></span>
                                                    </a>

                                                <?php else: ?>

                                                    <label class="deensimc-switch">
                                                        <input type="checkbox"
                                                            name="marquee_addons_widgets[<?php echo esc_attr($deensimc_cat_widget_key); ?>]"
                                                            <?php checked($deensimc_is_checked, true); ?>
                                                            value="on">
                                                        <span class="slider"></span>
                                                    </label>

                                                <?php endif; ?>

                                            </div>
                                            <div class="deensimc-button-group-wrapper">
                                                <?php if (! empty($deensimc_widget['doc'])) : ?>
                                                    <a href="<?php echo esc_url($deensimc_widget['doc']); ?>" class="deensimc-see-demo-btn" target="_blank" rel="nofollow">
                                                        <?php echo esc_html__('Doc', 'marquee-addons-for-elementor'); ?>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (! empty($deensimc_widget['demo'])) : ?>
                                                    <a href="<?php echo esc_url($deensimc_widget['demo']); ?>" class="deensimc-see-demo-btn" target="_blank" rel="nofollow">
                                                        <?php echo esc_html__('Demo', 'marquee-addons-for-elementor'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
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