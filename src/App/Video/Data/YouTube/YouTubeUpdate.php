<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
use Nemundo\Model\Data\AbstractModelUpdate;
class YouTubeUpdate extends AbstractModelUpdate {
/**
* @var YouTubeModel
*/
public $model;

/**
* @var string
*/
public $youtubeId;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $description;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->youtubeId, $this->youtubeId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->description, $this->description);
parent::update();
}
}