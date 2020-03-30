<?php
namespace Nemundo\Process\App\Podcast\Data\PodcastEpisode;
class PodcastEpisodeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $podcastId;

/**
* @var \Nemundo\Process\App\Podcast\Data\Podcast\PodcastExternalType
*/
public $podcast;

protected function loadModel() {
$this->tableName = "podcast_podcast_episode";
$this->aliasTableName = "podcast_podcast_episode";
$this->label = "Podcast Episode";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "podcast_podcast_episode";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "podcast_podcast_episode_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->podcastId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->podcastId->tableName = "podcast_podcast_episode";
$this->podcastId->fieldName = "podcast";
$this->podcastId->aliasFieldName = "podcast_podcast_episode_podcast";
$this->podcastId->label = "Podcast";
$this->podcastId->allowNullValue = false;

}
public function loadPodcast() {
if ($this->podcast == null) {
$this->podcast = new \Nemundo\Process\App\Podcast\Data\Podcast\PodcastExternalType($this, "podcast_podcast_episode_podcast");
$this->podcast->tableName = "podcast_podcast_episode";
$this->podcast->fieldName = "podcast";
$this->podcast->aliasFieldName = "podcast_podcast_episode_podcast";
$this->podcast->label = "Podcast";
}
return $this;
}
}