// FUNCTION: Recover block
const recoverBlock = (block = null, autoSave = false) => {
  // DECONSTRUCT: WP object
  const { wp = {} } = window || {};
  const { data = {}, blocks = {} } = wp;
  const { dispatch, select } = data;
  const { createBlock } = blocks;
  const { replaceBlock } = dispatch('core/block-editor');
  const wpRecoverBlock = ({ name = '', attributes = {}, innerBlocks = [] }) => createBlock(name, attributes, innerBlocks);

  // DEFINE: Validation variables
  const blockIsValid = block !== null
    && typeof block === 'object'
    && block.clientId !== null
    && typeof block.clientId === 'string';

  // IF: Block is not valid
  if (blockIsValid !== true) {
    return false;
  }

  // GET: Block based on ID, to make sure it exists
  const currentBlock = select('core/block-editor').getBlock(block.clientId);

  // IF: Block was found
  if (!currentBlock !== true) {
    // DECONSTRUCT: Block
    const {
      clientId: blockId = '',
      isValid: blockIsValid = true,
      innerBlocks: blockInnerBlocks = [],
    } = currentBlock;

    // DEFINE: Validation variables
    const blockInnerBlocksHasLength = blockInnerBlocks !== null
      && Array.isArray(blockInnerBlocks)
      && blockInnerBlocks.length >= 1;

    // IF: Block is not valid
    if (blockIsValid !== true) {
      // DEFINE: New recovered block
      const recoveredBlock = wpRecoverBlock(currentBlock);

      // REPLACE: Broke block
      replaceBlock(blockId, recoveredBlock);

      // IF: Auto save post
      if (autoSave === true) {
        wp.data.dispatch("core/editor").savePost();
      }
    }

    // IF: Inner blocks has length
    if (blockInnerBlocksHasLength) {
      blockInnerBlocks.forEach((innerBlock = {}) => {
        recoverBlock(innerBlock, autoSave);
      })
    }
  }

  // RETURN
  return false;
};

// FUNCTION: Attempt to recover broken blocks
const autoRecoverBlocks = (autoSave = false) => {
  // DECONSTRUCT: WP object
  const { wp = {} } = window || {};
  const { domReady, data = {} } = wp;
  const { select } = data;

  // AWAIT: For dom to get ready
  domReady(function () {
    setTimeout(
      function () {
        // DEFINE: Basic variables
        const blocksArray = select('core/block-editor').getBlocks();
        const blocksArrayHasLength = Array.isArray(blocksArray)
          && blocksArray.length >= 1;

        // IF: Blocks array has length
        if (blocksArrayHasLength === true) {
          blocksArray.forEach((element = {}) => {
            recoverBlock(element, autoSave);
          });
        }
      },
      1
    )
  });
}

// EXPORT
export default autoRecoverBlocks;

// DECONSTRUCT: WP
const { wp = {} } = window || {};
const { domReady, data } = wp;

// AWAIT: jQuery to get ready
jQuery(document).on( 'fl-builder-fix-blocks', function () {
  // DEFINE: Validation variables
  const hasGutenbergClasses = jQuery('body').hasClass('post-php') === true && jQuery('.block-editor').length >= 1 && jQuery('body').hasClass('fl-builder-blocks');
  const gutenbergHasObject = domReady !== undefined && data !== undefined;
  const gutenbergIsPresent = hasGutenbergClasses === true && gutenbergHasObject === true;

  // IF: Gutenberg editor is present
  if (gutenbergIsPresent === true) {
		autoRecoverBlocks(false);
  }
});
