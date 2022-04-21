<?php
/**
 * Copyright (C) 2022 Paladin Business Solutions
 * 
 */
/* ============================================= */
/* if the constant is not defined then get out ! */
/* ============================================= */
if (!defined('WP_UNINSTALL_PLUGIN')) exit() ;

/* ======================================== */
// Drop the DB tables related to the plugin */
/* ======================================== */
global $wpdb;
$wpdb->query('DROP TABLE ringcentral_control');
$wpdb->query('DROP TABLE ringcentral_help');
?>