<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $textFrom;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $textTo;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateTextLogModel::class;
$this->externalTableName = "process_template_text_log";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->textFrom = new \Nemundo\Model\Type\Text\TextType();
$this->textFrom->fieldName = "text_from";
$this->textFrom->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->textFrom->aliasFieldName = $this->textFrom->tableName . "_" . $this->textFrom->fieldName;
$this->textFrom->label = "Text From";
$this->addType($this->textFrom);

$this->textTo = new \Nemundo\Model\Type\Text\TextType();
$this->textTo->fieldName = "text_to";
$this->textTo->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->textTo->aliasFieldName = $this->textTo->tableName . "_" . $this->textTo->fieldName;
$this->textTo->label = "Text To";
$this->addType($this->textTo);

}
}