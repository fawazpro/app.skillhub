<?php
namespace ComposerScript;

use Composer\Script\Event;

class Installer
{
    public static function postUpdate(Event $event)
    {
    $composer = $event->getComposer();
    // do stuff
    }

    public static function postPackageUpdate(Event $event)
    {
    $packageName = $event->getOperation()
        ->getPackage()
        ->getName();
    echo "$packageName\n";
    // do stuff
    }

    public static function warmCache(Event $event)
    {
    // make cache toasty
    }
}