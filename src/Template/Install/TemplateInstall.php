<?php


namespace Nemundo\Process\Template\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Status\DocumentDeleteProcessStatus;
use Nemundo\Process\Workflow\Setup\StatusSetup;
use Nemundo\Project\Install\AbstractInstall;

class TemplateInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new TemplateCollection());

        $setup = new StatusSetup();
        $setup->addStatus(new DocumentDeleteProcessStatus());
        //$setup->addStatus(new ReopenStatus());


        /*
        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new DocumentContentType());

        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new WikiPageContentType());
        $setup->addContentType(new WebImageContentType());*/






    }

}