# Eleventy Lab

This is an experimental setup. It tries to configure 11ty in a way that it can read directly from Kirby's content folder.

In contrast to the [Eleventy Kit](https://github.com/getkirby/eleventykit), this would not need any form of headless approach. 11ty can just grab the same data that Kirby stores. It truly gives you the best of both systems.

## Why?

Such a setup could be running on cheap shared hosting, with the single purpose to give personal access to Kirby’s panel. Then you can edit content for your 11ty site on the go and profit from Kirby’s panel features.

Content changes could then be automatically commited in your git repo and pushed to Github for example. This would then trigger a deployment of your 11ty site – through Netlify or any other similar provider.

## Get up and running

1. Clone this repo
2. Run `npx @11ty/eleventy --serve` to start 11ty
3. Run `php -S localhost:8181 kirby/router.php` to start Kirby
4. Visit `http://localhost:8181/panel` to access your panel

## Todos

This is still an experiment. It seems to be very promising but has a couple remaining things to fix.

- [x] Configure 11ty to read from Kirby’s content folder (.eleventy.js)
- [x] New frontmatter plugin for Kirby
- [x] Fix watcher issues after a page is being deleted
- [x] Remove Kirby’s sorting numbers form 11ty permalinks
- [x] Setup basic blog
- [x] Fix links to assets in Kirby’s textareas
- [ ] Proper support for drafts (see https://github.com/11ty/eleventy-base-blog/blob/main/eleventy.config.drafts.js)
- [ ] Better ways to copy images and other assets, but still keep them colocated in Kirby’s page folders
- [ ] Add git auto commits and pushes when content changes
