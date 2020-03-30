<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var PodcastModel
*/
protected $model;

/**
* @var string
*/
public $rssUrl;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->rssUrl, $this->rssUrl);
$id = parent::save();
return $id;
}
}