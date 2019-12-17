<?php
namespace Nemundo\Process\App\Wiki\Site;
use Nemundo\Web\Site\AbstractSite;
class WikiDeleteSite extends AbstractSite {
protected function loadSite() {
$this->title = 'WikiDelete';
$this->url = 'wikidelete';
}
public function loadContent() {
}
}