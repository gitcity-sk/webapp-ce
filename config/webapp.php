<?php 

return [
    'url' => env('WEBAPP_URL', 'localhost'),
    'ssh_port' => env('WEBAPP_SSH_PORT', ''),
    'redirect_home_page' => env('WEBAPP_HOME_REDIRECT', ''),
    'allow_registration' => env('WEBAPP_ALLOW_REGISTRATION', '')
];