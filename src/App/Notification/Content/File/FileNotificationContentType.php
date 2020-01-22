<?php


namespace Nemundo\Process\App\Notification\Content\File;


use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;

class FileNotificationContentType extends AbstractNotificationContentType
{

    protected function loadContentType()
    {
        $this->typeLabel=' File Notification';
        $this->typeId='f697b125-fa28-4af3-8170-692bae5fd52c';
        $this->formClass=FileNotificationContentForm::class;
        // TODO: Implement loadContentType() method.
    }



}