<?php


namespace Nemundo\Process\App\Calendar\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Calendar\Data\CalendarCollection;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class CalendarInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new CalendarCollection());

        // TODO: Implement install() method.
    }

}