<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\User\Data\User\UserReader;

class UserContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->contentLabel='User';
        $this->contentId='8ef8e1d2-0c15-45b0-ba10-7c306d617406';
$this->viewClass=UserContentView::class;
        // TODO: Implement loadContentType() method.
    }


    public function getSubject()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }


}