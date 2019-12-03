<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Workflow\App\WorkflowTemplate\Com\WorkflowFancyboxHyperlink;
use Schleuniger\App\ChangeRequest\Data\Dokument\DokumentReader;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogModel;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogRow;
use Schleuniger\App\ChangeRequest\Parameter\DokumentParameter;
use Schleuniger\App\ChangeRequest\Site\Delete\DokumentDeleteSite;
use Nemundo\Process\Status\DokumentStatus;

class DokumentView extends AbstractChangeRequestView
{


    protected function loadView()
    {

        $this->status = new DokumentStatus();

    }


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Dokument');
        $header->addText('Ersteller');
        $header->addEmpty();

        $dokumentReader = new DokumentReader();

        $externalModel = new WorkflowLogModel();
        $externalModel->loadMitarbeiter();

        $join = new ModelJoin($dokumentReader);
        $join->type = $dokumentReader->model->id;
        $join->externalModel = $externalModel;
        $join->externalType =$externalModel->dataId;

        //$dokumentReader->model->loadWorkflowLog();
        //$dokumentReader->model->workflowLog->loadMitarbeiter();
        //$dokumentReader->filter->andEqual($dokumentReader->model->workflowLog->workflowId, $this->workflowId);

        $dokumentReader->filter->andEqual($externalModel->workflowId, $this->workflowId);

        //$dokumentReader->addFieldByModel($externalModel);
        $dokumentReader->checkExternal($externalModel);
        //$dokumentReader->addFieldByModel($externalModel);


        $dokumentReader->addOrder($dokumentReader->model->dokument->fileName);
        foreach ($dokumentReader->getData() as $dokumentRow) {

            $row = new TableRow($table);

            if (!$dokumentRow->deleted) {
                $link = new WorkflowFancyboxHyperlink($row);
                $link->filename = $dokumentRow->dokument->getFilename();
                $link->url = $dokumentRow->dokument->getUrl();

                //$row->addText($dokumentRow->workflowLog->mitarbeiter->getDisplayName());
            //    $row->addText($dokumentRow->workflowLog->mitarbeiter->login . ' ' . $dokumentRow->workflowLog->dateTime->getShortDateTimeFormat());

               //$workflowLogRow = new WorkflowLogRow($dokumentRow, $externalModel);

//                $login = $workflowLogRow->mitarbeiter->login;
//                $date = $workflowLogRow->dateTime->getShortDateLeadingZeroFormat();

                /*$login = $workflowLogRow->mitarbeiter->login;
                $date = $workflowLogRow->dateTime->getShortDateLeadingZeroFormat();
                $row->addText($login.' '.$date);*/



               // $row->addText(    $dokumentRow->getModelValue($externalModel->dateTime));

             //   $row->addText($dokumentRow->workflowLog->mitarbeiter->login . ' ' . $dokumentRow->workflowLog->dateTime->getShortDateTimeFormat());



                $site = clone(DokumentDeleteSite::$site);
                $site->addParameter(new DokumentParameter($dokumentRow->id));
                $row->addIconSite($site);


            } else {
                $stroke = new Strike($row);
                $stroke->content = $dokumentRow->dokument->getFilename();

                $row->addEmpty();
                $row->addEmpty();
                $row->addEmpty();

            }

        }

        /*if ($reader->getCount() == 0) {
            $this->visible = false;
        }*/

        return parent::getContent();

    }

}