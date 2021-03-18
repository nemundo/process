<?php


namespace Nemundo\Process\App\Bookmark\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Bookmark\Content\BookmarkContentType;
use Nemundo\Process\App\Bookmark\Data\BookmarkCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class BookmarkInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new BookmarkCollection());

        (new ContentTypeSetup())
            ->addContentType(new BookmarkContentType());

    }

}