module.exports = eleventyConfig => {

  /**
   * Not sure if this is actually needed :)
   */
  eleventyConfig.addWatchTarget("content");
  eleventyConfig.addPassthroughCopy("content/**/*.(png|jpg|webp|avif|css|js)");

  /**
   * Kirby stores metadata for assets in an additional content file
   * Those content files should not be used by 11ty to create more
   * subpages.
   */
  eleventyConfig.ignores.add("content/**/*.(png|jpg|webp|avif).md");

  /**
   * The permalink feature is used to rewrite Kirby’s folders.
   * Kirby uses sorting numbers in folder names. Those need to be removed.
   * Kirby also uses different content file names to load specific templates.
   * This is not compatible with 11ty's data file naming convention. But we can
   * fix this by rewriting that to index.html instead.
   */
  eleventyConfig.addGlobalData("permalink", () => {
    return (data) => {
      const dir     = data.page.filePathStem;
      const folders = dir.split("/");


      /**
       * Remove the last part. It’s Kirby’s content file name
       * but will be mistaken in 11ty as yet another sub page.
       */
      const path = folders.slice(0, -1);

      /**
       * Don't render anything inside a drafts folder
       */
      if (path.includes("_drafts")) {
        return false;
      }

      /**
       * Remove Kirby's sorting numbers
       */
      const permalink = path.map((folder) => {
        if (folder.includes("_")) {
          return folder.replace(/^([0-9]+_)/, "");
        }

        return folder;
      });

      return `${permalink.join("/")}/index.html`;
    };
  });

  // Return your Object options:
  return {
    dir: {
      input: "content",
      includes: "../_includes"
    }
  }
};
