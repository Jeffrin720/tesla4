
/*
function i18n(namespaces, cb) {
  return Translate().init(namespaces, cb);  
}
//*/


function i18n(opts) {

  if (typeof i18n.instance === "object") {
    return i18n.instance;
  }

  if (!(this instanceof i18n)) {
    return new i18n(opts);
  }

  opts = opts || {};

  this.data = {};
  this._debug = false;
  this._debugLang = "en";

  /*
  //  See if debug mode is set in localStorage
  if (localStorage) {
    try {
      this._debug = !!localStorage.getItem("debug");
    }
    catch (err) {
      console.error(err);
    }
  }
  //*/


  //
  //  Setup i18next
  //
  var i18next = opts.i18next || window.i18next.createInstance();
  var i18nextBrowserLanguageDetector = opts.i18nextBrowserLanguageDetector || window.i18nextBrowserLanguageDetector;
  var i18nextXHRBackend = opts.i18nextXHRBackend || window.i18nextXHRBackend;


  this._i18next = i18next
    .use(i18nextBrowserLanguageDetector)
    .use(i18nextXHRBackend);

  this._i18next.on("languageChanged", this.languageChanged);

  //  Bind locale selector
  //this.bindLocaleSelector();

  i18n.instance = this;

  return this;
}


i18n.prototype.debug = function () {
  this._debug = !this._debug;
  this.translate();
  console.log("DEBUG", this._debug);
}


i18n.prototype.init = function (namespaces, cb) {

  //  Bind locale selector
  this.bindLocaleSelector();


  var ns = namespaces || ["common"];
  ns = Array.isArray(ns) ? ns : [ns];

  var opts = {
    detection: {
      lookupQuerystring: "locale",
      lookupCookie: "i18next"
    },
    ns: ns,
    defaultNS: ns[0],
    fallbackLng: "en",
    backend: {
      loadPath: "/static/data/locales/content/{{ns}}/{{lng}}.json"
    }
  };

  this._i18next.init(opts, cb);

  return this;
}


i18n.prototype.t = function (key, data) {

  if (this._debug && this._i18next.exists(key)) {
    var REPLACE_PATTERN = new RegExp(/[^ ]/, "g");
    var fixedT = this._i18next.getFixedT(this._debugLang);
    var content = fixedT(key);

    //  Strip HTML
    var div = document.createElement("div");
    div.innerHTML = content || "";

    return div.innerText.replace(REPLACE_PATTERN, "x");

  }

  return this._i18next.t(key, data);
};


i18n.prototype.translate = function () {
  var container = document;
  var i18nValues = {};

  function forEach(selector, cb) {
    return Array.prototype.slice.apply(selector).map(cb);
  }
  

  //  Replace with specified key
  //  data-i18n-key="example-attribute-key"
  forEach(container.querySelectorAll("[data-i18n-key]"), function (el) {
    var key = el.getAttribute('data-i18n-key');
    var data = this.geti18nData(el, el.innerHTML);

    el.innerHTML = this.t(key, data);
  }.bind(this));


  //  Replace with innerText
  //  data-i18n-text
  forEach(container.querySelectorAll('[data-i18n-text]'), function (el) {
    var key = el.innerText.trim();
    var data = this.geti18nData(el, el.innerText);

    el.innerHTML = this.t(key, data);
  }.bind(this));


  //  Replace placeholders
  //  data-i18n-placeholder
  forEach(container.querySelectorAll('[data-i18n-placeholder]'), function (el) {
    var key = el.getAttribute('data-i18n-placeholder');
    var data = this.geti18nData(el);

    el.setAttribute('placeholder', this.t(key, data));
  }.bind(this));


  //  Replace links/href
  //  data-i18n-href
  forEach(container.querySelectorAll('[data-i18n-href]'), function (el) {
    var key = el.getAttribute('data-i18n-href');
    var data = this.geti18nData(el);

    el.setAttribute('href', this.t(key, data));
  }.bind(this));


  //console.log("map", map);
  this.afterTranslate && this.afterTranslate(this._i18next.language);
};


i18n.prototype.clearMessages = function clearMessages() {
  
};


i18n.prototype.language = function() {
  return this._i18next.language;
};


i18n.prototype.on = function on(event, callback) {
  this._i18next.on(event, callback);
};


i18n.prototype.languageChanged = function languageChanged(lng) {
  console.log("Language changed:", lng);

  //  Set cookie
  document.cookie = "i18next=" + lng + ";path=/";

  //  Update the page direction based on language (Hebrew and Arabic)
  if (lng.match(/^he|ar/i)) {
    document.documentElement.setAttribute("dir", "rtl");
  } else {
    document.documentElement.removeAttribute("dir");
  }

  //
  //  Update locale selector
  //
  var localeSelector = document.querySelector("#locale-modal");
  if (localeSelector) {
    var actives = localeSelector.querySelectorAll(".region-item");
    for (var i = 0; i < actives.length; i++) {
      var langAnchor = actives[i].querySelector("a");
      if (langAnchor && (langAnchor.getAttribute("data-lang") === lng)) {
        actives[i].classList.add("active");
      }
      else {
        actives[i].classList.remove("active");
      }
    }
  }

  //
  //  Update Locale Placeholder
  //
  Array.prototype.forEach.call(
    document.querySelectorAll("[data-placeholder-locale]"),
    function(el) {
      el.innerText = lng;
    }
  );

};



i18n.prototype.changeLanguage = function changeLanguage(lng) {
  this._i18next.changeLanguage(lng, function (err, t) {
    this.translate();
  }.bind(this));

  return this;
};


i18n.prototype.bindLocaleSelector = function bindLocaleSelector() {
  var modal = document.querySelector("#locale-modal");

  if (!modal) {
    return;
  }

  modal.addEventListener("click", function (e) {
    var el = e.target;
    var lang = el.getAttribute("data-lang");
    var langContainer = el.parentNode;
    var hasSublang = langContainer.classList.contains("has_sublang");

    if (hasSublang) {
      var sublang = langContainer.getAttribute("data-sublang");
      var sublangClass = ".is-sublang-" + sublang;

      var parentNode = langContainer.parentNode;
      var sublangs = parentNode.querySelectorAll(sublangClass);

      for (var i = 0; i < sublangs.length; i++) {
        sublangs[i].classList.toggle("tds--is_hidden");
      }

      return;
    }


    if (lang) {
      this.changeLanguage(lang);

      var button = e.currentTarget.querySelector("button.tds-modal-close");
      button.dispatchEvent(new Event("click"));
    }
  }.bind(this));
}


i18n.prototype.geti18nData = function geti18nData(el, defaultValue) {
  var data = Object.create(this.data || {});
  if (el.hasAttribute("data-i18n-data")) {
    data = el.getAttribute('data-i18n-data');
    data = JSON.parse(data);
  }
  data.defaultValue = defaultValue;

  return data;
}


