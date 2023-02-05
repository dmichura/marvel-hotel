new Hamburger(
  document.querySelector(".header-hamburger"),
  document.querySelector(".nav")
);
class Application {
  constructor() {
    this.hamburger = new Hamburger(
      document.querySelector(".header-hamburger"),
      document.querySelector("#header-nav")
    );
    // All handlers
    addEventListener("click", (event) => {
      this.clickHandler(event);
    });
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
}

new Application();
