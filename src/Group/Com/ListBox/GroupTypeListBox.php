<?php


namespace Nemundo\Process\Group\Com\ListBox;


use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupType\GroupTypeReader;

class GroupTypeListBox extends BootstrapListBox
{

    public function getContent()
    {

        $this->label = 'Group Type';

        /*
        $reader = new GroupReader();
        $reader->model->loadGroupType();
        $reader->addGroup($reader->model->groupTypeId);
        $reader->addOrder($reader->model->groupType->contentType);

        $count = new CountField($reader);

        foreach ($reader->getData() as $groupRow) {
            $label = $groupRow->groupType->contentType . ' (' . $groupRow->getModelValue($count) . ')';
            $this->addItem($groupRow->groupTypeId, $label);
        }*/

        $reader=new GroupTypeReader();
        $reader->model->loadGroupType();
        foreach ($reader->getData() as $groupTypeRow) {
            $this->addItem($groupTypeRow->groupTypeId,$groupTypeRow->groupType->contentType);
        }





        return parent::getContent();

    }

}