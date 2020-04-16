/**
 *
 * Change Image & Gallery block linkDestination Default.
 *
 * @param {*} settings Block settings.
 * @param string name Block name.
 * @since 1.1.0
 * @source https://wordpress.stackexchange.com/questions/327396/set-default-image-link-target-in-gutenberg-image-block
 *
 */
function naswpBaguetteBoxModifyLinkDestinationDefault(settings, name) {

    if ( name ==='core/gallery') {
        settings.attributes.linkTo.default = "media";
    }
  
    return settings;
  }
  
  wp.hooks.addFilter(
    "blocks.registerBlockType",
    "naswp/BaguetteBox",
    naswpBaguetteBoxModifyLinkDestinationDefault
  );