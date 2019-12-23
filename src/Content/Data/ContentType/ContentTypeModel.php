<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $phpClass;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "content2_content_type";
$this->aliasTableName = "content2_content_type";
$this->label = "Content Type";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content2_content_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content2_content_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->phpClass = new \Nemundo\Model\Type\Text\TextType($this);
$this->phpClass->tableName = "content2_content_type";
$this->phpClass->fieldName = "php_class";
$this->phpClass->aliasFieldName = "content2_content_type_php_class";
$this->phpClass->label = "Php Class";
$this->phpClass->allowNullValue = false;
$this->phpClass->length = 255;

$this->contentType = new \Nemundo\Model\Type\Text\TextType($this);
$this->contentType->tableName = "content2_content_type";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "content2_content_type_content_type";
$this->contentType->label = "Content Type";
$this->contentType->allowNullValue = false;
$this->contentType->length = 255;

}
}