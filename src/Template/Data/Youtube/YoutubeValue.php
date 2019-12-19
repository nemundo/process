<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
}