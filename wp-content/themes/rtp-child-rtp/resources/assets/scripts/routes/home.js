export default {
  init() {
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
    $('.directory-search-filter .filter-selects select').formSelect();
  },
};
