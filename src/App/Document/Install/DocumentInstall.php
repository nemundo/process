<?php


namespace Nemundo\Process\App\Document\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class DocumentInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new DocumentCollection());


    }

}