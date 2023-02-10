// Utils
const isElement = (e) => (typeof e === "object" && e !== null ? true : false);
const debounce = (func) => {
  let timer;
  return function (event) {
    if (timer) clearTimeout(timer);
    timer = setTimeout(func, 100, event);
  };
};

const getCookie = (cname) => {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
};

class CookieManager {
  accepted = false;
  constructor() {
    if (getCookie("accepted")) this.accepted = true;
    console.log(this.accepted);
  }

  setCookie()
  getCookie()
}

class LanguageSystem {
  data = null;
  lang = null;
  langs = [];
  buttons = [];
  elements = [];

  constructor(lang) {
    this.lang = "pl";
  }

  setLang(lang) {
    this.buttons[this.langs.indexOf(this.lang)].classList.toggle(
      "active",
      false
    );
    this.lang = this.langs[lang];
    this.updateText();
    this.buttons[lang].classList.toggle("active", true);
  }

  async init() {
    this.data = await fetch("./translation.json").then((response) =>
      response.json()
    );

    this.langs = Object.keys(this.data);

    const langs__wrapper = document.querySelector("#nav__menu-flags");

    this.langs.forEach((e) => {
      const div = document.createElement("div");
      div.className = "nav__menu-flag";
      if (this.lang == e) {
        div.classList.add("active");
      }
      const wrapper = document.createElement("div");
      wrapper.className = "nav__menu-flag__wrapper";
      const img = document.createElement("img");
      img.setAttribute("src", `./assets/img/flag/${e}.jpg`);
      wrapper.append(img);
      div.append(wrapper);
      langs__wrapper.append(div);
      this.buttons.push(div);
    });

    this.elements = document.querySelectorAll("*[data-ls]");
    this.updateText();
  }

  updateText() {
    if (this.data[this.lang] != null && this.data[this.lang] != undefined) {
      for (const element of this.elements) {
        const attr = element.getAttribute("data-ls");
        if (attr) {
          const value = this.data[this.lang][attr];
          if (value) {
            element.innerText = value;
          }
        }
      }
    }
  }
}

class TypingText {
  text = [];
  curr = 0;
  element = null;
  constructor(e, text) {
    if (!isElement(e)) {
      return false;
    }

    e.innerText = "";
    this.element = e;
    this.curr = 0;
    this.text = text;
    this.addLetter();
  }

  addLetter() {
    if (!this.element) return false;
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
    }, Math.floor(Math.random() * 100 + 160));
  }

  removeLetter() {
    if (!this.element) return false;
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
    this.curr =
      this.curr == this.text.length - 1
        ? 0
        : Math.min(this.text.length - 1, ++this.curr);
  }
}

class Hamburger {
  element = null;
  elementMenu = null;
  active = false;
  constructor(e, eMenu) {
    if (!isElement(e)) {
      return false;
    }
    if (!isElement(eMenu)) {
      return false;
    }
    this.element = e;
    this.elementMenu = eMenu;
  }

  toggle(force) {
    // this.elementMenu.style.transition = "var(--tran2)";
    this.elementMenu.classList.toggle(
      "active",
      force !== null ? force : undefined
    );
    return this.element.classList.toggle(
      "active",
      force !== null ? force : undefined
    );
  }
}

class Application {
  constructor() {
    this.init();
  }
  async init() {
    this.cookieManager = new CookieManager();
    this.languageSystem = new LanguageSystem();

    await this.languageSystem.init();

    this.logoText = new TypingText(document.querySelector("#header-logo"), [
      "Marvel",
      "Wypoczynek",
      "Bługaria",
      "Bezpieczeństwo",
    ]);

    this.hamburger = new Hamburger(
      document.querySelector(".nav__hamburger"),
      document.querySelector(".nav__menu")
    );

    // Handlers

    window.addEventListener("load", (e) => this.loadHandler(e), false);
    document.addEventListener("click", (e) => this.clickHandler(e));

    window.addEventListener(
      "resize",
      debounce((e) => {
        this.resizeHandler(e);
      })
    );
  }

  loadHandler(e) {
    console.log("ready");
    document.documentElement.classList.remove("preload"); // remove preload class
  }
  clickHandler(e) {
    if (!isElement(e)) return false;
    const { target } = e;
    if (!target) {
      this.hamburger.toggle(false);
      return false;
    }

    if (target === this.hamburger.element) {
      this.hamburger.toggle();
    } else if (this.languageSystem.buttons.indexOf(target) > -1) {
      this.languageSystem.setLang(this.languageSystem.buttons.indexOf(target));
    }
  }

  resizeHandler(e) {
    this.hamburger.toggle(false);
  }
}

new Application();
