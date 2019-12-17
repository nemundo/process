<?php
namespace Nemundo\Process\App\News\Data\News;
class NewsExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $teaser;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = NewsModel::class;
$this->externalTableName = "news_news";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->title = new \Nemundo\Model\Type\Text\TextType();
$this->title->fieldName = "title";
$this->title->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->title->aliasFieldName = $this->title->tableName . "_" . $this->title->fieldName;
$this->title->label = "Title";
$this->addType($this->title);

$this->teaser = new \Nemundo\Model\Type\Text\LargeTextType();
$this->teaser->fieldName = "teaser";
$this->teaser->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->teaser->aliasFieldName = $this->teaser->tableName . "_" . $this->teaser->fieldName;
$this->teaser->label = "Teaser";
$this->addType($this->teaser);

}
}