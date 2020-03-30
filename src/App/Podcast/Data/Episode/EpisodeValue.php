<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var EpisodeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new EpisodeModel();
}
}