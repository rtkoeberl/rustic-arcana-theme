class LogoAnimate {
  constructor() {
    this.path = document.getElementById("path");
    this.turbulence = document.getElementById("turbulence");
    this.events();
    this.startBounce();
    this.endBounce();

    this.upward = true;
    this.interval;
  }

  events () {
    path.addEventListener("mouseenter", this.startBounce.bind(this));
    path.addEventListener("mouseleave", this.endBounce.bind(this));
  }


  startBounce () {
    let repetitions = 0;
    
    this.interval = setInterval(() => {

      var frequency = Number(turbulence.getAttribute("baseFrequency"));

      if (this.upward) {
        frequency += 0.001;
      } else if (!this.upward) {
        frequency -= 0.001;

      }
      frequency = (parseInt(1000*frequency))/1000;

      if (frequency > 0.1) {
        this.upward = false;
      } else if (frequency < 0.04) {
        this.upward = true;
      }

      this.turbulence.setAttribute("baseFrequency", frequency);
      repetitions++;

      // end after 12 repetitions (roughly 2ms after css hover effect has ended)
      if (repetitions === 12) {
        clearInterval(this.interval);
      }
    }, 100);
  }

  endBounce () {
    clearInterval(this.interval);
  }

}

export default LogoAnimate;