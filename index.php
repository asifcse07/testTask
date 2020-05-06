<?php
    use MyApp\ReadFile\ReadFile;

require_once ('vendor/autoload.php');

    $readFile = new ReadFile();
    $readFile->readFileData($argv);


