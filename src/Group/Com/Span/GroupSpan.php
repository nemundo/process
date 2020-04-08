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
            $text->addValue($userRow->user->displayName);
        }


        $this->title = $text->getTextWithSeperator();

        $groupReader = new GroupReader();
        $groupReader->filter->andEqual($groupReader->model->id, $this->groupId);
        foreach ($groupReader->getData() as $groupRow) {
            $this->content = $groupRow->group;
        }

        return parent::getContent();

    }

}