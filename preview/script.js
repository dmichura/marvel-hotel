class Application {
  data = {};
  ui = {};
  constructor() {
    // All handlers
    this.ui.ball = document.querySelector(".ball");
    addEventListener("click", (e) => {
      this.clickHandler(e);
    });

    this.ui.navItems = document.querySelectorAll(".nav-item");
    if (this.ui.navItems.length > 0) {
      this.ui.navItems.forEach((element, index) => {
        if (index == 0)
          this.ui.ball.style.left = `${
            element.offsetLeft + element.clientWidth / 2
          }px`;
        element.addEventListener("mouseenter", (e) => {
          this.mouseEnterHandler(e);
        });
        element.addEventListener("mouseout", (e) => {
          this.mouseOutHandler(e);
        });
      });
    }
  }

  clickHandler(e) {}

  mouseEnterHandler(e) {
    if (e.target) {
      const { target } = e;
      if (target.classList.contains("nav-item")) {
        this.ui.ball.style.left = `${
          target.offsetLeft + target.clientWidth / 2
        }px`;
      }
    }
  }

  mouseOutHandler(e) {
    if (e.target) {
      const target = this.ui.navItems[0];
      if (target.classList.contains("nav-item")) {
        this.ui.ball.style.left = `${
          target.offsetLeft + target.clientWidth / 2
        }px`;
      }
    }
  }
}

new Application();
