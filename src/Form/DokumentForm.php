<?php


namespace Nemundo\Process\Form;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Schleuniger\App\ChangeRequest\Data\Dokument\Dokument;
use Schleuniger\App\ChangeRequest\Data\Kommentar\Kommentar;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogUpdate;

class DokumentForm extends AbstractChangeRequestForm
{

    /**
     * @var BootstrapFileUpload
     */
    private $file;

    public function getContent()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'Dokument';
        $this->file->multiUpload=true;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {



            $data = new Dokument();
            //$data->workflowLogId = $workflowLogId ;
            $data->dokument->fromFileRequest($fileRequest);
            $this->dataId=$data->save();

             $this->saveWorkflowLog();

            //$this->updateDataId();

        }


    }

}