<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
class WikiTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "wiki_wiki_type";
$this->aliasTableName = "wiki_wiki_type";
$this->label = "Wiki Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "wiki_wiki_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "wiki_wiki_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "wiki_wiki_type";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "wiki_wiki_type_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content_type";
$index->addType($this->contentTypeId);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "wiki_wiki_type_content_type");
$this->contentType->tableName = "wiki_wiki_type";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "wiki_wiki_type_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}