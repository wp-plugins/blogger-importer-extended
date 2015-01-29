=== Plugin Name ===
Contributors: yurifari
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40yurifarina%2ecom&item_name=Blogger%20Importer%20Extended&currency_code=EUR
Tags: importer, blogger
Requires at least: 3.1
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Import posts, pages, comments, images and links from your Blogger blog.

== Description ==

Inspired by the good work done on Blogger Importer, this plugin tries to fill the gap including import for pages, a theme-friendly formatting conversion, compatibility with Blogger 301 Redirect plugin and more over.

Blogger Importer Extended can:

* Import posts
* Import pages
* Import comments
* Import images
* Import links
* Convert formatting
* Preserve slugs

**Hey!** This plugin is pretty young and some wicked bugs can hide in the shadow, if you find them, let me know! :)

***Notes***

1. *Due to Google APIs daily quota limitations the importer can be unavailable, try later.*
2. *Due to Google policies, Blogger API v3 are only accessible through manually approved web services, so, any imported content (posts, pages, comments, ecc...) go through our web service, only public contents are processed, no private data, no anything else.*

== Installation ==

1. Upload the `blogger-importer-extended` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Tools > Import > Blogger Importer Extended

== Frequently Asked Questions ==

= The importer stopped unexpectedly, why? =

The importer can stop for several reasons, most frequently reasons are:

* Restart: when you refresh the browser page 2 or more import processes can be together actives, so, BIE waits for the first one finish its work.
* Timeout: the browser, a proxy, or something else, breaks the import process for some reason, usually a timeout.
* Quota exceeded: BIE uses the Google Blogger APIs, these grant a limited number of requests per day and per second, if the quota is exceeded, the importer stops.

== Screenshots ==

1. Authorization
2. Blog list
3. Importing options
4. Importing process
5. Author assignment
