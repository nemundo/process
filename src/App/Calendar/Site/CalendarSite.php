<?php

namespace Nemundo\Process\App\Calendar\Site;

use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexPaginationReader;
use Nemundo\Process\App\Calendar\Data\CalendarSourceType\CalendarSourceTypeReader;
use Nemundo\Process\Config\ProcessConfig;
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


        $formSearch = new SearchForm($page);

        $formRow = new BootstrapFormRow($formSearch);

        $sourceType = new BootstrapListBox($formRow);
        $sourceType->label = 'Quelle';
        $sourceType->submitOnChange = true;
        $sourceType->searchMode = true;

        $reader = new CalendarSourceTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $sourceTypeRow) {
            $sourceType->addItem($sourceTypeRow->contentTypeId, $sourceTypeRow->contentType->contentType);
        }


        $reader = new CalendarIndexPaginationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();

        $reader->filter->andEqualOrGreater($reader->model->date, (new Date())->setNow()->getIsoDateFormat());

        $reader->addOrder($reader->model->date);
        $reader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($page);

        $div = new Div($page);

        $header = new TableHeader($table);
        $header->addText($reader->model->date->label);
        $header->addText($reader->model->title->label);
        $header->addText('View');
        $header->addText('Type');
        $header->addText('Source');
        $header->addText('Source Type');

        foreach ($reader->getData() as $calendarIndexRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($calendarIndexRow->date->getShortDateLeadingZeroFormat());
            $row->addText($calendarIndexRow->title);


            $row->addText($calendarIndexRow->content->contentType->contentType);

            $type = $calendarIndexRow->content->getContentType();
            $type->getView($row);

            $row->addText($type->typeLabel);

            $row->addClickableSite($type->getViewSite());

        }


        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $reader;


        $page->render();


    }
}