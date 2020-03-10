<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
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
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroupReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexReader;
use Nemundo\Process\Search\Type\SearchIndexTrait;
use Nemundo\Process\Tree\Type\TreeTypeTrait;
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


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site = ContentSite::$site;

        ContentSite::$site->showMenuAsActive = true;


        $contentType = (new ContentParameter())->getContentType(false);

        $contentReader = new ContentReader();
        $contentReader->model->loadUser();
        $contentRow = $contentReader->getRowById($contentType->getContentId());

        $title = new AdminTitle($page);
        $title->content = $contentType->getSubject();

        if ($contentType->hasView()) {
            $contentType->getView($page);
        } else {
            $p = new Paragraph($page);
            $p->content = '[No View]';
        }

        $table1 = new AdminLabelValueTable($page);
        $table1->addLabelValue('Subject', $contentType->getSubject());

        if ($contentType->isObjectOfTrait(TreeTypeTrait::class)) {
            $table1->addLabelYesNoValue('Has Parent', $contentType->hasParent());
            $table1->addLabelValue('Child Count', $contentType->getChildCount());
            $table1->addLabelValue('Parent Count', $contentType->getParentCount());
        }

        $table1->addLabelValue('Content Type Class', $contentType->getClassName());


        //$model = new ContentModel();

        $table1->addLabelValue('Content Id', $contentType->getContentId());
        $table1->addLabelValue('Data Id', $contentType->getDataId());


        $table1->addLabelValue($contentReader->model->dateTime->label, $contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
        $table1->addLabelValue($contentReader->model->user->label, $contentRow->user->displayName);


        if ($contentType->hasView()) {
            $view = $contentType->getView();
            $table1->addLabelValue('View Class', $view->getClassName());
            $table1->addLabelCom('View', $view);
        } else {
            $table1->addLabelValue('View', '[No View]');
        }


        if ($contentType->hasViewSite()) {
            $table1->addLabelSite('View Site', $contentType->getViewSite());
            $table1->addLabelSite('Subject View Site', $contentType->getSubjectViewSite());
        } else {
            $table1->addLabelValue('View Site', '[No View Site]');
        }


        if ($contentType->isObjectOfTrait(TreeTypeTrait::class)) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = 'Child';

            $table = new AdminClickableTable($page);

            $header = new TableHeader($table);
            $header->addText('Content Type');
            $header->addText('Subject (Data)');
            $header->addText('Subject (Type)');
            $header->addText('Item Order');
            $header->addText('Class');

            $header->addText('Date/Time');


            foreach ($contentType->getChild() as $contentRow) {

                $childContentType = $contentRow->getContentType();

                $row = new BootstrapClickableTableRow($table);
                $row->addText($contentRow->contentType->contentType);
                $row->addText($contentRow->subject);
                $row->addText($childContentType->getSubject());
                $row->addText($contentRow->itemOrder);
                $row->addText($childContentType->getClassName());

                $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());


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


        if ($contentType->isObjectOfTrait(SearchIndexTrait::class)) {

            $table1->addLabelValue('Search', 'yes');

            $table = new AdminTable($page);

            $header = new TableHeader($table);
            $header->addText('Search Word');

            $reader = new SearchIndexReader();
            $reader->model->loadWord();
            $reader->filter->andEqual($reader->model->contentId, $contentType->getContentId());
            foreach ($reader->getData() as $searchIndexRow) {

                $row = new TableRow($table);
                $row->addText($searchIndexRow->word->word);

            }


        } else {

            $table1->addLabelValue('Search', 'no');

        }


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


        /* $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();


            $form = $contentType->getForm($page);
            $form->parentId = $dataId;
            $form->redirectSite = ContentItemSite::$site;
            $form->redirectSite->addParameter(new DataParameter());

        }*/


        /*
        foreach ($contentType->getChild() as $contentRow) {

            $subtitle = new AdminSubtitle($page);
            $subtitle->content = $contentRow->dateTime->getShortDateTimeFormat();

            $contentType = $contentRow->getContentType();

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

        }*/

        $page->render();


    }


}