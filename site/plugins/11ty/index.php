<?php

load([
    'kirby\\eleventy\\frontmatter' => __DIR__ . '/src/Frontmatter.php'
]);

/**
 * This registers a new frontmatter handler for markdown files
 * in the content folder
 */
Data::$handlers['md'] = 'Kirby\Eleventy\Frontmatter';

/**
 * For some reasons, 11ty's watcher does not update
 * correctly when a folder is being deleted.
 * It can be tricked to react by updating the site.md
 */
function triggerEleventyUpdate() {
    site()->update([
        'modified' => date('r')
    ]);
}

Kirby::plugin('getkirby/11ty', [
    'hooks' => [
        'file.*:after' => function () {
            triggerEleventyUpdate();
        },
        'page.*:after' => function ($event) {
            if ($event->action() === 'render') {
                return;
            }

            triggerEleventyUpdate();
        },
        'site.*:after' => function () {
            triggerEleventyUpdate();
        }
    ]
]);
