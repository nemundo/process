<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $category;

protected function loadModel() {
$this->tableName = "process_notification_category";
$this->aliasTableName = "process_notification_category";
$this->label = "Category";

$this->primaryIndex = new \Nemundo\Db\Index\NumberIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_notification_category";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_notification_category_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->category = new \Nemundo\Model\Type\Text\TextType($this);
$this->category->tableName = "process_notification_category";
$this->category->fieldName = "category";
$this->category->aliasFieldName = "process_notification_category_category";
$this->category->label = "Category";
$this->category->allowNullValue = false;
$this->category->length = 50;

}
}