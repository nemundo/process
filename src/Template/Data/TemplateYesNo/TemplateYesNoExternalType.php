<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $yesNo;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateYesNoModel::class;
$this->externalTableName = "template_template_yes_no";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->yesNo = new \Nemundo\Model\Type\Number\YesNoType();
$this->yesNo->fieldName = "yes_no";
$this->yesNo->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->yesNo->aliasFieldName = $this->yesNo->tableName . "_" . $this->yesNo->fieldName;
$this->yesNo->label = "Yes No";
$this->addType($this->yesNo);

}
}