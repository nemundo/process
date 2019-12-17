<?php


namespace Nemundo\Process\Install;

//use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Workflow\Install\WorkflowInstall;
use Nemundo\Project\Install\AbstractInstall;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentInstall())->install();
        (new WorkflowInstall())->install();
        (new InboxInstall())->install();




        /*
        $setup = new ModelCollectionSetup();
        $setup->addCollection(new ProcessCollection());
        $setup->addCollection(new TemplateCollection());
        $setup->addCollection(new ContentCollection());
        $setup->addCollection(new NewsCollection());
        $setup->addCollection(new InboxCollection());
        $setup->addCollection(new WikiCollection());

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