<?php


namespace Nemundo\Process\Group\Content;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Group\Type\GroupContentType;


class GroupContentForm extends AbstractContentForm
{

    /**
     * @var GroupContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    private $group;

    public function getContent()
    {

        $this->group = new BootstrapTextBox($this);
        $this->group->label[LanguageCode::EN] = 'Group';
        $this->group->label[LanguageCode::DE] = 'Gruppe';

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $this->contentType->group = $this->group->getValue();
        $this->contentType->saveType();

    }

}