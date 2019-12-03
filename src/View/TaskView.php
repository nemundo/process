<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Core\Debug\Debug;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;
use Nemundo\Process\Status\Eco\AufgabenListeStatus;
use Schleuniger\App\Task\Content\Type\Process\TaskProcess;
use Schleuniger\App\Task\Data\Task\TaskReader;

class TaskView extends AbstractChangeRequestView
{

   protected function loadView()
   {
       $this->status=new AufgabenListeStatus();
   }


    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $taskReader=new TaskReader();
        $taskReader->filter->andEqual($taskReader->model->sourceDataId,$this->workflowId);
        //$taskReader->filter->andEqual($contentLogModel->parentId, $this->dataId);
        foreach ($taskReader->getData() as $taskRow) {

            $taskProcess = new TaskProcess($taskRow->id);

            $row = new BootstrapClickableTableRow($table);

            if ($taskRow->done) {
                $row->addYesNo(true);
            } else {
                $trafficLight = new DateTrafficLight($row);
                $trafficLight->date = $taskRow->deadline;
            }

            $row->addText($taskProcess->getSubject());
            $row->addText($taskRow->zuweisung->getValue());
            //$row->addText($taskRow->zuweisung->identificationType->getValue($taskRow->zuweisung->identificationId));

            //(new Debug())->write($taskRow->zuweisung->identificationType);

            $row->addClickableSite($taskProcess->getViewSite());

        }

        return parent::getContent();

    }

}