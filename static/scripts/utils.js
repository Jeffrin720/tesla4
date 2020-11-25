
//  Array.prototype.find polyfill
Array.prototype.find||Object.defineProperty(Array.prototype,"find",{value:function(r){if(null==this)throw TypeError('"this" is null or not defined');var t=Object(this),e=t.length>>>0;if("function"!=typeof r)throw TypeError("predicate must be a function");for(var i=arguments[1],o=0;o<e;){var n=t[o];if(r.call(i,n,o,t))return n;o++}},configurable:!0,writable:!0});


function $(selector, ctx) {
  ctx = ctx || document;
  return ctx.querySelectorAll(selector);
}


function cookiesEnabled() {
  try {
    document.cookie = 'cookietest=1;SameSite=Lax';
    var cookiesEnabled = document.cookie.indexOf('cookietest=') !== -1;
    document.cookie = 'cookietest=1;SameSite=Lax;expires=Thu, 01-Jan-1970 00:00:01 GMT';
    return cookiesEnabled;
  } catch (e) {
    return false;
  }
}


function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};


function getHashParameters() {
  
  var hash = window.location.hash.substring(1) || "";
  //var hash = window.location.hash ? window.location.hash.substring(1) : "";
  //console.log("HASH", window.location.hash, typeof hash, hash);
  
  var hashParams = hash.split("&").reduce(function(ctx, item) {
    
    //console.log("ITEM", item);
    
    var values = item.split("=");
    if (values.length == 2) {
      //ctx[values[0]] = values[1];
      ctx[values[0]] = decodeURIComponent(values[1]);
    }
    
    //console.log("values", values);
    
    return ctx;
  }, {});

  //console.log("hashParams", hashParams);
  
  return hashParams;
  
}



function ajax(method, url, data, cb) {
  data = data || {};

  var xhr = new XMLHttpRequest();
  xhr.open(method, url);

  xhr.onreadystatechange = function () {
    var DONE = 4; // readyState 4 means the request is done.
    var OK = 200; // status 200 is a successful return.
    
    if (xhr.readyState === DONE) {
      
      //console.log(xhr.responseText); // "This is the returned text."
      //console.log(xhr.response);
      //console.log("response", response);
      //console.log("status", xhr.status);
      //console.log("headers", xhr.getAllResponseHeaders());
      
      var headers = xhr.getAllResponseHeaders() || "";
      headers = headers.split("\n").reduce(function(ctx, line) {
        var parts = line.split(": ");
        var key = parts.shift();
        
        if (key.length) {
          ctx[key] = parts.join(": ");
        }
        return ctx;
      }, {});

      //console.log("headers", headers);
      //console.log(xhr.responseText);

      var response;

      try {
        response = JSON.parse(xhr.responseText);
      }
      catch (err) {
        cb(xhr.responseText);
        return;
      }

      if (xhr.status === OK) { 
        if (cb) {
          cb(null, response, xhr.status, headers);
        }
      } else {
        //console.log("Error: " + xhr.status); // An error occurred during the request.
        //console.log("Response: " + xhr.responseText);
        
        if (cb) {
          cb(null, response, xhr.status, headers);
        }
      }
    }
  }
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  //xhr.setRequestHeader("Authorization", hashParams.token);
  
  function serializeMap(k) {
    return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
  }
  
  var params = typeof data == "string" ? data : Object.keys(data).map(serializeMap).join("&");      
  //console.log("params", params);      
  //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  //xhr.send(params);
  
  xhr.setRequestHeader("Accept", "application/json");
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.send(JSON.stringify(data));
}


function clearMessages() {
  //  clear alerts
  var alerts = document.querySelectorAll(".tds-alert.tds-alert--error");
  alerts = [].slice.call(alerts);
  
  alerts.map(function(el) {
    if (!el.classList.contains("hidden")) {
      el.classList.add("hidden");
    }
  });
  
  
  var els = document.querySelectorAll("[data-field]");
  els = [].slice.call(els);
  
  els.map(function(el) {
    //el.classList.remove("invalid-input");  // @deprecated
    el.classList.remove("tds-form-item--error");
     //el.classList.add("hidden");
    if (el.classList.contains("warning-section")) {
      el.classList.add("hidden");
    }
    
   
    
    var container = el.querySelector(".tds-alert,.tds-form-item-feedback,.warning-caption,.tds-status_msg-body");
    container.innerHTML = "";

    if (!container.classList.contains("hidden")) {
      container.classList.add("hidden");
    }
        
  });
}


function addErrorMessage(message, placeholder) {
  
  //console.log(message, placeholder);
  
  var selector = "[data-field=" + placeholder + "]";
  var el = document.querySelector(selector);
  
  if (!el) {
    //console.log("NO ELEMENT", placeholder, message);
    return;
  }
  
  // @deprecated
  //if (!el.classList.contains("invalid-input")) {
  //  el.classList.add("invalid-input");
  //}
  
  if (!el.classList.contains("tds-form-item--error")) {
    el.classList.add("tds-form-item--error");
  }
  
  
  if (el.classList.contains("hidden")) {
    el.classList.remove("hidden");
  }


  if (el.classList.contains("tds--is_hidden")) {
    el.classList.remove("tds--is_hidden");
  }

  
  
  //var container = el.querySelector(".tds-alert");
  //container.appendChild(child);
  
  var container = el.querySelector(".tds-form-item-feedback,.tds-alert,.warning-caption,.tds-status_msg-body");
  
  if (!container) {
    //console.log("no container", placeholder, message);
    return;
  }
  
  var elementType = container.tagName.toLowerCase();

  var child = (elementType === "ul") ? document.createElement("li") : document.createElement("div");
  child.setAttribute("data-i18n-key", message);

/*
  if (window.i18next && translate) {
    //child.setAttribute("data-i18n-key", message);
    message = translate(message);
  }
//*/
  //console.log("message", placeholder, message);
  
  child.innerHTML = message;
  

  container.appendChild(child);
  
  
  if (container.classList.contains("hidden")) {
    container.classList.remove("hidden");
  }
  

  if (container.classList.contains("tds--is_hidden")) {
    container.classList.remove("tds--is_hidden");
  }

}
