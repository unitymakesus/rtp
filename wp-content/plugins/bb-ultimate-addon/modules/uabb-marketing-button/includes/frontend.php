<?php
/**
 *  UABB Button Module front-end file
 *
 *  @package UABB Button Module
 */

echo wp_kses_post( $module->render_button() );
