<?php


namespace Nemundo\Process\Group\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Script\GroupCheckScript;
use Nemundo\Process\Group\Script\GroupTestScript;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\AppUserGroupType;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Group\Type\UsergroupGroupType;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\User\Data\User\UserReader;
use Nemundo\User\Data\Usergroup\UsergroupReader;


class GroupInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new GroupCollection());

        $setup=new ContentTypeSetup();
        $setup->addContentType(new GroupContentType());
        $setup->addContentType(new AppUserGroupType());
        $setup->addContentType(new UserGroupType());
        $setup->addContentType(new UsergroupGroupType());

        (new GroupSetup())
            ->addGroupType(new UserGroupType())
            ->addGroupType(new UsergroupGroupType())
            ->addGroupType(new AppUserGroupType());


        $setup=new ScriptSetup();
        $setup->addScript(new GroupCheckScript());
        $setup->addScript(new GroupTestScript());

        (new AppUserGroupType())->saveType();


        //$this->importUser();
        //$this->importUsergroup();

        // TODO: Implement install() method.
    }


    private function importUser() {


        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {

            $type=new UserGroupType($userRow->id);
            $type->saveType();
            $type->addUser($userRow->id);


            //(new SchleunigerContentGroup())->addUser($userRow->id);


            /*
            $group=new Group();
            $group->id = $userRow->id;
            $group->group = $userRow->displayName;

            $item = new UserContentItem($userRow->id);
            //$item->saveItem();
            $item->addGroup(new PublicGroup());
            $item->addGroup($group);

            $setup=new GroupSetup();
            $setup->addGroup($group,new UserGroupType());*/


        }


    }


    private function importUsergroup() {

        $reader = new UsergroupReader();
        foreach ($reader->getData() as $usergroupRow) {

            $type=new UsergroupGroupType($usergroupRow->id);
            $type->saveType();

        }


    }


}