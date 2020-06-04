<?php
interface ContentIDao{

    public function selectAll($final);

    public function updateOne($final, $content, $id);

    public function disableContent($final);

    public function preView($final);

    public function selectOne($final, $id);

    public function createIterable($final);

    public function deleteIterable($final, $bloque);

    public function nextIterable($final);

}