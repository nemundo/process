<?php


namespace Nemundo\Process\App\Task\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexPaginationReader;
use Nemundo\Process\App\Task\Com\TaskSearchForm;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Web\Site\AbstractSite;


class TaskSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Task';
        $this->url = 'task';
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        new TaskSearchForm($page);



        $reader = new TaskIndexPaginationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->model->loadAssignment();
        $reader->model->loadUser();

        $reader->addOrder($reader->model->deadline);

        $reader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText($reader->model->subject->label);
        $header->addText($reader->model->assignment->label);
        $header->addText($reader->model->deadline->label);
        $header->addText($reader->model->user->label);
        $header->addText($reader->model->dateTime->label);
        $header->addText($reader->model->closed->label);

        foreach ($reader->getData() as $taskRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($taskRow->subject);
            $row->addText($taskRow->assignment->group);
            $row->addText($taskRow->deadline->getShortDateLeadingZeroFormat());
            $row->addText($taskRow->user->login);
            $row->addText($taskRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addYesNo($taskRow->closed);

            $row->addClickableSite($taskRow->content->getContentType()->getViewSite());


        }


        $page->render();

        // TODO: Implement loadContent() method.
    }

}