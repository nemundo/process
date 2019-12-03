<?php


namespace Nemundo\Process\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\Bootstrap\Table\BootstrapTable;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogReader;


class WorkflowLogTable extends AdminTable
{

    /**
     * @var string
     */
    public $workflowId;


    public function getContent()
    {

        $reader = new WorkflowLogReader();
        $reader->model->loadStatus();
        $reader->model->loadUser();// loadMitarbeiter();
        $reader->filter->andEqual($reader->model->workflowId, $this->workflowId);
        foreach ($reader->getData() as $logRow) {

            $row = new TableRow($this);
            //$row->addText($logRow->status->statusLabel);

            $status = $logRow->status->getStatus();
            $row->addText($status->getLogText($logRow->dataId));


//            $row->addText($logRow->mitarbeiter->login.' '.$logRow->dateTime->getShortDateLeadingZeroFormat());
            $row->addText($logRow->user->login.' '.$logRow->dateTime->getShortDateLeadingZeroFormat());


            //$row->addText($logRow->mitarbeiter->getDisplayName());
            //$row->addText($logRow->dateTime->getShortDateTimeLeadingZeroFormat());
            //$row->addText($logRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

        }



        return parent::getContent();

    }


}