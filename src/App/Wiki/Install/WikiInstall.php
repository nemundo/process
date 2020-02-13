<?php


namespace Nemundo\Process\App\Wiki\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Process\Template\Content\EventAdd\EventAddContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\Html\HtmlContentType;
use Nemundo\Process\Template\Content\Image\ImageContentType;
use Nemundo\Process\Template\Content\LargeText\LargeTextContentType;
use Nemundo\Process\Template\Content\MultiFile\MultiFileContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\Video\VideoContentType;
use Nemundo\Process\Template\Content\YouTube\YouTubeContentType;
use Nemundo\Project\Install\AbstractInstall;

class WikiInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new WikiCollection());

        $setup = new ContentTypeSetup();
        $setup->addContentType(new WikiPageContentType());
        //$setup->addContentType(new LargeTextContentType());

        $setup = new WikiSetup();
        $setup->addContentType(new HtmlContentType());
        $setup->addContentType(new EventAddContentType());


        $setup = new WikiSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new EventContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new FileContentType());
        $setup->addContentType(new YouTubeContentType());
        $setup->addContentType(new ImageContentType());
        $setup->addContentType(new VideoContentType());

        (new WikiSetup())
        ->addContentType(new TextContentType())
            ->addContentType(new MultiFileContentType());



        /*
        $setup->addContentType(new YoutubeContentType());
        $setup->addContentType(new WebImageContentType());
        $setup->addContentType(new NewsContentType());*/

        (new WikiEditorGroup())->saveType();


    }

}