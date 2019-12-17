<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Parameter\ContentTypeParameter;
use Nemundo\Process\Parameter\DataIdParameter;

class ContentEditSite extends AbstractEditIconSite
{

    /**
     * @var ContentEditSite
     */
    public static $site;

    protected function loadSite()
    {
        //$this->title = 'Content';
        $this->url = 'content-item';
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
        $form->dataId= $dataId;

        $form->redirectSite= ContentItemSite::$site;
        $form->redirectSite->addParameter(new DataIdParameter());

        $page->render();


    }


}