<?php


namespace Nemundo\Process\Template\Content\Comment;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

use Nemundo\Process\Template\Status\CommentProcessStatus;

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

        $type = new CommentContentType();
        $type->parentId = $this->parentId;
        $type->comment = $this->comment->getValue();
        $type->saveType();

    }

}