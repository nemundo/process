<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var YouTubeModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->youtubeId, $this->youtubeId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->description, $this->description);
$id = parent::save();
return $id;
}
}