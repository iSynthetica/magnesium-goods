<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group">
        <input type="search" class="search-field input-group-field" placeholder="<?php echo esc_attr_x( 'Поиск', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
        <div class="input-group-button">
            <input type="submit" class="search-submit button" value="&#xf002;" />
        </div>
    </div>
</form>