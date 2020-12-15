<?php
namespace Nemundo\Process\App\Favorite\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class FavoriteModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Favorite\Data\Favorite\FavoriteModel());
}
}