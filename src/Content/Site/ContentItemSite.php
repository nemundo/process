<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
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
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroupReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
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

        $nav = new AdminNavigation($page);
        $nav->site=ContentSite::$site;

        $dataId = (new DataParameter())->getValue();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $contentRow = $reader->getRowById($dataId);
        $contentType = $contentRow->getContentType();


        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject();

        if ($contentType->hasView()) {
            $contentType->getView($page);
        } else {
            $p=new Paragraph($page);
            $p->content='[No View]';
        }

        $table = new AdminLabelValueTable($page);
        $table->addLabelValue('Subject', $contentType->getSubject());
        $table->addLabelYesNoValue('Has Parent', $contentType->hasParent());
        $table->addLabelValue('Child Count', $contentType->getChildCount());
        $table->addLabelValue('Parent Count', $contentType->getParentCount());

        if ($contentType->hasViewSite()) {
            $table->addLabelSite('View', $contentType->getViewSite());
        } else {
            $table->addLabelValue('View', '[No View Site]');
        }

        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Child';

        $table = new AdminTable($page);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Subject');

        foreach ($contentType->getChild() as $contentRow) {

            $childContentType = $contentRow->getContentType();

            $row = new TableRow($table);
            $row->addText($contentRow->contentType->contentType);
            $row->addText($contentRow->subject);
            $row->addText($childContentType->getSubject());

        }





        if ($contentType->hasParent()) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = 'Parent Type';

            $table = new AdminClickableTable($page);

            $header->addText('Content Type');
            $header->addText('Subject');

            foreach ($contentType->getParentContent() as $contentRow) {

                $row = new TableRow($table);

                $parentContentType=$contentRow->getContentType();
                $row->addText($parentContentType->typeLabel);

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new DataParameter($contentRow->id));
                $site->title =$parentContentType->getSubject();  // $contentRow->subject;
                $row->addSite($site);

            }

        }

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentEditSite::$site;
        $btn->site->addParameter(new DataParameter());

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentDeleteSite::$site;
        $btn->site->addParameter(new DataParameter());



        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Content User';

        $list = new UnorderedList($page);

        $reader = new ContentGroupReader();
        $reader->model->loadGroup();
        $reader->filter->andEqual($reader->model->contentId, $dataId);
        foreach ($reader->getData() as $contentGroupRow) {
            $list->addText($contentGroupRow->group->group);
        }


        //$btn = new FavoriteButton($page);
        //$btn->dataId = $dataId;


        if ($contentType->isObjectOfTrait(MenuTrait::class)) {

            $dropdown = new BootstrapSiteDropdown($page);

            //$reader = new ContentTypeReader();
            //foreach ($reader->getData() as $contentTypeRow) {

            foreach ($contentType->getMenuList() as $menuContentType) {

                $site = clone(ContentItemSite::$site);
                $site->title = $menuContentType->typeLabel;  // $contentTypeRow->contentType;
                $site->addParameter(new DataParameter());
                $site->addParameter(new ContentTypeParameter($menuContentType->typeId));

                $dropdown->addSite($site);

            }

        }


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();

            $form = $contentType->getForm($page);
            $form->parentId = $dataId;
            $form->redirectSite = ContentItemSite::$site;
            $form->redirectSite->addParameter(new DataParameter());

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
            $btn->site->addParameter(new DataParameter($contentRow->id));
            $btn->site->title = 'View';

        }

        $page->render();


    }


}