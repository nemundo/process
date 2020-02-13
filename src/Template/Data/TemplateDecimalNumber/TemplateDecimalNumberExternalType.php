<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\DecimalNumberType
*/
public $decimalNumber;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateDecimalNumberModel::class;
$this->externalTableName = "template_template_decimal_number";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->decimalNumber = new \Nemundo\Model\Type\Number\DecimalNumberType();
$this->decimalNumber->fieldName = "decimal_number";
$this->decimalNumber->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->decimalNumber->aliasFieldName = $this->decimalNumber->tableName . "_" . $this->decimalNumber->fieldName;
$this->decimalNumber->label = "Decimal Number";
$this->addType($this->decimalNumber);

}
}