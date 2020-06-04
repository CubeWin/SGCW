<?php

interface PersonaIService
{

    public function findAll();

    public function findByPersona($dato);

    public function save(PersonaEntity $persona);

    public function findOne($id);

    public function delete($id);
}
