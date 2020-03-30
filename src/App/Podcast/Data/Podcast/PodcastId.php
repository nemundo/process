<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
use Nemundo\Model\Id\AbstractModelIdValue;
class PodcastId extends AbstractModelIdValue {
/**
* @var PodcastModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PodcastModel();
}
}