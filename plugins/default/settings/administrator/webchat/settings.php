<?php
/**
 * This file determines what to display when you click the webchat admin button
 * in the admin dashboard.
 */
 
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/webchat/admin/settings',
    'component' => 'webchat',
    'class' => 'ossn-admin-form'	
), false);