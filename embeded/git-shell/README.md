```php
<?php
if(empty($_SERVER['SSH_CLIENT'])){
        echo "SSH connection only!\n";
        exit(1);
}
if(empty($_SERVER['SSH_ORIGINAL_COMMAND'])){
        echo "Hello, {$argv[1]}, welcome to PHPGitLab\n";
        exit(0);
}
file_put_contents('/tmp/cmd.log', $_SERVER['SSH_ORIGINAL_COMMAND']);
$user = $argv[1];
$soc = $_SERVER['SSH_ORIGINAL_COMMAND'];
$pattern = "/^(git-upload-pack|git-receive-pack|git-upload-archive) '?\/?(.*?)(?:\.git(\d)?)?'?$/";
preg_match($pattern, $soc, $match);
if(empty($match[1])){
        lg("cannot parse original command: {$soc}");
        exit(1);
}
$verb = $match[1];
if(empty($match[2])){
        lg("cannot parse repo name: {$soc}");
        exit(1);
}
$repo = $match[2];
if(!empty($match[3])){
        define('D', $match[3]);
}
//$aa = stripos($repo, 'upload') ? 'R' : 'W';
//$cmd = "git-shell -c \"{$verb} '/root/{$repo}.git'\"";
$cmd = "git-shell -c \"{$_SERVER['SSH_ORIGINAL_COMMAND']}\"";
lg($cmd);
system($cmd);
function lg($message){
    file_put_contents('/tmp/gitlab.log', $message . "\n", FILE_APPEND);
}
```
