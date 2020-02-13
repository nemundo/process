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
$this->tableName = "template_template_number";
$this->aliasTableName = "template_template_number";
$this->label = "Template Number";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_number";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_number_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->number = new \Nemundo\Model\Type\Number\NumberType($this);
$this->number->tableName = "template_template_number";
$this->number->fieldName = "number";
$this->number->aliasFieldName = "template_template_number_number";
$this->number->label = "Number";
$this->number->allowNullValue = false;

}
}