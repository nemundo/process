<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroupReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
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

        $this->url = 'content-item';
        $this->menuActive = false;
        ContentItemSite::$site = $this;

        new ContentEditSite($this);

    }

    public function loadContent()
    {


        ContentSite::$site->showMenuAsActive=true;

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = ContentSite::$site;

        $contentType = (new ContentParameter())->getContentType(false);

        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject();

        if ($contentType->hasView()) {
            $contentType->getView($page);
        } else {
            $p = new Paragraph($page);
            $p->content = '[No View]';
        }

        $table = new AdminLabelValueTable($page);
        $table->addLabelValue('Subject', $contentType->getSubject());
        $table->addLabelYesNoValue('Has Parent', $contentType->hasParent());
        $table->addLabelValue('Child Count', $contentType->getChildCount());
        $table->addLabelValue('Parent Count', $contentType->getParentCount());
        $table->addLabelValue('Class', $contentType->getClassName());

        if ($contentType->hasViewSite()) {
            $table->addLabelSite('View Site', $contentType->getViewSite());
            $table->addLabelSite('Subject View Site', $contentType->getSubjectViewSite());
        } else {
            $table->addLabelValue('View', '[No View Site]');
        }

        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Child';

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Subject');

        foreach ($contentType->getChild() as $contentRow) {

            $childContentType = $contentRow->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentRow->contentType->contentType);
            $row->addText($contentRow->subject);
            $row->addText($childContentType->getSubject());

            $site = clone(ContentItemSite::$site);
            $site->addParameter(new ContentParameter($contentRow->id));
            //$site->title =$parentContentType->getSubject();  // $contentRow->subject;
            $row->addClickableSite($site);


        }


        if ($contentType->hasParent()) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = 'Parent Type';

            $table = new AdminClickableTable($page);

            $header->addText('Content Type');
            $header->addText('Subject');

            foreach ($contentType->getParentContent() as $contentRow) {

                $row = new BootstrapClickableTableRow($table);

                $parentContentType = $contentRow->getContentType();
                $row->addText($parentContentType->typeLabel);

                $row->addText($parentContentType->getSubject());
                $site = clone(ContentItemSite::$site);
                $site->addParameter(new ContentParameter($contentRow->id));
                //$site->title =$parentContentType->getSubject();  // $contentRow->subject;
                $row->addClickableSite($site);

            }

        }

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentEditSite::$site;
        $btn->site->addParameter(new ContentParameter());

        $btn = new AdminIconSiteButton($page);
        $btn->site = ContentDeleteSite::$site;
        $btn->site->addParameter(new ContentParameter());


        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Content User';

        $list = new UnorderedList($page);

        $reader = new ContentGroupReader();
        $reader->model->loadGroup();
        $reader->filter->andEqual($reader->model->contentId, $contentType->getContentId());
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
                $site->addParameter(new ContentParameter());
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
            $btn->site->addParameter(new ContentParameter($contentRow->id));
            $btn->site->title = 'View';

        }

        $page->render();


    }


}