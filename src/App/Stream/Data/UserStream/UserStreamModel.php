<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "stream_user_stream";
$this->aliasTableName = "stream_user_stream";
$this->label = "User Stream";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "stream_user_stream";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "stream_user_stream_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "stream_user_stream";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "stream_user_stream_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "stream_user_stream";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "stream_user_stream_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "stream_user_stream_user");
$this->user->tableName = "stream_user_stream";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "stream_user_stream_user";
$this->user->label = "User";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "stream_user_stream_content");
$this->content->tableName = "stream_user_stream";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "stream_user_stream_content";
$this->content->label = "Content";
}
return $this;
}
}