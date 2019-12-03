<?php


namespace Nemundo\Process\Form;


use Nemundo\Core\Random\RandomText;
use Nemundo\Package\Bootstrap\FormElement\BootstrapCkEditor4Editor;
use Schleuniger\App\ChangeRequest\ChangeRequestConfig;
use Schleuniger\App\ChangeRequest\Data\Kommentar\Kommentar;

class KommentarForm extends AbstractChangeRequestForm
{

    /**
     * @var BootstrapCkEditor4Editor
     */
    private $kommentar;

    public function getContent()
    {

        $this->kommentar = new BootstrapCkEditor4Editor($this);
        $this->kommentar->label = 'Kommentar';
        $this->kommentar->validation = true;

        if (ChangeRequestConfig::$debugMode) {
            $this->kommentar->value = 'Test ' . (new RandomText())->getText();
        }

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $data = new Kommentar();
        //$data->workflowLogId = $workflowLogId;
        $data->kommentar = $this->kommentar->getValue();
        $this->dataId = $data->save();

        $this->saveWorkflowLog();


//        $this->updateDataId();

    }

}