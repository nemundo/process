<?php


namespace Nemundo\Process\App\Calendar\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Calendar\Data\CalendarCollection;
use Nemundo\Project\Install\AbstractInstall;

class CalendarInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new CalendarCollection());

        // TODO: Implement install() method.
    }

}