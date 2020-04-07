<?php


namespace Nemundo\Process\Group\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Script\GroupCheckScript;
use Nemundo\Process\Group\Script\GroupCleanScript;
use Nemundo\Process\Group\Script\GroupTestScript;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Project\Install\AbstractInstall;


class GroupInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new GroupCollection());

        (new GroupSetup())
            ->addGroupType(new UserGroupType());

        (new ScriptSetup())
            ->addScript(new GroupCleanScript());

        $setup = new ScriptSetup();
        $setup->addScript(new GroupCheckScript());
        $setup->addScript(new GroupTestScript());

    }

}