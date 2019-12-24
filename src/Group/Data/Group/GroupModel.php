<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $group;

protected function loadModel() {
$this->tableName = "group_group";
$this->aliasTableName = "group_group";
$this->label = "Group";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "group_group";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "group_group_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->group = new \Nemundo\Model\Type\Text\TextType($this);
$this->group->tableName = "group_group";
$this->group->fieldName = "group";
$this->group->aliasFieldName = "group_group_group";
$this->group->label = "Group";
$this->group->allowNullValue = false;
$this->group->length = 255;

}
}