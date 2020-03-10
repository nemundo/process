<?php


namespace Nemundo\Process\Template\Status\SubjectChange;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class SubjectChangeStatusForm extends AbstractContentForm
{

    /**
     * @var SubjectChangeProcessStatus
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    private $subject;

    public function getContent()
    {

        $this->subject = new BootstrapTextBox($this);
        $this->subject->label[LanguageCode::EN] = 'Subject';
        $this->subject->label[LanguageCode::DE] = 'Betreff';

        $this->subject->value = $this->contentType->getParentProcess()->getDataRow()->subject;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        //$type = new SubjectChangeProcessStatus();
        //$type->parentId = $this->parentId;
        $this->contentType->subject = $this->subject->getValue();
        $this->contentType->saveType();

    }

}