<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroupReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Type\MenuTrait;
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
        $this->menuActive = false;
        ContentItemSite::$site = $this;

        new ContentEditSite($this);

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $dataId = (new DataIdParameter())->getValue();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $contentRow = $reader->getRowById($dataId);
        $contentType = $contentRow->getContentType();


        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject();

        if ($contentType->hasView()) {
            $contentType->getView($page);
        }

        $table = new AdminLabelValueTable($page);

        $table->addLabelYesNoValue('Subject', $contentType->getSubject());
        $table->addLabelYesNoValue('Has Parent', $contentType->hasParent());
        $table->addLabelValue('Child Count', $contentType->getChildCount());
        $table->addLabelValue('Parent Count', $contentType->getParentCount());
        $table->addLabelSite('View', $contentType->getViewSite());

        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Child';

        $table = new AdminTable($page);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Subject');

        foreach ($contentType->getChild() as $contentRow) {
            $row = new TableRow($table);
            $row->addText($contentRow->contentType->contentType);
            $row->addText($contentRow->subject);

        }


        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Content User';

        $list = new UnorderedList($page);

        $reader = new ContentGroupReader();
        $reader->model->loadGroup();
        $reader->filter->andEqual($reader->model->contentId, $dataId);
        foreach ($reader->getData() as $contentGroupRow) {
            $list->addText($contentGroupRow->group->group);
        }


        if ($contentType->hasParent()) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = 'Parent Type';

            $table = new AdminClickableTable($page);
            foreach ($contentType->getParentContent() as $contentRow) {

                $row = new TableRow($table);

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new DataIdParameter($contentRow->id));
                $site->title = $contentRow->subject;
                $row->addSite($site);

            }

        }

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentEditSite::$site;
        $btn->site->addParameter(new DataIdParameter());

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentDeleteSite::$site;
        $btn->site->addParameter(new DataIdParameter());


        //$btn = new FavoriteButton($page);
        //$btn->dataId = $dataId;


        if ($contentType->isObjectOfTrait(MenuTrait::class)) {

            $dropdown = new BootstrapSiteDropdown($page);

            //$reader = new ContentTypeReader();
            //foreach ($reader->getData() as $contentTypeRow) {

            foreach ($contentType->getMenuList() as $menuContentType) {

                $site = clone(ContentItemSite::$site);
                $site->title = $menuContentType->contentLabel;  // $contentTypeRow->contentType;
                $site->addParameter(new DataIdParameter());
                $site->addParameter(new ContentTypeParameter($menuContentType->contentId));

                $dropdown->addSite($site);

            }

        }


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();

            $form = $contentType->getForm($page);
            $form->parentId = $dataId;
            $form->redirectSite = ContentItemSite::$site;
            $form->redirectSite->addParameter(new DataIdParameter());

        }


        foreach ($contentType->getChild() as $contentRow) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = $contentRow->dateTime->getShortDateTimeFormat();

            $contentType = $contentRow->getContentType();  // contentType->getContentType();

            if ($contentType->hasView()) {
                $div = new Div($page);
                $contentType->getView($div);
            }

            // $view = $contentRow->contentType->getContentType()->getView($div);
            //  $view->dataId = $contentRow->id;

            $btn = new AdminSiteButton($page);
            $btn->site = clone(ContentItemSite::$site);
            $btn->site->addParameter(new DataIdParameter($contentRow->id));
            $btn->site->title = 'View';

        }

        $page->render();


    }


}