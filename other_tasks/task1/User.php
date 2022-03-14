<?php

class User
{
    private $firstName = "";
    private $lastName = "";
    private $email = "";

    /**
     * It will change the default behaviour of class object when it treated as string
     * @return string
     */
    public function __toString()
    {
        return "{$this->firstName} {$this->lastName} &lt;$this->email&gt;";
    }

    public function setFirstName($value)
    {
        $this->firstName = $value;
        return $this;
    }

    public function setLastName($value)
    {
        $this->lastName = $value;
        return $this;
    }

    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }
}