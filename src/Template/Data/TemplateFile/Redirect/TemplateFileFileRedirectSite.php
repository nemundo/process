<?php
namespace Nemundo\Process\Template\Data\TemplateFile\Redirect;
class TemplateFileFileRedirectSite extends \Nemundo\Model\Redirect\AbstractRedirectFilenameSite {
public function loadSite() {
parent::loadSite();
$this->url = "process-template-file-file-redirect";
$this->model = new  \Nemundo\Process\Template\Data\TemplateFile\TemplateFileModel();
$this->type = $this->model->file;
TemplateFileRedirectConfig::$redirectTemplateFileFileSite = $this;
}
}