<div class="search-widget sidebar-widget">
    <form id="searchform" role="search" class="search-form" action="<?php echo home_url('/'); ?>" method="get">
        <label class="visuallyhidden" for="s"><?php global $FRONTEND_STRINGS; echo $FRONTEND_STRINGS['search_for']; ?></label>
        <fieldset>
            <div>
                <input id="s" type="text" value="" name="s"/>
            </div>
            <!-- <input type="submit" id="searchsubmit" value="<?php echo $FRONTEND_STRINGS['search'];?>" class="btn"> -->
            <button name="searchbutton" class="btn"><i class="icon-search"></i></button>
        </fieldset>
    </form>
</div>