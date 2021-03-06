<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Type\WikiContentTypeCollection;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Web\Site\AbstractSite;

class ContentEditSite extends AbstractEditIconSite
{

    /**
     * @var ContentEditSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'ContentEdit';
        $this->url = 'contentedit';

        ContentEditSite::$site=$this;

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $contentParameter=new ContentParameter();
        $contentParameter->addAllowedContentTypeCollection(new WikiContentTypeCollection());

        $contentType = $contentParameter->getContentType();  // $contentRow->getContentType();
        $form = $contentType->getForm($page);
        //$form->dataId=$contentRow->id;

        $form->redirectSite= WikiSite::$site;
        $form->redirectSite->addParameter(new WikiParameter());

        $page->render();

    }
}