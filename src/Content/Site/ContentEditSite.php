<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\DataParameter;

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

        /*$dataId = (new DataParameter())->getValue();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $contentRow = $reader->getRowById($dataId);
        $contentType = $contentRow->getContentType();*/

        $contentType = (new ContentParameter())->getContentType();

        $form = $contentType->getForm($page);
        $form->redirectSite = ContentItemSite::$site;
        $form->redirectSite->addParameter(new ContentParameter());

        $page->render();

    }

}