class Hamburger {
  status = false;
  constructor(hamburger) {
    this.element = hamburger;
    this.setTransition(1);
  }

  setTransition(type) {
    let classN = "transition-hamburger-close";
    if (type === 2) classN = "transition-hamburger-open ";
    const list = this.element.querySelectorAll("span");
    for (let i = 0; i < list.length; i++) {
      list[i].className = classN;
    }
  }

  toggle() {
    this.status = !this.status;
    if (this.status) {
      this.element.classList.toggle("active", true);
    } else {
      this.element.classList.toggle("active", false);
    }
    this.setTransition(this.status === false ? 1 : 2);
    return this.status;
  }
  getElement() {
    return this.element;
  }
}

class Application {
  constructor() {
    this.hamburger = new Hamburger(document.querySelector(".header-hamburger"));
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
