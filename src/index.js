import "../css/style.scss";

// modules
import LogoAnimate from './modules/LogoAnimate';

// new objects
var logoanimate = new LogoAnimate();

// Allow new JS and CSS to load in browser without a traditional page refresh
if (module.hot) {
  module.hot.accept()
}
