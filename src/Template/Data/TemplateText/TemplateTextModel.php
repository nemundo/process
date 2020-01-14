<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $text;

protected function loadModel() {
$this->tableName = "process_template_text";
$this->aliasTableName = "process_template_text";
$this->label = "Template Text";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_text";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_text_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->text = new \Nemundo\Model\Type\Text\TextType($this);
$this->text->tableName = "process_template_text";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "process_template_text_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;
$this->text->length = 255;

}
}