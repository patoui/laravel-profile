<?php

$pre_commit_file = dirname(__DIR__) . '/.git/hooks/pre-commit';
if (!file_exists($pre_commit_file)) {
    if (!copy(__DIR__ . '/pre-commit', $pre_commit_file)) {
        die('Unable to copy pre-commit');
    }
    if (!chmod($pre_commit_file, 0755)) {
        die('Unable to set file permissions on pre-commit');
    }
    echo 'Add pre-commit hook' . PHP_EOL;
}
