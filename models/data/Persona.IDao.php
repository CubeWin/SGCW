<?php
interface PersonaIDao{

    public function personaFindAll();

    public function personaFindByNameAndSurname($dato);

    public function personaSave(PersonaEntity $persona);

    public function personaFindOne($id);

    public function personaDelete($id);

}