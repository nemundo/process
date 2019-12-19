<?php
namespace Nemundo\Process\Template\Data\Youtube;
use Nemundo\Model\Data\AbstractModelUpdate;
class YoutubeUpdate extends AbstractModelUpdate {
/**
* @var YoutubeModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->url, $this->url);
$this->typeValueList->setModelValue($this->model->youtubeId, $this->youtubeId);
parent::update();
}
}