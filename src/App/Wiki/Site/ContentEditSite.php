<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Parameter\ContentParameter;
use Nemundo\Process\Parameter\DataIdParameter;
use Nemundo\Process\Site\ContentItemSite;
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


        //$dataId = (new DataIdParameter())->getValue();

        $contentId = (new ContentParameter())->getValue();


        $reader = new ContentReader();
        $reader->model->loadContentType();
        //$reader->filter->andEqual($reader->model->dataId, $dataId);
        $contentRow = $reader->getRowById($contentId);

        $contentType = $contentRow->contentType->getContentType();

        $form = $contentType->getForm($page);
        $form->dataId=$contentRow->dataId;

        $form->redirectSite= WikiSite::$site;
        $form->redirectSite->addParameter(new WikiParameter($contentRow->parentId));



        $page->render();

    }
}