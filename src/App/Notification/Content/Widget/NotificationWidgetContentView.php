<?php


namespace Nemundo\Process\App\Notification\Content\Widget;


use Nemundo\Process\App\Notification\Com\Table\UserNotificationTable;
use Nemundo\Process\Content\View\AbstractContentView;

class NotificationWidgetContentView extends AbstractContentView
{

    public function getContent()
    {

        new UserNotificationTable($this);


        return parent::getContent();

    }

}