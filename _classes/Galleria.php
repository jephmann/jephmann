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
        return "<a href=\"{$image_path}\">"
            . "<img"
            . " src=\"{$image_path}\""
            . " data-big=\"{$image_path}\""
            . " data-title=\"{$data_title}\""
            . " data-description=\"{$data_description}\""
            . ">"
            . "</a>";
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
                $image          = ApiMovieDB::urlImage( $img[ 'file_path' ] );
                $description    = $gallery_dates
                    . "<p>({$type} {$i} of {$count})</p>";
                $list           .= Galleria::img(
                    $image, $gallery_subject, $description
                );
            }
        }
        return $list;
    }
    
}