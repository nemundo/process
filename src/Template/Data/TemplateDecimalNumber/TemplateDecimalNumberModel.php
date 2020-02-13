<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\DecimalNumberType
*/
public $decimalNumber;

protected function loadModel() {
$this->tableName = "template_template_decimal_number";
$this->aliasTableName = "template_template_decimal_number";
$this->label = "Template Decimal Number";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_decimal_number";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_decimal_number_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->decimalNumber = new \Nemundo\Model\Type\Number\DecimalNumberType($this);
$this->decimalNumber->tableName = "template_template_decimal_number";
$this->decimalNumber->fieldName = "decimal_number";
$this->decimalNumber->aliasFieldName = "template_template_decimal_number_decimal_number";
$this->decimalNumber->label = "Decimal Number";
$this->decimalNumber->allowNullValue = false;

}
}