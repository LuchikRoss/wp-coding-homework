<div class="one-quarter-block" role="complementary">
    <div class="sidebar">
        <?php
        if ( function_exists('dynamic_sidebar') ){
            dynamic_sidebar('right-sidebar');
        }

        ?>
        <!--<div class="search-widget widget">
            <form class="widget-form" action="#" method="get" role="search">
                <label>
                    <span class="screen-reader-text">Search this website:</span>
                    <input type="search" class="search-field" placeholder="Search &hellip;" value="" name="search" title="Search" />
                </label>
                <button><i class="fa fa-search"></i></button>
            </form>
        </div> <!-- .search.widget --

        <div class="widget">
            <h3 class="widget-title">Categories</h3>
            <ul>
                <li><a href="blog.html">Category One</a></li>
                <li><a href="blog.html">Category Two</a></li>
                <li><a href="blog.html">Category Three</a></li>
                <li><a href="blog.html">Category Four</a></li>
                <li><a href="blog.html">Category Five</a></li>
                <li><a href="blog.html">Category Six</a></li>
                <li><a href="blog.html">Category Seven</a></li>
                <li><a href="blog.html">Category Eight</a></li>
            </ul>
        </div> <!-- .widget --

        <div class="widget">
            <h3 class="widget-title">Archives</h3>
            <ul>
                <li><a href="blog.html">July 2015</a></li>
                <li><a href="blog.html">June 2015</a></li>
                <li><a href="blog.html">May 2015</a></li>
                <li><a href="blog.html">April 2015</a></li>
                <li><a href="blog.html">March 2015</a></li>
                <li><a href="blog.html">February 2015</a></li>
                <li><a href="blog.html">January 2015</a></li>
                <li><a href="blog.html">December 2014</a></li>
                <li><a href="blog.html">November 2014</a></li>
                <li><a href="blog.html">October 2014</a></li>
            </ul>
        </div> <!-- .widget -->

    </div> <!-- .sidebar -->
</div> <!-- .one-quarter-block -->