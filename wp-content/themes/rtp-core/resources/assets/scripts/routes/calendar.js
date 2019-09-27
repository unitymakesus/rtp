export default {
  init() {
    // Materialize Select Dropdowns
    $('.mec-date-search select').formSelect();
    $('.mec-dropdown-search select').formSelect();

    // Search form for any URL params that are set on load
    // var url = new URL(url_string);
    // var category = url.searchParams.get("category");
    // var location = url.searchParams.get("location");
    // var type = url.searchParams.get("type");
    //
    // console.log(category);

  },
};
