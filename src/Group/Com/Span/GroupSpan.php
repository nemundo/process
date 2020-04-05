<?php


namespace Nemundo\Process\Group\Com\Span;


use Nemundo\Core\Directory\TextDirectory;
use Nemundo\Html\Inline\Span;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;

class GroupSpan extends Span
{

    public $groupId;

    public function getContent()
    {

        $text = new TextDirectory();

        $groupUserReader = new GroupUserReader();
        $groupUserReader->model->loadUser();
        $groupUserReader->filter->andEqual($groupUserReader->model->groupId, $this->groupId);
        foreach ($groupUserReader->getData() as $userRow) {
            //$this->sendUserNotification($userRow->userId,$category);
            $text->addValue($userRow->user->displayName);
        }


        $this->title = $text->getTextWithSeperator();

        $groupReader = new GroupReader();
        $groupReader->filter->andEqual($groupReader->model->id, $this->groupId);
        foreach ($groupReader->getData() as $groupRow) {
            $this->content = $groupRow->group;
        }


        //= $groupReader->getRowById($this->groupId);

        /*foreach ($this->getUserList() as $userRow) {
            $text->addValue($userRow->displayName);
        }*/

        //return $text->getTextWithSeperator();

        //$group = (new GroupContentType())->fromGroupId($this->groupId);

        //$span = new Bold();
        //$span->content = $group->getSubject();  // $this->workflowRow->assignment->group;
        //$this->title =  $text->getTextWithSeperator();  //$group->getUserListText();

        return parent::getContent();

    }

}