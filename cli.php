<?php
require 'vendor/autoload.php';

$cmd = new Commando\Command();

$cmd->option()
    ->require()
    ->describedAs('Name of a song to be searched in youtube and downloaded as a mp3');

if( isset($cmd[0]) )
{
    $search = new \YoutubeHelper\Search($cmd[0]);
    $videoHash = $search->run();
    echo $videoHash;
}
