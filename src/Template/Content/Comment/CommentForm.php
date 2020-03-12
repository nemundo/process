<?php


namespace Nemundo\Process\Template\Content\Comment;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class CommentForm extends AbstractContentForm
{

    /**
     * @var CommentContentType
     */
    public $contentType;

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

        $this->contentType->comment = $this->comment->getValue();
        $this->contentType->saveType();

    }

}