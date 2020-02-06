<?php


namespace Nemundo\Process\App\Survey\Content\Survey;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class SurveyContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapTextBox
     */
    private $survey;

    /**
     * @var BootstrapLargeTextBox
     */
    private $question;

    public function getContent()
    {

        $this->survey=new BootstrapTextBox($this);
        $this->survey->label='Survey';
        $this->survey->validation=true;
        $this->survey->autofocus=true;

        $this->question=new BootstrapLargeTextBox($this);
        $this->question->label='Question';

        return parent::getContent();

    }


    protected function onSubmit()
    {


        $type  = new SurveyContentType();
        $type->parentId=$this->parentId;
        $type->survey = $this->survey->getValue();
        $type->question=$this->question->getValue();
        $type->saveType();


    }

}