const header_logo = document.querySelector("#header-logo");
console.log(header_logo);

class TypingText {
  text = [];
  curr = 0;
  element = null;
  constructor(e, text) {
    e.innerText = "";
    this.element = e;
    this.curr = 0;
    this.text = text;
    this.addLetter();
  }

  addLetter() {
    setTimeout(() => {
      this.element.innerText +=
        this.text[this.curr][this.element.innerText.length];
      if (this.element.innerText.length < this.text[this.curr].length) {
        requestAnimationFrame(() => {
          this.addLetter();
        });
      } else {
        setTimeout(() => {
          this.removeLetter();
        }, 1200);
      }
    }, 125);
  }

  removeLetter() {
    setTimeout(() => {
      this.element.innerText = this.element.innerText.substring(
        0,
        this.element.innerText.length - 1
      );
      if (this.element.innerText.length > 0) {
        requestAnimationFrame(() => {
          this.removeLetter();
        });
      } else {
        setTimeout(() => {
          this.nextText();
          this.addLetter();
        }, 1200);
      }
    }, 125);
  }

  nextText() {
    if (this.curr < this.text.length - 1) {
      this.curr++;
    } else {
      this.curr = 0;
    }

    console.log(`Curr: ${this.curr}`);
  }
}

class Application {
  constructor() {
    this.logoText = new TypingText(header_logo, [
      "Marvel",
      "Wypoczynek",
      "Bługaria",
      "Bezpieczeństwo",
    ]);
    document.addEventListener("DOMContentLoaded", () => {
      console.log("loaded");
      this.loadHandler();
    });
  }

  loadHandler() {}
}

new Application();
