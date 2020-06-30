<?php


namespace Nemundo\Process\App\Wiki\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Bookmark\Content\BookmarkContentType;

use Nemundo\Process\App\Video\Content\YouTube\YouTubeContentType;
use Nemundo\Process\App\Wiki\Content\TitleChange\TitleChangeContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Process\App\Wiki\Group\Type\WikiGroupType;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Template\Content\Audio\AudioContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\FileList\FileListContentType;
use Nemundo\Process\Template\Content\Html\HtmlContentType;
use Nemundo\Process\Template\Content\Image\ImageContentType;
use Nemundo\Process\Template\Content\ImageList\ImageListContentType;
use Nemundo\Process\Template\Content\LargeText\LargeTextContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\Video\VideoContentType;

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

        (new ContentTypeSetup())
            ->addContentType(new TitleChangeContentType());


        $setup = new WikiSetup();
        $setup->addContentType(new HtmlContentType());
        //$setup->addContentType(new EventAddContentType());


        $setup = new WikiSetup();
        $setup->addContentType(new LargeTextContentType());
        //$setup->addContentType(new EventContentType());
        $setup->addContentType(new TextContentType());


        $setup->addContentType(new FileContentType());
        $setup->addContentType(new YouTubeContentType());


        $setup->addContentType(new ImageContentType());
        $setup->addContentType(new VideoContentType());

        (new WikiSetup())
            ->addContentType(new BookmarkContentType())
           // ->addContentType(new FeedContentType())
            ->addContentType(new AudioContentType())
            ->addContentType(new TextContentType())
            ->addContentType(new ImageListContentType())
            ->addContentType(new FileListContentType())
            ->addContentType(new ImageListContentType());


        /*
        $setup->addContentType(new YoutubeContentType());
        $setup->addContentType(new WebImageContentType());
        $setup->addContentType(new NewsContentType());*/

        (new GroupSetup())
            ->addGroupType(new WikiGroupType());

        (new WikiEditorGroup())->saveType();


    }

}