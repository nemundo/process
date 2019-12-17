<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Web\Site\AbstractSite;

class ContentItemSite extends AbstractSite
{

    /**
     * @var ContentItemSite
     */
    public static $site;

    protected function loadSite()
    {
        //$this->title = 'Content';
        $this->url = 'content-item';
        $this->menuActive=false;
        ContentItemSite::$site = $this;

        new ContentEditSite($this);

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

        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject($contentRow->dataId);

        $view = $contentType->getView($page);
        $view->dataId = $dataId;

        $btn = new AdminIconSiteButton($page);
        $btn->site=ContentEditSite::$site;
        $btn->site->addParameter(new DataIdParameter());


        $dropdown = new BootstrapSiteDropdown($page);


        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {

            $site = clone(ContentItemSite::$site);
            $site->title = $contentTypeRow->phpClass;
            $site->addParameter(new DataIdParameter());
            $site->addParameter(new ContentTypeParameter($contentTypeRow->id));

            $dropdown->addSite($site);

        }


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();

            $form = $contentType->getForm($page);
            $form->parentId = $dataId;
            $form->redirectSite = ContentItemSite::$site;
            $form->redirectSite->addParameter(new DataIdParameter());
            //$form->redirectSite=new Site();

        }


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->filter->andEqual($reader->model->parentId, $dataId);
        $reader->addOrder($reader->model->itemOrder);
        foreach ($reader->getData() as $contentRow) {


            $subtitle = new AdminSubtitle($page);
            $subtitle->content = $contentRow->dateTimeCreated->getShortDateTimeFormat();

            $div = new Div($page);

            $contentRow->contentType->getContentType();

            $view = $contentRow->contentType->getContentType()->getView($div);
            $view->dataId = $contentRow->dataId;


        }


        $page->render();


    }


}