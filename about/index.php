<?php
    declare( strict_types = 1 );
    $path       = '../';
    $subtitle   = "About This Project";
    


    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708.jpg';
    $meta_description   = (string) NULL;
    $meta_querystring   = (string) NULL;
    /*
     *  HTML start
     */
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
?>

<div class="container">
    <div class="jumbotron">
        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                
                <h2>About This Project</h2>

                <p>If the worst part of this project is my About page, then
                    hopefully I am on the right track. As I started writing
                    this page, I found myself becoming rather verbose.
                    Thus I broke apart my "elevator speech" (if our elevator
                    is in the former Sears Tower) into smaller, clickable
                    sections, each of which focuses on a goal for this
                    project.</p>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                
                <div class="panel-group" id="accordion">      

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                    href="#aboutPortfolio">As Portfolio</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutPortfolio" class="panel-collapse collapse">
                            <div class="panel-body">

<p>
    Confidentiality agreements. Non-compete clauses. Private, inner-office
    intranet projects. Strictly "back-end/server-side" development work. Simply
    just starting out -- or starting over again from scratch. And/or... some
    other thing. When the bulk of your web design and development work lands in
    any combination of such categories, building a public portfolio is a major
    challenge.
</p>
<p>
    True, I am on GitHub, ostensibly a good, free place to show people one's
    behind-the-scenes coding style (especially when it comes to server-side
    coding). Yet GitHub remains a place of interest only to other coders.
    Often clients prefer not to know how the sausage is made, although sooner or
    later you must hand them them the keys to the car you just built for them
    (if I may mix metaphors [and who's stopping me?]). Plus not as many coders
    are as interested in other people's coding projects as one might think.
</p>
<p>
    Well, at least for me, that's how it's been. So this site must stand as my
    only portfolio where I may demonstrate my current skills as a web developer.
</p>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#aboutDemoSite">As Demo Site</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutDemoSite" class="panel-collapse collapse">
                            <div class="panel-body">

<p>
    "Demo site" may be a more accurate term than "portfolio" to describe this
    project. Unlike a portfolio site, where one might see a slide show of screen
    shots of someone's past works, this site is a live demonstration of what I
    currently do as a coder -- and, perhaps, by inference or implication, what
    more I <em>could</em> do as a coder.
</p>                
<p>
    Perhaps it is just as well that I do not have access to my previous work
    anyhow. Much of my own past work used technology now considered deprecated
    if not obsolete. Plus, knowing what I know now, my past work often makes me
    cringe.
</p>                
<p>
    So with this site I simply want to demonstrate my basic strengths, which are
    mostly on the back-end/server-side, as well as my ability to adapt to
    changes on the front-end/client-side.
</p>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#aboutWorkshop">As Workshop</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutWorkshop" class="panel-collapse collapse">
                            <div class="panel-body">

<p>
    Assuming that my basic strengths may not be enough to suit prospective
    employers, I also need to demonstrate my abilty to learn new skills.
</p>                
<p>
    For several years I got by as a self-taught, learn-on-the-job developer.
    Then the Recession compelled me to return to school and pick up some new
    skills, and thus I earned a Masters degree in the process. Still, changes in
    web design and development continue to increase exponentially. Concepts
    which did not come up in past jobs or even when I went back to school are
    now in vogue and in demand. Thus I still often find myself in self-taught
    mode these days.
</p>                
<p>
    Therefore, this site also serves as a workshop where I may test certain
    things, learn new concepts, apply a "best practice" or six, and
    troubleshoot code -- ideally before taking similar risks on a client's
    project. Thus from time to time you may notice the odd "mistake" here and
    there, which may or may not be on purpose or which simply may be a
    subjective judgment call (i.e. "because I can", for now). Every aspect of
    this site <em>including this page</em> is a constant work in progress.
    Ultimately I am in search of a simple working method which suits me as a
    hard coder while keeping current regarding changes in web development.
</p>
<p>
    Regardless, this site should keep me in practice while between jobs. Yes, I
    might take requests regarding technologies which I should add to my skill
    set. Anyhow, even if I cannot claim professional, real-world experience
    regarding certain skills, maybe I can point to this project as a place where
    have used them. For example: here is where I'm using Bootstrap, and here is
    where I tap into external applications for data -- nowhere else. And, as a
    workshop, here is where I welcome <em>constructive</em> advice regarding
    whether I am applying new concepts properly.
</p>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#aboutPersonalSite">As Personal Site</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutPersonalSite" class="panel-collapse collapse">
                            <div class="panel-body">

<p>
    And, whether failing at any of the above, above all, this is ultimately a
    personal website. Here I am both client and "websmythe" -- the latter, a
    term I prefer over "webmaster", although I believe that someone beat me to
    copyrighting it. I also wanted to use "Dig Me" as the name of my own web
    business some day... but I digress.
</p>
<p>
    Thus for this site I am likely to practice with data from subjects close to
    my heart (e.g. movies, music, baseball, long-term unemployment, etc.). Plus,
    if I want to pepper this site with quotes from George Carlin, Buster Keaton
    et al, well... I know nothing about copyright law; so maybe I can't after
    all.
</p>
<p>
    Still, here I am the customer, and my budget compels me to hire myself as an
    expert. Anyhow, whom am I to argue with me? Not that anything stopped me
    before. After all, I am nothing if not me.
</p>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#aboutSpecifications">Specifications</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutSpecifications" class="panel-collapse collapse">
                            <div class="panel-body">

<ul>
    <li>PHP 7 (and coming soon MySQL)*</li>
    <li>Bootstrap 3.3.7</li>
    <li>Concepts and intangibles:
        <ul>
            <li>D*R*Y (Don't Repeat Yourself)</li>
            <li>Object-oriented development</li>
            <li>Responsive web design</li>
        </ul>
    </li>
    <li>Some data furnished by other websites and applications.</li>
    <li>Yes, I include Google Analytics on nearly every page. So be good. ;)</li>
    <li>Local environment:
        <ul>
            <li>IDE: NetBeans (Atom standing by)</li>
            <li>XAMPP over Windows 10</li>
        </ul>
    </li>
</ul>
<p>
    Although I am not quite dogmatic when it comes to the usage of third-party
    libraries, platforms, templates and other such tools, I am keenly aware that
    one uses such things at one's own risk. In fact, this site is where I can
    take some risks before trying them elsewhere. Beyond that, this is (more or
    less) a 100% hard-coded project.
</p>
<p>
    Portions of this project (e.g. "data-driven" pages) may include outside
    resources and thus are subject to the limitations of those resources.
</p>
<p>
    * My sincere apologies to devotees of ASP.NET (C# or VB.NET), Ruby, Python
    and other such languages. Yes, I am willing to learn these (or, in the case
    of ASP.NET, relearn) and, if necessary, convert to any one of them. PHP
    happens to be my "hot hand" these days. In any event I am not dogmatic about
    back-end code. I certainly won't apply for work at a PHP shop and insist
    that they abandon everything for C#, for example, whether it may truly be
    the way to go or not. It's for me to adapt to however the shop is run or
    move on... or even start my own shop.
</p>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="#aboutOtherStuff">Other Stuff</a>
                                <span class="caret"></span>
                            </h3>
                        </div>
                        <div id="aboutOtherStuff" class="panel-collapse collapse">
                            <div class="panel-body">

<p>
    I welcome and encourage <em>constructive</em> criticism; I ignore and
    dismiss any other kind.
</p>
<p>
    Although I have plenty of ideas for this project and although I expect to
    receive many more, I have priorities above and beyond this project. So
    please forgive me if certain changes and suggestions do not come to pass
    here as quickly as you might expect. For example, as I write this
    (<?php echo $thisMonthYear; ?>)
    I am currently seeking work; thus my job search is a priority. Also, on
    alternate weekends I run errands and do odd jobs for my Mom. Once I am truly
    and gainfully employed, I may devote more of my attention to the job at
    hand than to this project.
</p>
<p>
    I consider myself an intermediate, junior-level web developer. That is, I am
    not necessarily seeking an instant "promotion" to senior-level work but
    rather a long-term situation wherein I may learn a company's system before
    perhaps earning the right to attain senior-level status. So the majority of
    the work on this site might at best be considered junior-level work -- unless
    you truly are impressed by my efforts, in which case you may forget that I
    said anything and simply accept me as the guru/ninja/jedi/rockstar/etc.
    which I appear to be.
</p>
<p>
    That said, I am open to requests within reason where I may use this project
    to learn, attempt and demonstrate more advanced work. If you have such a
    request (and if you can find me), feel free to let me know <em>nicely</em>.
    Among my to-dos: chatting with my web host about e-mail capability for this
    website. Until then, if it's strictly business, you can find me on
    <a target='_blank'
       href='https://www.linkedin.com/in/jeffreyhartmann/'>LinkedIn</a>.
    Otherwise... well, you'd already know where to find me. ;)
</p>

                            </div>
                        </div>
                    </div>

                </div>
                    
            </div>            
        </div>        
    </div>
</div>
<?php
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';
    /*
     *  HTML end
     */