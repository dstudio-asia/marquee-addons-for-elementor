<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait Stackedslider_Style_Button_Controls {
    protected function style_button_controls() 
    {
        $this->start_controls_tabs(
            'deensimc_btn_property'
        );
    
            $this->start_controls_tab(
                'deensimc_btn_normal_property',
                [
                    'label' => esc_html__( 'Normal', 'marquee-addons-for-elementor' ),
                ]
            );
    
            $this->add_control(
                'deensimc_btn_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_control(
                'deensimc_btn_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Border::get_type(),
               [
                   'name' => 'deensimc_btn_border',
                   'selector' => '{{WRAPPER}} .deensimc-content-btn',
               ]
           );
    
           $this->add_responsive_control(
                'deensimc_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'deensimc_btn_box_shadow',
                    'selector' => '{{WRAPPER}} .deensimc-content-btn',
                ]
            );
            
    
            $this->end_controls_tab();
    
            $this->start_controls_tab(
                'deensimc_btn_hover_property',
                [
                    'label' => esc_html__( 'Hover', 'marquee-addons-for-elementor' ),
                ]
            );
    
            $this->add_control(
                'deensimc_btn_bg_hover_color',
                [
                    'label' => esc_html__( 'Background Color', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_control(
                'deensimc_btn_text_hover_color',
                [
                    'label' => esc_html__( 'Text Color', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_group_control(
                 Group_Control_Border::get_type(),
                [
                    'name' => 'deensimc_btn_border_hover',
                    'selector' => '{{WRAPPER}} .deensimc-content-btn:hover',
                ]
            );
    
            $this->add_responsive_control(
                'deensimc_btn_border_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-content-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'deensimc_btn_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .deensimc-content-btn:hover',
                ]
            );
    
            $this->end_controls_tab();
    
            $this->end_controls_tabs();
    }
}