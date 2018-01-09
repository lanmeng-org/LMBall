<?php

namespace Lanmeng\Laravel\Foundation;

use Composer\Script\Event;
use Symfony\Component\Process\Process;

class ComposerScripts
{
    public static function postInstall(Event $event)
    {
        $dir = getcwd();

        // 生成 .env 文件并且生成系统密钥
        $envFile = "$dir/.env";
        if (!file_exists($envFile)) {
            $event->getIO()->write('生成 .env 文件');
            copy("$dir/.env.example", $envFile);

            static::cmd($event, 'php artisan key:generate');
        }
    }

    protected static function cmd(Event $event, $cmd, $description = null)
    {
        if (!is_null($description)) {
            $event->getIO()->write($description);
        }

        $process = new Process($cmd);
        $process->run();

        if (!$process->isSuccessful()) {
            $event->getIO()->write($process->getErrorOutput());
        }

        $event->getIO()->write($process->getOutput());
    }
}
