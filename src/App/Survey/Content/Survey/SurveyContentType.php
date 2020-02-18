<?php


namespace Nemundo\Process\App\Survey\Content\Survey;


use Nemundo\Process\App\Assignment\Content\Message\MessageAssignmentContentType;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;

use Nemundo\Process\App\Survey\Content\Answer\AnswerContentType;
use Nemundo\Process\App\Survey\Data\Survey\Survey;
use Nemundo\Process\App\Survey\Data\Survey\SurveyReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Session\UserSession;

class SurveyContentType extends AbstractSequenceContentType
{

    public $survey;

    public $question;

    protected function loadContentType()
    {

        $this->typeLabel = 'Survey';
        $this->typeId = 'b6757597-14a7-49a3-bf2c-8869917216a6';

        $this->formClass = SurveyContentForm::class;
        $this->viewClass = SurveyContentView::class;


        //$this->startContentType = new ErfassungContentType();  //  ErfassungContentType::class;

        $this->nextMenuClass=AnswerContentType::class;

    }


    protected function onCreate()
    {

        $data = new Survey();
        $data->survey = $this->survey;
        $data->question=$this->question;
        $this->dataId = $data->save();


        $assignment = new MessageAssignmentContentType();  // new AssignmentContentType();
        $assignment->parentId = $this->getContentId();
        $assignment->groupId = (new UserContentType((new UserSession())->userId))->getGroupId();
        $assignment->message = $this->getSubject();
        $assignment->saveType();

        $notification = new MessageNotificationContentType();
        $notification->parentId = $this->getContentId();
        $notification->toUserId = (new UserSession())->userId;
        $notification->saveType();

    }


    public function getDataRow()
    {

        $row = (new SurveyReader())->getRowById($this->dataId);
        return $row;

    }

    public function getSubject()
    {

        return $this->getDataRow()->survey;
    }


    /*
    public function getForm(AbstractHtmlContainer $parent)
    {

        $form= $this->startContentType->getForm($parent);
        return $form;

    }*/


}