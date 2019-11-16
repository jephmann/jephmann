
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">The Search Form</h3>
    </div>
    <div class="panel-body">        
        <form method="post" action="./">
            <div class="form-group">
                <label for="query">Search (Enter a part of a name or title):</label>
                <br />
                <input type="search" name="query" id="query"
                    value="" required="required"
                    placeholder="Enter a part of a name or title." />
            </div>

            <!--
            <p>
                <input type="checkbox" name="include_adult" />
                Include Adult Data
            </p>
            -->
            
            <!--
            <p>[_] Page. ("&page" = integer)</p>
            <p>[]> Language e.g. "en_us". ("&language" string)</p>
            <p><select></select> Year. ("&year" = integer)</p>
            <p><select></select> Primary Release Year. ("&primary_release_year" = integer)</p>
            -->
           
            <div class="form-group">
                <button name="search" class="btn btn-primary"
                    onclick="alert(document.getElementById('txtSearch').value)">
                    Search
                </button>
            </div>

       </form>
    </div>
    <div class="panel-footer">
        <p style="font-size:small;">            
            For issues regarding data and images, please contact
            <a target="_blank" title="TheMovieDB"
               href="https://www.themoviedb.org">TheMovieDB</a>.
        </p>
    </div>
</div>

<?php
    /*
     * self-scraping
     */
    
    /*
    (string) $url1  = 'http://jephmann.com/movies/api/';
    (int) $randomID = rand(9, 99999);
    (string) $url2  = '.php?id=' . $randomID;
    (array) $movies = array(
        array(
            'topic' => "Film Title",
            'url'   => "{$url1}film{$url2}",
            'regex' => '~<h3>[\W]+?<em>(.*)<\/em>[\W]+?\(?(\d{4}?)\)?\W+?<\/h3>~',
        ),
        array(
            'topic' => "TV Title",
            'url'   => "{$url1}tv{$url2}",
            'regex' => '~<h3>[\W]+?<em>(.*)<\/em>[\W]+?\(?(\d{4}?)\)?\W+?<\/h3>~',
        ),
        array(
            'topic' => "Person's Name",
            'url'   => "{$url1}name{$url2}",
            'regex' => '~<h3>[\s?]+(.*)\s[\(](.*)[\)]<\/h3>~',
        ),        
    );        
    $randomLinks = '<ul>';        
    foreach( $movies as $m )
    {
        $a = Tools::scrapeHTML( $m['url'], $m['regex'] );
        $randomLinks .= "<li>Random {$m['topic']}:<br />";
        if( $a[0] === 'not found')
        {
            $randomLinks .= 'Try Again';
        }
        else 
        {
            $randomLinks .= "<a href=\"{$m['url']}\">{$a[1]} ({$a[2]})</a>";
        }
        $randomLinks .= "</li>";
    }
    $randomLinks .= "</ul>";
      * 
      */
?>
<!--
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Random Links *</h3>
    </div>
    <div class="panel-body">
        <?php //echo $randomLinks; ?>
    </div>
    <div class="panel-footer">
        <p style="font-size:small;"> 
            * In order to display random links in the above panel, here I
            experiment with "scraping" -- wherein with the use of PHP, cURL
            and regular expressions I retrieve data from the HTML of this very
            website. That's right: <em>I am scraping my own website.</em> It's
            okay; I gave myself permission to do so.
        </p>
        <p style="font-size:small;">
            For now, to see different links appear in this panel -- as well as
            "try again" -- simply refresh this page (F5).
        </p>
    </div>
</div>
-->