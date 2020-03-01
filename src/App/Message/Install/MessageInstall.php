<?php


namespace Nemundo\Process\App\Message\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Message\Content\MessageContentType;
use Nemundo\Process\App\Document\Setup\DocumentSetup;
use Nemundo\Process\App\Message\Data\MessageCollection;
use Nemundo\Process\App\Message\Notification\MessageNotification;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class MessageInstall extends AbstractInstall
{

    public function install()
    {
        // TODO: Implement install() method.

        $setup=new ModelCollectionSetup();
        $setup->addCollection(new MessageCollection());


        $setup=new ContentTypeSetup();
        $setup->addContentType(new MessageContentType());
        $setup->addContentType(new MessageNotification());

        //$setup=new DocumentSetup();
        //$setup->addContentType(new MessageContentType());


    }

}