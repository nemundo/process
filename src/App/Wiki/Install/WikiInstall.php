<?php


namespace Nemundo\Process\App\Wiki\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Template\Content\EventAdd\EventAddContentType;
use Nemundo\Process\Template\Content\Html\HtmlContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\Process\Template\Type\WebImageContentType;
use Nemundo\Process\Template\Type\YoutubeContentType;
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

        $setup=new WikiSetup();
        $setup->addContentType(new HtmlContentType());
        $setup->addContentType(new EventAddContentType());


        /*
        $setup->addContentType(new YoutubeContentType());
        $setup->addContentType(new WebImageContentType());
        $setup->addContentType(new NewsContentType());*/

    }

}