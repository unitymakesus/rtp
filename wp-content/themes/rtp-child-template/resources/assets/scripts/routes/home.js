import TimelineMax from 'TimelineMax'; // eslint-disable-line no-unused-vars
// import TweenMax from 'TweenMax'; // eslint-disable-line no-unused-vars
import ScrollMagic from 'ScrollMagic';
import 'animation.gsap';
import 'debug';
import * as Ease from 'EasePack'; // eslint-disable-line no-unused-vars
// import 'gsap/TextPlugin';

export default {
  init() {
    // Set up the controller
    var controller = new ScrollMagic.Controller();

    /**
     * Where People + Ideas Convene Text Animation
     */

    // Duration
    var durationValueCache;
    function durationCallback () { return durationValueCache; }
    function updateDuration () { durationValueCache = ($(window).height() * 0.50); }
    updateDuration(); // set to initial value

     // Tween
     var wordTween = new TimelineMax();
     wordTween.to(['#svg-where', '#svg-converge', '#svg-plus'], 2, {autoAlpha:0}, 0)
       .to('#svg-people', 9, {attr:{x:150}}, 0)
       .to('#svg-ideas', 9, {attr:{dx:-300}}, 0)
       .to('#svg-bar', 4, {attr:{width:'100%', x:'0%'}}, 2)

    // Scene
    new ScrollMagic.Scene({triggerElement:'#landing-graphic-pin', triggerHook: '0', offset: '-200'})
      .setTween(wordTween)
      .setPin('#landing-graphic-pin', {pushFollowers: false})
      // .addIndicators({name: '1 (duration: 50% of window height)'})
      .duration(durationCallback)
      .addTo(controller);

    /**
     * Landing Banner Animation Scene
     */

    // Tween
    var imgTween = new TimelineMax();
    imgTween.to(['#svg-bar', '#svg-people', '#svg-ideas'], 0, {autoAlpha:0}, 0)
      .to('#landing-banner-gradient', 0.5, {className: '+=open'}, 0)

    // Scene
    new ScrollMagic.Scene({triggerElement:'#landing-graphic-swipe', triggerHook: '0.5', duration: '0'})
      .setTween(imgTween)
      // .addIndicators({name: '2 (location: 40% height of screen)'})
      .addTo(controller);

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
