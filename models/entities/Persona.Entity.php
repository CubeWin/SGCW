<?php
class PersonaEntity
{
    private $id;
    private $name;
    private $surname;
    private $telephone;
    private $email;
    private $gender;
    private $create_at;
    private $update_at;
    private $disable_at;
    private $state;

    public function validate()
    {
        $response = false;

        if (
            $this->name != null &&
            $this->surname != null &&
            $this->gender != null &&
            $this->create_at != null &&
            $this->update_at != null &&
            $this->disable_at != null &&
            $this->state != null
        ) {
            $response = true;
        }
        return $response;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of create_at
     */
    public function getCreate_at()
    {
        return $this->create_at;
    }

    /**
     * Set the value of create_at
     *
     * @return  self
     */
    public function setCreate_at($create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * Get the value of state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of update_at
     */
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * Get the value of disable_at
     */
    public function getDisable_at()
    {
        return $this->disable_at;
    }

    /**
     * Set the value of disable_at
     *
     * @return  self
     */
    public function setDisable_at($disable_at)
    {
        $this->disable_at = $disable_at;

        return $this;
    }

    public function toString()
    {
        $response = array(
            "id" => $this->id,
            "name" => $this->name,
            "surname" => $this->surname,
            "telephone" => $this->telephone,
            "email" => $this->email,
            "gender" => $this->gender,
            "create_at" => $this->create_at,
            "state" => $this->state,
        );
        //echo "{name :". $this->name . "," . "surname :". $this->surname . ","  . "telephone :".$this->telephone . ","  . "email :".$this->email . ","  . "gender :".$this->gender . ","  . "create_at :".$this->create_at . ","  . "state :".$this->state . "}" ;
        return $response;
    }
}
