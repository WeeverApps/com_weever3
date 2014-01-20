<div class="row" style="max-width: 100%;">
    <!-- start: left col -->
    <div class="large-8 columns">

        <div class="row">
            <div class="large-12 columns">
                <h2><?php echo 'Welcome to appBuilder!'; //echo __( 'Welcome to appBuilder!', 'weever' ); ?></h2>
                <p class="lead">Please enter your <b>free trial</b> or <b>paid</b> app subscription key.</p>
            </div>
        </div>

        <!-- start: subscription key form -->
        <form action="" method="post">

            <div class="row">
                <div class="large-12 columns">
                    <input <?php if ( ! $this->appKey ) echo 'class="error"'; ?> type="text" name="site_key" value="<?php echo $this->appKey; ?>" />
                    <br>
                    <div class="wx-inputContainer" id="save-button">
                        <button id="wx-button-submit" class="success radius" name="submit" type="submit" value="Save Changes">Save app subscription key</button>
                    </div>
                    <label><a target="_blank" href="http://weeverapps.com/pricing"><?php echo 'Need a subscription key?';//echo __( 'Need a subscription key?' ); ?></a></label>
                </div>
            </div>
        </form>

        <br>

        <?php if ( $this->appKey ): ?>
            <div class="row">
                <div class="large-12 columns">
                    <?php if ( $this->siteDomain ): ?>
                        <p class="lead">
                            <?php //echo sprintf( __( 'Your current app building key is linked to the web address: %s', 'weever' ), $this->siteDomain ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <!-- endof: left col -->

    <div class="large-4 columns">

        <!-- about your current subscription -->
        <div class="row">
            <div class="large-12 columns">

                <div class="panel">

                    <p class=""><b>Your subscription</b></p>

                    <p>Current status:&nbsp;
                    
                    <p><a target="_blank" href="http://weeverapps.com/pricing">View plans and pricing</a></p>

                    <p class=""><b>About</b></p>

                    <p>appBuilder is made with care by <a target="_blank" href="http://weeverapps.com">Weever Apps</a>, a company in Hamilton, Canada.</p>
                    <p>appBuilder is used in over 60 countries and 16 languages.</p>

                </div>

            </div>
        </div>

    </div>


</div>


<script type="text/javascript">
    // jQuery(document).foundation('joyride', 'start');
</script>
