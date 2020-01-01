<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Process\Content\Type\AbstractContentType;

class UserContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->type='User';
        $this->contentId='8ef8e1d2-0c15-45b0-ba10-7c306d617406';
$this->viewClass=UserContentView::class;
        // TODO: Implement loadContentType() method.
    }


}