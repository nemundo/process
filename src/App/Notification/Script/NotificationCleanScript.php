<?php


namespace Nemundo\Process\App\Notification\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\App\Notification\Install\NotificationClean;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\User\Data\User\UserReader;

class NotificationCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'notification-clean';
    }

    public function run()
    {

        (new NotificationClean())->cleanData();


        // TODO: Implement run() method.
    }

}