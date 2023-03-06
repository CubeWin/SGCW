<?php
require "./models/data/Persona.Dao.php";
require "./models/services/Persona.IService.php";

class PersonaService  implements PersonaIService
{

	public $personaDao = null;

    public function __construct()
    {
		$this->personaDao = new PersonaDao();
	}

	public function findAll()
	{
		return $this->personaDao->personaFindAll();
	}

	public function findByPersona($dato)
	{
		return $this->personaDao->personaFindByNameAndSurname($dato);
	}

	public function findOne($id)
	{
		return $this->personaDao->personaFindOne($id);
	}

	public function save(PersonaEntity $persona)
	{
		return $this->personaDao->personaSave($persona);
	}

	public function delete($id)
	{
		return $this->personaDao->personaDelete($id);
	}
}