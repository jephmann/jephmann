<?php

class Galleria {
    
    /*
     * per individual image, within a loop (via images function)
     * populates img attributes with values,
     * including custom Galleria attributes
     */
    public function img(
        string $image_path,
        string $data_title,
        string $data_description
    ) : string
    {        
        return "\r\n<a href=\"{$image_path}\">"
            . "<img"
            . "\r\n alt=\"{$data_title}\""
            . "\r\n src=\"{$image_path}\""
            . "\r\n data-big=\"{$image_path}\""
            . "\r\n data-title=\"{$data_title}\""
            . "\r\n data-description=\"{$data_description}\""
            . ">"
            . "\r\n</a>";
    }
    
    /*
     * per type of TheMovieDB image,
     * creates a list of images to populate a Galleria
     */
    public function images(
        string $gallery_subject,
        string $gallery_dates,
        array $images,
        string $type
    ) : string
    {
        $count  = count( $images );
        $list   = '';
        if( $count > 0 )
        {
            $i = 0;
            foreach( $images as $img )
            {
                $i++;
                $file           = $img[ 'file_path' ];
                $image          = ApiMovieDB::urlImages( $file )[ 'gallery' ];
                $original       = ApiMovieDB::urlImages( $file )[ 'original'];
                $description    = $gallery_dates
                    . "<br /><br />"
                    . "<strong><a target='_blank' title='Click for full image'"
                    . " \r\n href='{$original}'>"
                    . "{$type} {$i} of {$count}"
                    . "</a></strong>";
                $list           .= Galleria::img(
                    $image, $gallery_subject, $description
                );
            }
        }
        return $list;
    }
    
}