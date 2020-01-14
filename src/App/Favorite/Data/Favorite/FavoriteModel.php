<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
class FavoriteModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $user;

protected function loadModel() {
$this->tableName = "favorite_favorite";
$this->aliasTableName = "favorite_favorite";
$this->label = "Favorite";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "favorite_favorite";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "favorite_favorite_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "favorite_favorite";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "favorite_favorite_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->userId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userId->tableName = "favorite_favorite";
$this->userId->fieldName = "user";
$this->userId->aliasFieldName = "favorite_favorite_user";
$this->userId->label = "User";
$this->userId->allowNullValue = false;

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "favorite_favorite_content");
$this->content->tableName = "favorite_favorite";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "favorite_favorite_content";
$this->content->label = "Content";
}
return $this;
}
public function loadUser() {
if ($this->user == null) {
$this->user = new \Nemundo\User\Data\User\UserExternalType($this, "favorite_favorite_user");
$this->user->tableName = "favorite_favorite";
$this->user->fieldName = "user";
$this->user->aliasFieldName = "favorite_favorite_user";
$this->user->label = "User";
}
return $this;
}
}