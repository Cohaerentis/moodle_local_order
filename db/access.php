<?php

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    // Ability to validate and cancel all orders
    'local/order:manage' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'manager' => CAP_ALLOW,
        )
    ),

    // Ability to view all orders
    'local/order:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'manager' => CAP_ALLOW,
            'coursecreator' => CAP_ALLOW,
        )
    ),
);
