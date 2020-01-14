<?php


namespace Nemundo\Process\Template\Content\VersionText;


use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;

class VersionTextContentType extends AbstractTreeContentType
{

    public $text;

    protected function loadContentType()
    {
        $this->typeLabel='Version Text';
        $this->typeId='058c6cdf-41b5-4b66-8474-6822278389e5';
        $this->formClass=VersionTextContentForm::class;
        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $this->dataId = (new UniqueId())->getUniqueId();

        //$this->saveContent();

        //$data=new TemplateText();

        $type = new TextContentType();
        $type->parentId=$this->getContentId();
        $type->text=$this->text;
        //$type->saveContent()
        $type->saveType();


    }

}