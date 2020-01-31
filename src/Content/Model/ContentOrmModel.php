<?php


namespace Nemundo\Process\Content\Model;


use Nemundo\App\ModelDesigner\Type\ExternalModelDesignerType;
use Nemundo\App\ModelDesigner\Type\TextModelDesignerType;
use Nemundo\Orm\Model\AbstractOrmModel;
use Nemundo\Orm\Type\DateTime\DateOrmType;
use Nemundo\Orm\Type\DateTime\DateTimeOrmType;
use Nemundo\Orm\Type\Number\NumberOrmType;
use Nemundo\Orm\Type\Number\YesNoOrmType;
use Nemundo\Orm\Type\Text\TextOrmType;
use Nemundo\Process\Content\Row\ContentCustomRow;
use Nemundo\Process\Content\Row\ContentTypeCustomRow;

class ContentOrmModel extends AbstractOrmModel
{

    /**
     * @var YesNoOrmType
     */
    public $active;

    /**
     * @var ExternalModelDesignerType
     */
    public $content;


    public function __construct()
    {

        parent::__construct();

        $this->templateLabel = 'Content Model';
        $this->templateName = 'content_model';
        $this->templateId = '5b496a78-e317-4e43-a0ec-7882a09ddf86';
        $this->templateExtendsClass = AbstractContentModel::class;

        $this->active = new YesNoOrmType($this);
        $this->active->label = 'Active';
        $this->active->fieldName = 'active';
        $this->active->variableName = 'active';
        $this->active->createModelProperty = false;
        $this->active->isEditable = false;

        $this->content = new ExternalModelDesignerType($this);
        $this->content->label = 'Content';
        $this->content->fieldName = 'content';
        $this->content->variableName = 'content';
        $this->content->createModelProperty = false;
        $this->content->isEditable = false;
        $this->content->externalClassName = 'Nemundo\Process\Content\Data\ContentType\ContentType';
        $this->content->rowClassName = ContentCustomRow::class;

    }


    protected function loadModel()
    {

    }

}