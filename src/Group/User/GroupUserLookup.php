<?php


namespace Nemundo\Process\Group\User;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Type\UserGroupType;
use Schleuniger\App\Org\Content\Mitarbeiter\MitarbeiterContentType;


// move to ...
class GroupUserLookup extends AbstractBase
{

    private $userId;

    public function __construct($userId)
    {
        $this->userId=$userId;
    }

    public function getGroupId() {

        $groupId = null;

        $reader = new GroupUserReader();
        $reader->model->loadGroup();
        //$reader->filter->andEqual($reader->model->group->groupTypeId, (new UserGroupType())->contentId);
        $reader->filter->andEqual($reader->model->group->groupTypeId, (new MitarbeiterContentType())->typeId);

        $reader->filter->andEqual($reader->model->userId,$this->userId);
        foreach ($reader->getData() as $groupUserRow) {
            $groupId = $groupUserRow->groupId;
        }

        return $groupId;

    }

}