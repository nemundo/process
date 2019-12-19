<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var YoutubeModel
*/
protected $model;

/**
* @var string
*/
public $url;

/**
* @var string
*/
public $youtubeId;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->url, $this->url);
$this->typeValueList->setModelValue($this->model->youtubeId, $this->youtubeId);
$id = parent::save();
return $id;
}
}