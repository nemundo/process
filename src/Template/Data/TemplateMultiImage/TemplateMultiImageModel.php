<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\File\ImageType
*/
public $image;

/**
* @var \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat
*/
public $imageAutoSize400;

/**
* @var \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat
*/
public $imageAutoSize1200;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $dataContentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $dataContent;

protected function loadModel() {
$this->tableName = "process_template_multi_image";
$this->aliasTableName = "process_template_multi_image";
$this->label = "Template Multi Image";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_multi_image";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_multi_image_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->image = new \Nemundo\Model\Type\File\ImageType($this);
$this->image->tableName = "process_template_multi_image";
$this->image->fieldName = "image";
$this->image->aliasFieldName = "process_template_multi_image_image";
$this->image->label = "Image";
$this->image->allowNullValue = false;
$this->imageAutoSize400 = new \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat($this->image);
$this->imageAutoSize400->size = 400;
$this->imageAutoSize1200 = new \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat($this->image);
$this->imageAutoSize1200->size = 1200;

$this->dataContentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->dataContentId->tableName = "process_template_multi_image";
$this->dataContentId->fieldName = "data_content";
$this->dataContentId->aliasFieldName = "process_template_multi_image_data_content";
$this->dataContentId->label = "Data Content";
$this->dataContentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->dataContentId);

}
public function loadDataContent() {
if ($this->dataContent == null) {
$this->dataContent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_template_multi_image_data_content");
$this->dataContent->tableName = "process_template_multi_image";
$this->dataContent->fieldName = "data_content";
$this->dataContent->aliasFieldName = "process_template_multi_image_data_content";
$this->dataContent->label = "Data Content";
}
return $this;
}
}