<?php

namespace Nemundo\Process\App\Calendar\Site;

use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Field\DistinctField;
use Nemundo\Db\Sql\Join\SqlJoinType;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexReader;
use Nemundo\Process\App\Calendar\Data\CalendarSourceType\CalendarSourceTypeReader;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Web\Site\AbstractSite;

class CalendarSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Calendar';
        $this->url = 'calendar';
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $formSearch=new SearchForm($page);

        $formRow=new BootstrapFormRow($formSearch);

        $sourceType=new BootstrapListBox($formRow);
        $sourceType->label='Quelle';
        $sourceType->submitOnChange=true;
        $sourceType->searchMode=true;

        $reader=new CalendarSourceTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $sourceTypeRow) {
            $sourceType->addItem($sourceTypeRow->contentTypeId,$sourceTypeRow->contentType->contentType);
        }


        $reader=new CalendarIndexReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();


        $distnct = new DistinctField($reader);
        $distnct->tableName = $reader->model->tableName;


        $treeModel = new TreeModel();
        //$treeModel->aliasTableName = 'tree2';
        $treeModel->loadParent();

        $join=new ModelJoin($reader);
        //$join->joinType = SqlJoinType::OUTER_JOIN;
        $join->externalModel=$treeModel;
        $join->externalType=$treeModel->childId;
        $join->type = $reader->model->contentId;

        $reader->addFieldByModel($treeModel);
        $reader->checkExternal($treeModel);

      //$reader->addFieldByModel($treeModel);
      //  $reader->addFieldByModel($treeModel->parent);


        if ($sourceType->hasValue()) {
            $reader->filter->andEqual($treeModel->parent->contentTypeId,$sourceType->getValue());
        }

        $table = new AdminClickableTable($page);

        $div = new Div($page);

        $header=new TableHeader($table);
        $header->addText($reader->model->date->label);
        $header->addText($reader->model->title->label);
        $header->addText('Type');
        $header->addText('Source');
        $header->addText('Source Type');

        foreach ($reader->getData() as $calendarIndexRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($calendarIndexRow->date->getShortDateLeadingZeroFormat());
            $row->addText($calendarIndexRow->title);


            $type=$calendarIndexRow->content->getContentType();
            $type->getView($div);

            $row->addText($type->typeLabel);

            $row->addText($calendarIndexRow->getModelValue($treeModel->parentId));

            //$row->addText($calendarIndexRow->getModelValue($treeModel->parent->subject));

            //$contentRow=(new ContentReader())->getRowById($calendarIndexRow->getModelValue($treeModel->parentId));
            //$row->addText($contentRow->subject);



            $ul = new UnorderedList($row);
            foreach ($type->getParentContent() as $parentContentRow) {

                $parentContentType = $parentContentRow->getContentType();
                $ul->addText($parentContentType->getSubject().' / '.$parentContentType->typeLabel);

            }


        }


        $page->render();


    }
}