
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">          
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button"
                        data-toggle="collapse"
                        data-target="#navbar-main"
                        title="Navbar Toggle"
                        alt="Navbar Toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="pull-left navbar-toggle collapsed"
                    title="Go Back"
                    onclick="goBack()" href="#"
                    data-toggle="tooltip" data-placement="bottom"
                    data-original-title="Go Back"                            
                    style="margin: 0.33em 0.75em;">&lt; BACK</a>                        
                <a class="navbar-brand"
                    title="Home"
                    data-toggle="tooltip" data-placement="bottom"
                    data-original-title="Home"
                    href="<?php echo $path ?>">Jeffrey Hartmann</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">                
                <ul class="nav navbar-nav">
                    <li>
                        <a title="About this project"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="About this project"
                            href="<?php echo $path ?>about">About</a>
                    </li>
                    <li>
                        <a title="Experiments with data regarding movies"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Experiments with data regarding movies"
                            href="<?php echo $path ?>movies">Movies</a>
                    </li>
                    <!--
                    <li>
                        <a title="Experiments with data regarding movies"
                            href="#" data-toggle="dropdown">Movies <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $path ?>movies">Introduction</a></li>
                            <li><a href="<?php echo $path ?>movies/api">TheMovieDB Version</a></li>
                            <li><a href="<?php echo $path ?>movies/db">Database Version</a></li>
                        </ul>
                    </li>
                    -->
                    <!--
                    <li>
                        <a title="Experiments with data regarding weather"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Experiments with data regarding weather"
                            href="<?php echo $path ?>weather">Weather</a>
                    </li>
                    -->
                    <li>
                        <a title="Contact me"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Contact me"
                            href="<?php echo $path ?>contact">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a target="_blank"
                            title="Jeffrey Hartmann's resume (PDF, opens in new window)"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Jeffrey Hartmann's resume (PDF, opens in new window)"
                            href="<?php echo $path ?>resume.pdf">My Resume</a>
                    </li>
                    <li>
                        <a target="_blank"
                            title="Jeffrey Hartmann's LinkedIn profile (opens in new window)"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Jeffrey Hartmann's LinkedIn profile (opens in new window)"
                            href="https://www.linkedin.com/in/jeffreyhartmann/">My LinkedIn</a>
                    </li>
                    <li>
                        <a target="_blank"
                            title="Jeffrey Hartmann's code samples on GitHub.com (opens in new window)"
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Jeffrey Hartmann's code samples on GitHub.com (opens in new window)"
                            href="https://github.com/jephmann">My GitHub</a>
                    </li>
                    <li>
                        <!-- Bootstrap "data" classes withheld as tooltip could block dropdown-menu -->
                        <a title="Click for a list of technologies in use on this project"                           
                            data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Click for a list of technologies in use on this project"
                            href="#" data-toggle="dropdown">Resources <span class="caret"></span></a>
                        <ul class="dropdown-menu">                            
                            <li>
                                <a target="_blank"
                                    title="paper.li: jephmann.companion (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="paper.li: jephmann.companion (opens in new window)"
                                    href="http://paper.li/JeffreyHartmann/1502334205#/">jephmann.companion</a>
                            </li>                            
                            <li>
                                <a target="_blank"
                                    title="Built With Bootstrap (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="Built With Bootstrap (opens in new window)"
                                    href="http://builtwithbootstrap.com/">Built With Bootstrap</a>
                            </li>
                            <li>
                                <a target="_blank"
                                    title="WrapBootstrap (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="WrapBootstrap (opens in new window)"
                                    href="https://wrapbootstrap.com/?ref=bsw">WrapBootstrap</a>
                            </li>
                            <li>
                                <a target="_blank"
                                    title="PHP (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="PHP (opens in new window)"
                                    href="http://php.net/">PHP</a>
                            </li>
                            <li>
                                <a target="_blank"
                                    title="jQuery (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="jQuery (opens in new window)"
                                    href="https://jquery.com/">jQuery</a>
                            </li>
                            <li>
                                <a target="_blank"
                                    title="TheMovieDB API (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="TheMovieDB API (opens in new window)"
                                    href="https://www.themoviedb.org/documentation/api">TheMovieDB API</a>
                            </li>
                            <li>
                                <a target="_blank"
                                    title="OMDb API (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="OMDb API (opens in new window)"
                                    href="http://www.omdbapi.com/">OMDb API</a>
                            </li>
                            <!-- SUSPENDED
                            <li>
                                <a target="_blank"
                                    title="Weather Underground (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="Weather Underground (opens in new window)"
                                    href="https://www.wunderground.com/?apiref=aa64dd3c5f156d74">Weather Underground</a>
                            </li>
                            -->
                            <li>
                                <a target="_blank"
                                    title="FatCow (opens in new window)"
                                    data-toggle="tooltip" data-placement="left"
                                    data-original-title="FatCow (opens in new window)"
                                    href="http://www.fatcow.com/">FatCow</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>          
        </div>
    </div>
