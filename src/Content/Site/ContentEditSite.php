<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\DataIdParameter;

class ContentEditSite extends AbstractEditIconSite
{

    /**
     * @var ContentEditSite
     */
    public static $site;

    protected function loadSite()
    {
        //$this->title = 'Content';
        $this->url = 'content-edit';
        ContentEditSite::$site = $this;
    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $dataId = (new DataIdParameter())->getValue();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->filter->andEqual($reader->model->dataId, $dataId);

        $contentRow = $reader->getRow();

        $contentType = $contentRow->contentType->getContentType();

        $form = $contentType->getForm($page);
        $form->dataId = $dataId;

        $form->redirectSite = ContentItemSite::$site;
        $form->redirectSite->addParameter(new DataIdParameter());

        $page->render();


    }


}