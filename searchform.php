<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="govuk-form-group">
        <label class="govuk-label" for="s"><?php _e('Search for:','gdstheme'); ?></label>
        <input class="govuk-input" type="search" id="s" name="s" value="" />
        <button class="govuk-button govuk-button--secondary" data-module="govuk-button" type="submit" id="searchsubmit" ><?php _e('Search','gdstheme'); ?></button>
    </div>
</form>