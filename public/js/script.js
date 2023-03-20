// Utils
const isElement = (e) => (typeof e === "object" && e !== null ? true : false);
const debounce = (func) => {
  let timer;
  return function (event) {
    if (timer) clearTimeout(timer);
    timer = setTimeout(func, 100, event);
  };
};

const goto = (link) => {
  if (link !== undefined) {
    document.location.href = link;
    return true;
  }
  return false;
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
    if (isElement(langs__wrapper)) {
      this.langs.forEach((e) => {
        const div = document.createElement("div");
        div.className = "nav__menu-flag";
        if (this.lang == e) {
          div.classList.add("active");
        }
        const wrapper = document.createElement("div");
        wrapper.className = "nav__menu-flag__wrapper";
        const img = document.createElement("img");

        img.setAttribute("data-src", `./assets/img/flag/${e}.jpg`);
        img.setAttribute("aria-label", `FLAG ${e}`);
        img.setAttribute("alt", `${e}`);
        wrapper.append(img);
        div.append(wrapper);
        langs__wrapper.append(div);
        this.buttons.push(div);
      });
    }

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

class LazyLoading {
  observator = null;
  constructor(elements) {
    // console.log(elements);
    if ("IntersectionObserver" in window) {
      this.observer = new IntersectionObserver(
        (changes, observer) => {
          changes.forEach(function (change) {
            if (change.intersectionRatio > 0) {
              // console.log(change);
              LazyLoading.loadImage(change.target);
              observer.unobserve(change.target);
            }
          });
        },
        {
          root: null,
          rootMargin: "0px",
          threshold: 0.5,
        }
      );
      elements.forEach((image) => {
        this.observer.observe(image);
      });
    } else {
      elements.forEach(function (image) {
        LazyLoading.loadImage(image);
      });
    }
  }

  static loadImage(image) {
    // console.log(image);
    image.classList.add("fade-in");
    if (image.dataset && image.dataset.src) {
      image.src = image.dataset.src;
    }

    if (image.dataset && image.dataset.srcset) {
      image.srcset = image.dataset.srcset;
    }
  }
}

class Acoredeon {
  element = null;
  acordeon__question = null;
  acordeon__answer = null;
  id = null;
  visible = false;
  constructor(i) {
    const acordeon = document.createElement("div");
    acordeon.className = "acordeon";
    acordeon.id = `acordeon-${i}`;
    this.element = acordeon;
    this.id = i;
    this.indexText = `acordeon-${i}`;
    const data = languageSystem.getVal(this.indexText);
    this.acordeon__question = document.createElement("div");
    this.acordeon__question.className = `acordeon__question`;
    this.acordeon__question.innerHTML = `<h3>${data[0]}</h3>`;

    this.acordeon__answer = document.createElement("div");
    this.acordeon__answer.className = `acordeon__answer`;
    this.acordeon__answer.innerHTML = `<h4>${data[1]}</h4>`;

    acordeon.append(this.acordeon__question);
    acordeon.append(this.acordeon__answer);

    document.querySelector(".acordeons__wrapper").append(acordeon);
  }
  toggle(force) {
    this.visible = !this.visible;
    if (this.visible) {
      this.acordeon__answer.classList.add("show");
    } else {
      this.acordeon__answer.classList.remove("show");
    }
    return true;
  }

  updateText() {
    const data = languageSystem.getVal(this.indexText);
    this.acordeon__question.innerHTML = `<h3>${data[0]}</h3>`;
    this.acordeon__answer.innerHTML = `<p>${data[1]}</p>`;
  }
}

class Request {
  path = null;
  constructor() {
    const checkParam = /\?/;
    this.path = document.location.href.split("/").reverse()[0];
    this.params = {};
    if (checkParam.test(this.path)) {
      const query = this.path.split("?");
      this.path = query[0];
      let params = query[1].split("&");
      params.forEach((element) => {
        const param = element.split("=");
        if (param[0] != undefined && param[0] != "") {
          this.params[param[0]] = param[1];
        }
      });
    }
  }

  getPath() {
    return this.path;
  }
}

class Application {
  constructor() {
    this.init();
  }
  elements = {};
  async init() {
    this.request = new Request();
    this.cookieManager = new CookieManager(
      document.querySelector("#cookie-modal")
    );

    await languageSystem.init(this);
    this.elements.img = document.querySelectorAll("source, img");
    this.lazyLoading = new LazyLoading(this.elements.img);
    this.elements.logoText = new TypingText(
      document.querySelector("#header-logo"),
      "typing-header"
    );
    this.elements.acordeons = [];

    if (this.request.getPath() === "contact") {
      for (let i = 0; i <= 9; i++) {
        this.elements[`acordeon-${i}`] = new Acoredeon(i);
      }
    }

    if (this.request.getPath() === "room") {
      const slider = document.querySelector(".room__preview__slider");
      slider.setAttribute("data-current-img", 0);
      const sliderImage = slider.querySelector(".room__preview__slider__image");
      const sliderImages = slider.getAttribute("data-imgs").split(",");
      sliderImage.src = `./assets/img/room/${sliderImages[0]}`;
      const sliderInfo = slider.querySelector(".room__preview__slider__info");
      sliderInfo.innerText = `1/${sliderImages.length}`;
    }

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
    } else if (target.tagName !== undefined) {
      const action = target.getAttribute("data-action");
      if (target.tagName.toUpperCase() === "BUTTON") {
        if (target.className === "room__book") {
          // console.log(action);
          if (action == "goto") {
            const roomID = parseInt(target.getAttribute("data-roomid"));
            if (roomID !== undefined && roomID !== NaN) {
              // console.log(roomID);
              goto(`/room?id=${roomID}`);
              return true;
            }
          } else if (action == "book") {
            return true;
          }
        } else if (target.className === "room__preview__calendar__top-prev") {
          if (this.request.getPath() === "room") {
            if (
              this.request.params["id"] !== undefined &&
              parseInt(this.request.params["id"]) > 0
            ) {
              const roomID = parseInt(this.request.params["id"]);
              const date = new Date();
              let month =
                this.request.params["month"] !== undefined &&
                parseInt(this.request.params["month"]) >= 1 &&
                parseInt(this.request.params["month"]) <= 12
                  ? parseInt(this.request.params["month"])
                  : date.getMonth() + 1;
              let year =
                this.request.params["year"] !== undefined
                  ? parseInt(this.request.params["year"])
                  : date.getFullYear();

              if (month >= 1 && month <= 12) {
                if (month - 1 > 0) {
                  month--;
                } else {
                  year--;
                  month = 12;
                }
                goto(`/room?id=${roomID}&month=${month}&year=${year}`);
              } else {
                goto(`/room?id=${roomID}`);
              }
              return true;
            }
            return false;
          }
        } else if (target.className === "room__preview__calendar__top-next") {
          if (this.request.getPath() === "room") {
            if (
              this.request.params["id"] !== undefined &&
              parseInt(this.request.params["id"]) > 0
            ) {
              const roomID = parseInt(this.request.params["id"]);
              const date = new Date();
              let month =
                this.request.params["month"] !== undefined &&
                parseInt(this.request.params["month"]) >= 1 &&
                parseInt(this.request.params["month"]) <= 12
                  ? parseInt(this.request.params["month"])
                  : date.getMonth() + 1;
              let year =
                this.request.params["year"] !== undefined
                  ? parseInt(this.request.params["year"])
                  : date.getFullYear();
              // console.log(month);
              if (month >= 1 && month <= 12) {
                if (month + 1 >= 13) {
                  year++;
                  month = 1;
                } else {
                  month++;
                }
                // console.log(month);
                goto(`/room?id=${roomID}&month=${month}&year=${year}`);
              } else {
                goto(`/room?id=${roomID}`);
              }
              return true;
            }
            return false;
          }
        } else if (target.className === "aview__c_button__prev") {
          if (this.request.getPath() === "manage") {
            const date = new Date();
            let month =
              this.request.params["month"] !== undefined &&
              parseInt(this.request.params["month"]) >= 1 &&
              parseInt(this.request.params["month"]) <= 12
                ? parseInt(this.request.params["month"])
                : date.getMonth() + 1;
            let year =
              this.request.params["year"] !== undefined
                ? parseInt(this.request.params["year"])
                : date.getFullYear();

            if (month >= 1 && month <= 12) {
              if (month - 1 > 0) {
                month--;
              } else {
                year--;
                month = 12;
              }
              goto(`/manage?mode=reservations&month=${month}&year=${year}`);
            } else {
              goto(`/manage?mode=reservations`);
            }
            return true;
          }
        } else if (target.className === "aview__c_button__next") {
          if (this.request.getPath() === "manage") {
            const date = new Date();
            let month =
              this.request.params["month"] !== undefined &&
              parseInt(this.request.params["month"]) >= 1 &&
              parseInt(this.request.params["month"]) <= 12
                ? parseInt(this.request.params["month"])
                : date.getMonth() + 1;
            let year =
              this.request.params["year"] !== undefined
                ? parseInt(this.request.params["year"])
                : date.getFullYear();

            if (month >= 1 && month <= 12) {
              if (month + 1 >= 13) {
                year++;
                month = 1;
              } else {
                month++;
              }
              goto(`/manage?mode=reservations&month=${month}&year=${year}`);
            } else {
              goto(`/manage?mode=reservations`);
            }
            return true;
          }
        } else if (target.className === "room__preview__slider__prev") {
          if (this.request.getPath() === "room") {
            const slider = document.querySelector(".room__preview__slider");
            const sliderImage = slider.querySelector(
              ".room__preview__slider__image"
            );
            const sliderImages = slider.getAttribute("data-imgs").split(",");
            let newSliderImage = parseInt(
              slider.getAttribute("data-current-img")
            );
            newSliderImage--;
            if (newSliderImage < 0) {
              newSliderImage = 0;
            }
            slider.setAttribute("data-current-img", newSliderImage);
            sliderImage.src = `./assets/img/room/${sliderImages[newSliderImage]}`;
            const sliderInfo = slider.querySelector(
              ".room__preview__slider__info"
            );
            sliderInfo.innerText = `${newSliderImage + 1}/${
              sliderImages.length
            }`;
          }
        } else if (target.className === "room__preview__slider__next") {
          if (this.request.getPath() === "room") {
            const slider = document.querySelector(".room__preview__slider");
            const sliderImage = slider.querySelector(
              ".room__preview__slider__image"
            );
            const sliderImages = slider.getAttribute("data-imgs").split(",");
            let newSliderImage = parseInt(
              slider.getAttribute("data-current-img")
            );
            newSliderImage++;
            if (newSliderImage > sliderImages.length - 1) {
              newSliderImage = sliderImages.length - 1;
            }
            slider.setAttribute("data-current-img", newSliderImage);
            sliderImage.src = `./assets/img/room/${sliderImages[newSliderImage]}`;
            const sliderInfo = slider.querySelector(
              ".room__preview__slider__info"
            );
            sliderInfo.innerText = `${newSliderImage + 1}/${
              sliderImages.length
            }`;
          }
        }
      } else if (target.tagName.toUpperCase() === "DIV") {
        if (target.className === "acordeon__question") {
          const acordeonID = parseInt(
            target.parentElement.getAttribute("id").split("-")[1]
          );

          if (
            acordeonID != null &&
            this.elements[`acordeon-${acordeonID}`] &&
            typeof this.elements[`acordeon-${acordeonID}`] == "object"
          ) {
            // console.log(this.elements[`acordeon-${acordeonID}`]);

            this.elements[`acordeon-${acordeonID}`].toggle();
          }
        }
      } else {
        // console.log(target.tagName.toUpperCase());
      }
    }
  }

  resizeHandler(e) {
    this.hamburger.toggle(false);
  }
}

new Application();
