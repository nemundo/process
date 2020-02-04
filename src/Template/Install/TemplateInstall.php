<?php


namespace Nemundo\Process\Template\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Calendar\Setup\CalendarSourceSetup;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Template\Content\AddSource\AddSourceContentType;
use Nemundo\Process\Template\Content\Audio\AudioContentType;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Process\Template\Content\File\FileActiveContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Content\Item\ActiveItemContentType;
use Nemundo\Process\Template\Content\Item\CreateItemContentType;
use Nemundo\Process\Template\Content\Item\EditItemContentType;
use Nemundo\Process\Template\Content\Item\InactiveItemContentType;
use Nemundo\Process\Template\Content\LargeText\LargeTextContentType;
use Nemundo\Process\Template\Content\SourceRemove\SourceRemoveContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Process\Template\Content\VersionText\VersionTextContentType;

use Nemundo\Process\Template\Content\Video\VideoContentType;
use Nemundo\Process\Template\Content\YouTube\YouTubeContentType;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Script\TemplateTestScript;
use Nemundo\Process\Template\Status\SubjectChange\SubjectChangeProcessStatus;
use Nemundo\Process\Template\Status\WorkflowDelete\WorkflowDeleteStatus;
use Nemundo\Project\Install\AbstractInstall;

class TemplateInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new TemplateCollection());

        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new FileContentType());
        $setup->addContentType(new FileInactiveContentType());
        $setup->addContentType(new FileActiveContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new VersionTextContentType());
        $setup->addContentType(new VideoContentType());
        $setup->addContentType(new AudioContentType());
        $setup->addContentType(new YouTubeContentType());



        $setup->addContentType(new NewsContentType());
        $setup->addContentType(new WikiPageContentType());
        //$setup->addContentType(new WebImageContentType());
        $setup->addContentType(new UserContentType());
        $setup->addContentType(new EventContentType());
        $setup->addContentType(new AddSourceContentType());
        $setup->addContentType(new SourceRemoveContentType());
        $setup->addContentType(new WorkflowDeleteStatus());
        $setup->addContentType(new SubjectChangeProcessStatus());

        $setup->addContentType(new ActiveItemContentType());
        $setup->addContentType(new CreateItemContentType());
        $setup->addContentType(new EditItemContentType());
        $setup->addContentType(new InactiveItemContentType());

        $setup = new WikiSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new EventContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new FileContentType());
        $setup->addContentType(new YouTubeContentType());

        //$setup = new CalendarSourceSetup();
        //$setup->addSourceContentType(new WikiPageContentType());

        $setup=new ScriptSetup();
        $setup->addScript(new TemplateTestScript());


    }

}