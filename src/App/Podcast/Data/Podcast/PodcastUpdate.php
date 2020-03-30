<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
use Nemundo\Model\Data\AbstractModelUpdate;
class PodcastUpdate extends AbstractModelUpdate {
/**
* @var PodcastModel
*/
public $model;

/**
* @var string
*/
public $rssUrl;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->rssUrl, $this->rssUrl);
parent::update();
}
}