<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $largeText;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = LargeTextModel::class;
$this->externalTableName = "process_template_large_text";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->largeText = new \Nemundo\Model\Type\Text\LargeTextType();
$this->largeText->fieldName = "large_text";
$this->largeText->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->largeText->aliasFieldName = $this->largeText->tableName . "_" . $this->largeText->fieldName;
$this->largeText->label = "Large Text";
$this->addType($this->largeText);

}
}