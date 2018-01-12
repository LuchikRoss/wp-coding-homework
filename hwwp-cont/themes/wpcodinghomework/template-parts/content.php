<div class="content">

    <article class="post hentry" itemscope itemprop="blogPost" itemtype="http://schema.org/Article">

        <header class="entry-header">

            <h2 class="entry-title" itemprop="headline">
                <a href="<?php the_permalink(); ?>"><?php the_title() ;?></a>
            </h2>

            <div class="entry-meta">

                <span class="post-date">
                    <i class="fa fa-clock-o fa-fw"></i>
                    <span class="updated">
                        <?php the_date(); ?>
                    </span>
                </span> <!-- .post-date -->

                <span class="post-author">
                    <i class="fa fa-user fa-fw"></i>
                    <span class="vcard">
                        <a class="fn url" href="<?php the_author_link(); ?>">
                            <?php the_author(); ?>
                        </a>
                    </span>
                </span> <!-- .post-author -->

                <span class="post-categories">
                    <i class="fa fa-folder fa-fw"></i>
                    <?php the_category(' ');?>
                    <!--<a href="blog.html" rel="tag">Category A</a>,
                    <a href="blog.html" rel="tag">Category B</a>-->
                </span> <!-- .post-categories -->

                <span class="post-tags">
                    <i class="fa fa-tags fa-fw"></i>
                    <?php the_tags('', ' ', ''); ?>
                    <!--<a href="blog.html" rel="tag">Tag A</a>,
                    <a href="blog.html" rel="tag">Tag B</a>,
                    <a href="blog.html" rel="tag">Tag C</a>-->
                </span> <!-- .post-tags -->

            </div> <!-- .entry-meta -->

        </header> <!-- .entry-header -->

        <div class="entry-image">
            <?php if ( has_post_thumbnail()) :?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail(); ?>
                </a>
            <?php else:  ?>
                <img src="http://dummyimage.com/800x250/f3f3f3/d1d1d1.jpg&text=Featured+Image" alt="Featured Image" itemprop="image">
            <?php endif; ?>
        </div> <!-- .entry-image -->

        <div class="entry-content" itemprop="articleBody">
            <?php the_excerpt(); ?>
        </div> <!-- .entry-content -->

    </article> <!-- .post -->

</div> <!-- .content -->