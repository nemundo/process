<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
}