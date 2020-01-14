<?php


namespace Nemundo\Process\Group\Com\Widget;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableRow;
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

        //$ul = new UnorderedList($this);

        $table=new AdminTable($this);

$userId = (new UserSessionType())->userId;
        $type=new UserContentType($userId);
        foreach ($type->getGroupList() as $groupRow) {

            $row = new TableRow($table);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->contentType);

          //  $ul->addText($groupRow->group);
          //  $groupRow->groupType->contentType

        }

        return parent::getContent();

    }

}