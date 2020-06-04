<?php

interface ContentIService
{

    public function findAll($final);

    public function updateOne($final, $content, $id);

    public function disableOne($final);

    public function preView($final);

    public function findOne($final, $id);

    public function addBlock($final);

    public function deleteBlock($final, $bloque);

}
