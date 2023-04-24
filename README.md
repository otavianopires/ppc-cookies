# PPC Cookies Plugin

The PPC Cookies plugin for WordPress helps Digital Marketing and Business intelligence (BI) professionals to track users when they access Pay-Per-Click (PPC) Marketing pages. The plugin is able to track Ads for Google, Bing, and Facebook.

## Features

* Adds the **Paid Media URL** meta box to pages and posts with a toogle button to enable or disable the tracking features.
* Include Paid URL preview with the new URL that can be used for Ad campains:
  * `https://www.your-site-name.com/my-feature-post/?utm_medium=paid`
* Set the `ppc_cookie_toggle` cookie when the `utm_medium` query string is present in the campain URL.
* Set the `ppc_cookie_tracking` cookie when the `utm_medium` and a clickID (`gclid` for Google, `msclkid` for Bing, or `fbclid` for Facebook) query strings are present in the campain URL.

## Installation

1. Clone the repo into the `/wp-content/plugins/` directory of your WordPress site.
2. Access your WordPress Dashboard and visit the Plugins page.
3. Search for "PPC Cookies"
4. Install and Activate PPC Cookies from your Plugins page.
