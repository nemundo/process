<?php


namespace Nemundo\Process\Template\Status\SubjectChange;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Text\TextBold;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextReader;
use Nemundo\Process\Text\BoldText;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;


class SubjectChangeProcessStatus extends AbstractProcessStatus
{

    public $subject;


    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Subject Change';
        $this->typeLabel[LanguageCode::DE] = 'Betreff Ändern';
        $this->typeId = '54527fcb-d417-4bd4-acfe-53e5e689e3bb';

        $this->formClass = SubjectChangeStatusForm::class;

    }


    protected function onCreate()
    {

        $data = new TemplateText();
        $data->text = $this->subject;
        $this->dataId = $data->save();

        $this->getParentProcess()->changeSubject($this->subject);

    }


    public function saveType()
    {


        $workflowRow = $this->getParentProcess()->getDataRow();

        if ($workflowRow->subject !== $this->subject) {
            parent::saveType();
        }


    }


    public function getSubject()
    {

        //$this->typeLabel[LanguageCode::EN] = 'Subject Change';
        //$this->typeLabel[LanguageCode::DE] = 'Betreff Ändern';


        $subject = 'Subject was changed to ' . (new BoldText())->getBold((new TemplateTextReader())->getRowById($this->dataId)->text);



        return $subject;

    }


}