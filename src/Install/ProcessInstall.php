<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Content\Message\MessageAssignmentContentType;
use Nemundo\Process\App\Assignment\Install\AssignmentInstall;
use Nemundo\Process\App\Calendar\Data\CalendarCollection;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\Message\Install\MessageInstall;
use Nemundo\Process\App\News\Data\NewsCollection;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Notification\Install\NotificationInstall;
use Nemundo\Process\App\Plz\Content\PlzContentType;
use Nemundo\Process\App\Plz\Data\PlzCollection;
use Nemundo\Process\App\Survey\Content\Type\ErfassungContentType;
use Nemundo\Process\App\Survey\Content\Type\SurveyContentType;
use Nemundo\Process\App\Survey\Data\SurveyCollection;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Script\ContentUpdateScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Install\GroupInstall;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\AppUserGroupType;
use Nemundo\Process\Group\Type\PublicGroupContentType;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Search\Install\SearchInstall;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Process\Template\Status\SubjectChange\SubjectChangeProcessStatus;
use Nemundo\Process\Workflow\Install\WorkflowInstall;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\User\Data\User\UserReader;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentInstall())->install();
        (new SearchInstall())->install();

        (new WorkflowInstall())->install();
        (new InboxInstall())->install();
        (new WikiInstall())->install();
        (new TemplateInstall())->install();
        (new FavoriteInstall())->install();
        (new GroupInstall())->install();

        (new AssignmentInstall())->install();
        (new NotificationInstall())->install();
        (new MessageInstall())->install();
        //(new ToDoInstall())->install();

        //(new ChangeRequestInstall())->install();
        //(new TestData())->createTestData();


        $setup = new ModelCollectionSetup();
        $setup->addCollection(new SearchCollection());
        $setup->addCollection(new GroupCollection());
        $setup->addCollection(new GeoCollection());
        $setup->addCollection(new SurveyCollection());
        $setup->addCollection(new NewsCollection());
        $setup->addCollection(new CalendarCollection());
        $setup->addCollection(new DocumentCollection());
        $setup->addCollection(new PlzCollection());

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());
        $setup->addScript(new ContentUpdateScript());

        $setup = new ContentTypeSetup();
        //$setup->addContentType(new GroupContentType());
        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new SurveyContentType());
        //$setup->addContentType(new OptionTextContentType());
        //$setup->addContentType(new DescriptionContentType());
        $setup->addContentType(new ErfassungContentType());
        $setup->addContentType(new PlzContentType());
        $setup->addContentType(new MessageAssignmentContentType());
        $setup->addContentType(new SubjectChangeProcessStatus());

        $setup = new GroupSetup();
        //$setup->addGroup(new PublicGroupContentType(), new AppUserGroupType());
        //$setup->addGroupType(new UserGroupType());
        //$setup->addGroupType(new AppUserGroupType());


        /*
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


        //}


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