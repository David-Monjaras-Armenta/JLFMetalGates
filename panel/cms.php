<?php

include_once dirname(__DIR__) . "/panel/models/section.php";

class CMS
{
    public static function get_content($section)
    {
        $sectionModel = new SectionModel();
        return $sectionModel->read_by_id(intval($section));
    }
}