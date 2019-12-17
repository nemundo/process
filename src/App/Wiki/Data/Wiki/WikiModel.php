<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

protected function loadModel() {
$this->tableName = "wiki_wiki";
$this->aliasTableName = "wiki_wiki";
$this->label = "Wiki";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "wiki_wiki";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "wiki_wiki_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "wiki_wiki";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "wiki_wiki_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

}
}