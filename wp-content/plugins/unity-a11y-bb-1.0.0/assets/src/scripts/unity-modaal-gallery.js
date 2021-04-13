import $ from 'jquery';

let event;
$('.unity-modaal-gallery-item__link').modaal({
  type: 'image',
  before_open: e => {
    event = e;
  },
  after_open: modaal => {
    let targetGallery = $(event.target).parents('.unity-modaal-gallery');
    $('.modaal-gallery-label').each((i, elem) => {
      let caption = targetGallery.find(
        `.unity-modaal-gallery-item__caption[data-index='${i}']`
      );

      // if a provided caption exists, set it as modaal's caption.
      if (caption.length > 0) {
        $(elem).addClass('loaded').html(caption.html());
      }
    });
  }
});
