// Utils
const isElement = (e) => (typeof e === "object" && e !== null ? true : false);
const debounce = (func) => {
  let timer;
  return function (event) {
    if (timer) clearTimeout(timer);
    timer = setTimeout(func, 100, event);
  };
};

class CookieManager {
  static accepted = false;
  cookieMessage = null;
  cookieMessageActionButton = null;
  constructor(cookieMessage) {
    if (!isElement(cookieMessage)) return false;
    this.cookieMessage = cookieMessage;
    if (Boolean(CookieManager.getCookie("accepted")))
      CookieManager.accepted = true;
    if (CookieManager.accepted) {
      this.toggleCookieMessage(false);
    }

    this.cookieMessageActionButton = cookieMessage.querySelector(
      "#cookie-modal__button"
    );
  }
  acceptCookie() {
    CookieManager.setCookie("accepted", true, 100, true);
    this.toggleCookieMessage(false);
    return true;
  }
  toggleCookieMessage(force) {
    this.cookieMessage.classList.toggle(
      "hide",
      force !== undefined ? !force : undefined
    );
  }

  static setCookie(name, value, days, force) {
    if (!CookieManager.accepted && force !== true) {
      return false;
    }
    let expires = "";
    if (days) {
      let date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
    return true;
  }

  static getCookie(cname) {
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
  }
}

class LanguageSystem {
  data = null;
  lang = null;
  langs = [];
  buttons = [];
  elements = [];
  app = null;
  constructor() {}

  setLang(lang) {
    this.buttons[this.langs.indexOf(this.lang)].classList.toggle(
      "active",
      false
    );
    this.lang = this.langs[lang];
    CookieManager.setCookie("lang", this.lang, 100);
    this.updateText();
    this.buttons[lang].classList.toggle("active", true);
  }

  async init(app) {
    this.app = app;
    this.data = await fetch("./js/data/translation.json").then((response) =>
      response.json()
    );

    this.langs = Object.keys(this.data);
    const lang = CookieManager.getCookie("lang");
    this.lang =
      lang !== "" && lang !== null && this.langs.indexOf(lang) > -1
        ? lang
        : "pl";
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

  getVal(key) {
    if (key !== undefined) {
      return this.data[this.lang][key];
    }
    return false;
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

    for (var key in this.app.elements) {
      let value = this.app.elements[key];
      if (
        value !== undefined &&
        value !== null &&
        value.updateText !== null &&
        value.updateText !== undefined &&
        typeof value.updateText == "function"
      ) {
        value.updateText();
      }
    }
  }
}

const languageSystem = new LanguageSystem();

class TypingText {
  text = [];
  curr = 0;
  element = null;
  currText = "";
  willChange = false;
  constructor(e, text) {
    if (!isElement(e)) {
      return false;
    }

    e.innerText = "";
    this.element = e;
    this.curr = 0;
    this.indexText = text;
    this.text = languageSystem.getVal(text);
    this.addLetter();
  }

  addLetter() {
    if (!this.element) return false;
    setTimeout(() => {
      let text = this.text[this.curr][this.element.innerText.length];
      if (
        this.text[this.curr][this.element.innerText.length] === " " &&
        this.text[this.curr][this.element.innerText.length + 1] !== undefined
      ) {
        text = ` ${this.text[this.curr][this.element.innerText.length + 1]}`;
      }
      this.currText += text;
      this.element.innerHTML = `${this.currText}`;

      if (this.currText.length < this.text[this.curr].length) {
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
      this.currText = this.currText.substring(0, this.currText.length - 1);
      this.element.innerHTML = this.currText;
      if (this.currText.length > 0) {
        requestAnimationFrame(() => {
          this.removeLetter();
        });
      } else {
        setTimeout(async () => {
          await this.nextText();
          this.addLetter();
        }, 1200);
      }
    }, 125);
  }

  nextText() {
    if (this.willChange) {
      this.text = languageSystem.getVal(this.indexText);
      this.willChange = false;
      return this.nextText();
    }
    this.curr =
      this.curr == this.text.length - 1
        ? 0
        : Math.min(this.text.length - 1, ++this.curr);
  }

  updateText() {
    this.willChange = true;
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
      force !== undefined ? force : undefined
    );
    return this.element.classList.toggle(
      "active",
      force !== undefined ? force : undefined
    );
  }
}

class Application {
  constructor() {
    this.init();
  }
  elements = {};
  async init() {
    this.cookieManager = new CookieManager(
      document.querySelector("#cookie-modal")
    );

    await languageSystem.init(this);

    this.elements.logoText = new TypingText(
      document.querySelector("#header-logo"),
      "typing-header"
    );

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
    // console.log("ready");
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
    } else if (languageSystem.buttons.indexOf(target) > -1) {
      languageSystem.setLang(languageSystem.buttons.indexOf(target));
    } else if (target === this.cookieManager.cookieMessageActionButton) {
      this.cookieManager.acceptCookie();
    }
  }

  resizeHandler(e) {
    this.hamburger.toggle(false);
  }
}

new Application();
