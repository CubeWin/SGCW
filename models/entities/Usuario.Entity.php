<?php

class UsuarioEntity
{
    private $id;
    private $id_persona;
    private $id_grupo;
    private $user;
    private $password;
    private $token;
    private $create_at;
    private $update_at;
    private $disable_at;
    private $state;

    public function validate()
    {
        $response = false;
        if (
            $this->id_persona != null &&
            $this->id_grupo != null &&
            $this->user != null &&
            $this->password != null &&
            $this->create_at != null &&
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
     * Get the value of id_persona
     */
    public function getId_persona()
    {
        return $this->id_persona;
    }

    /**
     * Set the value of id_persona
     *
     * @return  self
     */
    public function setId_persona($id_persona)
    {
        $this->id_persona = $id_persona;

        return $this;
    }

    /**
     * Get the value of id_grupo
     */
    public function getId_grupo()
    {
        return $this->id_grupo;
    }

    /**
     * Set the value of id_grupo
     *
     * @return  self
     */
    public function setId_grupo($id_grupo)
    {
        $this->id_grupo = $id_grupo;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function toString()
    {
        $response = array(
            "id" => $this->id,
            "id_persona" => $this->id_persona,
            "id_grupo" => $this->id_grupo,
            "user" => $this->user,
            "password" => $this->password,
            "create_at" => $this->create_at,
            "update_at" => $this->update_at,
            "disable_at" => $this->disable_at,
            "state" => $this->state
        );
        return $response;
    }

}