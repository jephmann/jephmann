
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">        
        <form method="post" action="./">
            <div class="form-group">
               <input type="text" name="query" value="" required="required"
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
        <p>            
            For issues regarding data and images, please contact
            <a target="_blank" title="TheMovieDB"
               href="https://www.themoviedb.org">TheMovieDB</a>.
        </p>
    </div>
</div>