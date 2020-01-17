<?php


namespace Nemundo\Process\Template\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Calendar\Setup\CalendarSourceSetup;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Template\Content\AddSource\AddSourceContentType;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileDeleteContentType;
use Nemundo\Process\Template\Content\SourceRemove\SourceRemoveContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Process\Template\Content\VersionText\VersionTextContentType;
use Nemundo\Process\Template\Data\TemplateCollection;

use Nemundo\Process\Template\Status\DocumentDeleteProcessStatus;

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

        //$setup = new StatusSetup();
        //$setup->addStatus(new DocumentDeleteProcessStatus());
        //$setup->addStatus(new ReopenStatus());


        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new FileContentType());
        $setup->addContentType(new FileDeleteContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new VersionTextContentType());

        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new WikiPageContentType());
        $setup->addContentType(new WebImageContentType());
        $setup->addContentType(new UserContentType());
        $setup->addContentType(new EventContentType());
        $setup->addContentType(new AddSourceContentType());
        $setup->addContentType(new SourceRemoveContentType());


        $setup = new WikiSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new EventContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new FileContentType());

        $setup= new CalendarSourceSetup();
        $setup->addSourceContentType(new WikiPageContentType());
        $setup->addSourceContentType(new AufgabeProcess());
        $setup->addSourceContentType(new EcrProcess());


    }

}