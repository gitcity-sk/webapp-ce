<?php 
/**
 * Webapp config file
 * Each of this can be added  into .env file, just copy key and set them there
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

    /**
     * GIT module Configuration
     * Paths to folders required for GIT module
     */
    'git' => [
        /**
         * Standard git path
         * If you want use your own binary change this to /path/to/git where git is binary file
         */
        'binary' => env('GIT_BINARY', 'git'),

        /**
         * Where git repositories are stored
         */
        'path' => env('GIT_DATA', '/var/opt/webapp/data/git-data/'),

        'ssh_keys' => env('GIT_SSH_KEYS', '/var/opt/webapp/data/git-data/.ssh/'),

        'shell_hooks' => env('GITCITY_SHELL_HOOKS', '/opt/webapp/webapp-shell/hooks'),

        'ssh_exec' => env('GITCITY_SSH_EXEC', '/opt/webapp/webapp-shell/ssh-exec')
    ],
];