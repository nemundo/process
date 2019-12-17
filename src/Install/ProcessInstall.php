<?php


namespace Nemundo\Process\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Inbox\Data\InboxCollection;
use Nemundo\Process\App\News\Data\NewsCollection;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Process\Content\Data\ContentCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Data\ProcessCollection;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Setup\StatusSetup;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Status\DocumentDeleteStatus;
use Nemundo\Process\Template\Status\ReopenStatus;
use Nemundo\Process\Template\Type\DocumentContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\Process\Template\Type\WebImageContentType;
use Nemundo\Project\Install\AbstractInstall;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {

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
        $setup->addScript(new ProcessCleanScript());


    }

}