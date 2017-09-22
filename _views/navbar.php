
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">          
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button"
                        data-toggle="collapse"
                        data-target="#navbar-main">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo $path ?>" class="navbar-brand">Jeffrey Hartmann</a>
            </div>          
            <div class="collapse navbar-collapse" id="navbar-main">                
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo $path ?>about">About</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="dropdown">Movies <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $path ?>movies">Introduction</a></li>
                            <li><a href="<?php echo $path ?>movies/api">TheMovieDB Version</a></li>
                            <li><a href="<?php echo $path ?>movies/db">Database Version</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo $path ?>weather">Weather</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a target="_blank" href="<?php echo $path ?>resume.pdf">My Resume</a>
                    </li>
                    <li>
                        <a target="_blank"
                           href="https://www.linkedin.com/in/jeffreyhartmann/">My LinkedIn</a>
                    </li>
                    <li>
                        <a target="_blank"
                           href="https://github.com/jephmann">My GitHub</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="dropdown">Resources <span class="caret"></span></a>
                        <ul class="dropdown-menu">                            
                            <li>
                                <a target="_blank"
                                   href="http://paper.li/JeffreyHartmann/1502334205#/">jephmann.companion</a>
                            </li>                            
                            <li>
                                <a target="_blank"
                                   href="http://builtwithbootstrap.com/">Built With Bootstrap</a>
                            </li>
                            <li>
                                <a target="_blank"
                                   href="https://wrapbootstrap.com/?ref=bsw">WrapBootstrap</a>
                            </li>
                            <li>
                                <a target="_blank"
                                   href="http://php.net/">PHP</a>
                            </li>
                            <li>
                                <a target="_blank"
                                   href="https://www.themoviedb.org/documentation/api">TheMovieDB API</a>
                            </li>
                            <li>
                                <a target="_blank"
                                   href="https://www.wunderground.com/?apiref=aa64dd3c5f156d74">Weather Underground</a>
                            </li>
                            <li>
                                <a target="_blank"
                                   href="http://www.fatcow.com/">FatCow</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>          
        </div>
    </div>
