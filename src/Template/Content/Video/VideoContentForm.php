<?php


namespace Nemundo\Process\Template\Content\Video;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\Video\VideoContentType;

class VideoContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapFileUpload
     */
    private $file;

    public function getContent()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'Video';
        $this->file->acceptFileType = AcceptFileType::VIDEO;
        $this->file->multiUpload = true;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new VideoContentType();
            $type->parentId = $this->parentId;
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }

    }

}