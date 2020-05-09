<?php

namespace Nemundo\Process\Template\Site\File;

use App\App\PdfSearch\Content\PdfDocumentContentType;
use Nemundo\Core\File\FileInformation;
use Nemundo\Core\File\Pdf\PdfFile;
use Nemundo\Core\System\OperatingSystem;
use Nemundo\Core\System\PhpEnvironment;
use Nemundo\Core\TextFile\Reader\TextFileReader;
use Nemundo\Package\Dropzone\DropzoneFileRequest;
use Nemundo\Package\Dropzone\DropzoneHttpResponse;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Web\Site\AbstractSite;
use PdfDemo\Content\DocumentIndex;
use PdfDemo\Data\Document\Document;
use PdfDemo\Data\Document\DocumentReader;
use PdfDemo\Data\Document\DocumentUpdate;

class FileSaveSite extends AbstractSite
{

    /**
     * @var FileSaveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'save';
        $this->menuActive = false;
      FileSaveSite::$site = $this;
    }

    public function loadContent()
    {

        (new PhpEnvironment())->setTimeLimit(180);

        $type = new FileContentType();
        $type->file->fromFileRequest((new DropzoneFileRequest()));
        $type->saveType();




        /*

        $documentRow = (new DocumentReader())->getRowById($documentId);
        $filename = $documentRow->document->getFullFilename();
        $file = new FileInformation($filename);


        if ((new OperatingSystem())->isLinux()) {

            if ($file->isPdf()) {

                $pdfFile = new PdfFile($filename);
                $text = $pdfFile->getPdfText();

            }

        }

        if ($file->isText()) {

            $txtFile = new TextFileReader($filename);
            $text = $txtFile->getText();

        }


        $update = new DocumentUpdate();
        $update->text = $text;
        $update->updateById($documentId);

        $documentRow = (new DocumentReader())->getRowById($documentId);
        (new DocumentIndex())->saveIndex($documentRow);*/


        (new DropzoneHttpResponse())->sendResponse();

    }
}