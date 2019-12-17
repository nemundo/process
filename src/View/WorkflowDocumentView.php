<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogModel;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Parameter\DocumentParameter;
use Nemundo\Process\Template\Site\DocumentDeleteSite;
use Nemundo\Process\Template\Status\DocumentStatus;
use Nemundo\Workflow\App\WorkflowTemplate\Com\WorkflowFancyboxHyperlink;


class WorkflowDocumentView extends AbstractStatusView
{


    protected function loadView()
    {

  //      $this->status = new DokumentStatus();

    }


    public function getContent()
    {

        //$subtitle = new AdminSubtitle($this);
        //$subtitle->content = 'Document';

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Dokument');
        $header->addText('Ersteller');
        $header->addEmpty();

        $documentReader = new DocumentReader();

        $externalModel = new ContentModel();  // new WorkflowLogModel();
        $externalModel->loadUserCreated();  // loadMitarbeiter();

        $join = new ModelJoin($documentReader);
        $join->type = $documentReader->model->id;
        $join->externalModel = $externalModel;
        $join->externalType =$externalModel->dataId;

        //$dokumentReader->model->loadWorkflowLog();
        //$dokumentReader->model->workflowLog->loadMitarbeiter();
        //$dokumentReader->filter->andEqual($dokumentReader->model->workflowLog->workflowId, $this->workflowId);

  //      $documentReader->filter->andEqual($externalModel->workflowId, $this->workflowId);
//        $documentReader->filter->andEqual($externalModel->statusId, (new DocumentStatus())->id);

        $documentReader->filter->andEqual($externalModel->dataId, $this->workflowId);
        $documentReader->filter->andEqual($externalModel->contentTypeId, (new DocumentStatus())->id);



        //$dokumentReader->addFieldByModel($externalModel);

        $documentReader->checkExternal($externalModel);
        $documentReader->addFieldByModel($externalModel);

        $documentReader->addOrder($documentReader->model->document->fileName);
        foreach ($documentReader->getData() as $dokumentRow) {

            $row = new TableRow($table);

            if ($dokumentRow->active) {
                $link = new WorkflowFancyboxHyperlink($row);
                $link->filename = $dokumentRow->document->getFilename();
                $link->url = $dokumentRow->document->getUrl();

                $row->addText(    $dokumentRow->getModelValue($externalModel->dateTimeCreated));
                $row->addText(    $dokumentRow->getModelValue($externalModel->userCreated->displayName));


             //   $row->addText($dokumentRow->workflowLog->mitarbeiter->login . ' ' . $dokumentRow->workflowLog->dateTime->getShortDateTimeFormat());

                $site = clone(DocumentDeleteSite::$site);
                $site->addParameter(new WorkflowParameter($this->workflowId));
                $site->addParameter(new DocumentParameter($dokumentRow->id));
                $row->addIconSite($site);


            } else {
                $stroke = new Strike($row);
                $stroke->content = $dokumentRow->document->getFilename();

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