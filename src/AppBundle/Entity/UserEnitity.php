<?php

class UserEntity
{
    private $userName;

    public function setUserName($name)
    {
        $this->userName = $name;
    }

    public function getUserName()
    {
        return $this->userName;
    }
}
