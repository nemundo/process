<?php


namespace Nemundo\Process\App\Notification\Filter;


use Nemundo\Db\Filter\AbstractFilter;
use Nemundo\Process\App\Notification\Data\Notification\NotificationModel;
use Nemundo\Process\App\Notification\Parameter\ArchiveParameter;
use Nemundo\Process\App\Notification\Parameter\SourceParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\User\Type\UserSessionType;

class UserNotificationFilter extends AbstractFilter
{

    private $filterContentType;

    public function __construct($filterContentType = true)
    {

        $this->filterContentType = $filterContentType;
        parent::__construct();

    }

    protected function loadFilter()
    {

        $model = new NotificationModel();

        $this->andEqual($model->toId, (new UserSessionType())->userId);

        if ((new ArchiveParameter())->getValue() == '1') {
            $this->andEqual($model->archive, true);
        } else {
            $this->andEqual($model->archive, false);
        }

        $parameter=new SourceParameter();
        if ($parameter->hasValue()) {
            $this->andEqual($model->sourceId, $parameter->getValue());
        }


        if ($this->filterContentType) {
            $parameter = new ContentTypeParameter();
            if ($parameter->hasValue()) {
                $this->andEqual($model->contentTypeId, $parameter->getValue());
            }
        }


    }

}