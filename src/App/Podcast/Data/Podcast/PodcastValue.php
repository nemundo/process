<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var PodcastModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
}