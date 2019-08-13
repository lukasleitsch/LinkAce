---
title: Link Checks
layout: default
---

LinkAce has a nice feature called Link Checks. If you [set up your cron](/docs/v1/configuration/system-settings) 
correctly, LinkAce will regularily take a chunk of links from your collection and check if the links are still 
accessible.

## How does this work?

With the help of the cron, LinkAce will perform the Link Check every hour. When started, LinkAce pulls 100 links
from the database and then run the check on each link.

* If the link returns the HTTP status code `200` within a timespan of 5 seconds, the link is considered fine.
* If the link takes longer than 5 seconds to load, it is considered broken.
* If the link returns the HTTP status code `301` or `302`, the page was moved.

If LinkAce found at least one moved link *or* one broken link, it will send an email to the user containing details
about the moved or broken links. The user can then react to this and check what happened to the link.

Moved or broken links are highlighted in the user interface.
