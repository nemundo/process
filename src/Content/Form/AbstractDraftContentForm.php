<?php


namespace Nemundo\Process\Content\Form;



use Nemundo\Admin\Com\Button\AdminSubmitButton;

abstract class AbstractDraftContentForm extends AbstractContentForm
{


    /**
     * @var AdminSubmitButton
     */
    private $draftButton;


    protected function loadContainer()
    {
        parent::loadContainer(); // TODO: Change the autogenerated stub

        $this->draftButton=new AdminSubmitButton();
        $this->draftButton->label='Entwurt speichern';
        $this->draftButton->value = 'save_draft';
        $this->draftButton->name = 'button';
        $this->draftButton->addCssClass('mr-3');

        $this->buttonFormRow->addContainerAtFirst($this->draftButton);


    }


    protected function onValidate()
    {

        $value = true;
        if (!$this->isDraft()) {
            $value = parent::onValidate();
        }

        return $value;

    }


    protected function isDraft() {

        $draft = false;
        if ($this->draftButton->getValue() == $this->draftButton->value) {
            $draft=true;
        }

        return $draft;

    }


}