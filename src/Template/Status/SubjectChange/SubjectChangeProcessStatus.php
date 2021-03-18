<?php


namespace Nemundo\Process\Template\Status\SubjectChange;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Text\TextBold;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\TemplateText\TemplateTextReader;
use Nemundo\Process\Template\Data\TemplateTextLog\TemplateTextLog;
use Nemundo\Process\Template\Data\TemplateTextLog\TemplateTextLogReader;
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

        $data=new TemplateTextLog();
        $data->textFrom = $this->getParentProcess()->getDataRow()->subject;
        $data->textTo = $this->subject;
        $this->dataId = $data->save();

        $this->getParentProcess()->changeSubject($this->subject);
        $this->getParentProcess()->saveIndex();

    }


    public function saveType()
    {

        $workflowRow = $this->getParentProcess()->getDataRow();

        if ($workflowRow->subject !== $this->subject) {
            parent::saveType();
        }

    }


    public function getSubject() {
        return $this->getParentContentType()->getSubject();
    }


    public function getMessage()
    {

        $from =  (new BoldText())->getBold((new TemplateTextLogReader())->getRowById($this->dataId)->textFrom);
        $to =  (new BoldText())->getBold((new TemplateTextLogReader())->getRowById($this->dataId)->textTo);

        $subject[LanguageCode::EN] = "Subject was changed from $from to $to";
        $subject[LanguageCode::DE] = "Betreff wurde geändert von $from nach $to";

        return (new Translation())->getText( $subject);

    }


}