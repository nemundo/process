<?php


namespace Nemundo\Process\Group\Com\Widget;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Session\UserSession;

class GroupMembershipWidget extends AbstractAdminWidget
{

    protected function loadWidget()
    {
        $this->widgetTitle = 'Group Membership';
    }


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new AdminTableHeader($table);
        $header->addText('Group');
        $header->addText('Type');

        $userId = (new UserSession())->userId;
        $type = new UserContentType($userId);
        foreach ($type->getGroupMembershipList() as $groupRow) {

            $row = new TableRow($table);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->contentType);

        }




        return parent::getContent();

    }

}