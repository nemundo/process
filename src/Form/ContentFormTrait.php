<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Content\Type\AbstractContentType;

trait ContentFormTrait
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var string
     */
    public $dataId;

    /**
     * @var string
     */
    public $parentId;


    protected function loadUpdateForm() {

    }

}