class Hamburger {
  status = false;
  constructor(hamburger, menu) {
    this.element = hamburger;
    this.menu = menu;
    this.setTransition(1);
  }

  setTransition(classN) {
    const list = this.element.querySelectorAll("span");
    for (let i = 0; i < list.length; i++) {
      list[i].className = classN;
    }
  }

  toggle(force) {
    this.status = force == null ? !this.status : force;
    if (this.status) {
      this.element.classList.toggle("active", true);
      this.menu.classList.toggle("active", true);
    } else {
      this.element.classList.toggle("active", false);
      this.menu.classList.toggle("active", false);
    }
    this.setTransition(
      this.status === false
        ? "transition-hamburger-close"
        : "transition-hamburger-open"
    );
    return this.status;
  }
  getElement() {
    return this.element;
  }
}
