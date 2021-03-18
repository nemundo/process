<?php


namespace Nemundo\Process\Relation\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Relation\Data\RelationCollection;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class RelationInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())->addCollection(new RelationCollection());

        // TODO: Implement install() method.
    }

}