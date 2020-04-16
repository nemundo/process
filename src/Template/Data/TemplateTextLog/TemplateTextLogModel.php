<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "process_template_text_log";
$this->aliasTableName = "process_template_text_log";
$this->label = "Template Text Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_text_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_text_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->textFrom = new \Nemundo\Model\Type\Text\TextType($this);
$this->textFrom->tableName = "process_template_text_log";
$this->textFrom->fieldName = "text_from";
$this->textFrom->aliasFieldName = "process_template_text_log_text_from";
$this->textFrom->label = "Text From";
$this->textFrom->allowNullValue = false;
$this->textFrom->length = 255;

$this->textTo = new \Nemundo\Model\Type\Text\TextType($this);
$this->textTo->tableName = "process_template_text_log";
$this->textTo->fieldName = "text_to";
$this->textTo->aliasFieldName = "process_template_text_log_text_to";
$this->textTo->label = "Text To";
$this->textTo->allowNullValue = false;
$this->textTo->length = 255;

}
}