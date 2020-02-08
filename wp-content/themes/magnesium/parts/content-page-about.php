<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
	        <?php joints_the_breadcrumbs(); ?>
            <header class="article-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header> <!-- end article header -->
        </div>

        <div class="lmedium-8 lmedium-push-4 columns">
            <div class="row">
                <div class="columns">
                    <section class="entry-content" itemprop="articleBody">
		                <?php the_content(); ?>
		                <?php wp_link_pages(); ?>
                    </section> <!-- end article section -->

                    <footer class="article-footer">

                    </footer> <!-- end article footer -->
                </div>
            </div>
        </div>

        <div class="lmedium-4 lmedium-pull-8 columns">
            <div class="container-styled-1 schedule-contacts__container">
		        <?php
		        $sch_ttl = get_post_meta($post->ID, 'page_sidebar_schedule_title' , true );
		        $sch_cnt = get_post_meta($post->ID, 'page_sidebar_schedule' , true );
		        $cntct_ttl = get_post_meta($post->ID, 'page_sidebar_contacts_title' , true );
		        $cntct_cnt = get_post_meta($post->ID, 'page_sidebar_contacts' , true );

		        if ($sch_ttl) {
		            ?><h3><?php echo htmlspecialchars_decode($sch_ttl); ?></h3><?php
                }

		        if ($sch_cnt) {
		            ?><?php echo wpautop($sch_cnt); ?><?php
                }

		        if ($cntct_ttl) {
		            ?><h3><?php echo htmlspecialchars_decode($cntct_ttl); ?></h3><?php
                }

		        if ($cntct_cnt) {
		            ?><?php echo wpautop($cntct_cnt); ?><?php
                }
		        ?>
            </div>
        </div>
    </div>
</article> <!-- end article -->