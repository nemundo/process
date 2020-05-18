<?php

namespace Nemundo\Process\Template\Site\File;

use Nemundo\Core\System\PhpEnvironment;
use Nemundo\Package\Dropzone\DropzoneFileRequest;
use Nemundo\Package\Dropzone\DropzoneHttpResponse;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Web\Site\AbstractSite;


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

        // Check for Video,Audio etc.

        $type = new FileContentType();
        $type->file->fromFileRequest((new DropzoneFileRequest()));
        $type->saveType();

        (new DropzoneHttpResponse())->sendResponse();

    }
}