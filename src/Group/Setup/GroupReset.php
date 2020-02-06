<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Process\Group\Data\GroupType\GroupTypeDelete;
use Nemundo\Process\Group\Data\GroupType\GroupTypeUpdate;

class GroupReset
{


    public function reset() {

        $update = new GroupTypeUpdate();
        $update->setupStatus=false;
        $update->update();

    }


    public function delete() {

        $delete = new GroupTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }


}