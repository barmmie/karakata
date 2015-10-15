<?php
$repo_dir = '/srv/users/serverpilot/apps/karakata/repo';
$web_root_dir = '/srv/users/serverpilot/apps/karakata/public';

// Full path to git binary is required if git is not in your PHP user's path. Otherwise just use 'git'.
$git_bin_path = 'git';

$update = false;

// Parse data from Bitbucket hook payload
$payload = json_decode($_POST['payload']);

if (empty($payload->commits)) {
    // When merging and pushing to bitbucket, the commits array will be empty.
    // In this case there is no way to know what branch was pushed to, so we will do an update.
    $update = true;
} else {
    foreach ($payload->commits as $commit) {
        $branch = $commit->branch;
        if ($branch === 'demo' || isset($commit->branches) && in_array('demo', $commit->branches)) {
            $update = true;
            break;
        }
    }
}

if ($update) {
    // Do a git checkout to the web root
    echo exec('cd ' . $repo_dir . ' && ' . $git_bin_path . ' fetch');
    echo exec('cd ' . $repo_dir . ' && GIT_WORK_TREE=' . $web_root_dir . ' ' . $git_bin_path . ' checkout -f');
    echo shell_exec('cd ' . $web_root_dir . ' && composer5.4-sp install --dev');
    echo shell_exec('cd ' . $web_root_dir . ' && php5.4-sp artisan migrate --force');
    echo shell_exec('cd ' . $web_root_dir . ' &&  echo "DB_HOST=\'localhost\' \\nDB_NAME=\'karakata_db\' \\nDB_USER=\'06a3c4259f4f\' \\nDB_PASS=\'655118a8ca930b0a\'" | cat > .env ');

    // Log the deployment
    $commit_hash = shell_exec('cd ' . $repo_dir . ' && ' . $git_bin_path . ' rev-parse --short HEAD');
    file_put_contents('deploy.log',
        date('m/d/Y h:i:s a') . " Deployed branch: " . $branch . " Commit: " . $commit_hash . "\n", FILE_APPEND);
}
?>