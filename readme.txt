=== Plugin Name ===
Contributors: yurifari
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40yurifarina%2ecom&item_name=Blogger%20Importer%20Extended&currency_code=EUR
Tags: importer, blogger
Requires at least: 3.1
Tested up to: 4.2
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Import posts, pages, tags, comments, images and links from your Blogger blog.

== Description ==

Inspired by the good work done on Blogger Importer, this plugin tries to fill the gap including import for pages, a theme-friendly formatting conversion, compatibility with Blogger 301 Redirect plugin and more over.

Blogger Importer Extended can:

* Import posts
* Import pages
* Import tags
* Import comments
* Import images
* Import links
* Convert formatting
* Preserve slugs

= Notes =
1. *Due to Google APIs daily quota limitations the importer can be unavailable, try later.*
2. *Due to Google policies, Blogger API v3 are only accessible through manually approved web services, so, any imported content (posts, pages, comments, etc...) go through our web service, only public contents are processed, no private data, no anything else.*

== Installation ==

1. Upload the `blogger-importer-extended` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Tools > Import > Blogger Importer Extended

== Frequently Asked Questions ==

= The importer stopped unexpectedly, why? =
The importer can stop for several reasons, most frequently reasons are:

* Restart: when you refresh the browser page 2 or more import processes can be together active, so, BIE waits for the first one finish its work.
* Timeout: the browser, a proxy, or something else, breaks the import process for some reason, usually a timeout.
* Quota exceeded: BIE uses the Google Blogger APIs, these grant a limited number of requests per day and per second, if the quota is exceeded, the importer stops.

== Screenshots ==

1. Authorization
2. Blog list
3. Importing options
4. Importing process
5. Author assignment

== Changelog ==

= 1.3 =
* Improvements on formatting conversion

= 1.2.2 =
* Fix for page comments

= 1.2.1 =
* Fix for unexpected timeout

= 1.2 =
* Fix for alert loop
* Workaround for imprecision in denormalized counters

= 1.1 =
* Fix for posts without slug

== Upgrade Notice ==

= 1.3 =
Now, the plugin also imports tags for headings and lists.

= 1.2 =
Now, when the countdown ends, the importer shall be forced to restart.

= 1.1 =
If some posts don't have slug, using Blogger 301 Redirect, the home redirection fails.
