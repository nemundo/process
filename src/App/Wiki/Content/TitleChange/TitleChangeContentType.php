<?php


namespace Nemundo\Process\App\Wiki\Content\TitleChange;


use Nemundo\Process\App\Wiki\Data\Wiki\WikiUpdate;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\Text\AbstractTextContentType;

class TitleChangeContentType extends AbstractTextContentType  // AbstractTreeContentType
{


    protected function loadContentType()
    {
       $this->typeLabel='Title Change';
       $this->typeId='859c1ef4-6d67-4b4f-8cbc-400ad91350e8';
       $this->formClass=TitleChangeContentForm::class;
       $this->viewClass=null;
    }


    protected function onCreate()
    {

        parent::onCreate();

        $update = new WikiUpdate();
        $update->title = $this->text;
        $update->updateById($this->getParentDataId());


    }


    public function getSubject()
    {

        $subject = 'Title Changed to '. $this->getDataRow()->text;
        return $subject;

    }


}