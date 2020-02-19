<?php


namespace Nemundo\Process\Group\Com\Widget;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Type\UserSessionType;

class GroupMembershipWidget extends AbstractAdminWidget
{

    protected function loadWidget()
    {
        $this->widgetTitle = 'Group Membership';
    }


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Group');
        $header->addText('Type');

        $userId = (new UserSessionType())->userId;
        $type = new UserContentType($userId);
        foreach ($type->getGroupMembershipList() as $groupRow) {

            $row = new TableRow($table);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->contentType);

        }




        return parent::getContent();

    }

}