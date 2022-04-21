=== RingCentral Communications Plugin - FREE ===
Contributors:      pbmacintyre
Tags:              Ring Central Communications API tools
Requires at least: 4.1
Tested up to:      5.8.1
Stable tag:        0.5
Requires PHP:      7.3
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

This plugin allows for the use of the RingCentral communication tools platform based on the RingCentral PHP API.

This plugin makes calls to: https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js

The code base is here: https://github.com/ringcentral/ringcentral-embeddable

The license is here: https://github.com/ringcentral/ringcentral-js-widgets/blob/master/LICENSE

This is an out-of-the-box embeddable web phone app that helps developers to integrate RingCentral services into their own web applications. This is controlable in the settings page with a check box to turn it on or off. There is also a Team Messaging component added in version 1.4

== Description ==

This plugin allows for the use of the Ring Central communication tools platform based on the RingCentral PHP API.

This plugin makes calls to: https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js

The code base is here: https://github.com/ringcentral/ringcentral-embeddable

The license is here: https://github.com/ringcentral/ringcentral-js-widgets/blob/master/LICENSE

This is an out-of-the-box embeddable web phone app that helps developers to integrate RingCentral services into their own web applications. This is controlable in the settings page with a check box to turn it on or off. There is also a Team Messaging component added in version 1.4

= Features =

<ul>
<li>RingCentral Embedded Phone app - 
RingCentral's embedded phone app can be turned on or off and calls can be made from within the WordPress Admin area.
</li>

<li>Call Me Request widget - 
Feature for adding a Call Me request Widget to the sidebar on the public side of your WordPress installation. This allows Website visitors to call you (using the RingCentral RingOut feature) and if no one is on-line to answer the request will be stored on the admin side.
</li>

<li>Newsletter Sign Up widget - 
Feature for adding a Newsletter (New Post) signup Widget to the sidebar on the public side of your WordPress installation. Asking for both email address and mobile number as communication points (double opt-in).
</li>

<li>New Newsletter (Post) announcements - 
Based on configuration settings, you can send out automatic announcements to your collected newsletter list based on their provided (double opt-in) contact information: email and / or mobile.
</li>

<li>Manually add subscribers - 
Feature to manually add to your list of Newsletter announcement subscribers with name email and mobile number. The new subscriber will still have to opt-in to the list. 
</li>

<li>List / Manage subscribers - 
Feature to display your existing list of Newsletter announcement subscribers. You can delete individually or collectively. No edit feature as changes will need to be initiated by the subscriber and re-validate via the opt-in process.
</li>

<li>List / Manage Call Me Requests -  
Feature to display your existing list of Call Me requests. You can delete individually or collectively. List shows caller name, phone number to call back, reason for the call.
</li>

<li>Chat / Manage Team Messaging -  
Feature to display and control the Team Messaging (GLIP) feature of RingCentrals API. You can embed the chat portion into the admin area or simply connect to the Team Messaging area and post to it via the API. 
</li>

<li>Default pages are created for you to customize - 
Default WordPress pages are created upon activation of the plugin. Very basic confirmation of email and SMS opt-in pages are provided. Basic pages for confirming opt-out request are also provided. Page names are: 'eMail Confirmation', 'eMail Unsubscribe', 'Mobile Confirmation', and 'Mobile Unsubscribe' NOTE: permainks must be set to "Post name" 
</li>

<li>New Database tables are created - 
New tables are created in the database and seeded with basic starting data in order for the plugin to operate correctly. All table names are prefixed by 'ringcentral_'. The plugin drops these tables if the plugin is ever deleted, so be sure to save any data if you ever plan on deleting the plugin.
</li>

<li>Team Messaging (Glip) embedded - 
Team Messaging (Glip) has been added as an embeddable option with width and height controls .
</li>

<li>Team Messaging (Glip) Messages - 
Team Messaging (Glip) messages can be posted directly to the stand-alone Messaging interface through the API .
</li>

</ul>

= PRO Features (Coming Soon) =

<ul>
    <li>Customization of newsletter opt-in email and SMS messages</li>
    <li>Customization of newsletter announcement email and SMS messages</li>
    <li>Ability to send individual or group SMS messages from WP-Admin</li>
    <li>Ability to book RingCentral group meetings from WP-Admin</li>
    <li>Ability to send Faxes from WP-Admin</li>
    <li>Ability to listen to RingCentral voice messages</li>
    <li>Ability to send SMS to admin when a new voice message arrives</li>
    <li>Short code [RC-Newsletter] for Newsletter signup</li>
    <li>Short code [RC-CallMe] for Call Me request</li>
    <li>Click-to-call feature on Call Me requests list for call back from WP-Admin</li>
</ul>

== Installation ==
Use WordPress' Add New Plugin feature, searching "RCCP Free", or download the archive and:
1. Unzip the archive on your computer
2. Upload `RCCP-Free` directory to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. New menu item should appear in the 'Admin' top level menu

== Frequently Asked Questions ==
= Do I need a Ring Central Developer account =
Currently, yes. We are working on another edition that will allow for account only holders to make 
use of this plug in, but currently you do need to have a developer account. 

== Screenshots ==
1. The Admin Configurations screen
2. The Admin Configurations screen with Embedded Phone Tool enabled
3. Manually add a new newsletter subscriber
4. Generated opt-in eMail for newsletter subscriber
5. Manager Subscribers list display
6. Newsletter Signup Widget on Public side of website
7. Call Me Request Widget on Public side of website
8. Embedded Team Messaging interface
9. Sending a team message to the Team Messaging web interface 
== Changelog ==
= 1.0 =
* Initial version
= 1.4 =
* Added in the Team Messaging (Glip) API / embedded tool
= 1.4.2 =
* Updated User Guide with Appendix A - Guide to create app on RingCentral Developers site.
= 1.4.5 =
* Ensured compatability with WordPress 5.8.1. 
== Upgrade Notice ==
== Contribute ==
If you find this useful and if you want to contribute, here are some ways:
1. You can [write me](https://paladin-bs.com/contact) and submit your bug reports or improvement suggestions;