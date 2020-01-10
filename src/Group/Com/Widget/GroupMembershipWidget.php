<?php


namespace Nemundo\Process\Group\Com\Widget;


use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Type\UserSessionType;

class GroupMembershipWidget extends AbstractAdminWidget
{

    protected function loadWidget()
    {
      $this->widgetTitle='Group Membership';
    }


    public function getContent()
    {

        $ul = new UnorderedList($this);

$userId = (new UserSessionType())->userId;
        $type=new UserContentType($userId);
        foreach ($type->getGroupList() as $groupRow) {
            $ul->addText($groupRow->group);
        }

        return parent::getContent();

    }

}