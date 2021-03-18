<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $number;

protected function loadModel() {
$this->tableName = "process_template_number";
$this->aliasTableName = "process_template_number";
$this->label = "Template Number";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_number";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_number_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->number = new \Nemundo\Model\Type\Number\NumberType($this);
$this->number->tableName = "process_template_number";
$this->number->fieldName = "number";
$this->number->aliasFieldName = "process_template_number_number";
$this->number->label = "Number";
$this->number->allowNullValue = false;

}
}