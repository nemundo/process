<?php


namespace Nemundo\Process\App\Wiki\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;

class WikiCleanScript extends AbstractConsoleScript
{

  protected function loadScript()
  {
      $this->scriptName='wiki-clean';
  }

  public function run()
  {

      $reader=new WikiReader();
      foreach ($reader->getData() as $wikiRow) {


          (new WikiPageContentType($wikiRow->id))->deleteType();

      }


  }

}