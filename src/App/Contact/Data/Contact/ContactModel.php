<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $company;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $lastName;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $firstName;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $phone;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $email;

protected function loadModel() {
$this->tableName = "contact_contact";
$this->aliasTableName = "contact_contact";
$this->label = "Contact";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "contact_contact";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "contact_contact_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->company = new \Nemundo\Model\Type\Text\TextType($this);
$this->company->tableName = "contact_contact";
$this->company->fieldName = "company";
$this->company->aliasFieldName = "contact_contact_company";
$this->company->label = "Company";
$this->company->allowNullValue = false;
$this->company->length = 255;

$this->lastName = new \Nemundo\Model\Type\Text\TextType($this);
$this->lastName->tableName = "contact_contact";
$this->lastName->fieldName = "last_name";
$this->lastName->aliasFieldName = "contact_contact_last_name";
$this->lastName->label = "Last Name";
$this->lastName->allowNullValue = false;
$this->lastName->length = 255;

$this->firstName = new \Nemundo\Model\Type\Text\TextType($this);
$this->firstName->tableName = "contact_contact";
$this->firstName->fieldName = "first_name";
$this->firstName->aliasFieldName = "contact_contact_first_name";
$this->firstName->label = "First Name";
$this->firstName->allowNullValue = false;
$this->firstName->length = 255;

$this->phone = new \Nemundo\Model\Type\Text\TextType($this);
$this->phone->tableName = "contact_contact";
$this->phone->fieldName = "phone";
$this->phone->aliasFieldName = "contact_contact_phone";
$this->phone->label = "Phone";
$this->phone->allowNullValue = false;
$this->phone->length = 255;

$this->email = new \Nemundo\Model\Type\Text\TextType($this);
$this->email->tableName = "contact_contact";
$this->email->fieldName = "email";
$this->email->aliasFieldName = "contact_contact_email";
$this->email->label = "eMail";
$this->email->allowNullValue = false;
$this->email->length = 255;

}
}