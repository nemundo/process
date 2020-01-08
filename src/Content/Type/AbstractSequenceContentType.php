<?php


namespace Nemundo\Process\Content\Type;


abstract class AbstractSequenceContentType extends AbstractTreeContentType
{

    use MenuTrait;

    /**
     * @var AbstractMenuContentType
     */
    public $startContentType;

    /**
     * @var string
     */
    protected $nextMenuClass;

    /**
     * @var string
     */
    protected $previousMenuClass;


    // getNextContentType
    public function getNextMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->nextMenuClass !== null) {
            $className = $this->nextMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


    public function getPreviousMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->previousMenuClass !== null) {
            $className = $this->previousMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


}