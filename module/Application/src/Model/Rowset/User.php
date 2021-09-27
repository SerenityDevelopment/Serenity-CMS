<?php

namespace Application\Model\Rowset;

class User extends AbstractModel implements \Laminas\InputFilter\InputFilterAwareInterface
{
    
    public $add = null;
    
    public $edit = null;
    
    public $delete = null;
    
    public $login = null;
    
    public $logout = null;
    
    public $profile = null;
    
    public $id = null;
    
    public $username = null;
    
    public $email = null;
    
    public function getAdd()
    {
        return $this->add;
    }
    
    public function setAdd($value)
    {
        $this->add = $value;
        return $this;
    }
    
    public function getEdit()
    {
        return $this->edit;
    }
    
    public function setEdit($value)
    {
        $this->edit = $value;
        return $this;
    }
    
    public function getDelete()
    {
        return $this->delete;
    }
    
    public function setDelete($value)
    {
        $this->delete = $value;
        return $this;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function setLogin($value)
    {
        $this->login = $value;
        return $this;
    }
    
    public function getLogout()
    {
        return $this->logout;
    }
    
    public function setLogout($value)
    {
        $this->logout = $value;
        return $this;
    }
    
    public function getProfile()
    {
        return $this->profile;
    }
    
    public function setProfile($value)
    {
        $this->profile = $value;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($value)
    {
        $this->username = $value;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail()
    {
        $this->email = $value;
        return $this;
    }
    
    public function exchangeArray(array $row)
    {
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
        $this->username = (!empty($row['username'])) ? $row['username'] : null;
        $this->email = (!empty($row['email'])) ? $row['email'] : null;
        $this->add = (!empty($row['add'])) ? $row['add'] : null;
        $this->edit = (!empty($row['edit'])) ? $row['edit'] : null;
        $this->delete = (!empty($row['delete'])) ? $row['delete'] : null;
        $this->login = (!empty($row['login'])) ? $row['login'] : null;
        $this->logout = (!empty($row['logout'])) ? $row['logout'] : null;
        $this->profile = (!empty($row['profile'])) ? $row['profile'] : null;
        $this->id = (!empty($row['id'])) ? $row['id'] : null;
    }
    
    public function getArrayCopy()
    {
        return[
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'add' => $this->getAdd(),
            'edit' => $this->getEdit(),
            'delete' => $this->getDelete(),
            'login' => $this->getLogin(),
            'logout' => $this->getLogout(),
            'profile' => $this->getProfile(),
            'id' => $this->getId(),
        ];
    }
    
    public function getInputFilter()
    {
        return new \Laminas\InputFilter\InputFilter();
    }
    
    public function setInputFilter(\Laminas\InputFilter\InputFilterInterface $inputFilter)
    {
        throw new DomainException('This class does not support adding of extra input filters');
    }
    
    
}