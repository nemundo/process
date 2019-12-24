<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Template\Content\User\UserContentItem;
use Nemundo\Process\Template\Data\TemplateCollection;
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
        (new FavoriteInstall())->install();

        (new ToDoInstall())->install();

        //(new ChangeRequestInstall())->install();
        //(new TestData())->createTestData();


        $setup=new ModelCollectionSetup();
        $setup->addCollection(new SearchCollection());
        $setup->addCollection(new GroupCollection());

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());



        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {
            $item = new UserContentItem($userRow->id);
            $item->saveItem();
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