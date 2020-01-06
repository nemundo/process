<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\News\Data\NewsCollection;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Survey\Content\Type\DescriptionContentType;
use Nemundo\Process\App\Survey\Content\Type\ErfassungContentType;
use Nemundo\Process\App\Survey\Content\Type\OptionTextContentType;
use Nemundo\Process\App\Survey\Content\Type\SurveyContentType;
use Nemundo\Process\App\Survey\Data\SurveyCollection;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Script\ContentUpdateScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Process\Group\Content\Group\GroupContentType;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\AppUserGroupType;
use Nemundo\Process\Group\Type\Group;
use Nemundo\Process\Group\Type\PublicGroup;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Template\Content\User\UserContentItem;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Process\Workflow\Install\WorkflowInstall;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\ToDo\Install\ToDoInstall;
use Nemundo\User\Data\User\UserReader;
use Schleuniger\App\ChangeRequest\Install\ChangeRequestInstall;
use Schleuniger\App\ChangeRequest\Test\TestData;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentInstall())->install();
        (new WorkflowInstall())->install();
        (new InboxInstall())->install();
        (new WikiInstall())->install();
        (new TemplateInstall())->install();
        //(new FavoriteInstall())->install();

        //(new ToDoInstall())->install();

        //(new ChangeRequestInstall())->install();
        //(new TestData())->createTestData();


        $setup = new ModelCollectionSetup();
        $setup->addCollection(new SearchCollection());
        $setup->addCollection(new GroupCollection());
        $setup->addCollection(new GeoCollection());
        $setup->addCollection(new SurveyCollection());
        $setup->addCollection(new NewsCollection());

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());
        $setup->addScript(new ContentUpdateScript());

        $setup = new ContentTypeSetup();
        //$setup->addContentType(new GroupContentType());
$setup->addContentType(new NewsContentType());
       /* $setup->addContentType(new SurveyContentType());
        $setup->addContentType(new OptionTextContentType());
        $setup->addContentType(new DescriptionContentType());
        $setup->addContentType(new ErfassungContentType());*/

        $setup = new GroupSetup();
        $setup->addGroup(new PublicGroup(), new AppUserGroupType());
        $setup->addGroupType(new UserGroupType());
        $setup->addGroupType(new AppUserGroupType());


        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {

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


        /*
        $setup = new StatusSetup();
        $setup->addStatus(new DocumentDeleteStatus());
        $setup->addStatus(new ReopenStatus());


        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new DocumentContentType());

        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new WikiPageContentType());
        $setup->addContentType(new WebImageContentType());

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());*/





    }

}