<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $date;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateDateModel::class;
$this->externalTableName = "template_template_date";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->date = new \Nemundo\Model\Type\DateTime\DateType();
$this->date->fieldName = "date";
$this->date->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->date->aliasFieldName = $this->date->tableName . "_" . $this->date->fieldName;
$this->date->label = "Date";
$this->addType($this->date);

}
}