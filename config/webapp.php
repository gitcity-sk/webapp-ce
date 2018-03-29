<?php 
/**
 * Webapp config file
 */
return [

    /**
     * URL without https / https before address
     * Is used to generate clone url for projects
     */
    'url' => env('WEBAPP_URL', 'localhost'),

    /**
     * Port where is your SSH server running
     * Requred for GIT server and clone url generation
     */
    'ssh_port' => env('WEBAPP_SSH_PORT', ''),

    /**
     * Use this if you want have different homepage
     */
    'redirect_home_page' => env('WEBAPP_HOME_REDIRECT', ''),

    /**
     * Enable or disable registration
     */
    'allow_registration' => env('WEBAPP_ALLOW_REGISTRATION', ''),

    'shell_secret' => env('WEBAPP_SHELL_SECRET', ''),
];