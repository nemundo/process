<?php


namespace Nemundo\Process\App\Notification\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\User\Data\User\UserReader;

class NotificationTestScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'notification-test';
    }

    public function run()
    {

        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {

            $parent = new TextContentType();
            $parent->text = 'first message';
            $parent->saveType();


            $type = new MessageNotificationContentType();
            $type->parentId = $parent->getContentId();
            $type->message = 'hello world';
            $type->userId = $userRow->id;
            $type->saveType();

        }


        // TODO: Implement run() method.
    }

}