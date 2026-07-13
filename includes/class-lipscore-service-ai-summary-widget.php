<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Lipscore_Service_AI_Summary_Widget' ) ) :

class Lipscore_Service_AI_Summary_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'lipscore_service_ai_summary',
            __( 'Lipscore Service AI Summary', 'lipscore' ),
            array( 'description' => __( 'Displays an AI-generated summary of service reviews.', 'lipscore' ) )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        echo '<div class="lipscore-service-ai-summary"></div>';
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>' . __( 'No configuration needed. Add this widget to a footer area to display the Lipscore Service AI Summary.', 'lipscore' ) . '</p>';
    }
}

endif;
