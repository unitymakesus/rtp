// Web Font Loader
var WebFont = require('webfontloader');

var fontFamilies = ['Poppins:400,400i,500,500i,600,600i', 'Material Icons'];

WebFont.load({
 google: {
   families: fontFamilies
 }
});
