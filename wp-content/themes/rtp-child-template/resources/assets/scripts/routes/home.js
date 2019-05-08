import TimelineMax from 'TimelineMax'; // eslint-disable-line no-unused-vars
// import TweenMax from 'TweenMax'; // eslint-disable-line no-unused-vars
import ScrollMagic from 'ScrollMagic';
import 'animation.gsap';
// import 'gsap/TextPlugin';

export default {
  init() {
    // Set up the controller
    var controller = new ScrollMagic.Controller();

    // Build tween
    var tween = new TimelineMax();
    tween.to('#svg-where', 1, {autoAlpha:0}, 0).to('#svg-convene', 1, {autoAlpha:0}, 0).to('#svg-plus', 1, {autoAlpha:0}, 0)
      .to('#svg-people', 3, {attr:{x:50}}, 0).to('#svg-ideas', 3, {attr:{dx:-100}}, 0)
      .to('#gradient-bar', 4, {width:'100%'}, 1);
      // .setClassToggle('#gradient-bar', 'wide')
      // .to('#svg-people', 1, {text:{value:'RTP', delimiter:' '}}, 1)
      // .to('#svg-people', 1, {autoAlpha:0}, 1)
      // .to('#svg-ideas', 1, {autoAlpha:0}, 1);

    // Build scene
    new ScrollMagic.Scene({triggerElement:'#landing-graphic', offset:250, duration:'100%'}).setTween(tween).setPin('#landing-graphic-pin', {pushFollowers: false}).addTo(controller);
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
