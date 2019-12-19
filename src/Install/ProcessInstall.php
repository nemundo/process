<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Process\Workflow\Install\WorkflowInstall;
use Nemundo\Project\Install\AbstractInstall;
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

        (new ChangeRequestInstall())->install();
        (new TestData())->createTestData();


        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());





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