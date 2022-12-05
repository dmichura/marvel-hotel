class Hamburger {
  element = null;
  elementMenu = null;
  constructor(element, elementMenu) {
    this.element = element;
    this.elementMenu = elementMenu;
    this.element.addEventListener("click", () => {
      this.element.classList.toggle("active");
      this.elementMenu.classList.toggle("active");
      this.elementMenu.classList.toggle(
        "hide",
        !this.element.classList.contains("active")
      );
    });
  }
}
