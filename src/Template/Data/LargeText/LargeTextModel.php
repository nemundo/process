<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $largeText;

protected function loadModel() {
$this->tableName = "process_template_large_text";
$this->aliasTableName = "process_template_large_text";
$this->label = "Large Text";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_large_text";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_large_text_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->largeText = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->largeText->tableName = "process_template_large_text";
$this->largeText->fieldName = "large_text";
$this->largeText->aliasFieldName = "process_template_large_text_large_text";
$this->largeText->label = "Large Text";
$this->largeText->allowNullValue = false;

}
}