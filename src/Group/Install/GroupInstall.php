<?php


namespace Nemundo\Process\Group\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Project\Install\AbstractInstall;


class GroupInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new GroupCollection());

        (new GroupSetup())
            ->addGroupType(new GroupContentType())
            ->addGroupType(new UserGroupType());


        /*
        (new ScriptSetup())
            ->addScript(new GroupCleanScript());

        $setup = new ScriptSetup();
        $setup->addScript(new GroupCheckScript());
        $setup->addScript(new GroupTestScript());*/

    }

}