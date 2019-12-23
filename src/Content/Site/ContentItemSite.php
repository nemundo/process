<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Type\Number\YesNo;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\App\Favorite\Com\FavoriteButton;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Item\ContentItem;
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

        $contentItem = new ContentItem($dataId);


        $reader = new ContentReader();
        $reader->model->loadContentType();
        //$reader->filter->andEqual($reader->model->dataId, $dataId);

        $contentRow = $reader->getRowById($dataId);

        $contentType = $contentRow->contentType->getContentType();

        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject($contentRow->id);

        $view = $contentType->getView($page);
        $view->dataId = $dataId;

        //$contentItem = $contentType->getItem($dataId);
        $table = new AdminLabelValueTable($page);

        //$table->addLabelYesNoValue('Has Parent', $contentItem->hasParent());
        $table->addLabelValue('Child Count', $contentItem->getChildCount());
        $table->addLabelValue('Parent Count', $contentItem->getParentCount());



        if ($contentItem->hasParent()) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = 'Parent Type';

            $table=new AdminClickableTable($page);
            foreach ($contentItem->getParentContent() as $contentRow) {

                $row = new TableRow($table);

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new DataIdParameter($contentRow->id));
                $site->title = $contentRow->subject;
                $row->addSite($site);

            }


        }



        $btn = new AdminIconSiteButton($page);
        $btn->site=ContentEditSite::$site;
        $btn->site->addParameter(new DataIdParameter());

        $btn = new AdminIconSiteButton($page);
        $btn->site=ContentDeleteSite::$site;
        $btn->site->addParameter(new DataIdParameter());


        $btn = new FavoriteButton($page);
        $btn->dataId = $dataId;



        $dropdown = new BootstrapSiteDropdown($page);

        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {

            $site = clone(ContentItemSite::$site);
            $site->title = $contentTypeRow->contentType;
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



        //$reader = new ContentReader();
        //$reader->model->loadContentType();
        //$reader->filter->andEqual($reader->model->parentId, $dataId);
        //$reader->addOrder($reader->model->itemOrder);
        foreach ($contentItem->getChild() as $contentRow) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = $contentRow->dateTime->getShortDateTimeFormat();

            $div = new Div($page);

            $contentRow->contentType->getContentType();

            $view = $contentRow->contentType->getContentType()->getView($div);
            $view->dataId = $contentRow->id;

            $btn=new AdminSiteButton($page);
            $btn->site=clone(ContentItemSite::$site);
            $btn->site->addParameter(new DataIdParameter($contentRow->id));
$btn->site->title='View';

        }

        $page->render();


    }


}