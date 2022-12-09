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
    if (target === this.hamburger.getElement()) {
      this.hamburger.toggle();
      return true;
    }
    return false;
  }
}

new Application();
