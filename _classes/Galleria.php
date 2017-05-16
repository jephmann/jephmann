<?php

class Galleria {
    
    public function img(
        string $image_path,
        string $data_title,
        string $data_description
    ) : string
    {        
        return "<a href=\"{$image_path}\">"
            . "<img"
            . " src=\"{$image_path}\""
            . " data-big=\"{$image_path}\""
            . " data-title=\"{$data_title}\""
            . " data-description=\"{$data_description}\""
            . ">"
            . "</a>";
    }
    
}