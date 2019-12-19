<?php
namespace Nemundo\Process\Template\Data\Youtube;
use Nemundo\Model\Id\AbstractModelIdValue;
class YoutubeId extends AbstractModelIdValue {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
}