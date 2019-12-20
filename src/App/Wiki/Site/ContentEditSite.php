<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
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

        $contentId = (new ContentParameter())->getValue();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $contentRow = $reader->getRowById($contentId);

        $contentType = $contentRow->contentType->getContentType();

        $form = $contentType->getForm($page);
        $form->dataId=$contentRow->dataId;

        $form->redirectSite= WikiSite::$site;
        $form->redirectSite->addParameter(new WikiParameter($contentRow->parentId));

        $page->render();

    }
}