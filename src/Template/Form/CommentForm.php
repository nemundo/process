<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Item\CommentItem;

class CommentForm extends AbstractContentForm
{

    /**
     * @var BootstrapLargeTextBox
     */
    private $comment;

    public function getContent()
    {

        $this->comment = new BootstrapLargeTextBox($this);
        $this->comment->label = 'Comment';

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $builder = new CommentItem();
        //$builder->contentType = $this->contentType;
        $builder->parentId = $this->parentId;
        $builder->comment = $this->comment->getValue();
        $builder->saveType();

    }

}