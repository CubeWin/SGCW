<?php
require "./models/data/Content.Dao.php";
require "./models/services/Content.IService.php";

class ContentService implements ContentIService
{

	public $contentDao = null;

    public function __construct()
    {
		$this->contentDao = new ContentDao();
    }	
    
    public function findAll($final)
    {
		return $this->contentDao->selectAll($final);
    }

    public function updateOne($final, $content, $id)
    {
		return $this->contentDao->updateOne($final, $content, $id);
    }

    public function disableOne($final)
    {
		return $this->contentDao->disableContent($final);
    }

    public function preView($final)
    {
		return $this->contentDao->preView($final);
    }

    public function findOne($final, $id)
    {
		return $this->contentDao->selectOne($final, $id);
    }

    public function addBlock($final)
    {
		return $this->contentDao->createIterable($final);
    }

    public function deleteBlock($final, $bloque)
    {
		return $this->contentDao->deleteIterable($final, $bloque);
    }
}