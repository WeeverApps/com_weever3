<div class="section-container auto section-subnav" data-section>
	<!-- Share App Online -->
	<section>
		<p class="title" data-section-title><a href="#"><?php echo 'share app online'; //echo __( 'share app online', 'weever' ); ?></a></p>
		<div class="content" data-section-content>
			<p class="wx-ui-title"><?php echo 'Web Address';//echo __( 'Web Address', 'weever' ); ?></p>
			<p>
				<?php echo 'Your "web app" launches instantly for all popular phone and tablet browsers when online.  Share it with a simple web link.';//echo __( 'Your "web app" launches instantly for all popular phone and tablet browsers when online.  Share it with a simple web link.', 'weever' ); ?>
                <br>
                <br>
                <input type="text" value="http://<?php echo $this->siteDomain;//echo $weeverapp->primary_domain; ?>" />
			</p>

            <br>

			<p class="wx-ui-title"><?php echo 'Share your app on social media';//echo __( 'Share your app on social media', 'weever' ); ?></p>
			<p>
				<?php echo 'Share a link to your web app.  You\'ll get the opportunity to preview your message before it goes out.';//echo __( 'Share a link to your web app.  You\'ll get the opportunity to preview your message before it goes out.', 'weever' ); ?>
			</p>

			<ul class="small-block-grid-3 large-block-grid-5">
				<li>
					<a target="_blank" class="wx-launch-share" id="share-app-twitter" href="http://twitter.com/intent/tweet?url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&via=WeeverApps">
                        &nbsp;
					</a>
                    <a target="blank" class="button success expand small radius" href="http://twitter.com/intent/tweet?url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&via=WeeverApps">Twitter</a>
                </li>
				<li>
					<a target="_blank" class="wx-launch-share" id="share-app-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">
                        &nbsp;
					</a>
                    <a target="blank" class="button success expand small radius" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">Facebook</a>
                </li>
				<li>
					<a target="_blank" class="wx-launch-share" id="share-app-email" href="mailto:?subject=Share App&body=Link to App: <?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>%0A%0A++++++++++++QR Code Link: http%3A%2F%2Fchart.apis.google.com%2Fchart%3Fcht%3Dqr%2526chs%3D250x250%2526choe%3DUTF-8%2526chld%3DH%7C0%2526chl%3D<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>%0A%0A++++++++++++via appBuilder&trade; - Build your app today at http://weeverapps.com/">
                        &nbsp;
					</a>
                    <a target="blank" class="button success expand small radius" href="mailto:?subject=Share App&body=Link to App: <?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>%0A%0A++++++++++++QR Code Link: http%3A%2F%2Fchart.apis.google.com%2Fchart%3Fcht%3Dqr%2526chs%3D250x250%2526choe%3DUTF-8%2526chld%3DH%7C0%2526chl%3D<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>%0A%0A++++++++++++via appBuilder&trade; - Build your app today at http://weeverapps.com/">Email</a>
                </li>
				<li>
					<a target="_blank" class="wx-launch-share" id="share-app-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&title={<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>}source=Weever%20appBuilder">
                        &nbsp;
					</a>
                    <a target="blank" class="button success expand small radius" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&title={<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>}source=Weever%20appBuilder">LinkedIn</a>
                </li>
				<li>
					<a target="_blank" class="wx-launch-share" id="share-app-pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&media=http%3A%2F%2Fweeverapps.com%2Fwp-content%2Fplugins%2Fweever-apps-for-wordpress%2Fstatic%2Fimages%2Ftablet_load_default.png">
                        &nbsp;
					</a>
                    <a target="blank" class="button success expand small radius" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>&media=http%3A%2F%2Fweeverapps.com%2Fwp-content%2Fplugins%2Fweever-apps-for-wordpress%2Fstatic%2Fimages%2Ftablet_load_default.png">Pinterest</a>
                </li>
			</ul>
		</div>
	</section>

	<!-- App Stores -->
	<section>
		<p class="title" data-section-title><a href="#"><?php echo 'submit to app stores'//, 'weever';echo __( 'submit to app stores', 'weever' ); ?></a></p>
		<div class="content" data-section-content>

			<p class="wx-ui-title">Publish to app stores <span class="label secondary"><?php echo 'add-on service';//echo __( 'add-on service', 'weever' ); ?></span></p>

            <p>Have Weever Apps create a &lsquo;hybrid app&rsquo; based on your web app and submit it to the stores you specify.  We offer discount pricing when submitting to multiple stores.</p>

            <ul class="small-block-grid-3 large-block-grid-5">
                <li>
                    <a target="_blank" class="wx-launch-publish" id="publish-app-itunes" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">
                        &nbsp;
                    </a>
                    <a target="_blank" class="button success expand small radius" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">App Store&trade;</a>
                </li>
                <li>
                    <a target="_blank" class="wx-launch-publish" id="publish-app-google-play" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">
                        &nbsp;
                    </a>
                    <a target="_blank" class="button success expand small radius" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">Play&trade;</a>

                </li>
                <li>
                    <a target="_blank" class="wx-launch-publish" id="publish-app-windows-store" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">
                        &nbsp;
                    </a>
                    <a target="_blank" class="button success expand small radius" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">Windows&trade;</a>
                </li>
                <li>
                    <a target="_blank" class="wx-launch-publish" id="publish-app-blackberry-world" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">
                        &nbsp;
                    </a>
                    <a target="_blank" class="button success expand small radius" href="http://weeverapps.com/native-app/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">BlackBerry</a>
                </li>
            </ul>

            <br>

            <!-- Push notifications -->
            <p class="wx-ui-title">Push Notifications <span class="label secondary">add-on service</span> <span class="label secondary">Hybrid Only</span></p>
            <p>Send &lsquo;push notifications&rsquo; to customers who have your hybrid app installed.</p>
            <p><a target="_blank" class="button success radius" href="http://weeverapps.com/native-app/">View plans and pricing</a></p>

            <br>

            <!-- NFC stickers -->
            <p class="wx-ui-title">NFC Stickers <span class="label secondary">add-on service</span</p>
            <p>Imagine tapping a poster with your phone and seeing an app launch instantly.  That technology is here today with NFC Stickers!</p>
            <p>NFC Stickers (aka 'tags') come with a sticker backing and are pre-programmed to go to your Mobile App URL.  NFC Stickers are compatible with Android, Windows 8 and Blackberry 10 devices.</p>
            <p><a target="_blank" class="button success radius" href="http://weeverapps.com/nfc-tags/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">View plans and pricing</a></p>

        </div>
	</section>

	<!-- Marketing Toolbox -->
	<section>
		<p class="title" data-section-title><a href="#">Marketing Toolbox</a></p>
		<div class="content" data-section-content>
			<p class="wx-ui-title">App QR Code</p>
			<p>Your app includes a set of QR Codes for print marketing use.  When a mobile user scans your QR code with a barcode reader like or Google Goggles (<a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.unveil">Android</a> | <a target="_blank" href="https://itunes.apple.com/us/app/google-mobile-app/id284815942">iTunes</a>)  or the <a target="_blank" href="http://www.i-nigma.mobi">i-nigma QR Reader</a>, your app launches instantly to their touch phone or tablet browser.</p>
			<a class="button success radius" href="#" data-reveal-id="qr-modal">View your QR Code</a>

			<div id="qr-modal" class="reveal-modal">
                <div class="row">
                    <div class="large-6 columns">
                        <h2>Your app QR Code</h2>
                        <p>Launch address for this QR Code:</p>
                        <p><?php echo $this->siteDomain;//echo $weeverapp->primary_domain ?></p>
                        <p><b>How do I scan this QR Code?</b></p>
                        <p>Install a barcode reader on your phone if one is not already pre-installed.  Try Google Goggles (<a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.unveil">Android</a>, <a target="_blank" href="https://itunes.apple.com/us/app/google-mobile-app/id284815942">iTunes</a>)  or the <a target="_blank" href="http://www.i-nigma.mobi">i-nigma QR Reader</a>.</p>
                    </div>
                    <div class="large-6 columns">
                        <img src="http://qr.weeverapps.com/?site=<?php echo $this->siteDomain;//echo $weeverapp->primary_domain; ?>&style=smooth&error=3&margin=1&size=20" />
                        <br>
                        <br>
                    </div>
                </div>
				<div>
                    <a class="button success radius" href="<?php //plugins_url( 'print-qr.html', __FILE__ ); ?>?domain=<?php echo $this->siteDomain;//echo $weeverapp->primary_domain; ?>&style=smooth&error=3&margin=1&size=20" target="_BLANK">Print</a>
					<button onclick="jQuery('#qr-modal').foundation('reveal', 'close');">Done</button>
                    <a class="close-reveal-modal">&#215;</a>
				</div>
			</div>

            <br>
            <br>
            <br>

            <!-- SMS messaging -->
            <p class="wx-ui-title">SMS Messages <span class="label secondary">add-on service</span></p>
            <p>Statistics indicate that SMS messages are ready by over 90% of recipients.  Weever Apps SMS Messaging service allows you to send targeted offers to your mobile audience.</p>
            <p><a target="_blank" class="button success radius" href="http://weeverapps.com/sms/">View plans and pricing</a>

            <br>
            <br>

            <!-- NFC stickers -->
            <p class="wx-ui-title">NFC Stickers <span class="label secondary">add-on service</span></p>
            <p>Imagine tapping a poster with your phone and seeing an app launch instantly.  That technology is here today with NFC Stickers!</p>
            <p>NFC Stickers (aka 'tags') come with a sticker backing and are pre-programmed to go to your Mobile App URL.  Weever NFC Stickers are compatible with Android, Windows 8 and Blackberry 10 devices.</p>
            <p><a target="_blank" class="button success radius" href="http://weeverapps.com/nfc-tags/?site_url=<?php echo urlencode($this->siteDomain);//echo urlencode($weeverapp->primary_domain) ?>">View plans and pricing</a></p>

            <br>

            <!-- Push notifications -->
            <p class="wx-ui-title">Push Notifications <span class="label secondary">add-on service</span> <span class="label secondary">Hybrid Only</span></p>
            <p>Send &lsquo;push notifications&rsquo; to customers who have downloaded your hybrid app from the App Store&trade; Google Play&trade; Windows Store&trade; or Blackberry World&trade;.</p>
            <p><a target="_blank" class="button success radius" href="http://weeverapps.com/native-app/">View plans and pricing</a></p>

		</div>
	</section>

	<!-- Advanced -->
	<section>
		<p class="title" data-section-title><a href="#">Advanced</a></p>
		<div class="content" data-section-content>

            <!-- Mobile device publishing -->
            <p class="wx-ui-title"><?php echo 'Mobile Redirect';//echo __( 'Mobile Redirect', 'weever' ); ?></p>
            <p><?php echo 'When your app is <b>online</b>, compatible mobile device visitors will see your app launch instantly when accessing your web site address.';//echo __( 'When your app is <b>online</b>, compatible mobile device visitors will see your app launch instantly when accessing your web site address.', 'weever' ); ?></p>

            <label class="" for="off" onclick=""><input id="off" name="switch-tablet" type="radio" <?php if ( $this->deviceSettings != 'DetectTierWeeverTablets' ) { echo 'checked'; } ?>> When app is online, instant-launch for phones only</label>
            <label class="" for="on"  onclick=""><input id="on" name="switch-tablet" type="radio"  <?php if ( $this->deviceSettings == 'DetectTierWeeverTablets' ) { echo 'checked'; } ?>> When app is online, instant-launch for phones <b>and tablets</b></label>

            <br>
            <br>

            <!-- Compatible devices note -->
            <p class="wx-ui-title"><?php echo 'Compatible Devices';//echo __( 'Compatible Devices', 'weever' ); ?></p>
            <p><?php echo 'Weever Apps support all popular touch phones and tablets including Apple, Android, Windows and Blackberry 10 touch devices.';//echo __( 'Weever Apps support all popular touch phones and tablets including Apple, Android, Windows and Blackberry 10 touch devices.', 'weever' ); ?></p>

			<p><?php echo 'Please <a target="_blank" href="http://weeverapps.com/">check our web site</a> for a complete up-to-date list of supported devices and operating systems.';//echo __( 'Please <a target="_blank" href="http://weeverapps.com/">check our web site</a> for a complete up-to-date list of supported devices and operating systems.', 'weever' ); ?></p>

            <br>

			<!-- Redirect Tool -->
			<p class="wx-ui-title"><?php echo 'Redirect Snippet';//echo __( 'Redirect Snippet', 'weever' ); ?></p>
			<p><?php echo 'For advanced users only. Modify the redirect snippet below and launch your app from <b>separate</b> third-party web sites.';//echo __( 'For advanced users only. Modify the redirect snippet below and launch your app from <b>separate</b> third-party web sites.', 'weever' ); ?></p>

			<textarea style="height: 200px">&lt;!--======================================---&gt;
&lt;!--IMPORTANT - MODIFY this REDIRECT CODE ---&gt;
&lt;!--1. Change the URL to point to your app --&gt;
&lt;!--2. Choose phones, tablets or both -------&gt;
&lt;!--3. Paste somewhere in &lt;body&gt; tag --------&gt;
&lt;!--======================================---&gt;

&lt;script src="http://detect.weeverapp.com/mdetect.js"&gt;&lt;/script&gt;
&lt;script&gt;

	/* STEP 1.  Change the URL to point to your app */
	/* Update the app URL below: */

	var appUrl = "http://myappname.weeverapps.com";

	/* STEP 2. Choose phones, tablets or both /*
	/* Uncomment which devices you want to show your app to: phones only, tablets only, or both (default).  Two of the three device options below should always start with a double-forward slash (//) */

	//var deviceForward = isTierWeeverSmartphone;
	//var deviceForward = isTierWeeverTablet;
	  var deviceForward = isTierWeeverAny;

	var forwardWeever = function() {

		if(deviceForward) {

			window.location.href = appUrl;

		}

	}();

&lt;/script&gt;

&lt;!--==============--&gt;
&lt;!--END EMBED CODE--&gt;
&lt;!--==============--&gt;
			</textarea>

            <div class="panel">
                <p><b>Where do I put this code?</b></p>
                <p>Generally this snippet can be placed just before the closing <b>/body</b> tag in a template or theme file, or pasted into an input area where you would normally add analytics tracking code.</p>
            </div>

		</div>

	</section>
</div>