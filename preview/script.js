const root = document.querySelector(":root");

class Hamburger {
  constructor(hamburger, menu) {
    // this.element = hamburger;
    // this.menu = menu;
  }
  setTransition(classN) {
    const list = this.element.querySelectorAll("span");
    // console.log(classN);
    for (let i = 0; i < list.length; i++) {
      list[i].className = `hamburger-bar ${classN}`;
    }
  }
  toggle(force) {
    if (this.timer) return false;
    this.status = force == null ? !this.status : force;
    if (this.status) {
      this.element.classList.toggle("active", true);
      this.menu.classList.toggle("show", true);
      this.menu.classList.toggle("active", true);
    } else {
      this.element.classList.toggle("active", false);
      this.menu.classList.toggle("active", false);
      this.timer = setTimeout(
        () => {
          this.menu.classList.toggle("show", false);

          clearTimeout(this.timer);
          this.timer = null;
        },
        300,
        this
      );
    }
    this.setTransition(
      this.status === false
        ? "hamburger-bar-transition-fadeOut"
        : "hamburger-bar-transition-fadeIn"
    );
    return this.status;
  }
  getElement() {
    return this.element;
  }
}

class Preloader {
  timer = null;
  status = false;
  constructor(element) {
    this.element = element;
    this.loadingText = element.querySelector(".preloader-logo-text");
    this.bar = element.querySelector(".preloader-bar");
    this.show();
  }

  changeLoadingText() {
    let text = this.loadingText.innerText;
    switch (text) {
      case "Ładowanie":
        text += ".";
        break;
      case "Ładowanie.":
        text += ".";
        break;
      case "Ładowanie..":
        text += ".";
        break;
      default:
        text = "Ładowanie";
        break;
    }
    this.loadingText.innerText = text;
  }

  setPercentage(percentage) {
    if (percentage >= 0 && percentage <= 100) {
      this.bar.style.width = `${percentage}%`;
    }
  }

  show() {
    if (this.status === false) {
      if (this.timer != null) clearInterval(this.timer);
      this.timer = setInterval(() => {
        this.changeLoadingText();
      }, 250);
      this.setPercentage(0);
      this.status = true;
    }
  }

  hide() {
    if (this.status) {
      if (this.timer != null) clearInterval(this.timer);
      this.timer = null;
      this.status = false;
      this.element.classList.toggle("hide", true);
    }
  }
}

class Application {
  constructor() {
    this.hamburger = new Hamburger(
      document.querySelector(".hamburger"),
      document.querySelector("nav")
    );
    this.preloader = new Preloader(document.querySelector(".preloader"));
    // setInterval(() => {
    //   this.percentage += 5;
    //   this.preloader.setPercentage(this.percentage);
    // }, 200);
    // All handlers
    addEventListener("click", (event) => {
      this.clickHandler(event);
    });
    addEventListener("resize", (event) => {
      this.resizeHandler(event);
    });
    addEventListener("load", (event) => {
      this.load(event);
    });
  }

  load(e) {
    this.preloader.setPercentage(50);
    setTimeout(() => {
      this.preloader.setPercentage(100);
      setTimeout(() => {
        this.preloader.hide();
      }, 100);
    }, 500);
  }

  clickHandler(e) {
    const target = e.target || null;
    // console.log(target);
    if (target === this.hamburger.getElement()) {
      this.hamburger.toggle();
      return true;
    } else {
      this.hamburger.toggle(false);
    }
    return false;
  }

  resizeHandler(e) {
    this.hamburger.toggle(false);
    // this.hamburger.update();
    return false;
  }
}

new Application();
