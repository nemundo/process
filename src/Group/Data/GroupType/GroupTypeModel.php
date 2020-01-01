<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $groupType;

protected function loadModel() {
$this->tableName = "group_group_type";
$this->aliasTableName = "group_group_type";
$this->label = "Group Type";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "group_group_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "group_group_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->groupType = new \Nemundo\Model\Type\Text\TextType($this);
$this->groupType->tableName = "group_group_type";
$this->groupType->fieldName = "group_type";
$this->groupType->aliasFieldName = "group_group_type_group_type";
$this->groupType->label = "Group Type";
$this->groupType->allowNullValue = false;
$this->groupType->length = 255;

}
}