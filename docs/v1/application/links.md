---
title: Links / Bookmarks
layout: default
---

Links are - for sure - the heart of LinkAce and store information about bookmarks together with their corresponding
meta data. The core concept is that you can simply save URLs and LinkAce will try to parse some meta data from the 
website. You may also categorize links by adding categories or tags.

## Link Overview

The link overview lists all available links together with some meta information like categories and tags as well as
the sharing options and links for editing and deleting them.

## Adding new Links

![Preview of the Link form](/images/screens/v1/linkace_links_create.png)

New links can be added in two ways: directly from the dashboard by using the "Quick Add" form, or by using the more
powerful main form available via the "Add Link" link in the menu bar.

The main form shows you a lot of different fields which will be described in the following overview:

<div class="table-responsive">
<div class="table" markdown="block">

| Field | Required | Description |
|:------|:---------|:------------|
| URL | Yes | Contains the URL of the link you want to add |
| Title | No | You may set a custom title for the link here. If left blank, LinkAce will try to parse the title from the website. |
| Description | No | You may set a custom description for the link here. If left blank, LinkAce will try to parse the description from the website. |
| Category | No | Select a category for the link |
| Tags | No | Used to add tags for the link. When you start typing, LinkAce will search for existing tags. If there are none you may add new tags by just entering them here. |
| Is Private | No | Set the privacy mode of the link here. |

</div>
</div>

If you would like to add several links in a row, check the "Continue Adding" box. If checked, you will not be redirected
to the link details page, but will see the link form again.

## Link Details

![Preview of the Dashboard](/images/screens/v1/linkace_links_view.png)

The link detail page shows all available information about the link, including title, description, categories and tags.
From the details page you can directly hop into the edit form or delete the link.

You will also be shown all share links if you enabled some in the user settings.

### Link Notes

Each link can have several notes. Those may be used to add more detailed information about the link or leaving hints
to your guest viewers. Notes can like links be either private or not private. Private notes can only be read by
yourself.

---

## Automatic Backups with the Wayback Machine

After you add a link to LinkAce, it will schedule an automatic "backup" with the help of the [Wayback Machine](https://archive.org/web/web.php).
This backup will help you access the contents of your saved link in case it goes offline. The Wayback Machine itself
is not capable of knowing every website available, so LinkAce will just ping the service so the website can be archived.

**You need to have the cron set up for this to work.**

## Notifications about dead or moved Links

Also, if you set up the cron correctly, LinkAce will regularily check all links if they are still available. More
details about this can be found on the [Link Checks](/docs/v1/application/link-checks.md) page.
