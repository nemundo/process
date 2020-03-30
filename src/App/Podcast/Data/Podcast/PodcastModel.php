<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $rssUrl;

protected function loadModel() {
$this->tableName = "podcast_podcast";
$this->aliasTableName = "podcast_podcast";
$this->label = "Podcast";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "podcast_podcast";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "podcast_podcast_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->rssUrl = new \Nemundo\Model\Type\Text\TextType($this);
$this->rssUrl->tableName = "podcast_podcast";
$this->rssUrl->fieldName = "rss_url";
$this->rssUrl->aliasFieldName = "podcast_podcast_rss_url";
$this->rssUrl->label = "Rss Url";
$this->rssUrl->allowNullValue = false;
$this->rssUrl->length = 255;

}
}