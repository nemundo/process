<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImageModel extends \Nemundo\Model\Template\AbstractActiveModel {
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

protected function loadModel() {
$this->tableName = "process_template_image";
$this->aliasTableName = "process_template_image";
$this->label = "Template Image";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_image";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_image_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;


$this->image = new \Nemundo\Model\Type\File\ImageType($this);
$this->image->tableName = "process_template_image";
$this->image->fieldName = "image";
$this->image->aliasFieldName = "process_template_image_image";
$this->image->label = "Image";
$this->image->allowNullValue = false;
$this->imageAutoSize400 = new \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat($this->image);
$this->imageAutoSize400->size = 400;
$this->imageAutoSize1200 = new \Nemundo\Model\Type\ImageFormat\AutoSizeModelImageFormat($this->image);
$this->imageAutoSize1200->size = 1200;

}
}