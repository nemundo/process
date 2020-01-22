<?php


namespace Nemundo\Process\App\Message\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Message\Content\MessageContentType;
use Nemundo\Process\App\Message\Content\MessageContentView;
use Nemundo\Process\App\Message\Parameter\MessageParameter;
use Nemundo\Web\Site\AbstractSite;

class MessageSite extends AbstractSite
{
    /**
     * @var MessageSite
     */
    public static $site;

    protected function loadSite()
    {
    $this->title='Message';
    $this->url='message';
    $this->menuActive=false;
    MessageSite::$site=$this;
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();

        $messageId=(new MessageParameter())->getValue();

        $type=new MessageContentType($messageId);
        $type->getView($page);



        $page->render();


        // TODO: Implement loadContent() method.
    }

}