"use strict"; /*! cash-dom 1.3.0, https://github.com/kenwheeler/cash @license MIT */
! function(t, e) { "function" == typeof define && define.amd ? define(e) : "undefined" != typeof exports ? module.exports = e() : t.cash = t.$ = e() }(this, function() {
    function t(t, e) { e = e || C; var i = R.test(t) ? e.getElementsByClassName(t.slice(1)) : O.test(t) ? e.getElementsByTagName(t) : e.querySelectorAll(t); return i }

    function e(t) { return E = E || C.createDocumentFragment(), k = k || E.appendChild(C.createElement("div")), k.innerHTML = t, k.childNodes }

    function i(t) { "loading" !== C.readyState ? t() : C.addEventListener("DOMContentLoaded", t) }

    function n(n, s) { if (!n) return this; if (n.cash && n !== A) return n; var r, a = n,
            o = 0; if (I(n)) a = F.test(n) ? C.getElementById(n.slice(1)) : D.test(n) ? e(n) : t(n, s);
        else if (N(n)) return i(n), this; if (!a) return this; if (a.nodeType || a === A) this[0] = a, this.length = 1;
        else
            for (r = this.length = a.length; r > o; o++) this[o] = a[o]; return this }

    function s(t, e) { return new n(t, e) }

    function r(t, e) { for (var i = t.length, n = 0; i > n && e.call(t[n], t[n], n, t) !== !1; n++); }

    function a(t, e) { var i = t && (t.matches || t.webkitMatchesSelector || t.mozMatchesSelector || t.msMatchesSelector || t.oMatchesSelector); return !!i && i.call(t, e) }

    function o(t) { return s(P.call(t).filter(function(t, e, i) { return i.indexOf(t) === e })) }

    function l(t) { return t[V] = t[V] || {} }

    function c(t, e, i) { return l(t)[e] = i }

    function h(t, e) { var i = l(t); return void 0 === i[e] && (i[e] = t.dataset ? t.dataset[e] : s(t).attr("data-" + e)), i[e] }

    function u(t, e) { var i = l(t);
        i ? delete i[e] : t.dataset ? delete t.dataset[e] : s(t).removeAttr("data-" + name) }

    function d(t) { return I(t) && t.match(H) }

    function p(t, e) { return t.classList ? t.classList.contains(e) : new RegExp("(^| )" + e + "( |$)", "gi").test(t.className) }

    function f(t, e, i) { t.classList ? t.classList.add(e) : i.indexOf(" " + e + " ") && (t.className += " " + e) }

    function g(t, e) { t.classList ? t.classList.remove(e) : t.className = t.className.replace(e, "") }

    function m(t, e) { return parseInt(A.getComputedStyle(t[0], null)[e], 10) || 0 }

    function v(t, e, i) { var n = h(t, "_cashEvents") || c(t, "_cashEvents", {});
        n[e] = n[e] || [], n[e].push(i), t.addEventListener(e, i) }

    function w(t, e, i) { var n = h(t, "_cashEvents")[e];
        i ? t.removeEventListener(e, i) : (r(n, function(i) { t.removeEventListener(e, i) }), n = []) }

    function b(t, e) { return "&" + encodeURIComponent(t) + "=" + encodeURIComponent(e).replace(/%20/g, "+") }

    function y(t) { return "radio" === t.type || "checkbox" === t.type }

    function S(t, e, i) { if (i) { var n = t.childNodes[0];
            t.insertBefore(e, n) } else t.appendChild(e) }

    function x(t, e, i) { var n = I(e); return !n && e.length ? void r(e, function(e) { return x(t, e, i) }) : void r(t, n ? function(t) { return t.insertAdjacentHTML(i ? "afterbegin" : "beforeend", e) } : function(t, n) { return S(t, 0 === n ? e : e.cloneNode(!0), i) }) }

    function L(t, e) { return t === e } var E, k, C = document,
        A = window,
        T = Array.prototype,
        P = T.slice,
        j = T.filter,
        M = T.push,
        $ = function() {},
        N = function(t) { return typeof t == typeof $ },
        I = function(t) { return "string" == typeof t },
        F = /^#[\w-]*$/,
        R = /^\.[\w-]*$/,
        D = /<.+>/,
        O = /^\w+$/,
        Y = s.fn = s.prototype = n.prototype = { constructor: s, cash: !0, length: 0, push: M, splice: T.splice, map: T.map, init: n };
    s.parseHTML = e, s.noop = $, s.isFunction = N, s.isString = I, s.extend = Y.extend = function(t) { t = t || {}; var e = P.call(arguments),
            i = e.length,
            n = 1; for (1 === e.length && (t = this, n = 0); i > n; n++)
            if (e[n])
                for (var s in e[n]) e[n].hasOwnProperty(s) && (t[s] = e[n][s]); return t }, s.extend({ merge: function(t, e) { for (var i = +e.length, n = t.length, s = 0; i > s; n++, s++) t[n] = e[s]; return t.length = n, t }, each: r, matches: a, unique: o, isArray: Array.isArray, isNumeric: function(t) { return !isNaN(parseFloat(t)) && isFinite(t) } }); var V = s.uid = "_cash" + Date.now();
    Y.extend({ data: function(t, e) { if (I(t)) return void 0 === e ? h(this[0], t) : this.each(function(i) { return c(i, t, e) }); for (var i in t) this.data(i, t[i]); return this }, removeData: function(t) { return this.each(function(e) { return u(e, t) }) } }); var H = /\S+/g;
    Y.extend({ addClass: function(t) { var e = d(t); return e ? this.each(function(t) { var i = " " + t.className + " ";
                r(e, function(e) { f(t, e, i) }) }) : this }, attr: function(t, e) { if (t) { if (I(t)) return void 0 === e ? this[0] ? this[0].getAttribute ? this[0].getAttribute(t) : this[0][t] : void 0 : this.each(function(i) { i.setAttribute ? i.setAttribute(t, e) : i[t] = e }); for (var i in t) this.attr(i, t[i]); return this } }, hasClass: function(t) { var e = !1,
                i = d(t); return i && i.length && this.each(function(t) { return e = p(t, i[0]), !e }), e }, prop: function(t, e) { if (I(t)) return void 0 === e ? this[0][t] : this.each(function(i) { i[t] = e }); for (var i in t) this.prop(i, t[i]); return this }, removeAttr: function(t) { return this.each(function(e) { e.removeAttribute ? e.removeAttribute(t) : delete e[t] }) }, removeClass: function(t) { if (!arguments.length) return this.attr("class", ""); var e = d(t); return e ? this.each(function(t) { r(e, function(e) { g(t, e) }) }) : this }, removeProp: function(t) { return this.each(function(e) { delete e[t] }) }, toggleClass: function(t, e) { if (void 0 !== e) return this[e ? "addClass" : "removeClass"](t); var i = d(t); return i ? this.each(function(t) { var e = " " + t.className + " ";
                r(i, function(i) { p(t, i) ? g(t, i) : f(t, i, e) }) }) : this } }), Y.extend({ add: function(t, e) { return o(s.merge(this, s(t, e))) }, each: function(t) { return r(this, t), this }, eq: function(t) { return s(this.get(t)) }, filter: function(t) { return s(j.call(this, I(t) ? function(e) { return a(e, t) } : t)) }, first: function() { return this.eq(0) }, get: function(t) { return void 0 === t ? P.call(this) : 0 > t ? this[t + this.length] : this[t] }, index: function(t) { var e = this[0]; return P.call(t ? s(t) : s(e).parent().children()).indexOf(e) }, last: function() { return this.eq(-1) } }); var B = function() {
        function t(t) { return t.replace(s, function(t, e) { return t[0 === e ? "toLowerCase" : "toUpperCase"]() }).replace(a, "") } var e = {},
            i = C.createElement("div"),
            n = i.style,
            s = /(?:^\w|[A-Z]|\b\w)/g,
            a = /\s+/g; return function(i) { if (i = t(i), e[i]) return e[i]; var s = i.charAt(0).toUpperCase() + i.slice(1),
                a = ["webkit", "moz", "ms", "o"],
                o = (i + " " + a.join(s + " ") + s).split(" "); return r(o, function(t) { return t in n ? (e[t] = i = e[i] = t, !1) : void 0 }), e[i] } }();
    Y.extend({ css: function(t, e) { if (I(t)) return t = B(t), e ? this.each(function(i) { return i.style[t] = e }) : A.getComputedStyle(this[0])[t]; for (var i in t) this.css(i, t[i]); return this } }), r(["Width", "Height"], function(t) { var e = t.toLowerCase();
        Y[e] = function() { return this[0].getBoundingClientRect()[e] }, Y["inner" + t] = function() { return this[0]["client" + t] }, Y["outer" + t] = function(e) { return this[0]["offset" + t] + (e ? m(this, "margin" + ("Width" === t ? "Left" : "Top")) + m(this, "margin" + ("Width" === t ? "Right" : "Bottom")) : 0) } }), Y.extend({ off: function(t, e) { return this.each(function(i) { return w(i, t, e) }) }, on: function(t, e, n, s) { var r; if (!I(t)) { for (var o in t) this.on(o, e, t[o]); return this } return N(e) && (n = e, e = null), "ready" === t ? (i(n), this) : (e && (r = n, n = function(t) { for (var i = t.target; !a(i, e);) { if (i === this) return i = !1;
                    i = i.parentNode } i && r.call(i, t) }), this.each(function(e) { var i = n;
                s && (i = function() { n.apply(this, arguments), w(e, t, i) }), v(e, t, i) })) }, one: function(t, e, i) { return this.on(t, e, i, !0) }, ready: i, trigger: function(t, e) { var i = C.createEvent("HTMLEvents"); return i.data = e, i.initEvent(t, !0, !1), this.each(function(t) { return t.dispatchEvent(i) }) } }); var U = ["file", "reset", "submit", "button"];
    Y.extend({ serialize: function() { var t = this[0].elements,
                e = ""; return r(t, function(t) { t.name && U.indexOf(t.type) < 0 && ("select-multiple" === t.type ? r(t.options, function(i) { i.selected && (e += b(t.name, i.value)) }) : (!y(t) || y(t) && t.checked) && (e += b(t.name, t.value))) }), e.substr(1) }, val: function(t) { return void 0 === t ? this[0].value : this.each(function(e) { return e.value = t }) } }), Y.extend({ after: function(t) { return s(t).insertAfter(this), this }, append: function(t) { return x(this, t), this }, appendTo: function(t) { return x(s(t), this), this }, before: function(t) { return s(t).insertBefore(this), this }, clone: function() { return s(this.map(function(t) { return t.cloneNode(!0) })) }, empty: function() { return this.html(""), this }, html: function(t) { if (void 0 === t) return this[0].innerHTML; var e = t.nodeType ? t[0].outerHTML : t; return this.each(function(t) { return t.innerHTML = e }) }, insertAfter: function(t) { var e = this; return s(t).each(function(t, i) { var n = t.parentNode,
                    s = t.nextSibling;
                e.each(function(t) { n.insertBefore(0 === i ? t : t.cloneNode(!0), s) }) }), this }, insertBefore: function(t) { var e = this; return s(t).each(function(t, i) { var n = t.parentNode;
                e.each(function(e) { n.insertBefore(0 === i ? e : e.cloneNode(!0), t) }) }), this }, prepend: function(t) { return x(this, t, !0), this }, prependTo: function(t) { return x(s(t), this, !0), this }, remove: function() { return this.each(function(t) { return t.parentNode.removeChild(t) }) }, text: function(t) { return t ? this.each(function(e) { return e.textContent = t }) : this[0].textContent } }); var q = C.documentElement; return Y.extend({ position: function() { var t = this[0]; return { left: t.offsetLeft, top: t.offsetTop } }, offset: function() { var t = this[0].getBoundingClientRect(); return { top: t.top + A.pageYOffset - q.clientTop, left: t.left + A.pageXOffset - q.clientLeft } }, offsetParent: function() { return s(this[0].offsetParent) } }), Y.extend({ children: function(t) { var e = []; return this.each(function(t) { M.apply(e, t.children) }), e = o(e), t ? e.filter(function(e) { return a(e, t) }) : e }, closest: function(t) { return !t || a(this[0], t) ? this : this.parent().closest(t) }, is: function(t) { if (!t) return !1; var e = !1,
                i = I(t) ? a : t.cash ? function(e) { return t.is(e) } : L; return this.each(function(n, s) { return e = i(n, t, s), !e }), e }, find: function(e) { if (!e) return s(); var i = []; return this.each(function(n) { M.apply(i, t(e, n)) }), o(i) }, has: function(t) { return j.call(this, function(e) { return 0 !== s(e).find(t).length }) }, next: function() { return s(this[0].nextElementSibling) }, not: function(t) { return j.call(this, function(e) { return !a(e, t) }) }, parent: function() { var t = this.map(function(t) { return t.parentElement || C.body.parentNode }); return o(t) }, parents: function(t) { var e, i = []; return this.each(function(n) { for (e = n; e !== C.body.parentNode;) e = e.parentElement, (!t || t && a(e, t)) && i.push(e) }), o(i) }, prev: function() { return s(this[0].previousElementSibling) }, siblings: function() { var t = this.parent().children(),
                e = this[0]; return j.call(t, function(t) { return t !== e }) } }), s }),
/*!
 * MinPubSub
 * Copyright(c) 2011 Daniel Lamb <daniellmb.com>
 * MIT Licensed
 */
function(t) { var e = {},
        i = t.c_ || {};
    e.publish = function(e, n) { for (var s = i[e], r = s ? s.length : 0; r--;) s[r].apply(t, n || []) }, e.subscribe = function(t, e) { return i[t] || (i[t] = []), i[t].push(e), [t, e] }, e.unsubscribe = function(t, e) { for (var n = i[e ? t : t[0]], e = e || t[1], s = n ? n.length : 0; s--;) n[s] === e && n.splice(s, 1) }, t.publish = e.publish, t.subscribe = e.subscribe, t.unsubscribe = e.unsubscribe }($),
function() { var t = function(t) { this.threshold = t.threshold, this.up = t.up, this.down = t.down, this.onTouchStartListener = this.onTouchStart.bind(this), this.onTouchMoveListener = this.onTouchMove.bind(this), this.onTouchEndListener = this.onTouchEnd.bind(this), this.startX = 0, this.lastX = 0, this.startY = 0, this.lastY = 0, this.blackList = ["noUi", "graph-preview", "js-pagination"], this.enable() };
    t.prototype = { disable: function() { document.removeEventListener("touchstart", this.onTouchStartListener, !1), document.removeEventListener("touchmove", this.onTouchMoveListener, !1), document.removeEventListener("touchend", this.onTouchEndListener, !1) }, enable: function() { document.addEventListener("touchstart", this.onTouchStartListener, !1), document.addEventListener("touchmove", this.onTouchMoveListener, !1), document.addEventListener("touchend", this.onTouchEndListener, !1) }, isInBlacklist: function(t) { var e; for (e = this.blackList.length - 1; e >= 0; e--)
                if (t.indexOf(this.blackList[e]) > -1) return !0; return !1 }, onTouchStart: function(t) { this.startY = t.touches[0].clientX, this.startY = t.touches[0].clientY, this.lastY = t.touches[0].clientX, this.lastY = t.touches[0].clientY }, onTouchMove: function(t) { t.preventDefault(), this.lastY = t.touches[0].clientX, this.lastY = t.touches[0].clientY }, onTouchEnd: function(t) { var e = "string" == typeof t.target.className ? t.target.className : ""; return this.isInBlacklist(e) ? !0 : Math.abs(this.startY - this.lastY) < Math.abs(this.startX - this.lastX) ? !0 : Math.abs(this.startY - this.lastY) < this.threshold || 0 === this.startY || 0 === this.lastY ? !0 : this.startY < this.lastY ? (this.startY = 0, this.lastY = 0, this.up()) : (this.startY = 0, this.lastY = 0, this.down()) } }, window.SwipeDetection = t }(), /*! nouislider - 9.0.0 - 2016-09-29 21:44:02 */
function(t) { "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? module.exports = t() : window.noUiSlider = t() }(function() {
    function t(t, e) { var i = document.createElement("div"); return c(i, e), t.appendChild(i), i }

    function e(t) { return t.filter(function(t) { return this[t] ? !1 : this[t] = !0 }, {}) }

    function i(t, e) { return Math.round(t / e) * e }

    function n(t, e) { var i = t.getBoundingClientRect(),
            n = t.ownerDocument,
            s = n.documentElement,
            r = d(); return /webkit.*Chrome.*Mobile/i.test(navigator.userAgent) && (r.x = 0), e ? i.top + r.y - s.clientTop : i.left + r.x - s.clientLeft }

    function s(t) { return "number" == typeof t && !isNaN(t) && isFinite(t) }

    function r(t, e, i) { i > 0 && (c(t, e), setTimeout(function() { h(t, e) }, i)) }

    function a(t) { return Math.max(Math.min(t, 100), 0) }

    function o(t) { return Array.isArray(t) ? t : [t] }

    function l(t) { t = String(t); var e = t.split("."); return e.length > 1 ? e[1].length : 0 }

    function c(t, e) { t.classList ? t.classList.add(e) : t.className += " " + e }

    function h(t, e) { t.classList ? t.classList.remove(e) : t.className = t.className.replace(new RegExp("(^|\\b)" + e.split(" ").join("|") + "(\\b|$)", "gi"), " ") }

    function u(t, e) { return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className) }

    function d() { var t = void 0 !== window.pageXOffset,
            e = "CSS1Compat" === (document.compatMode || ""),
            i = t ? window.pageXOffset : e ? document.documentElement.scrollLeft : document.body.scrollLeft,
            n = t ? window.pageYOffset : e ? document.documentElement.scrollTop : document.body.scrollTop; return { x: i, y: n } }

    function p() { return window.navigator.pointerEnabled ? { start: "pointerdown", move: "pointermove", end: "pointerup" } : window.navigator.msPointerEnabled ? { start: "MSPointerDown", move: "MSPointerMove", end: "MSPointerUp" } : { start: "mousedown touchstart", move: "mousemove touchmove", end: "mouseup touchend" } }

    function f(t, e) { return 100 / (e - t) }

    function g(t, e) { return 100 * e / (t[1] - t[0]) }

    function m(t, e) { return g(t, t[0] < 0 ? e + Math.abs(t[0]) : e - t[0]) }

    function v(t, e) { return e * (t[1] - t[0]) / 100 + t[0] }

    function w(t, e) { for (var i = 1; t >= e[i];) i += 1; return i }

    function b(t, e, i) { if (i >= t.slice(-1)[0]) return 100; var n, s, r, a, o = w(i, t); return n = t[o - 1], s = t[o], r = e[o - 1], a = e[o], r + m([n, s], i) / f(r, a) }

    function y(t, e, i) { if (i >= 100) return t.slice(-1)[0]; var n, s, r, a, o = w(i, e); return n = t[o - 1], s = t[o], r = e[o - 1], a = e[o], v([n, s], (i - r) * f(r, a)) }

    function S(t, e, n, s) { if (100 === s) return s; var r, a, o = w(s, t); return n ? (r = t[o - 1], a = t[o], s - r > (a - r) / 2 ? a : r) : e[o - 1] ? t[o - 1] + i(s - t[o - 1], e[o - 1]) : s }

    function x(t, e, i) { var n; if ("number" == typeof e && (e = [e]), "[object Array]" !== Object.prototype.toString.call(e)) throw new Error("noUiSlider: 'range' contains invalid value."); if (n = "min" === t ? 0 : "max" === t ? 100 : parseFloat(t), !s(n) || !s(e[0])) throw new Error("noUiSlider: 'range' value isn't numeric.");
        i.xPct.push(n), i.xVal.push(e[0]), n ? i.xSteps.push(isNaN(e[1]) ? !1 : e[1]) : isNaN(e[1]) || (i.xSteps[0] = e[1]), i.xHighestCompleteStep.push(0) }

    function L(t, e, i) { if (!e) return !0;
        i.xSteps[t] = g([i.xVal[t], i.xVal[t + 1]], e) / f(i.xPct[t], i.xPct[t + 1]); var n = (i.xVal[t + 1] - i.xVal[t]) / i.xNumSteps[t],
            s = Math.ceil(Number(n.toFixed(3)) - 1),
            r = i.xVal[t] + i.xNumSteps[t] * s;
        i.xHighestCompleteStep[t] = r }

    function E(t, e, i, n) { this.xPct = [], this.xVal = [], this.xSteps = [n || !1], this.xNumSteps = [!1], this.xHighestCompleteStep = [], this.snap = e, this.direction = i; var s, r = []; for (s in t) t.hasOwnProperty(s) && r.push([t[s], s]); for (r.length && "object" == typeof r[0][0] ? r.sort(function(t, e) { return t[0][0] - e[0][0] }) : r.sort(function(t, e) { return t[0] - e[0] }), s = 0; s < r.length; s++) x(r[s][1], r[s][0], this); for (this.xNumSteps = this.xSteps.slice(0), s = 0; s < this.xNumSteps.length; s++) L(s, this.xNumSteps[s], this) }

    function k(t, e) { if (!s(e)) throw new Error("noUiSlider: 'step' is not numeric.");
        t.singleStep = e }

    function C(t, e) { if ("object" != typeof e || Array.isArray(e)) throw new Error("noUiSlider: 'range' is not an object."); if (void 0 === e.min || void 0 === e.max) throw new Error("noUiSlider: Missing 'min' or 'max' in 'range'."); if (e.min === e.max) throw new Error("noUiSlider: 'range' 'min' and 'max' cannot be equal.");
        t.spectrum = new E(e, t.snap, t.dir, t.singleStep) }

    function A(t, e) { if (e = o(e), !Array.isArray(e) || !e.length) throw new Error("noUiSlider: 'start' option is incorrect.");
        t.handles = e.length, t.start = e }

    function T(t, e) { if (t.snap = e, "boolean" != typeof e) throw new Error("noUiSlider: 'snap' option must be a boolean.") }

    function P(t, e) { if (t.animate = e, "boolean" != typeof e) throw new Error("noUiSlider: 'animate' option must be a boolean.") }

    function j(t, e) { if (t.animationDuration = e, "number" != typeof e) throw new Error("noUiSlider: 'animationDuration' option must be a number.") }

    function M(t, e) { var i, n = [!1]; if (e === !0 || e === !1) { for (i = 1; i < t.handles; i++) n.push(e);
            n.push(!1) } else { if (!Array.isArray(e) || !e.length || e.length !== t.handles + 1) throw new Error("noUiSlider: 'connect' option doesn't match handle count.");
            n = e } t.connect = n }

    function $(t, e) { switch (e) {
            case "horizontal":
                t.ort = 0; break;
            case "vertical":
                t.ort = 1; break;
            default:
                throw new Error("noUiSlider: 'orientation' option is invalid.") } }

    function N(t, e) { if (!s(e)) throw new Error("noUiSlider: 'margin' option must be numeric."); if (0 !== e && (t.margin = t.spectrum.getMargin(e), !t.margin)) throw new Error("noUiSlider: 'margin' option is only supported on linear sliders.") }

    function I(t, e) { if (!s(e)) throw new Error("noUiSlider: 'limit' option must be numeric."); if (t.limit = t.spectrum.getMargin(e), !t.limit || t.handles < 2) throw new Error("noUiSlider: 'limit' option is only supported on linear sliders with 2 or more handles.") }

    function F(t, e) { switch (e) {
            case "ltr":
                t.dir = 0; break;
            case "rtl":
                t.dir = 1; break;
            default:
                throw new Error("noUiSlider: 'direction' option was not recognized.") } }

    function R(t, e) { if ("string" != typeof e) throw new Error("noUiSlider: 'behaviour' must be a string containing options."); var i = e.indexOf("tap") >= 0,
            n = e.indexOf("drag") >= 0,
            s = e.indexOf("fixed") >= 0,
            r = e.indexOf("snap") >= 0,
            a = e.indexOf("hover") >= 0; if (s) { if (2 !== t.handles) throw new Error("noUiSlider: 'fixed' behaviour must be used with 2 handles");
            N(t, t.start[1] - t.start[0]) } t.events = { tap: i || r, drag: n, fixed: s, snap: r, hover: a } }

    function D(t, e) { if (e !== !1)
            if (e === !0) { t.tooltips = []; for (var i = 0; i < t.handles; i++) t.tooltips.push(!0) } else { if (t.tooltips = o(e), t.tooltips.length !== t.handles) throw new Error("noUiSlider: must pass a formatter for all handles.");
                t.tooltips.forEach(function(t) { if ("boolean" != typeof t && ("object" != typeof t || "function" != typeof t.to)) throw new Error("noUiSlider: 'tooltips' must be passed a formatter or 'false'.") }) } }

    function O(t, e) { if (t.format = e, "function" == typeof e.to && "function" == typeof e.from) return !0; throw new Error("noUiSlider: 'format' requires 'to' and 'from' methods.") }

    function Y(t, e) { if (void 0 !== e && "string" != typeof e && e !== !1) throw new Error("noUiSlider: 'cssPrefix' must be a string or `false`.");
        t.cssPrefix = e }

    function V(t, e) { if (void 0 !== e && "object" != typeof e) throw new Error("noUiSlider: 'cssClasses' must be an object."); if ("string" == typeof t.cssPrefix) { t.cssClasses = {}; for (var i in e) e.hasOwnProperty(i) && (t.cssClasses[i] = t.cssPrefix + e[i]) } else t.cssClasses = e }

    function H(t, e) { if (e !== !0 && e !== !1) throw new Error("noUiSlider: 'useRequestAnimationFrame' option should be true (default) or false.");
        t.useRequestAnimationFrame = e }

    function B(t) { var e, i = { margin: 0, limit: 0, animate: !0, animationDuration: 300, format: z };
        e = { step: { r: !1, t: k }, start: { r: !0, t: A }, connect: { r: !0, t: M }, direction: { r: !0, t: F }, snap: { r: !1, t: T }, animate: { r: !1, t: P }, animationDuration: { r: !1, t: j }, range: { r: !0, t: C }, orientation: { r: !1, t: $ }, margin: { r: !1, t: N }, limit: { r: !1, t: I }, behaviour: { r: !0, t: R }, format: { r: !1, t: O }, tooltips: { r: !1, t: D }, cssPrefix: { r: !1, t: Y }, cssClasses: { r: !1, t: V }, useRequestAnimationFrame: { r: !1, t: H } }; var n = { connect: !1, direction: "ltr", behaviour: "tap", orientation: "horizontal", cssPrefix: "noUi-", cssClasses: { target: "target", base: "base", origin: "origin", handle: "handle", horizontal: "horizontal", vertical: "vertical", background: "background", connect: "connect", ltr: "ltr", rtl: "rtl", draggable: "draggable", drag: "state-drag", tap: "state-tap", active: "active", tooltip: "tooltip", pips: "pips", pipsHorizontal: "pips-horizontal", pipsVertical: "pips-vertical", marker: "marker", markerHorizontal: "marker-horizontal", markerVertical: "marker-vertical", markerNormal: "marker-normal", markerLarge: "marker-large", markerSub: "marker-sub", value: "value", valueHorizontal: "value-horizontal", valueVertical: "value-vertical", valueNormal: "value-normal", valueLarge: "value-large", valueSub: "value-sub" }, useRequestAnimationFrame: !0 };
        Object.keys(e).forEach(function(s) { if (void 0 === t[s] && void 0 === n[s]) { if (e[s].r) throw new Error("noUiSlider: '" + s + "' is required."); return !0 } e[s].t(i, void 0 === t[s] ? n[s] : t[s]) }), i.pips = t.pips; var s = [
            ["left", "top"],
            ["right", "bottom"]
        ]; return i.style = s[i.dir][i.ort], i.styleOposite = s[i.dir ? 0 : 1][i.ort], i }

    function U(i, s, l) {
        function f(e, i) { var n = t(e, s.cssClasses.origin),
                r = t(n, s.cssClasses.handle); return r.setAttribute("data-handle", i), n }

        function g(e, i) { return i ? t(e, s.cssClasses.connect) : !1 }

        function m(t, e) { et = [], it = [], it.push(g(e, t[0])); for (var i = 0; i < s.handles; i++) et.push(f(e, i)), ot[i] = i, it.push(g(e, t[i + 1])) }

        function v(e) { c(e, s.cssClasses.target), 0 === s.dir ? c(e, s.cssClasses.ltr) : c(e, s.cssClasses.rtl), 0 === s.ort ? c(e, s.cssClasses.horizontal) : c(e, s.cssClasses.vertical), tt = t(e, s.cssClasses.base) }

        function w(e, i) { return s.tooltips[i] ? t(e.firstChild, s.cssClasses.tooltip) : !1 }

        function b() { var t = et.map(w);
            K("update", function(e, i, n) { if (t[i]) { var r = e[i];
                    s.tooltips[i] !== !0 && (r = s.tooltips[i].to(n[i])), t[i].innerHTML = r } }) }

        function y(t, e, i) { if ("range" === t || "steps" === t) return lt.xVal; if ("count" === t) { var n, s = 100 / (e - 1),
                    r = 0; for (e = [];
                    (n = r++ * s) <= 100;) e.push(n);
                t = "positions" } return "positions" === t ? e.map(function(t) { return lt.fromStepping(i ? lt.getStep(t) : t) }) : "values" === t ? i ? e.map(function(t) { return lt.fromStepping(lt.getStep(lt.toStepping(t))) }) : e : void 0 }

        function S(t, i, n) {
            function s(t, e) { return (t + e).toFixed(7) / 1 } var r = {},
                a = lt.xVal[0],
                o = lt.xVal[lt.xVal.length - 1],
                l = !1,
                c = !1,
                h = 0; return n = e(n.slice().sort(function(t, e) { return t - e })), n[0] !== a && (n.unshift(a), l = !0), n[n.length - 1] !== o && (n.push(o), c = !0), n.forEach(function(e, a) { var o, u, d, p, f, g, m, v, w, b, y = e,
                    S = n[a + 1]; if ("steps" === i && (o = lt.xNumSteps[a]), o || (o = S - y), y !== !1 && void 0 !== S)
                    for (o = Math.max(o, 1e-7), u = y; S >= u; u = s(u, o)) { for (p = lt.toStepping(u), f = p - h, v = f / t, w = Math.round(v), b = f / w, d = 1; w >= d; d += 1) g = h + d * b, r[g.toFixed(5)] = ["x", 0];
                        m = n.indexOf(u) > -1 ? 1 : "steps" === i ? 2 : 0, !a && l && (m = 0), u === S && c || (r[p.toFixed(5)] = [u, m]), h = p } }), r }

        function x(t, e, i) {
            function n(t, e) { var i = e === s.cssClasses.value,
                    n = i ? d : p,
                    r = i ? h : u; return e + " " + n[s.ort] + " " + r[t] }

            function r(t, e, i) { return 'class="' + n(i[1], e) + '" style="' + s.style + ": " + t + '%"' }

            function a(t, n) { n[1] = n[1] && e ? e(n[0], n[1]) : n[1], l += "<div " + r(t, s.cssClasses.marker, n) + "></div>", n[1] && (l += "<div " + r(t, s.cssClasses.value, n) + ">" + i.to(n[0]) + "</div>") } var o = document.createElement("div"),
                l = "",
                h = [s.cssClasses.valueNormal, s.cssClasses.valueLarge, s.cssClasses.valueSub],
                u = [s.cssClasses.markerNormal, s.cssClasses.markerLarge, s.cssClasses.markerSub],
                d = [s.cssClasses.valueHorizontal, s.cssClasses.valueVertical],
                p = [s.cssClasses.markerHorizontal, s.cssClasses.markerVertical]; return c(o, s.cssClasses.pips), c(o, 0 === s.ort ? s.cssClasses.pipsHorizontal : s.cssClasses.pipsVertical), Object.keys(t).forEach(function(e) { a(e, t[e]) }), o.innerHTML = l, o }

        function L(t) { var e = t.mode,
                i = t.density || 1,
                n = t.filter || !1,
                s = t.values || !1,
                r = t.stepped || !1,
                a = y(e, s, r),
                o = S(i, e, a),
                l = t.format || { to: Math.round }; return rt.appendChild(x(o, n, l)) }

        function E() { var t = tt.getBoundingClientRect(),
                e = "offset" + ["Width", "Height"][s.ort]; return 0 === s.ort ? t.width || tt[e] : t.height || tt[e] }

        function k(t, e, i, n) { var r = function(e) { return rt.hasAttribute("disabled") ? !1 : u(rt, s.cssClasses.tap) ? !1 : (e = C(e, n.pageOffset), t === st.start && void 0 !== e.buttons && e.buttons > 1 ? !1 : n.hover && e.buttons ? !1 : (e.calcPoint = e.points[s.ort], void i(e, n))) },
                a = []; return t.split(" ").forEach(function(t) { e.addEventListener(t, r, !1), a.push([t, r]) }), a }

        function C(t, e) { t.preventDefault(); var i, n, s = 0 === t.type.indexOf("touch"),
                r = 0 === t.type.indexOf("mouse"),
                a = 0 === t.type.indexOf("pointer"),
                o = t; if (0 === t.type.indexOf("MSPointer") && (a = !0), s) { if (o.touches.length > 1) return !1;
                i = t.changedTouches[0].pageX, n = t.changedTouches[0].pageY } return e = e || d(), (r || a) && (i = t.clientX + e.x, n = t.clientY + e.y), o.pageOffset = e, o.points = [i, n], o.cursor = r || a, o }

        function A(t) { var e = t - n(tt, s.ort),
                i = 100 * e / E(); return s.dir ? 100 - i : i }

        function T(t) { var e = 100,
                i = !1; return et.forEach(function(n, s) { if (!n.hasAttribute("disabled")) { var r = Math.abs(at[s] - t);
                    e > r && (i = s, e = r) } }), i }

        function P(t, e, i, n) { var s = i.slice(),
                r = [!t, t],
                a = [t, !t];
            n = n.slice(), t && n.reverse(), n.length > 1 ? n.forEach(function(t, i) { var n = O(s, t, s[t] + e, r[i], a[i]);
                n === !1 ? e = 0 : (e = n - s[t], s[t] = n) }) : r = a = [!0]; var o = !1;
            n.forEach(function(t, n) { o = U(t, i[t] + e, r[n], a[n]) || o }), o && n.forEach(function(t) { j("update", t), j("slide", t) }) }

        function j(t, e, i) { Object.keys(ht).forEach(function(n) { var r = n.split(".")[0];
                t === r && ht[n].forEach(function(t) { t.call(nt, ct.map(s.format.to), e, ct.slice(), i || !1, at.slice()) }) }) }

        function M(t, e) { "mouseout" === t.type && "HTML" === t.target.nodeName && null === t.relatedTarget && N(t, e) }

        function $(t, e) { if (-1 === navigator.appVersion.indexOf("MSIE 9") && 0 === t.buttons && 0 !== e.buttonsProperty) return N(t, e); var i = (s.dir ? -1 : 1) * (t.calcPoint - e.startCalcPoint),
                n = 100 * i / e.baseSize;
            P(i > 0, n, e.locations, e.handleNumbers) }

        function N(t, e) { var i = tt.querySelector("." + s.cssClasses.active);
            null !== i && h(i, s.cssClasses.active), t.cursor && (document.body.style.cursor = "", document.body.removeEventListener("selectstart", document.body.noUiListener)), document.documentElement.noUiListeners.forEach(function(t) { document.documentElement.removeEventListener(t[0], t[1]) }), h(rt, s.cssClasses.drag), H(), e.handleNumbers.forEach(function(t) { j("set", t), j("change", t), j("end", t) }) }

        function I(t, e) { if (1 === e.handleNumbers.length) { var i = et[e.handleNumbers[0]]; if (i.hasAttribute("disabled")) return !1;
                c(i.children[0], s.cssClasses.active) } t.preventDefault(), t.stopPropagation(); var n = k(st.move, document.documentElement, $, { startCalcPoint: t.calcPoint, baseSize: E(), pageOffset: t.pageOffset, handleNumbers: e.handleNumbers, buttonsProperty: t.buttons, locations: at.slice() }),
                r = k(st.end, document.documentElement, N, { handleNumbers: e.handleNumbers }),
                a = k("mouseout", document.documentElement, M, { handleNumbers: e.handleNumbers }); if (document.documentElement.noUiListeners = n.concat(r, a), t.cursor) { document.body.style.cursor = getComputedStyle(t.target).cursor, et.length > 1 && c(rt, s.cssClasses.drag); var o = function() { return !1 };
                document.body.noUiListener = o, document.body.addEventListener("selectstart", o, !1) } e.handleNumbers.forEach(function(t) { j("start", t) }) }

        function F(t) { t.stopPropagation(); var e = A(t.calcPoint),
                i = T(e); return i === !1 ? !1 : (s.events.snap || r(rt, s.cssClasses.tap, s.animationDuration), U(i, e, !0, !0), H(), j("slide", i, !0), j("set", i, !0), j("change", i, !0), j("update", i, !0), void(s.events.snap && I(t, { handleNumbers: [i] }))) }

        function R(t) { var e = A(t.calcPoint),
                i = lt.getStep(e),
                n = lt.fromStepping(i);
            Object.keys(ht).forEach(function(t) { "hover" === t.split(".")[0] && ht[t].forEach(function(t) { t.call(nt, n) }) }) }

        function D(t) { t.fixed || et.forEach(function(t, e) { k(st.start, t.children[0], I, { handleNumbers: [e] }) }), t.tap && k(st.start, tt, F, {}), t.hover && k(st.move, tt, R, { hover: !0 }), t.drag && it.forEach(function(e, i) { if (e !== !1 && 0 !== i && i !== it.length - 1) { var n = et[i - 1],
                        r = et[i],
                        a = [e];
                    c(e, s.cssClasses.draggable), t.fixed && (a.push(n.children[0]), a.push(r.children[0])), a.forEach(function(t) { k(st.start, t, I, { handles: [n, r], handleNumbers: [i - 1, i] }) }) } }) }

        function O(t, e, i, n, r) { return et.length > 1 && (n && e > 0 && (i = Math.max(i, t[e - 1] + s.margin)), r && e < et.length - 1 && (i = Math.min(i, t[e + 1] - s.margin))), et.length > 1 && s.limit && (n && e > 0 && (i = Math.min(i, t[e - 1] + s.limit)), r && e < et.length - 1 && (i = Math.max(i, t[e + 1] - s.limit))), i = lt.getStep(i), i = a(i), i === t[e] ? !1 : i }

        function Y(t) { return t + "%" }

        function V(t, e) { at[t] = e, ct[t] = lt.fromStepping(e); var i = function() { et[t].style[s.style] = Y(e), q(t), q(t + 1) };
            window.requestAnimationFrame && s.useRequestAnimationFrame ? window.requestAnimationFrame(i) : i() }

        function H() { ot.forEach(function(t) { var e = at[t] > 50 ? -1 : 1,
                    i = 3 + (et.length + e * t);
                et[t].childNodes[0].style.zIndex = i }) }

        function U(t, e, i, n) { return e = O(at, t, e, i, n), e === !1 ? !1 : (V(t, e), !0) }

        function q(t) { if (it[t]) { var e = 0,
                    i = 100;
                0 !== t && (e = at[t - 1]), t !== it.length - 1 && (i = at[t]), it[t].style[s.style] = Y(e), it[t].style[s.styleOposite] = Y(100 - i) } }

        function z(t, e) { null !== t && t !== !1 && ("number" == typeof t && (t = String(t)), t = s.format.from(t), t === !1 || isNaN(t) || U(e, lt.toStepping(t), !1, !1)) }

        function W(t, e) { var i = o(t),
                n = void 0 === at[0];
            e = void 0 === e ? !0 : !!e, i.forEach(z), s.animate && !n && r(rt, s.cssClasses.tap, s.animationDuration), ot.forEach(function(t) { U(t, at[t], !0, !1) }), H(), ot.forEach(function(t) { j("update", t), null !== i[t] && e && j("set", t) }) }

        function _(t) { W(s.start, t) }

        function X() { var t = ct.map(s.format.to); return 1 === t.length ? t[0] : t }

        function G() { for (var t in s.cssClasses) s.cssClasses.hasOwnProperty(t) && h(rt, s.cssClasses[t]); for (; rt.firstChild;) rt.removeChild(rt.firstChild);
            delete rt.noUiSlider }

        function J() { return at.map(function(t, e) { var i = lt.getNearbySteps(t),
                    n = ct[e],
                    s = i.thisStep.step,
                    r = null;
                s !== !1 && n + s > i.stepAfter.startValue && (s = i.stepAfter.startValue - n), r = n > i.thisStep.startValue ? i.thisStep.step : i.stepBefore.step === !1 ? !1 : n - i.stepBefore.highestStep, 100 === t ? s = null : 0 === t && (r = null); var a = lt.countStepDecimals(); return null !== s && s !== !1 && (s = Number(s.toFixed(a))), null !== r && r !== !1 && (r = Number(r.toFixed(a))), [r, s] }) }

        function K(t, e) { ht[t] = ht[t] || [], ht[t].push(e), "update" === t.split(".")[0] && et.forEach(function(t, e) { j("update", e) }) }

        function Q(t) { var e = t && t.split(".")[0],
                i = e && t.substring(e.length);
            Object.keys(ht).forEach(function(t) { var n = t.split(".")[0],
                    s = t.substring(n.length);
                e && e !== n || i && i !== s || delete ht[t] }) }

        function Z(t, e) { var i = X(),
                n = ["margin", "limit", "range", "animate", "snap", "step", "format"];
            n.forEach(function(e) { void 0 !== t[e] && (l[e] = t[e]) }); var r = B(l);
            n.forEach(function(e) { void 0 !== t[e] && (s[e] = r[e]) }), r.spectrum.direction = lt.direction, lt = r.spectrum, s.margin = r.margin, s.limit = r.limit, at = [], W(t.start || i, e) } var tt, et, it, nt, st = p(),
            rt = i,
            at = [],
            ot = [],
            lt = s.spectrum,
            ct = [],
            ht = {}; if (rt.noUiSlider) throw new Error("Slider was already initialized."); return v(rt), m(s.connect, tt), nt = { destroy: G, steps: J, on: K, off: Q, get: X, set: W, reset: _, __moveHandles: function(t, e, i) { P(t, e, at, i) }, options: l, updateOptions: Z, target: rt, pips: L }, D(s.events), W(s.start), s.pips && L(s.pips), s.tooltips && b(), nt }

    function q(t, e) { if (!t.nodeName) throw new Error("noUiSlider.create requires a single element."); var i = B(e, t),
            n = U(t, i, e); return t.noUiSlider = n, n } E.prototype.getMargin = function(t) { var e = this.xNumSteps[0]; if (e && t % e) throw new Error("noUiSlider: 'limit' and 'margin' must be divisible by step."); return 2 === this.xPct.length ? g(this.xVal, t) : !1 }, E.prototype.toStepping = function(t) { return t = b(this.xVal, this.xPct, t) }, E.prototype.fromStepping = function(t) { return y(this.xVal, this.xPct, t) }, E.prototype.getStep = function(t) { return t = S(this.xPct, this.xSteps, this.snap, t) }, E.prototype.getNearbySteps = function(t) { var e = w(t, this.xPct); return { stepBefore: { startValue: this.xVal[e - 2], step: this.xNumSteps[e - 2], highestStep: this.xHighestCompleteStep[e - 2] }, thisStep: { startValue: this.xVal[e - 1], step: this.xNumSteps[e - 1], highestStep: this.xHighestCompleteStep[e - 1] }, stepAfter: { startValue: this.xVal[e - 0], step: this.xNumSteps[e - 0], highestStep: this.xHighestCompleteStep[e - 0] } } }, E.prototype.countStepDecimals = function() { var t = this.xNumSteps.map(l); return Math.max.apply(null, t) }, E.prototype.convert = function(t) { return this.getStep(this.toStepping(t)) }; var z = { to: function(t) { return void 0 !== t && t.toFixed(2) }, from: Number }; return { create: q } }), Function.prototype.bind || (Function.prototype.bind = function(t) { if ("function" != typeof this) throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable"); var e = Array.prototype.slice.call(arguments, 1),
            i = this,
            n = function() {},
            s = function() { return i.apply(this instanceof n ? this : t, e.concat(Array.prototype.slice.call(arguments))) }; return this.prototype && (n.prototype = this.prototype), s.prototype = new n, s }), window.PinMagic = function(t) { this.triggers = [], this.disabled = t.disabled || !1, this.triggerPosition = t.triggerPosition || 0, document.addEventListener("scroll", this.test.bind(this), !1), window.addEventListener("resize", this.debounce(this.resize.bind(this), 100), !1), window.addEventListener("load", this.resize.bind(this), !1) }, window.PinMagic.prototype = { noop: function() {}, add: function(t) { this.triggers.push(this.createTrigger(t)) }, disable: function() { this.disabled = !0, this.triggers.filter(this.isActive).forEach(this.unpin.bind(this)), this.triggers.forEach(this.showSpacers.bind(this)) }, enable: function() { this.disabled = !1, this.triggers.forEach(this.showSpacers.bind(this)), this.test() }, resize: function() { var t = this;
            t.disabled !== !0 && (t.triggers.filter(t.isActive).forEach(t.unpin.bind(t)), t.triggers.forEach(t.resizeSpacersToDuration), t.triggers.forEach(t.resetSpacers), setTimeout(function() { t.triggers.forEach(t.setY.bind(t)), t.test() }, 20)) }, setY: function(t) { t.y = this.elementPosition(t.el).top - this.triggerPosition + t.offset }, test: function() { this.disabled !== !0 && (this.triggers.filter(this.isInactive).filter(this.isInsideView).forEach(this.pin.bind(this)), this.triggers.filter(this.isActive).filter(this.isOutsideView).forEach(this.unpin.bind(this)), this.triggers.filter(this.isActive).filter(this.isInsideView).forEach(this.onProgress)) }, onProgress: function(t) { t.onProgress.call(t, (window.pageYOffset - t.y) / t.duration) }, createTrigger: function(t) { var e = { active: !1, el: t.triggerEl, duration: t.duration || 0, offset: t.offset || 0, onStart: t.onStart || this.noop, onEnd: t.onEnd || this.noop, onProgress: t.onProgress || this.noop, beforeSpacer: this.createSpacer(t), afterSpacer: this.createSpacer(t), y: this.elementPosition(t.triggerEl).top - this.triggerPosition + (t.offset || 0) }; return e.el.insertAdjacentElement("beforebegin", e.beforeSpacer), e.el.insertAdjacentElement("afterend", e.afterSpacer), e.beforeSpacer.style.display = "none", this.resizeSpacersToDuration(e), e }, createSpacer: function() { var t = document.createElement("div"); return t.className = "pinmagic-spacer", t }, setSpacerHeights: function() { this.triggers.forEach(this.resizeSpacersToDuration.bind(this)) }, isActive: function(t) { return t.active === !0 }, isInactive: function(t) { return t.active === !1 }, isInsideView: function(t) { return window.pageYOffset >= t.y && window.pageYOffset < t.y + t.duration }, isOutsideView: function(t) { return window.pageYOffset < t.y || window.pageYOffset >= t.y + t.duration }, pin: function(t) { t.active = !0, this.resizeSpacersToHeight(t), t.el.style.cssText = "position:fixed;top:" + this.triggerPosition + "px;left:0;width:100%;z-index:10;", t.onStart.call(t) }, unpin: function(t) { t.active = !1, t.el.style.cssText = "", this.resizeSpacersToDuration(t), this.showSpacers(t), this.disabled !== !0 && t.onEnd.call(t) }, resizeSpacersToHeight: function(t) { var e = this.heightOf(t.el) + t.duration + "px";
            t.beforeSpacer.style.height = e, t.afterSpacer.style.height = e }, resizeSpacersToDuration: function(t) { var e = t.duration + "px";
            t.beforeSpacer.style.height = e, t.afterSpacer.style.height = e }, resetSpacers: function(t) { t.beforeSpacer.style.display = "none", t.afterSpacer.style.display = "block" }, showSpacers: function(t) { var e = Math.round((window.pageYOffset - t.y) / t.duration); return this.disabled === !0 ? (t.beforeSpacer.style.display = "none", void(t.afterSpacer.style.display = "none")) : void(e > 0 ? (t.beforeSpacer.style.display = "block", t.afterSpacer.style.display = "none") : (t.beforeSpacer.style.display = "none", t.afterSpacer.style.display = "block")) }, debounce: function(t, e, i) { var n; return function() { var s = this,
                    r = arguments,
                    a = function() { n = null, i || t.apply(s, r) },
                    o = i && !n;
                clearTimeout(n), n = setTimeout(a, e), o && t.apply(s, r) } }, heightOf: function(t) { var e = window.getComputedStyle(t),
                i = parseFloat(e.marginTop) + parseFloat(e.marginBottom); return Math.ceil(t.offsetHeight + i) }, scrollSlideToPercent: function(t, e) { var i = this.triggers.filter(function(e) { return e.el === t })[0];
            window.scrollTo(0, i.y + i.duration * e) }, elementPosition: function(t) { var e = 0,
                i = 0,
                n = t; if (n.offsetParent) { do e += n.offsetLeft, i += n.offsetTop; while (n = n.offsetParent); return { left: e, top: i } } return { left: 0, top: 0 } } },
    function() { var t = function() { this.triggers = [], this.disabled = !1, window.addEventListener("scroll", this.test.bind(this), !1), window.addEventListener("resize", this.resize.bind(this), !1) };
        t.prototype = { enable: function() { this.disabled = !1 }, disable: function() { this.disabled = !0 }, test: function() { this.disabled !== !0 && this.triggers.filter(this.isInactive).filter(this.hasScrolledPast).forEach(this.activate) }, resize: function() { this.triggers.forEach(this.resizeTrigger.bind(this)) }, resizeTrigger: function(t) { t.y = this.elementPosition(t.el).top }, add: function(t) { this.triggers.push({ el: t.el, y: this.elementPosition(t.el).top, offset: t.offset || 0, onActivate: t.onActivate, active: !1 }) }, isInactive: function(t) { return t.active === !1 }, hasScrolledPast: function(t) { return window.pageYOffset >= t.y + t.offset }, activate: function(t) { t.active = !0, t.onActivate.apply(t.el, [t]) }, elementPosition: function(t) { var e = 0,
                    i = 0,
                    n = t; if (n.offsetParent) { do e += n.offsetLeft, i += n.offsetTop; while (n = n.offsetParent); return { left: e, top: i } } return { left: 0, top: 0 } } }, window.SimpleTriggers = t }(),
    function() { var t = function(t, e) { this.el = t, this.settings = this.xtend(e || {}), this.slides = Array.prototype.slice.call(t.children), this.container = document.createElement("div"), this.x = 0, this.dragging = !1, this.disabled = !1, this.setup() };
        t.prototype = { disable: function() { this.disabled = !0 }, enable: function() { this.disabled = !1 }, xtend: function(t) { var e, i = { pagination: null, onPage: function() {}, threshold: 20, over: null, finish: null, projection: 8 }; for (e in i) t.hasOwnProperty(e) && (i[e] = t[e]); return i }, setup: function() { this.wrap(), this.resize(), this.buildPagination(), this.el.addEventListener("touchstart", this.onStart.bind(this), !1), this.el.addEventListener("touchmove", this.onMove.bind(this), !1), this.el.addEventListener("touchend", this.onEnd.bind(this), !1), window.addEventListener("resize", this.setWidth.bind(this), !1) }, wrap: function() { this.container.className = "sidler-container", this.el.insertAdjacentElement("afterend", this.container), this.el.classList.add("sidler-wrapper"), this.container.appendChild(this.el) }, setWidth: function() { this.width = parseInt(window.getComputedStyle(this.container).width), this.scrollTo(this.currentSlide()) }, resize: function() { this.el.style.width = 100 * this.slides.length + "%", this.slides.forEach(this.resizeSlide.bind(this)) }, buildPagination: function() { null !== this.settings.pagination && (this.selectedPage = 0, this.pages = this.slides.map(this.page.bind(this)), this.pages.forEach(this.appendPage.bind(this))) }, page: function(t, e) { var i = this,
                    n = document.createElement("li"); return n.className = "sidler-page", n.innerHTML = '<span class="sidler-page-span">' + (e + 1) + "</span>", n.addEventListener("click", function() { i.setPage(e) }, !1), this.selectedPage === e && n.classList.add("sidler-page-active"), n }, appendPage: function(t) { this.settings.pagination.appendChild(t) }, setPage: function(t) { this.disabled !== !0 && (this.width = parseInt(window.getComputedStyle(this.container).width), this.scrollTo(-t * this.width, 500), this.settings.onPage(t)) }, resizeSlide: function(t) { t.style.width = 100 / this.slides.length + "%" }, onStart: function(t) { var e = t.touches[0];
                this.disabled !== !0 && (this.width = parseInt(window.getComputedStyle(this.container).width), this.lastFrame = e.screenX, this.start = e.screenX) }, onMove: function(t) { var e = t.touches[0],
                    i = e.screenX - this.lastFrame; if (this.disabled !== !0) { if (this.dragging === !1) { if (Math.abs(i) < this.settings.threshold) return;
                        this.start = e.screenX, this.lastFrame = e.screenX, this.dragging = !0, i = e.screenX - this.lastFrame } t.preventDefault(), this.x += i, this.lastFrame = e.screenX, this.lastDelta = i, window.requestAnimationFrame(this.translate.bind(this)) } }, onEnd: function() { var t = this.lastDelta * this.settings.projection,
                    e = this.currentSlide(t);
                this.disabled !== !0 && (this.scrollTo(e * this.width, 500), this.dragging = !1) }, currentSlide: function(t) { var e = t || 0; return this.x = this.x || 0, void 0 === this.width && this.setWidth(), Math.max(Math.min(Math.round((this.x + e) / this.width), 0), -this.slides.length + 1) }, translate: function() { this.el.style.transform = "translate(" + this.x + "px, 0)", null !== this.settings.over && this.settings.over(this.currentSlide()), null !== this.settings.pagination && this.showPage(Math.abs(this.currentSlide())) }, showPage: function(t) { t !== this.selectedPage && (this.pages[this.selectedPage].classList.remove("sidler-page-active"), this.pages[t].classList.add("sidler-page-active"), this.selectedPage = t) }, easeOutQuint: function(t) { return 1 + --t * t * t * t * t }, tick: function() { var t, e, i = +new Date - this.startTime;
                t = i / this.duration, e = this.easeOutQuint(t), 1 > t ? (window.requestAnimationFrame(this.tick.bind(this)), this.x = this.scrollX + (this.scrollTargetX - this.scrollX) * e, this.translate()) : (this.x = this.scrollTargetX, this.translate(), null !== this.settings.finish && this.settings.finish(this.currentSlide())) }, scrollTo: function(t, e) { return void 0 === e ? (this.x = t, void window.requestAnimationFrame(this.translate.bind(this))) : (this.scrollX = this.x, this.scrollTargetX = t, this.startTime = +new Date, this.duration = e, void window.requestAnimationFrame(this.tick.bind(this))) } }, window.Sidler = t }(),
    function() { var t = function(t, e) { this.el = document.createElement("canvas"), this.poster = t, this.context = this.el.getContext("2d"), this.loadedImages = 0, this.sprites = [], this.numSprites = e.urls.length, this.loadedSprites = 0, this.height = parseInt(e.height), this.width = parseInt(e.width), this.frames = parseInt(e.frames), this.tiles = 0, this.head = 0, this.loop = e.loop || !1, this.autoplay = e.autoplay, this.el.className = t.className, this.el.play = this.play.bind(this), this.el.pause = this.pause.bind(this), this.el.width = this.width, this.el.height = this.height, this.el.style.width = "100%", this.lastRenderTime = +new Date, this.fetch(e.urls) };
        t.prototype = { onLoad: function() { var t;
                this.loadedSprites++, this.loadedSprites < this.numSprites || (this.tiles = this.sprites[0].width / this.width, this.autoplay === !0 ? this.play() : this.drawPoster(), this.poster.parentNode.replaceChild(this.el, this.poster), t = new CustomEvent("load"), this.el.dispatchEvent(t)) }, fetch: function(t) { var e; for (e = this.numSprites - 1; e >= 0; e--) this.sprites[e] = new Image, this.sprites[e].src = t[e], this.sprites[e].addEventListener("load", this.onLoad.bind(this), !1) }, play: function() { this.playing = !0, this.renderFrame() }, pause: function() { this.playing = !1 }, coordsAt: function(t) { var e = Math.floor(t / this.frames * this.numSprites),
                    i = t - e * this.frames / this.numSprites,
                    n = i % this.tiles,
                    s = Math.floor(i / this.tiles); return { x: n * this.width, y: s * this.height, sprite: e } }, drawFrame: function(t) { var e = this.coordsAt(t);
                this.lastRenderTime = +new Date, this.context.drawImage(this.sprites[e.sprite], e.x, e.y, this.width, this.height, 0, 0, this.width, this.height) }, drawPoster: function() { this.context.drawImage(this.poster, 0, 0, this.width, this.height) }, renderFrame: function() { var t = +new Date; return t - this.lastRenderTime < 31.25 ? void window.requestAnimationFrame(this.renderFrame.bind(this)) : (this.drawFrame(this.head), this.head++, this.head === this.frames && this.loop === !1 ? (this.head = 0, void this.drawPoster()) : (this.head === this.frames && (this.head = 0), void(this.playing !== !1 && window.requestAnimationFrame(this.renderFrame.bind(this))))) } }, window.MJPlayer = t }(),
    function() { var t = function(t) { this.onFinish = t || this.noop };
        t.prototype = { noop: function() {}, easeInOutQuint: function(t) { return (t /= .5) < 1 ? .5 * Math.pow(t, 5) : .5 * (Math.pow(t - 2, 5) + 2) }, tick: function() { var t, e, i = +new Date - this.startTime;
                t = i / this.duration, e = this.easeInOutQuint(t), 1 > t ? (window.requestAnimationFrame(this.tick.bind(this)), window.scrollTo(0, this.scrollY + (this.scrollTargetY - this.scrollY) * e)) : (window.scrollTo(0, this.scrollTargetY), this.onFinish()) }, scrollTo: function(t, e) { this.scrollY = window.scrollY, this.scrollTargetY = t, this.startTime = +new Date, this.duration = e, window.requestAnimationFrame(this.tick.bind(this)) } }, window.Scrolly = t }(),
    function() { var t = function(t, e) { e = e || ","; for (var i = new RegExp("(\\" + e + '|\\r?\\n|\\r|^)(?:"([^"]*(?:""[^"]*)*)"|([^"\\' + e + "\\r\\n]*))", "gi"), n = [
                    []
                ], s = null; s = i.exec(t);) { var r = s[1];
                r.length && r !== e && n.push([]); var a;
                a = s[2] ? s[2].replace(new RegExp('""', "g"), '"') : s[3], n[n.length - 1].push(a) } return n };
        window.parseCSV = t }(),
    function() {
        window.styleSelect = function() {
            var t = document.querySelector.bind(document),
                e = document.querySelectorAll.bind(document),
                i = { SPACE: 32, UP: 38, DOWN: 40, ENTER: 13 };
            NodeList.prototype.forEach || (NodeList.prototype.forEach = Array.prototype.forEach), HTMLCollection.prototype.forEach || (HTMLCollection.prototype.forEach = Array.prototype.forEach), Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.webkitMatchesSelector || Element.prototype.oMatchesSelector);
            var n = function(t, e) { e = e || { bubbles: !1, cancelable: !1, detail: void 0 }; var i = document.createEvent("CustomEvent"); return i.initCustomEvent(t, e.bubbles, e.cancelable, e.detail), i };
            if (n.prototype = window.Event.prototype, window.CustomEvent = n, !(document.documentElement.dataset || Object.getOwnPropertyDescriptor(Element.prototype, "dataset") && Object.getOwnPropertyDescriptor(Element.prototype, "dataset").get)) {
                var s = {
                    enumerable: !0,
                    get: function() {
                        var t, e, i, n, s, r, a = this,
                            o = this.attributes,
                            l = o.length,
                            c = function(t) { return t.charAt(1).toUpperCase() },
                            h = function() { return this },
                            u = function(t, e) {
                                return "undefined" != typeof e ? this.setAttribute(t, e) : this.removeAttribute(t);
                            };
                        try {
                            ({}).__defineGetter__("test", function() {}), e = {} } catch (d) { e = document.createElement("div") }
                        for (t = 0; l > t; t++)
                            if (r = o[t], r && r.name && /^data-\w[\w\-]*$/.test(r.name)) { i = r.value, n = r.name, s = n.substr(5).replace(/-./g, c); try { Object.defineProperty(e, s, { enumerable: this.enumerable, get: h.bind(i || ""), set: u.bind(a, n) }) } catch (p) { e[s] = i } }
                        return e
                    }
                };
                try { Object.defineProperty(Element.prototype, "dataset", s) } catch (r) { s.enumerable = !1, Object.defineProperty(Element.prototype, "dataset", s) }
            }
            var a = function(t, e, i) { var n = t.parentNode; if (i && t.matches(e)) return !0; for (; n && n.nodeType && 1 === n.nodeType;) { if (n.matches(e)) return !0;
                        n = n.parentNode } return !1 },
                o = function() { return "ss-xxxx-xxxx-xxxx-xxxx-xxxx".replace(/x/g, function(t) { var e = 16 * Math.random() | 0,
                            i = "x" == t ? e : 3 & e | 8; return i.toString(16) }) };
            return function(s) { var r, l = "object" == typeof s ? s : t(s),
                    c = l.children,
                    h = l.selectedIndex,
                    u = o(),
                    d = '<div class="style-select" aria-hidden="true" data-ss-uuid="' + u + '">',
                    p = c.length - 1;
                l.setAttribute("data-ss-uuid", u), l.setAttribute("aria-hidden", "false"); var f, g = '<div class="ss-dropdown">';
                c.forEach(function(t, e) { var i = t.textContent,
                        n = t.getAttribute("value") || "",
                        s = "ss-option";
                    e === h && (f = '<div class="ss-selected-option" tabindex="0" data-value="' + n + '">' + i + "</div>"), t.disabled && (s += " disabled"), g += '<div class="' + s + '" data-value="' + n + '">' + i + "</div>" }), g += "</div>", d += f += g += "</div>", l.insertAdjacentHTML("afterend", d); var m = t('.style-select[data-ss-uuid="' + u + '"]'),
                    v = m.querySelectorAll(".ss-option"),
                    w = m.querySelector(".ss-selected-option"),
                    b = function(t, e) { m.classList.remove("open"), w.textContent = e, w.dataset.value = t, v.forEach(function(e) { e.dataset.value === t ? e.classList.add("ticked") : e.classList.remove("ticked") }), l.value = t; var i = new n("change");
                        l.dispatchEvent(i) };
                v.forEach(function(t, e) { var i = v.item(e);
                    i.className.match(/\bdisabled\b/) || (i.addEventListener("click", function(t) { var e = t.target,
                            i = e.parentNode.parentNode,
                            n = (i.getAttribute("data-ss-uuid"), e.getAttribute("data-value")),
                            s = e.textContent;
                        b(n, s) }), i.dataset.value === l.value && (r = e, i.classList.add("ticked"), i.classList.add("highlighted")), i.addEventListener("mouseover", function(t) { i.parentNode.childNodes.forEach(function(e, i) { e === t.target ? (e.classList.add("highlighted"), r = i) : e.classList.remove("highlighted") }) })) }); var y = function(t) { e(".style-select").forEach(function(e) { e !== t && e.classList.remove("open") }) },
                    S = function(t) { t.classList.contains("open") || y(t), t.classList.toggle("open") },
                    x = t('.style-select[data-ss-uuid="' + u + '"] .ss-selected-option');
                x.addEventListener("click", function(t) { t.preventDefault(), t.stopPropagation(), S(t.target.parentNode) }), x.addEventListener("keydown", function(t) { var e = t.target.parentNode; switch (t.keyCode) {
                        case i.SPACE:
                            S(e); break;
                        case i.DOWN:
                        case i.UP:
                            e.classList.contains("open") ? (t.keyCode === i.UP ? 0 !== r && (r -= 1) : p > r && (r += 1), v.forEach(function(t, e) { e === r ? t.classList.add("highlighted") : t.classList.remove("highlighted") })) : S(e), t.preventDefault(), t.stopPropagation(); break;
                        case i.ENTER:
                            var n = x.parentNode.querySelectorAll(".ss-option")[r],
                                s = n.dataset.value,
                                a = n.textContent;
                            b(s, a), t.preventDefault(), t.stopPropagation() } }), t("body").addEventListener("touchstart", function(t) { a(t.target, ".style-select", !0) || y() }) }
        }()
    }(),
    /*!
     * JavaScript Cookie v2.0.3
     * https://github.com/js-cookie/js-cookie
     *
     * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
     * Released under the MIT license
     */
    function(t) { if ("function" == typeof define && define.amd) define(t);
        else if ("object" == typeof exports) module.exports = t();
        else { var e = window.Cookies,
                i = window.Cookies = t();
            i.noConflict = function() { return window.Cookies = e, i } } }(function() {
        function t() { for (var t = 0, e = {}; t < arguments.length; t++) { var i = arguments[t]; for (var n in i) e[n] = i[n] } return e }

        function e(i) {
            function n(e, s, r) { var a; if (arguments.length > 1) { if (r = t({ path: "/" }, n.defaults, r), "number" == typeof r.expires) { var o = new Date;
                        o.setMilliseconds(o.getMilliseconds() + 864e5 * r.expires), r.expires = o } try { a = JSON.stringify(s), /^[\{\[]/.test(a) && (s = a) } catch (l) {} return s = encodeURIComponent(String(s)), s = s.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), e = encodeURIComponent(String(e)), e = e.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent), e = e.replace(/[\(\)]/g, escape), document.cookie = [e, "=", s, r.expires && "; expires=" + r.expires.toUTCString(), r.path && "; path=" + r.path, r.domain && "; domain=" + r.domain, r.secure ? "; secure" : ""].join("") } e || (a = {}); for (var c = document.cookie ? document.cookie.split("; ") : [], h = /(%[0-9A-Z]{2})+/g, u = 0; u < c.length; u++) { var d = c[u].split("="),
                        p = d[0].replace(h, decodeURIComponent),
                        f = d.slice(1).join("="); '"' === f.charAt(0) && (f = f.slice(1, -1)); try { if (f = i && i(f, p) || f.replace(h, decodeURIComponent), this.json) try { f = JSON.parse(f) } catch (l) {}
                        if (e === p) { a = f; break } e || (a[p] = f) } catch (l) {} } return a } return n.get = n.set = n, n.getJSON = function() { return n.apply({ json: !0 }, [].slice.call(arguments)) }, n.defaults = {}, n.remove = function(e, i) { n(e, "", t(i, { expires: -1 })) }, n.withConverter = e, n } return e() }),
    function() { window.locales = { EN_CA: "en-ca", EN_GB: "en-gb", EN_US: "en-us", FR_CA: "fr-ca" }; var t, e = 1; for (var i in window.locales) { var n = window.locales[i];
            window.location.pathname.substring(e, n.length + e) === n && (t = n) } window.currentLocale = t || window.locales.EN_CA, window.currentJurisdiction = window.currentLocale.split("-")[1].toUpperCase(), console.info("Setting locale to " + window.currentLocale + " and jurisdiction to " + window.currentJurisdiction + ".") }(),
    function() { var t = function(t) { this.startingAmount = t.startingAmount, this.monthlyContribution = t.monthlyContribution, this.annualReturnRate = t.annualReturnRate };
        t.prototype.valueAtYear = function(t) { var e, i = this.annualReturnRate / 12,
                n = this.startingAmount; for (e = 0; 12 * t > e; e++) n = n * (1 + i) + 1 * this.monthlyContribution; return n }, t.prototype.valueAtYearMinusFees = function(t, e) { var i, n = this.annualReturnRate / 12,
                s = this.startingAmount; for (i = 0; 12 * t > i; i++) s = s * (1 + n) + 1 * this.monthlyContribution - Math.round(s * e / 12); return parseInt(s) }, window.RiskCalculatorModel = t }(),
    function() { var t = function() { this.freeAmount = 5e3, this.basicFee = window.ws.getBasicFee() / 100, this.blackFee = window.ws.getBlackFee() / 100 },
            e = { CA: .02, US: .0072, GB: .0256 };
        t.prototype = { industryFee: function(t) { return e[window.currentJurisdiction] || e.CA }, wealthsimpleFee: function(t) { switch (!0) {
                    case t <= this.freeAmount:
                        return 0;
                    case 1e5 > t:
                        return this.basicFee;
                    default:
                        return this.blackFee } }, savingsVsIndustry: function(t, e) { var i = .043,
                    n = .002,
                    s = this.wealthsimpleFee(e) + n,
                    r = e * Math.exp((i - s) * t) - e * Math.exp((i - this.industryFee(e)) * t); return Math.floor(r) }, savingsVsBlack: function(t, e) { var i = Math.round(1e4 * this.wealthsimpleFee(e) / 12),
                    n = Math.round(e * this.wealthsimpleFee(e) / 12); return 12 * n * t - 12 * i * t } }, window.FeeSavingsModel = t }(), window.ws = { onboardingDefaults: { investment_amount: 25e3, investment_timeframe: 20 }, how_it_works_amt: 25e3, fees: { black: { CA: .4, US: .4, GB: .5 }, basic: { CA: .5, US: .5, GB: .75 } }, util: { cookieSet: function(t, e) { Cookies.set("ws_" + t, e) }, cookieSetGlobal: function(t, e, i) { i.domain = "development" === window.env ? "localhost" : ".wealthsimple.com", Cookies.set("ws_" + t, e, i) }, cookieGet: function(t, e) { return e ? Cookies.get(t) : Cookies.get("ws_" + t) } }, isMobile: function() { return window.innerWidth < 620 }, isDesktop: function() { return window.innerWidth > 619 }, getCurrentOnboardingSettings: function() { var t; return window.ws.util.cookieGet("onboarding_params") && (t = JSON.parse(window.ws.util.cookieGet("onboarding_params")), t.investment_amount && t.investment_timeframe) ? t : window.ws.onboardingDefaults }, debounce: function(t, e, i) { var n; return function() { var s = this,
                    r = arguments,
                    a = function() { n = null, i || t.apply(s, r) },
                    o = i && !n;
                clearTimeout(n), n = setTimeout(a, e), o && t.apply(s, r) } } }, window.commaSeparate = function(t) { return t.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }, window.spaceSeparate = function(t) { return t.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") }, window.currencyForLocale = function(t) { var e, i = window.locales; switch (window.currentLocale) {
            case i.FR_CA:
                e = window.spaceSeparate(t) + " $"; break;
            case i.EN_GB:
                e = "\xa3" + window.commaSeparate(t); break;
            default:
                e = "$" + window.commaSeparate(t) } return e }, window.feePercentageForLocale = function(t) { var e, i = window.locales; switch (window.currentLocale) {
            case i.FR_CA:
                e = "Des frais de " + t.toString().replace(".", ",") + "%"; break;
            default:
                e = t.toString() + "% fee" } return e }, window.ws.getBasicFee = function() { var t = window.currentJurisdiction || "CA"; return window.ws.fees.basic[t] }, window.ws.getBlackFee = function() { var t = window.currentJurisdiction || "CA"; return window.ws.fees.black[t] },
    function() { window.Tab = function(t) { this.el = t, this.target = $("#" + this.el.getAttribute("data-tab-content")), this.group = this.el.getAttribute("data-tab-group"), $(this.el).on("click", this.showTabContent.bind(this)) }, window.Tab.prototype = { showTabContent: function(t) { return t.preventDefault(), null === this.group ? ($(".js-tab-content").each(this.removeActiveClass), void this.target.addClass("tab-active")) : ($('.js-tab-content[data-tab-group="' + this.group + '"]').removeClass("tab-active"), $('.js-tab[data-tab-group="' + this.group + '"]').removeClass("active"), this.target.addClass("tab-active"), void this.el.classList.add("active")) }, removeActiveClass: function(t) { t.classList.remove("tab-active") } }, $(".js-tab").each(function(t) { new window.Tab(t) }) }(),
    function() {
        function t() { s.addClass("show"), r.addClass("show") }

        function e() { s.removeClass("show"), r.removeClass("show") }

        function i() { var t = $('<div class="hamburger-menu-overlay" data-hamburger-action="close"></div>'); return t.appendTo("body"), t }

        function n() { s = $(".hamburger-menu"), r = i(), $("body").on("click", '[data-hamburger-action="open"]', t), $("body").on("click", '[data-hamburger-action="close"]', e) } var s, r;
        $(n) }(),
    function() { var t = function(t) { this.el = t, this.el.value = this.el.defaultValue, this.sliderEl = document.createElement("div"), $(this.sliderEl).insertAfter(this.el), this.slider = this.createSlider(), this.slider.on("slide", this.onUpdate.bind(this)), this.changeEvent = document.createEvent("Event"), this.changeEvent.initEvent("change", !0, !0) };
        t.prototype = { createSlider: function() { return noUiSlider.create(this.sliderEl, { start: parseInt(this.el.value), step: parseInt(this.el.step), connect: [!0, !1], range: this.parseRange(this.el.min, this.el.max, this.el.getAttribute("range")) }) }, parseRange: function(t, e, i) { var n, s, r = { min: parseInt(t) }; if (null === i) return { min: parseInt(t), max: parseInt(e) };
                n = JSON.parse(i); for (s in n) r[s] = n[s]; return r.max = parseInt(e), r }, onUpdate: function() { this.el.value = parseInt(this.slider.get()), this.el.dispatchEvent(this.changeEvent) } }, $('input[type="range"]').each(function(e) { e.type = "hidden", e.range = new t(e) }) }(),
    function() { var t = function(t) { t.insertAdjacentHTML("beforeend", '<source src="' + t.getAttribute("data-src-mp4") + '" type="video/mp4">') },
            e = function(t, e) { return 0 === e ? !0 : new MJPlayer(t, { urls: JSON.parse(t.getAttribute("data-urls")), width: t.getAttribute("data-width"), height: t.getAttribute("data-height"), frames: t.getAttribute("data-frames"), autoplay: null !== t.getAttribute("data-autoplay"), loop: null !== t.getAttribute("data-loop") }) };
        $(".js-video-placeholder").each(function(t) { var e = t.parentNode.querySelector(".js-video-gif").innerHTML,
                i = t.parentNode.querySelector(".js-video-desktop").innerHTML,
                n = ws.isMobile() ? e : i;
            t.outerHTML = n }), $(".js-animation").first().on("load", function() { var t = e(this);
            t.el.addEventListener("load", function() { $(".js-animation").each(e) }) }), $(".js-video-main").first().on("loadeddata", function() { $(".js-video-main").each(t), window.indexDesktop.safariResize() }) }(),
    function() { window.IndexVideoPlayer = function(t) { this.parent = t.parentNode, this.mainVideo = t, $.subscribe("pinmagic/start", this.onVideoOver.bind(this)), $.subscribe("pinmagic/end", this.onVideoOut.bind(this)) }, window.IndexVideoPlayer.prototype = { onVideoOver: function(t) { t === this.mainVideo && this.mainVideo.play() }, onVideoOut: function(t) { t === this.mainVideo && t.currentTime > 0 && t.currentTime !== t.duration && t.play() } }, $(".js-video-main").each(function(t) { return new window.IndexVideoPlayer(t) }) }(),
    function() { var t = function(t) { this.el = t, this.lastLocation = window.pageYOffset, this.stuck = this.stick(), this.lastCheck = +new Date, window.addEventListener("scroll", this.checkDirection.bind(this), !1) };
        t.prototype = { stick: function() { return this.el.addClass("header-sticky"), !0 }, unstick: function() { return this.el.removeClass("header-sticky"), !1 }, checkDirection: function() { ws.isDesktop() || +new Date < this.lastCheck + 1e3 || (this.lastLocation > window.pageYOffset && this.stuck === !1 && (this.stuck = this.stick()), this.lastLocation < window.pageYOffset && this.stuck === !0 && (this.stuck = this.unstick()), this.lastCheck = +new Date, this.lastLocation = window.pageYOffset) } }, new t($(".js-header")) }(),
    function() { var t = function(t) { this.slide = t, this.currentPage = 0, this.pages = $(".js-page", t), this.indicators = $(".js-pagination-indicator", t), this.indicators.on("click", this.scrollToPage.bind(this)), this.numPages = this.pages.length - 1, $.subscribe("pinmagic/progress", this.onProgress.bind(this)) };
        t.prototype = { scrollToPage: function(t) { var e = $(t.target).parent().index();
                this.currentPage = e, this.updatePage(), this.updateIndicator(), $.publish("index-pagination/page", [this.slide, e / this.numPages]), t.preventDefault() }, onProgress: function(t, e) { var i = Math.round(e * this.numPages);
                t === this.slide && i !== this.currentPage && (this.currentPage = i, this.updatePage(), this.updateIndicator()) }, setPageVisibility: function(t, e) { t.classList.remove("show"), e === this.currentPage && t.classList.add("show") }, setIndicatorStatus: function(t, e) { t.classList.remove("pagination-indicator-active"), e === this.currentPage && t.classList.add("pagination-indicator-active") }, updatePage: function() { this.pages.each(this.setPageVisibility.bind(this)) }, updateIndicator: function() { this.indicators.each(this.setIndicatorStatus.bind(this)) } }, window.IndexPagination = t }(),
    function() { if (null !== document.querySelector(".js-index-graph")) { var t = { US: { aggressive: .05, conservative: .0415, bank: .005 }, CA: { aggressive: .043, conservative: .03, bank: .005 }, GB: { aggressive: .0355, conservative: .0195, bank: .0075 } },
                e = function() { this.svg = $(".js-index-graph"), this.previewSum = "Wealthsimple", this.startingInvestmentSlider = $(".js-graph-starting-investment"), this.monthlyDepositSlider = $(".js-graph-monthly-deposit"), this.wealthsimpleFill = $(".js-wealthsimple-fill"), this.traditionalFill = $(".js-traditional-fill"), this.mattressFill = $(".js-mattress-fill"), this.wealthsimpleLine = $(".js-wealthsimple-line"), this.traditionalLine = $(".js-traditional-line"), this.mattressLine = $(".js-mattress-line"), this.wealthsimplePoint = $(".js-wealthsimple-point"), this.traditionalPoint = $(".js-traditional-point"), this.mattressPoint = $(".js-mattress-point"), this.wealthsimple30YearReturn = 0, this.traditional30YearReturn = 0, this.mattressPoint30YearReturn = 0, this.startingInvestmentSum = $(".js-graph-starting-investment-sum"), this.monthlyDepositSum = $(".js-graph-monthly-deposit-sum"), this.typicalReturnSum = $(".js-typical-return-sum"), this.startingInvestmentSlider.on("change", this.onSliderChange.bind(this)), this.monthlyDepositSlider.on("change", this.onSliderChange.bind(this)), this.wealthsimplePoint.on("click", this.changePreviewSum.bind(this)), this.traditionalPoint.on("click", this.changePreviewSum.bind(this)), this.mattressPoint.on("click", this.changePreviewSum.bind(this)), this.annualReturnRates = t[window.currentJurisdiction] || t.CA, window.addEventListener("resize", ws.debounce(this.resizeGraph, 200).bind(this), !1), this.resizeGraph(), setTimeout(this.resizeGraph.bind(this), 6e3) };
            e.prototype = { resizeGraph: function() { var t = this.svg[0].parentNode.getBoundingClientRect();
                    this.graphWidth = parseInt(t.width), this.graphHeight = parseInt(.45 * this.graphWidth), this.sliderWidth = parseInt(this.startingInvestmentSlider.parent().width()) - 30, this.svg[0].setAttribute("viewBox", "0 0 " + this.graphWidth + " " + this.graphHeight), (document.documentMode || /Edge/.test(navigator.userAgent)) && (this.svg[0].style.width = this.graphWidth + "px", this.svg[0].style.height = this.graphHeight + "px"), this.onSliderChange() }, normalize: function(t) { var e = [0, t[1] / t[2], t[2] / t[2]]; return e }, createLine: function(t, e, i) { var n = this.graphHeight - t[0] / e * this.graphHeight,
                        s = this.graphHeight - t[1] / e * this.graphHeight,
                        r = this.graphHeight - t[2] / e * this.graphHeight,
                        a = "M0," + n + " C0," + n + " " + this.graphWidth / 1.8 + "," + s + " " + this.graphWidth + "," + r; return i === !0 ? a + " L" + this.graphWidth + "," + this.graphHeight + " L0," + this.graphHeight + " Z" : a }, series: function(t, e, i) { var n = new RiskCalculatorModel({ startingAmount: t, monthlyContribution: e, annualReturnRate: i }); return [n.valueAtYear(1), n.valueAtYear(15), n.valueAtYear(30)] }, onSliderChange: function() { var t = parseInt(this.startingInvestmentSlider.val()),
                        e = parseInt(this.monthlyDepositSlider.val());
                    0 === t && (t = 500), 0 === e && (e = 25), this.wealthsimple = this.series(t, e, this.annualReturnRates.aggressive), this.traditional = this.series(t, e, this.annualReturnRates.conservative), this.mattress = this.series(t, e, this.annualReturnRates.bank), this.wealthsimple30YearReturn = this.wealthsimple[2], this.traditional30YearReturn = this.traditional[2], this.mattress30YearReturn = this.mattress[2], this.wealthsimpleLine[0].setAttribute("d", this.createLine(this.wealthsimple, this.wealthsimple[2])), this.traditionalLine[0].setAttribute("d", this.createLine(this.traditional, this.wealthsimple[2])), this.mattressLine[0].setAttribute("d", this.createLine(this.mattress, this.wealthsimple[2])), this.wealthsimpleFill[0].setAttribute("d", this.createLine(this.wealthsimple, this.wealthsimple[2], !0)), this.traditionalFill[0].setAttribute("d", this.createLine(this.traditional, this.wealthsimple[2], !0)), this.mattressFill[0].setAttribute("d", this.createLine(this.mattress, this.wealthsimple[2], !0)), this.startingInvestmentSum.text(currencyForLocale(t)), this.monthlyDepositSum.text(currencyForLocale(e)), this.moveSum(this.startingInvestmentSlider, this.startingInvestmentSum), this.moveSum(this.monthlyDepositSlider, this.monthlyDepositSum), this.updatePoint(this.wealthsimplePoint, this.wealthsimpleLine, this.wealthsimple[2]), this.updatePoint(this.traditionalPoint, this.traditionalLine, this.traditional[2]), this.updatePoint(this.mattressPoint, this.mattressLine, this.mattress[2]), this.updatePreviewSum(this.wealthsimple[2], this.traditional[2], this.mattress[2]) }, moveSum: function(t, e) { var i, n, s, r; return ws.isMobile() ? !1 : (i = parseInt(t.attr("min")), n = parseInt(t.attr("max")) - i, s = (parseInt(t.val()) - i) / n, void(r = t.val().toString().length * t.val().toString().length)) }, updatePoint: function(t, e, i) { var n = e[0].getPointAtLength(e[0].getTotalLength()); return t.text(currencyForLocale(parseInt(i))), t.css("transform", "translate(0, " + n.y + "px)"), !0 }, changePreviewSum: function(t) { var e = $(t.target);
                    this.previewSum = e.attr("data-preview-id"), this.updatePreviewSum(), $(".js-return-sum-title").text(e.attr("data-preview-title")) }, updatePreviewSum: function() { var t = this.wealthsimple30YearReturn,
                        e = this.traditional30YearReturn,
                        i = this.mattress30YearReturn; switch (this.previewSum) {
                        case "traditional":
                            this.typicalReturnSum.text(currencyForLocale(parseInt(e))); break;
                        case "mattress":
                            this.typicalReturnSum.text(currencyForLocale(parseInt(i))); break;
                        default:
                            this.typicalReturnSum.text(currencyForLocale(parseInt(t))) } } }, window.addEventListener("load", function() { new e }, !1) } }(),
    function() { if (null !== document.querySelector(".js-black-graph")) { var t = { US: { wealthsimpleBasic: .05, traditionalInvestor: .0415 }, CA: { wealthsimpleBasic: .043, traditionalInvestor: .03 }, GB: { wealthsimpleBasic: .0355, traditionalInvestor: .0195 } },
                e = function() { this.maxYears = 30, this.monthlyContribution = 1e3, this.svg = $(".js-black-graph"), this.previewSum = "Wealthsimple", this.startingInvestmentSlider = $(".js-ws-black-slider"), this.blackFill = $(".js-black-fill"), this.standardFill = $(".js-standard-fill"), this.typicalFill = $(".js-typical-fill"), this.blackLine = $(".js-black-line"), this.standardLine = $(".js-standard-line"), this.typicalLine = $(".js-typical-line"), this.blackPoint = $(".js-black-point"), this.standardPoint = $(".js-standard-point"), this.typicalPoint = $(".js-typical-point"), this.$gainsEl = $(".js-ws-black-gains"), this.$savingsEl = $(".js-ws-black-savings"), this.startingInvestmentSum = $(".js-ws-black-slider-value"), this.startingInvestmentSlider.on("change", this.onSliderChange.bind(this)), this.feeSavingsModel = new FeeSavingsModel, this.annualReturnRates = t[window.currentJurisdiction] || t.CA, this.riskCalculatorModel = new RiskCalculatorModel({ startingAmount: this.currentStartingAmount(), monthlyContribution: this.monthlyContribution, annualReturnRate: this.annualReturnRates.wealthsimpleBasic }), this.typicalRiskCalculatorModel = new RiskCalculatorModel({ startingAmount: this.currentStartingAmount(), monthlyContribution: this.monthlyContribution, annualReturnRate: this.annualReturnRates.traditionalInvestor }), window.addEventListener("resize", ws.debounce(this.resizeGraph, 200).bind(this), !1), this.resizeGraph(), setTimeout(this.resizeGraph.bind(this), 6e3) };
            e.prototype = { resizeGraph: function() { var t = this.svg[0].parentNode.getBoundingClientRect();
                    this.graphWidth = parseInt(t.width), this.graphHeight = parseInt(.45 * this.graphWidth), this.sliderWidth = parseInt(this.startingInvestmentSlider.parent().width()) - 30, this.svg[0].setAttribute("viewBox", "0 0 " + this.graphWidth + " " + this.graphHeight), (document.documentMode || /Edge/.test(navigator.userAgent)) && (this.svg[0].style.width = this.graphWidth + "px", this.svg[0].style.height = this.graphHeight + "px"), this.onSliderChange() }, normalize: function(t) { var e = [0, t[1] / t[2], t[2] / t[2]]; return e }, createLine: function(t, e, i) { var n = 1e5,
                        s = this.graphHeight - (t[0] - n) / (e - n) * this.graphHeight,
                        r = this.graphHeight - (t[1] - n) / (e - n) * this.graphHeight,
                        a = this.graphHeight - (t[2] - n) / (e - n) * this.graphHeight,
                        o = "M0," + s + " C0," + s + " " + this.graphWidth / 1.8 + "," + r + " " + this.graphWidth + "," + a; return i === !0 ? o + " L" + this.graphWidth + "," + this.graphHeight + " L0," + this.graphHeight + " Z" : o }, series: function(t, e, i) { return [this.valueAtYear(0, e, i), this.valueAtYear(this.maxYears / 2, e, i), this.valueAtYear(this.maxYears, e, i)] }, valueAtYear: function(t, e, i) { e.startingAmount = this.currentStartingAmount(); var n = e.valueAtYear(t); if ("black" === i) { var s = e.startingAmount;
                        n += this.gains(s, t) + this.savings(s, t) } return Math.round(n) }, onSliderChange: function() { var t = this.currentStartingAmount();
                    this.black = this.series(t, this.riskCalculatorModel, "black"), this.standard = this.series(t, this.riskCalculatorModel, "standard"), this.typical = this.series(t, this.typicalRiskCalculatorModel, "typical"), this.blackLine[0].setAttribute("d", this.createLine(this.black, this.black[2])), this.standardLine[0].setAttribute("d", this.createLine(this.standard, this.black[2])), this.typicalLine[0].setAttribute("d", this.createLine(this.typical, this.black[2])), this.blackFill[0].setAttribute("d", this.createLine(this.black, this.black[2], !0)), this.standardFill[0].setAttribute("d", this.createLine(this.standard, this.black[2], !0)), this.typicalFill[0].setAttribute("d", this.createLine(this.typical, this.black[2], !0)), this.startingInvestmentSum.text(currencyForLocale(t)), this.updatePoint(this.blackPoint, this.blackLine, this.black[2]), this.updatePoint(this.standardPoint, this.standardLine, this.standard[2]), this.updatePoint(this.typicalPoint, this.typicalLine, this.typical[2]), this.$gainsEl.text(currencyForLocale(this.gains(t, this.maxYears))), this.$savingsEl.text(currencyForLocale(this.savings(t, this.maxYears))) }, updatePoint: function(t, e, i) { var n = e[0].getPointAtLength(e[0].getTotalLength()); return t.text(currencyForLocale(parseInt(i))), t.css("transform", "translate(0, " + n.y + "px)"), !0 }, gains: function(t, e) { switch (window.currentJurisdiction) {
                        case "GB":
                            return 0;
                        default:
                            var i = window.ws.getBasicFee() / 100; return parseInt(t * (Math.exp(e * i) - 1)) } }, savings: function(t, e) { return this.feeSavingsModel.savingsVsBlack(e, t) }, currentStartingAmount: function() { return parseInt(this.startingInvestmentSlider.val()) } }, window.addEventListener("load", function() { new e }, !1) } }(),
    function() { var t = function(t) { return this.el = t, this.pagination = $(this.el).parents(".js-pin")[0].querySelector(".js-mobile-pagination"), this.toggleSidler(), window.addEventListener("resize", this.toggleSidler.bind(this), !1), this };
        t.prototype = { setupSidler: function() { return new Sidler(this.el, { threshold: 40, pagination: this.pagination }) }, toggleSidler: function() { ws.isDesktop() ? void 0 !== this.sidler && this.sidler.disable() : (void 0 === this.sidler && (this.sidler = this.setupSidler()), this.sidler.enable()) } }, $(".js-pages").each(function(e) { new t(e) }) }(),
    function() { var t = function(t) { var e, i = t.parentNode.querySelector(".js-carousel-arrow-left"),
                    n = t.parentNode.querySelector(".js-carousel-arrow-right"),
                    s = function() { var t = -e.currentSlide();
                        t = Math.max(t - 1, 0), e.setPage(t) },
                    r = function() { var t = -e.currentSlide();
                        t = Math.min(t + 1, e.slides.length - 1), e.setPage(t) },
                    a = function(t) { i.classList.toggle("clickable", 0 !== t), n.classList.toggle("clickable", t !== e.slides.length - 1) };
                i && n && (i.addEventListener("click", s, !1), n.addEventListener("click", r, !1)), e = new Sidler(t, { threshold: 40, pagination: t.nextElementSibling, onPage: a }) },
            e = Array.prototype.slice.call(document.querySelectorAll(".js-carousel"));
        e.forEach(t) }(),
    function() { var t = window.innerHeight,
            e = function() { this.swipeDetection = new SwipeDetection({ threshold: 100, up: this.prevSection.bind(this), down: this.nextSection.bind(this) }), this.scrolly = new Scrolly(this.onScrollFinished.bind(this)), this.sections = Array.prototype.slice.call(document.querySelectorAll(".index-section")).filter(this.isVisible), this.section = Math.round(window.pageYOffset / window.innerHeight) };
        e.prototype = { isVisible: function(t) { return t.offsetWidth > 0 && t.offsetHeight > 0 }, nextSection: function() { this.pauseCurrentVideo(), this.section = this.scrollToSection(this.section + 1), this.section >= this.sections.length - 1 && this.swipeDetection.disable() }, prevSection: function() { this.pauseCurrentVideo(), this.section = this.scrollToSection(this.section - 1) }, scrollToSection: function(t) { var e = Math.min(Math.max(t, 0), this.sections.length - 1),
                    i = $(this.sections[e]).offset().top; return this.scrolly.scrollTo(i, 600), e }, pauseCurrentVideo: function() { var t = $(".index-section")[this.section],
                    e = $(".js-animation", t).get(0);
                void 0 !== e && void 0 !== e.pause && e.pause() }, onScrollFinished: function() { var t = $(".index-section")[this.section],
                    e = $(".js-animation", t).get(0);
                void 0 !== e && void 0 !== e.play && e.play() } }, ws.isMobile() && document.body.classList.contains("index") && (window.addEventListener("load", function() { new e }, !1), $(".index-section").each(function(e, i) { var n = 0 === i ? 72 : 0;
            e.style.height = t - n + "px" })) }(),
    function() { var t = function(t) { switch (t) {
                    case "black":
                        return window.ws.getBlackFee();
                    default:
                        return window.ws.getBasicFee() } },
            e = function(e) { this.el = e, this.activeBenefits = "standard", this.bubble = $(".js-details-slider-bubble"), this.accountBalance = $(".js-account-balance"), this.fee = t("basic"), this.feeSavingsModel = new FeeSavingsModel, this.setValues(!0), $(this.el).on("change", this.onChange.bind(this)) };
        e.prototype = { onChange: function() { window.requestAnimationFrame(this.setValues.bind(this)) }, setValues: function(e) { var i = "0" === this.el.value ? 500 : parseInt(this.el.value); switch (!0) {
                    case this.el.value >= 1e5:
                        this.enableBlack(t("black")); break;
                    case this.el.value <= 5e3:
                        this.enableStandard(0); break;
                    default:
                        this.enableStandard(t("basic")) } $(".js-details-value").text(currencyForLocale(this.feeSavingsModel.savingsVsIndustry(20, i))), e !== !0 && this.showBubble() }, enableBlack: function(t) { return "black" === this.activeBenefits ? !1 : ($(".js-details-fee").text(feePercentageForLocale(t)), $(".js-details-pricing").removeClass("pricing-standard").addClass("pricing-black"), $(".pricing-selected").removeClass("pricing-selected"), $(".js-pricing-black").addClass("pricing-selected"), this.fee = t, this.activeBenefits = "black", !0) }, enableStandard: function(t) { return this.fee = t, $(".js-details-fee").text(feePercentageForLocale(t)), "standard" === this.activeBenefits ? !1 : ($(".js-details-pricing").removeClass("pricing-black").addClass("pricing-standard"), $(".pricing-selected").removeClass("pricing-selected"), $(".js-pricing-standard").addClass("pricing-selected"), this.activeBenefits = "standard", !0) }, showBubble: function() { var t = "0" === this.el.value ? 500 : parseInt(this.el.value);
                this.accountBalance.text(currencyForLocale(t)), this.bubble.addClass("bubble-active"), ws.isMobile() || this.bubble.css("left", $(".noUi-origin", this.el.parentNode).get(0).style.left) } }, $(".js-details-slider").each(function(t) { new e(t) }) }(),
    function() { var t = function() { this.enabled = !0, this.section = 0, this.sections = this.buildSectionTree($(".js-keyboard-section")), this.scrolly = new Scrolly, window.addEventListener("keydown", this.onKeyDown, !1), window.addEventListener("resize", this.recalculateY.bind(this), !1), window.addEventListener("load", this.recalculateY.bind(this), !1), $.subscribe("index-keyboard/change-section", this.changeSection.bind(this)) };
        t.prototype = { recalculateY: function() { this.sections = this.buildSectionTree($(".js-keyboard-section")) }, buildSectionTree: function(t) { var e = Array.prototype.slice.call(t).map(this.sectionObject.bind(this)); return [].concat.apply([], e) }, sectionObject: function(t) { var e = t.querySelectorAll(".js-page"),
                    i = this,
                    n = e.length - 1,
                    s = parseInt($(t).offset().top); return 0 === e.length ? [{ el: t, y: s }] : Array.prototype.slice.call(e).map(function(t, e) { return i.subSectionObject(t, s, n, e) }) }, subSectionObject: function(t, e, i, n) { return { el: t, y: e + n / i * 5998 } }, enable: function() { this.enabled !== !0 && window.addEventListener("keyup", this.onKeyDown, !1) }, disable: function() { this.enabled !== !1 && window.removeEventListener("keyup", this.onKeyDown, !1) }, onKeyDown: function(t) { switch (t.keyCode) {
                    case 37:
                        t.preventDefault(), $.publish("index-keyboard/change-section", ["up", t]); break;
                    case 38:
                        t.preventDefault(), $.publish("index-keyboard/change-section", ["up", t]); break;
                    case 39:
                        t.preventDefault(), $.publish("index-keyboard/change-section", ["down", t]); break;
                    case 40:
                        t.preventDefault(), $.publish("index-keyboard/change-section", ["down", t]) } }, changeSection: function(t) { "up" === t && (this.section = this.scrollToSection(this.section - 1)), "down" === t && (this.section = this.scrollToSection(this.section + 1)) }, scrollToSection: function(t) { var e = Math.min(Math.max(t, 0), this.sections.length - 1); return this.scrolly.scrollTo(this.sections[e].y, 600), e } }, window.IndexKeyboard = t }(),
    function() { var t = function() { this.slides = $(".js-pin"), this.reveals = $(".js-reveal"), this.enabled = !0, this.pinmagic = new PinMagic({}), this.simpleTriggers = new SimpleTriggers, this.setupPinnedSections(), this.setupReveals(), this.setupLastVideo(), this.indexKeyboard = new IndexKeyboard, this.toggle(), window.addEventListener("resize", ws.debounce(this.toggle.bind(this), 200), !1), window.addEventListener("load", this.startIndexVideo.bind(this), !1), $.subscribe("index-pagination/page", this.scrollTo.bind(this)) };
        t.prototype = { startIndexVideo: function() { this.enabled !== !1 && ($(".js-fade").each(function(t) { var e = parseInt(t.getAttribute("data-fade-delay")) || 200;
                    t.classList.add("fade"), setTimeout(function() { t.classList.add("fadein") }, e) }), setTimeout(function() { $(".js-video-main").get(0).play() }, 1500)) }, scrollTo: function(t, e) { this.pinmagic.scrollSlideToPercent(t, .999 * e) }, setupPinnedSections: function() { this.slides.each(this.enableSlide.bind(this)) }, setupReveals: function() { this.enabled !== !1 && this.reveals.each(this.addRevealFunction.bind(this)) }, setupLastVideo: function() { var t = document.querySelector(".js-last-video");
                null !== t && this.simpleTriggers.add({ el: t, offset: -300, onActivate: function() { this.play() } }) }, addRevealFunction: function(t) { t.classList.add("reveal"), this.simpleTriggers.add({ el: t, offset: -540, onActivate: this.onReveal }) }, onReveal: function() { this.classList.add("reveal-active") }, enableSlide: function(t) { var e = parseInt(t.getAttribute("data-pinmagic-duration")) || 2e3;
                this.pinmagic.add({ triggerEl: t, duration: e, onStart: this.onPinStart, onEnd: this.onPinEnd, onProgress: this.onPinProgress }), new IndexPagination(t) }, toggle: function() { var t = ws.isDesktop();
                this.safariResize(), t !== this.enabled && (this.enabled = t, t === !0 ? this.enable() : this.disable()) }, safariResize: function() {-1 !== navigator.userAgent.indexOf("Safari") && -1 === navigator.userAgent.indexOf("Chrome") && $(".js-video-main").each(function(t) { t.style.height = parseInt($(t).height()) - .5 + "px" }) }, enable: function() { this.pinmagic.enable(), this.reveals.each(function(t) { t.classList.add("reveal") }), this.indexKeyboard.enable(), this.simpleTriggers.enable() }, disable: function() { this.pinmagic.disable(), this.reveals.each(function(t) { t.classList.remove("reveal") }), this.simpleTriggers.disable(), this.indexKeyboard.disable() }, onPinStart: function() { var t = this.el;
                $.publish("pinmagic/start", [t.querySelector(".js-video")]), t.classList.add("section-active") }, onPinEnd: function() { var t = this.el;
                $.publish("pinmagic/end", [this.el.querySelector(".js-video")]), t.classList.remove("section-active") }, onPinProgress: function(t) { null !== this.el.paginationEl && $.publish("pinmagic/progress", [this.el, t]) } }, document.body.classList.contains("index") && (window.indexDesktop = new t) }(),
    function() { ws.initMap = function() { var t = $(".who-we-are-location-toronto > .location-map"),
                e = $(".who-we-are-location-ny > .location-map"),
                i = { disableDefaultUI: !0, styles: [{ featureType: "administrative", elementType: "all", stylers: [{ visibility: "simplified" }, { saturation: "-100" }] }, { featureType: "landscape", elementType: "all", stylers: [{ saturation: -100 }, { lightness: 50 }, { visibility: "on" }] }, { featureType: "landscape.man_made", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "poi", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "transit", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "road.highway", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "road.arterial", elementType: "all", stylers: [{ visibility: "simplified" }] }, { featureType: "road.local", elementType: "all", stylers: [{ visibility: "simplified" }] }, { featureType: "water", elementType: "all", stylers: [{ visibility: "simplified" }, { lightness: 30 }, { saturation: -100 }] }] };
            new google.maps.Map(t[0], $.extend(i, { center: new google.maps.LatLng(43.6446, -79.4115), zoom: 17 })), new google.maps.Map(e[0], $.extend(i, { center: new google.maps.LatLng(40.7235, -73.996), zoom: 16 })) }, document.body.insertAdjacentHTML("beforeend", '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0w0bDxV0KfU7ck8KpKJwdxIJbPkDBY80&callback=ws.initMap;"></script>') }(),
    function() {
        var t = function(t) { this.svg = t, this.wealthsimpleLine = t.querySelector(".js-wealthsimple-line"), this.typicalLine = t.querySelector(".js-typical-line"), this.riskLevelSlider = $(".js-risk-level-slider"), this.portfolioTypeRadios = $(".js-performance-radio"), this.bubble = document.querySelector(".js-portfolio-performance-bubble"), this.riskLevel = parseInt(this.riskLevelSlider.val()), this.portfolioType = $(".js-performance-radio:checked").val(), this.parsedWsPerformance = {}, this.parsedTypicalPerformance = {}, this.min = 9e3, this.max = 11571 - this.min, this.riskLevelSlider.on("change", this.setRiskLevel.bind(this)), this.portfolioTypeRadios.on("change", this.setPortfolioType.bind(this)), this.svg.addEventListener("mousemove", this.updateBubble.bind(this), !1), this.setDimensions(), $.subscribe("historical-data/load", this.draw.bind(this)), ws.isMobile() || window.addEventListener("resize", ws.debounce(this.setDimensions.bind(this), 200), !1) };
        t.prototype = {
            setDimensions: function() { var t = this.svg.getBoundingClientRect();
                this.width = parseInt(t.width), window.innerHeight > 620 ? (this.wealthsimpleLine.setAttribute("stroke-width", 2), this.typicalLine.setAttribute("stroke-width", 2), this.height = parseInt(.45 * this.width)) : (this.wealthsimpleLine.setAttribute("stroke-width", 2), this.typicalLine.setAttribute("stroke-width", 2), this.height = this.width), this.svg.setAttribute("viewBox", "0 0 " + this.width + " " + this.height), (document.documentMode || /Edge/.test(navigator.userAgent)) && (this.svg.style.width = this.width + "px", this.svg.style.height = this.height + "px"), window.requestAnimationFrame(this.draw.bind(this)) },
            setRiskLevel: function() { this.riskLevel = parseInt(this.riskLevelSlider.val()), window.requestAnimationFrame(this.draw.bind(this)) },
            setPortfolioType: function() { this.portfolioType = $(".js-performance-radio:checked").val(), this.toggleAssumptionsText(this.portfolioType), window.requestAnimationFrame(this.draw.bind(this)) },
            toggleAssumptionsText: function(t) { "socially-responsible" === t ? ($("#sri-assumptions").removeClass("hide"), $("#regular-assumptions").addClass("hide")) : ($("#sri-assumptions").addClass("hide"), $("#regular-assumptions").removeClass("hide")) },
            historicalWsData: function() { return void 0 === this.parsedWsPerformance[this.portfolioType] && (this.parsedWsPerformance[this.portfolioType] = this.parseWsPortfolio(this.portfolioType)), this.parsedWsPerformance[this.portfolioType] || [] },
            historicalTypicalData: function() {
                return void 0 === this.parsedTypicalPerformance[this.portfolioType] && (this.parsedTypicalPerformance[this.portfolioType] = this.parseTypicalPortfolio(this.portfolioType)),
                    this.parsedTypicalPerformance[this.portfolioType] || []
            },
            parseWsPortfolio: function(t) { return "regular" === t && "undefined" != typeof wsTypicalPerformanceNav ? parseCSV(wsPerformanceNav) : "socially-responsible" === t && "undefined" != typeof wsSRINav ? parseCSV(wsSRINav) : void 0 },
            parseTypicalPortfolio: function(t) { return "regular" === t && "undefined" != typeof wsTypicalPerformanceNav ? parseCSV(wsTypicalPerformanceNav) : "socially-responsible" === t && "undefined" != typeof wsSRINav ? parseCSV(wsSRITypicalNav) : void 0 },
            pointAt: function(t, e, i) { var n = parseInt(this.width / i * e),
                    s = parseInt(this.height - this.height * (t - this.min) / this.max),
                    r = "L"; return 0 === e && (r = "M"), r + n + "," + s },
            line: function(t) { var e = this,
                    i = [2, 4, 8][this.riskLevel],
                    n = t.map(function(t) { return parseFloat(t[i]) }),
                    s = n.length; return n.map(function(t, i) { return e.pointAt(t, i, s) }).join(" ") },
            draw: function() { this.wealthsimpleLine.setAttribute("d", this.line(this.historicalWsData())), this.typicalLine.setAttribute("d", this.line(this.historicalTypicalData())), $(".js-risk-level-legend").removeClass("color-black"), $(".js-risk-level-legend").get(this.riskLevel).classList.add("color-black"), this.bubble.style.transform = "translate(-2000px, 0px)", this.drawLabels(this.historicalWsData(), 7) },
            drawLabels: function(t, e) { if (0 !== t.length) { var i = new Date(t[0][0]),
                        n = new Date(t[t.length - 1][0]),
                        s = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        r = (n.getTime() - i.getTime()) / 59;
                    $(".js-dot").each(function(t, n) { var a = new Date(i.getTime() + r * n);
                        n % e === 1 && (t.classList.add("labeled"), t.querySelector(".js-dot-label").innerText = s[a.getMonth()] + " " + a.getFullYear()) }) } },
            getDataAtPercent: function(t, e) { var i, n, s, r; return i = "ws" === e ? this.parsedWsPerformance[this.portfolioType] : this.parsedTypicalPerformance[this.portfolioType], n = Math.round(t * (i.length - 1)), s = [2, 4, 8][this.riskLevel], r = Math.round(i[n][s] / 100) - 100, r > 0 ? "+" + r + "%" : r + "%" },
            updateBubble: function(t) { var e, i = t.offsetX / this.width,
                    n = this.wealthsimpleLine.getPointAtLength(i * this.wealthsimpleLine.getTotalLength()),
                    s = this.getDataAtPercent(i, "ws"),
                    r = this.getDataAtPercent(i, "typical"),
                    a = window.locales; switch (window.currentLocale) {
                    case a.FR_CA:
                        e = "Investisseur traditionnel"; break;
                    default:
                        e = "Traditional investor" } this.bubble.innerHTML = '<div class="performance-graph-bubble-inner"><div class="percent-left"><div class="percent">' + s + '</div><div class="legend">Wealthsimple</div></div><div class="percent-right"><div class="percent">' + r + '</div><div class="legend">' + e + "</div></div></div>", this.bubble.style.transform = "translate(" + parseInt(n.x) + "px," + parseInt(n.y) + "px)" }
        }, $(".js-portfolio-performance-graph").each(function(e) { window.addEventListener("load", function() { new t(e) }, !1) })
    }(),
    function() { var t = function(t) { this.el = t, this.stuck = !1, this.y = 0, this.sections = $(".js-details-section"), this.sectionMenuItems = $(".js-sticky-details-link"), this.activeSection = null, window.addEventListener("scroll", this.onScroll.bind(this), !1), this.onScroll() };
        t.prototype = { onScroll: function() { var t; return this.stuck === !0 && window.pageYOffset < this.y ? void window.requestAnimationFrame(this.unstick.bind(this)) : (this.stuck === !1 && (t = $(this.el).offset().top - 20, window.pageYOffset > t && (this.y = t, this.sectionYValues = this.getSectionYValues(), window.requestAnimationFrame(this.stick.bind(this)))), void(this.stuck === !0 && this.markActiveSection(window.pageYOffset))) }, stick: function() { this.stuck = !0, this.el.classList.add("sticky-details-active"), this.markActiveSection(window.pageYOffset) }, unstick: function() { this.stuck = !1, this.el.classList.remove("sticky-details-active") }, getOffset: function(t) { return $(t).offset().top }, getSectionYValues: function() { return Array.prototype.slice.call(this.sections).map(this.getOffset) }, markActiveSection: function(t) { var e, i = 0; for (e = 0; e < this.sectionYValues.length && t + 200 > this.sectionYValues[e]; e++) i = e;
                i !== this.activeSection && (this.activeSection = i, this.sectionMenuItems.removeClass("sticky-details-link-active"), this.sectionMenuItems[i].classList.add("sticky-details-link-active")) } }, null !== document.querySelector(".js-sticky-details-nav") && window.addEventListener("load", function() { $(".js-sticky-details-nav").each(function(e) { ws.isDesktop() && new t(e) }) }, !1) }(),
    function() {
        function t(t) { return Math.round(10 * t) / 10 } var e = { US: { conservative: [15.5, 2.5, 5, 9, 3, 34.5, 3.5, 20.5, 6.5], balanced: [22, 4, 7, 13, 4, 26.5, 2.5, 16, 5], growth: [35.5, 6, 11.5, 20.5, 6.5, 12, 0, 8, 0] }, CA: { conservative: [7.5, 5, 0, 7.5, 42.5, 7.5, 7.5, 7.5, 15], balanced: [10, 7.5, 5, 7.5, 30, 10, 10, 5, 15], growth: [0, 15, 10, 22.5, 12.5, 0, 32.5, 0, 7.5] }, GB: { conservative: [12, 10.28, 3.2, 2.3, 2.22, 18.65, 30.8, 6.5, 7, 7], balanced: [24, 20.5, 6.39, 4.62, 4.43, 10.66, 17.6, 3.75, 4, 4], growth: [36, 30.83, 9.59, 6.93, 6.65, 2.66, 4.4, .94, 1, 1] } },
            i = function(t, e) { this.el = t, this.allocations = $(".js-allocation", this.el), window.addEventListener("load", function() { this.setProfile(e) }.bind(this), !1) };
        i.prototype = { setProfile: function(t) { this.height = $(this.el).height(), this.portfolio = t, this.allocations.each(this.setAllocation.bind(this)) }, setAllocation: function(i, n) { var s = e[window.currentJurisdiction] || e.CA,
                    r = s[this.portfolio],
                    a = r[n] / 100;
                ws.isDesktop() ? (i.style.height = Math.max(a * this.height * 1.5, 25) + "px", i.style.width = "auto", 0 === a && (i.style.height = "0")) : (i.style.width = 130 * a + 5 + "%", i.style.height = "auto", 0 === a && (i.style.width = "0")), i.setAttribute("percent", t(100 * a) + "%"), 0 === a && i.setAttribute("percent", "") } }, $(".js-portfolio-bar-chart").each(function(t) { var e = $(".js-portfolio-radio:checked").val(),
                n = new i(t, e);
            $(".js-portfolio-radio").on("change", function() { n.setProfile($(".js-portfolio-radio:checked").val()) }) }) }(),
    function() { var t = function(t) { switch (this.speed = 1200, this.area = t, this.toggleTop = this.area.querySelectorAll(".js-faq-toggle")[0], this.toggleBottom = this.area.querySelectorAll(".js-faq-toggle")[1], this.target = this.createTarget(), this.jurisdiction = window.currentJurisdiction, this.jurisdiction) {
                case "GB":
                    this.section = this.toggleTop.getAttribute("data-section-gb"); break;
                case "US":
                    this.section = this.toggleTop.getAttribute("data-section-us"); break;
                default:
                    this.section = this.toggleTop.getAttribute("data-section-ca") } this.text = this.area.querySelector(".js-faq-toggle-text"), this.texts = { open: this.toggleTop.innerText, close: this.text.getAttribute("data-close-text") }, this.loaded = !1, this.opened = !1, this.toggleTop.addEventListener("click", this.toggle.bind(this), !1), this.toggleBottom.addEventListener("click", this.toggle.bind(this), !1), $(this.area).on("click", ".js-article-header", this.toggleQuestion) };
        t.prototype = { toggleQuestion: function(t) { t.preventDefault(), this.nextElementSibling.classList.toggle("hide") }, toggle: function(t) { return t.preventDefault(), this.loaded === !1 ? void this.load() : void(this.opened = this.opened === !0 ? this.close() : this.open()) }, open: function() { return this.area.classList.remove("loading"), this.toggleTop.insertAdjacentElement("afterend", this.target), this.animate(0, this.targetHeight(), this.onOpened), this.area.classList.add("opening"), !0 }, close: function() { return this.area.classList.remove("open"), this.area.classList.add("closing"), this.text.innerText = this.texts.open, this.animate(this.targetHeight(), 0, this.onClosed), !1 }, load: function() { var t = new XMLHttpRequest;
                this.area.classList.add("loading"), t.onreadystatechange = this.onLoaded.bind(this), t.open("GET", "/inline-faq/" + this.section + "?jurisdiction=" + this.jurisdiction), t.send() }, createTarget: function() { var t = document.createElement("div"); return t.className = "faq-area-target", t }, targetHeight: function() { return this.area.clientHeight }, animate: function(t, e, i) { var n = this.target;
                n.style.height = t + "px", n.style.transition = "height " + this.speed + "ms cubic-bezier(0.580, 0.000, 0.290, 0.845)", window.requestAnimationFrame(function() { window.getComputedStyle(n).opacity, n.style.height = e + "px" }), setTimeout(i.bind(this), this.speed) }, onLoaded: function(t) { var e = t.target;
                e.readyState === XMLHttpRequest.DONE && 200 === e.status && (this.target.innerHTML = e.responseText, this.loaded = !0, this.opened = this.open()) }, onOpened: function() { this.text.innerText = this.texts.close, this.area.classList.remove("opening"), this.area.classList.add("open"), this.target.style.height = "auto" }, onClosed: function() { this.area.classList.remove("closing"), this.area.removeChild(this.target), this.target.style.height = "auto" } }; var e = document.querySelectorAll(".js-faq-area");
        Array.prototype.slice.call(e).forEach(function(e) { new t(e) }) }(),
    function() { 
        	var t = "n";
//        window.console && (console.log(t), console.log("We're looking for talented people like you to join our team!"),
 //   console.log("Interested? Visit https://www.wealthsimple.com/work-with-us")) }(),
//    function() { ws.isMobile() && null !== document.querySelector(".sub-nav-select") && styleSelect(".sub-nav-select") 
       // 	}();
        };