<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "dashboard_dashboard";
$this->aliasTableName = "dashboard_dashboard";
$this->label = "Dashboard";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "dashboard_dashboard";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "dashboard_dashboard_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "dashboard_dashboard";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "dashboard_dashboard_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "dashboard_dashboard_content");
$this->content->tableName = "dashboard_dashboard";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "dashboard_dashboard_content";
$this->content->label = "Content";
}
return $this;
}
}