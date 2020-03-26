<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $category;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = CategoryModel::class;
$this->externalTableName = "notification_category";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->category = new \Nemundo\Model\Type\Text\TextType();
$this->category->fieldName = "category";
$this->category->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->category->aliasFieldName = $this->category->tableName . "_" . $this->category->fieldName;
$this->category->label = "Category";
$this->addType($this->category);

}
}