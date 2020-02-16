<?php


namespace Nemundo\Process\App\Wiki\Content\TitleChange;


use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiRow;
use Nemundo\Process\Template\Content\Text\AbstractTextContentForm;

class TitleChangeContentForm extends AbstractTextContentForm
{

    public function getContent()
    {


        /** @var WikiRow $wikiRow */
       $wikiRow = $this->contentType->getParentContentType()->getDataRow();

        $this->text->label='New Title';
$this->text->value=$wikiRow->title;

        $p=new Paragraph($this);
        $p->content='parent id'.$this->parentId;


        return parent::getContent();
    }

}