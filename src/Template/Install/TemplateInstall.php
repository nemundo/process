<?php


namespace Nemundo\Process\Template\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Calendar\Setup\CalendarSourceSetup;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Status\DocumentDeleteProcessStatus;
use Nemundo\Process\Template\Type\DocumentContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\Process\Template\Type\WebImageContentType;
use Nemundo\Process\Workflow\Setup\StatusSetup;
use Nemundo\Project\Install\AbstractInstall;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcrProcess;

class TemplateInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new TemplateCollection());

        $setup = new StatusSetup();
        $setup->addStatus(new DocumentDeleteProcessStatus());
        //$setup->addStatus(new ReopenStatus());


        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new DocumentContentType());

        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new WikiPageContentType());
        $setup->addContentType(new WebImageContentType());
        $setup->addContentType(new UserContentType());
        $setup->addContentType(new EventContentType());

        $setup = new WikiSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new EventContentType());

        $setup= new CalendarSourceSetup();
        $setup->addSourceContentType(new WikiPageContentType());
        $setup->addSourceContentType(new AufgabeProcess());
        $setup->addSourceContentType(new EcrProcess());


    }

}