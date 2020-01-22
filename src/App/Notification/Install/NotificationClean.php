<?php


namespace Nemundo\Process\App\Notification\Install;


use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Project\Install\AbstractClean;

class NotificationClean extends AbstractClean
{

    public function cleanData()
    {


  //      (new NotificationUninstall())->uninstall();
  //      (new NotificationInstall())->install();


        $reader = new NotificationReader();
        foreach ($reader->getData() as $row) {

            ($row->content->getContentType())->deleteType();

        }


        // TODO: Implement cleanData() method.
    }

}