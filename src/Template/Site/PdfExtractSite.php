<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\UniqueFilename;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Project\Path\TmpPath;
use Nemundo\Web\Site\AbstractSite;

class PdfExtractSite extends AbstractSite
{

    /**
     * @var PdfExtractSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Pdf Extract';
        $this->url = 'pdf-extract';
        $this->menuActive = false;

        PdfExtractSite::$site = $this;

    }


    public function loadContent()
    {

        $fileId = (new FileParameter())->getValue();

        $fileType = (new FileContentType($fileId));
        $fileRow = $fileType->getDataRow();

        $filenameInput = $fileRow->file->getFullFilename();
        $filenameOutput = (new TmpPath())
            ->addPath((new UniqueFilename())->getUniqueFilename('txt'))
            ->getFilename();

        //(new Debug())->write($fileRow->file->getFullFilename());

        $command = "pdftotext $filenameInput $filenameOutput";

        (new Debug())->write($command);

        $output = shell_exec($command);

        (new Debug())->write($output);



        // TODO: Implement loadContent() method.
    }

}