/**!
  *Jais Admin - Bootstrap Administrator Template .
  *Version:	1.0
  *Last change:	17/07/17 
  *Autor: Ravi Jaiswal
*/

!function(e) {
    return "function" === typeof define && define.amd ? define(["jquery"], function(n) {
        return e(n, window, document)
    }) : "object" === typeof exports ? module.exports = e(require("jquery"), window, document) : e(jQuery, window, document)
}(function(e, n, t) {
    "use strict";
    var i, a, s, o, l, r, c, f, d, u, h, p, v, g, m, y, C, b, T, x, S, w, k, E, I, _, N, A, H, O, $;
    k = {
        paneClass: "nano-pane",
        sliderClass: "nano-slider",
        contentClass: "nano-content",
        iOSNativeScrolling: !1,
        preventPageScrolling: !1,
        disableResize: !1,
        alwaysVisible: !1,
        flashDelay: 1500,
        sliderMinHeight: 20,
        sliderMaxHeight: null,
        documentContext: null,
        windowContext: null
    },
    b = "scrollbar",
    C = "scroll",
    d = "mousedown",
    u = "mouseenter",
    h = "mousemove",
    v = "mousewheel",
    p = "mouseup",
    y = "resize",
    l = "drag",
    r = "enter",
    x = "up",
    m = "panedown",
    s = "DOMMouseScroll",
    o = "down",
    S = "wheel",
    c = "keydown",
    f = "keyup",
    T = "touchmove",
    i = "Microsoft Internet Explorer" === n.navigator.appName && /msie 7./i.test(n.navigator.appVersion) && n.ActiveXObject,
    a = null,
    N = n.requestAnimationFrame,
    w = n.cancelAnimationFrame,
    H = t.createElement("div").style,
    $ = function() {
        var e, n, t, i, a, s;
        for (i = ["t", "webkitT", "MozT", "msT", "OT"],
        e = a = 0,
        s = i.length; s > a; e = ++a)
            if (t = i[e],
            n = i[e] + "ransform",
            n in H)
                return i[e].substr(0, i[e].length - 1);
        return !1
    }(),
    O = function(e) {
        return $ === !1 ? !1 : "" === $ ? e : $ + e.charAt(0).toUpperCase() + e.substr(1)
    }
    ,
    A = O("transform"),
    I = A !== !1,
    E = function() {
        var e, n, i;
        return e = t.createElement("div"),
        n = e.style,
        n.position = "absolute",
        n.width = "100px",
        n.height = "100px",
        n.overflow = C,
        n.top = "-9999px",
        t.body.appendChild(e),
        i = e.offsetWidth - e.clientWidth,
        t.body.removeChild(e),
        i
    }
    ,
    _ = function() {
        var e, t, i;
        return t = n.navigator.userAgent,
        (e = /(?=.+Mac OS X)(?=.+Firefox)/.test(t)) ? (i = /Firefox\/\d{2}\./.exec(t),
        i && (i = i[0].replace(/\D+/g, "")),
        e && +i > 23) : !1
    }
    ,
    g = function() {
        function c(i, s) {
            this.el = i,
            this.options = s,
            a || (a = E()),
            this.$el = e(this.el),
            this.doc = e(this.options.documentContext || t),
            this.win = e(this.options.windowContext || n),
            this.body = this.doc.find("body"),
            this.$content = this.$el.children("." + this.options.contentClass),
            this.$content.attr("tabindex", this.options.tabIndex || 0),
            this.content = this.$content[0],
            this.previousPosition = 0,
            this.options.iOSNativeScrolling && null != this.el.style.WebkitOverflowScrolling ? this.nativeScrolling() : this.generate(),
            this.createEvents(),
            this.addEvents(),
            this.reset()
        }
        return c.prototype.preventScrolling = function(e, n) {
            if (this.isActive)
                if (e.type === s)
                    (n === o && e.originalEvent.detail > 0 || n === x && e.originalEvent.detail < 0) && e.preventDefault();
                else if (e.type === v) {
                    if (!e.originalEvent || !e.originalEvent.wheelDelta)
                        return;
                    (n === o && e.originalEvent.wheelDelta < 0 || n === x && e.originalEvent.wheelDelta > 0) && e.preventDefault()
                }
        }
        ,
        c.prototype.nativeScrolling = function() {
            this.$content.css({
                WebkitOverflowScrolling: "touch"
            }),
            this.iOSNativeScrolling = !0,
            this.isActive = !0
        }
        ,
        c.prototype.updateScrollValues = function() {
            var e, n;
            e = this.content,
            this.maxScrollTop = e.scrollHeight - e.clientHeight,
            this.prevScrollTop = this.contentScrollTop || 0,
            this.contentScrollTop = e.scrollTop,
            n = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same",
            this.previousPosition = this.contentScrollTop,
            "same" !== n && this.$el.trigger("update", {
                position: this.contentScrollTop,
                maximum: this.maxScrollTop,
                direction: n
            }),
            this.iOSNativeScrolling || (this.maxSliderTop = this.paneHeight - this.sliderHeight,
            this.sliderTop = 0 === this.maxScrollTop ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop)
        }
        ,
        c.prototype.setOnScrollStyles = function() {
            var e;
            I ? (e = {},
            e[A] = "translate(0, " + this.sliderTop + "px)") : e = {
                top: this.sliderTop
            },
            N ? (w && this.scrollRAF && w(this.scrollRAF),
            this.scrollRAF = N(function(n) {
                return function() {
                    return n.scrollRAF = null,
                    n.slider.css(e)
                }
            }(this))) : this.slider.css(e)
        }
        ,
        c.prototype.createEvents = function() {
            this.events = {
                down: function(e) {
                    return function(n) {
                        return e.isBeingDragged = !0,
                        e.offsetY = n.pageY - e.slider.offset().top,
                        e.slider.is(n.target) || (e.offsetY = 0),
                        e.pane.addClass("active"),
                        e.doc.bind(h, e.events[l]).bind(p, e.events[x]),
                        e.body.bind(u, e.events[r]),
                        !1
                    }
                }(this),
                drag: function(e) {
                    return function(n) {
                        return e.sliderY = n.pageY - e.$el.offset().top - e.paneTop - (e.offsetY || .5 * e.sliderHeight),
                        e.scroll(),
                        e.contentScrollTop >= e.maxScrollTop && e.prevScrollTop !== e.maxScrollTop ? e.$el.trigger("scrollend") : 0 === e.contentScrollTop && 0 !== e.prevScrollTop && e.$el.trigger("scrolltop"),
                        !1
                    }
                }(this),
                up: function(e) {
                    return function() {
                        return e.isBeingDragged = !1,
                        e.pane.removeClass("active"),
                        e.doc.unbind(h, e.events[l]).unbind(p, e.events[x]),
                        e.body.unbind(u, e.events[r]),
                        !1
                    }
                }(this),
                resize: function(e) {
                    return function() {
                        e.reset()
                    }
                }(this),
                panedown: function(e) {
                    return function(n) {
                        return e.sliderY = (n.offsetY || n.originalEvent.layerY) - .5 * e.sliderHeight,
                        e.scroll(),
                        e.events.down(n),
                        !1
                    }
                }(this),
                scroll: function(e) {
                    return function(n) {
                        e.updateScrollValues(),
                        e.isBeingDragged || (e.iOSNativeScrolling || (e.sliderY = e.sliderTop,
                        e.setOnScrollStyles()),
                        null != n && (e.contentScrollTop >= e.maxScrollTop ? (e.options.preventPageScrolling && e.preventScrolling(n, o),
                        e.prevScrollTop !== e.maxScrollTop && e.$el.trigger("scrollend")) : 0 === e.contentScrollTop && (e.options.preventPageScrolling && e.preventScrolling(n, x),
                        0 !== e.prevScrollTop && e.$el.trigger("scrolltop"))))
                    }
                }(this),
                wheel: function(e) {
                    return function(n) {
                        var t;
                        return null != n ? (t = n.delta || n.wheelDelta || n.originalEvent && n.originalEvent.wheelDelta || -n.detail || n.originalEvent && -n.originalEvent.detail,
                        t && (e.sliderY += -t / 3),
                        e.scroll(),
                        !1) : void 0
                    }
                }(this),
                enter: function(e) {
                    return function(n) {
                        var t;
                        return e.isBeingDragged && 1 !== (n.buttons || n.which) ? (t = e.events)[x].apply(t, arguments) : void 0
                    }
                }(this)
            }
        }
        ,
        c.prototype.addEvents = function() {
            var e;
            this.removeEvents(),
            e = this.events,
            this.options.disableResize || this.win.bind(y, e[y]),
            this.iOSNativeScrolling || (this.slider.bind(d, e[o]),
            this.pane.bind(d, e[m]).bind("" + v + " " + s, e[S])),
            this.$content.bind("" + C + " " + v + " " + s + " " + T, e[C])
        }
        ,
        c.prototype.removeEvents = function() {
            var e;
            e = this.events,
            this.win.unbind(y, e[y]),
            this.iOSNativeScrolling || (this.slider.unbind(),
            this.pane.unbind()),
            this.$content.unbind("" + C + " " + v + " " + s + " " + T, e[C])
        }
        ,
        c.prototype.generate = function() {
            var e, t, i, s, o, l, r;
            return s = this.options,
            l = s.paneClass,
            r = s.sliderClass,
            e = s.contentClass,
            (o = this.$el.children("." + l)).length || o.children("." + r).length || this.$el.append('<div class="' + l + '"><div class="' + r + '" /></div>'),
            this.pane = this.$el.children("." + l),
            this.slider = this.pane.find("." + r),
            0 === a && _() ? (i = n.getComputedStyle(this.content, null).getPropertyValue("padding-right").replace(/[^0-9.]+/g, ""),
            t = {
                right: -14,
                paddingRight: +i + 14
            }) : a && (t = {
                right: -a
            },
            this.$el.addClass("has-scrollbar")),
            null != t && this.$content.css(t),
            this
        }
        ,
        c.prototype.restore = function() {
            this.stopped = !1,
            this.iOSNativeScrolling || this.pane.show(),
            this.addEvents()
        }
        ,
        c.prototype.reset = function() {
            var e, n, t, s, o, l, r, c, f, d, u, h;
            return this.iOSNativeScrolling ? void (this.contentHeight = this.content.scrollHeight) : (this.$el.find("." + this.options.paneClass).length || this.generate().stop(),
            this.stopped && this.restore(),
            e = this.content,
            s = e.style,
            o = s.overflowY,
            i && this.$content.css({
                height: this.$content.height()
            }),
            n = e.scrollHeight + a,
            d = parseInt(this.$el.css("max-height"), 10),
            d > 0 && (this.$el.height(""),
            this.$el.height(e.scrollHeight > d ? d : e.scrollHeight)),
            r = this.pane.outerHeight(!1),
            f = parseInt(this.pane.css("top"), 10),
            l = parseInt(this.pane.css("bottom"), 10),
            c = r + f + l,
            h = Math.round(c / n * r),
            h < this.options.sliderMinHeight ? h = this.options.sliderMinHeight : null != this.options.sliderMaxHeight && h > this.options.sliderMaxHeight && (h = this.options.sliderMaxHeight),
            o === C && s.overflowX !== C && (h += a),
            this.maxSliderTop = c - h,
            this.contentHeight = n,
            this.paneHeight = r,
            this.paneOuterHeight = c,
            this.sliderHeight = h,
            this.paneTop = f,
            this.slider.height(h),
            this.events.scroll(),
            this.pane.show(),
            this.isActive = !0,
            e.scrollHeight === e.clientHeight || this.pane.outerHeight(!0) >= e.scrollHeight && o !== C ? (this.pane.hide(),
            this.isActive = !1) : this.el.clientHeight === e.scrollHeight && o === C ? this.slider.hide() : this.slider.show(),
            this.pane.css({
                opacity: this.options.alwaysVisible ? 1 : "",
                visibility: this.options.alwaysVisible ? "visible" : ""
            }),
            t = this.$content.css("position"),
            ("static" === t || "relative" === t) && (u = parseInt(this.$content.css("right"), 10),
            u && this.$content.css({
                right: "",
                marginRight: u
            })),
            this)
        }
        ,
        c.prototype.scroll = function() {
            return this.isActive ? (this.sliderY = Math.max(0, this.sliderY),
            this.sliderY = Math.min(this.maxSliderTop, this.sliderY),
            this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop),
            this.iOSNativeScrolling || (this.updateScrollValues(),
            this.setOnScrollStyles()),
            this) : void 0
        }
        ,
        c.prototype.scrollBottom = function(e) {
            return this.isActive ? (this.$content.scrollTop(this.contentHeight - this.$content.height() - e).trigger(v),
            this.stop().restore(),
            this) : void 0
        }
        ,
        c.prototype.scrollTop = function(e) {
            return this.isActive ? (this.$content.scrollTop(+e).trigger(v),
            this.stop().restore(),
            this) : void 0
        }
        ,
        c.prototype.scrollTo = function(e) {
            return this.isActive ? (this.scrollTop(this.$el.find(e).get(0).offsetTop),
            this) : void 0
        }
        ,
        c.prototype.stop = function() {
            return w && this.scrollRAF && (w(this.scrollRAF),
            this.scrollRAF = null),
            this.stopped = !0,
            this.removeEvents(),
            this.iOSNativeScrolling || this.pane.hide(),
            this
        }
        ,
        c.prototype.destroy = function() {
            return this.stopped || this.stop(),
            !this.iOSNativeScrolling && this.pane.length && this.pane.remove(),
            i && this.$content.height(""),
            this.$content.removeAttr("tabindex"),
            this.$el.hasClass("has-scrollbar") && (this.$el.removeClass("has-scrollbar"),
            this.$content.css({
                right: ""
            })),
            this
        }
        ,
        c.prototype.flash = function() {
            return !this.iOSNativeScrolling && this.isActive ? (this.reset(),
            this.pane.addClass("flashed"),
            setTimeout(function(e) {
                return function() {
                    e.pane.removeClass("flashed")
                }
            }(this), this.options.flashDelay),
            this) : void 0
        }
        ,
        c
    }(),
    e.fn.nanoScroller = function(n) {
        return this.each(function() {
            var t, i;
            if ((i = this.nanoscroller) || (t = e.extend({}, k, n),
            this.nanoscroller = i = new g(this,t)),
            n && "object" === typeof n) {
                if (e.extend(i.options, n),
                null != n.scrollBottom)
                    return i.scrollBottom(n.scrollBottom);
                if (null != n.scrollTop)
                    return i.scrollTop(n.scrollTop);
                if (n.scrollTo)
                    return i.scrollTo(n.scrollTo);
                if ("bottom" === n.scroll)
                    return i.scrollBottom(0);
                if ("top" === n.scroll)
                    return i.scrollTop(0);
                if (n.scroll && n.scroll instanceof e)
                    return i.scrollTo(n.scroll);
                if (n.stop)
                    return i.stop();
                if (n.destroy)
                    return i.destroy();
                if (n.flash)
                    return i.flash()
            }
            return i.reset()
        })
    }
    ,
    e.fn.nanoScroller.Constructor = g
}),
!function(e, n) {
    if ("function" === typeof define && define.amd)
        define(["jquery"], n);
    else if ("undefined" != typeof exports)
        n(require("jquery"));
    else {
        var t = {
            exports: {}
        };
        n(e.jquery),
        e.metisMenu = t.exports
    }
}(this, function(e) {
    "use strict";
    function n(e) {
        return e && e.__esModule ? e : {
            "default": e
        }
    }
    function t(e, n) {
        if (!(e instanceof n))
            throw new TypeError("Cannot call a class as a function")
    }
    var i = (n(e),
    "function" === typeof Symbol && "symbol" === typeof Symbol.iterator ? function(e) {
        return typeof e
    }
    : function(e) {
        return e && "function" === typeof Symbol && e.constructor === Symbol ? "symbol" : typeof e
    }
    )
      , a = function() {
        function e(e, n) {
            for (var t = 0; t < n.length; t++) {
                var i = n[t];
                i.enumerable = i.enumerable || !1,
                i.configurable = !0,
                "value"in i && (i.writable = !0),
                Object.defineProperty(e, i.key, i)
            }
        }
        return function(n, t, i) {
            return t && e(n.prototype, t),
            i && e(n, i),
            n
        }
    }();
    !function(e) {
        function n() {
            return {
                bindType: g.end,
                delegateType: g.end,
                handle: function(n) {
                    return e(n.target).is(this) ? n.handleObj.handler.apply(this, arguments) : void 0
                }
            }
        }
        function s() {
            if (window.QUnit)
                return !1;
            var e = document.createElement("mm");
            for (var n in m)
                if (void 0 !== e.style[n])
                    return {
                        end: m[n]
                    };
            return !1
        }
        function o(n) {
            var t = this
              , i = !1;
            e(this).one(y.TRANSITION_END, function() {
                i = !0
            }),
            setTimeout(function() {
                i || y.triggerTransitionEnd(t)
            }, n)
        }
        function l() {
            g = s(),
            y.supportsTransitionEnd() && (e.event.special[y.TRANSITION_END] = n())
        }
        var r = "metisMenu"
          , c = "metisMenu"
          , f = "." + c
          , d = ".data-api"
          , u = e.fn[r]
          , h = 350
          , p = {
            toggle: !0,
            doubleTapToGo: !1,
            preventDefault: !0,
            activeClass: "active",
            collapseClass: "collapse",
            collapseInClass: "in",
            collapsingClass: "collapsing"
        }
          , v = {
            SHOW: "show" + f,
            SHOWN: "shown" + f,
            HIDE: "hide" + f,
            HIDDEN: "hidden" + f,
            CLICK_DATA_API: "click" + f + d
        }
          , g = !1
          , m = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        }
          , y = {
            TRANSITION_END: "mmTransitionEnd",
            triggerTransitionEnd: function(n) {
                e(n).trigger(g.end)
            },
            supportsTransitionEnd: function() {
                return Boolean(g)
            }
        };
        l();
        var C = function() {
            function n(e, i) {
                t(this, n),
                this._element = e,
                this._config = this._getConfig(i),
                this._transitioning = null,
                this.init()
            }
            return a(n, [{
                key: "init",
                value: function() {
                    var n = this;
                    e(this._element).find("li." + this._config.activeClass).has("ul").children("ul").attr("aria-expanded", !0).addClass(this._config.collapseClass + " " + this._config.collapseInClass),
                    e(this._element).find("li").not("." + this._config.activeClass).has("ul").children("ul").attr("aria-expanded", !1).addClass(this._config.collapseClass),
                    this._config.doubleTapToGo && e(this._element).find("li." + this._config.activeClass).has("ul").children("a").addClass("doubleTapToGo"),
                    e(this._element).find("li").has("ul").children("a").on(v.CLICK_DATA_API, function(t) {
                        var i = e(this)
                          , a = i.parent("li")
                          , s = a.children("ul");
                        return n._config.preventDefault && t.preventDefault(),
                        "true" !== i.attr("aria-disabled") ? (a.hasClass(n._config.activeClass) && !n._config.doubleTapToGo ? (i.attr("aria-expanded", !1),
                        n._hide(s)) : (n._show(s),
                        i.attr("aria-expanded", !0)),
                        n._config.onTransitionStart && n._config.onTransitionStart(t),
                        n._config.doubleTapToGo && n._doubleTapToGo(i) && "#" !== i.attr("href") && "" !== i.attr("href") ? (t.stopPropagation(),
                        void (document.location = i.attr("href"))) : void 0) : void 0
                    })
                }
            }, {
                key: "_show",
                value: function(n) {
                    if (!this._transitioning && !e(n).hasClass(this._config.collapsingClass)) {
                        var t = this
                          , i = e(n);
                        if (i.length) {
                            var a = e.Event(v.SHOW);
                            if (i.trigger(a),
                            !a.isDefaultPrevented()) {
                                i.parent("li").addClass(this._config.activeClass),
                                this._config.toggle && this._hide(i.parent("li").siblings().children("ul." + this._config.collapseInClass).attr("aria-expanded", !1)),
                                i.removeClass(this._config.collapseClass).addClass(this._config.collapsingClass).height(0),
                                this.setTransitioning(!0);
                                var s = function() {
                                    i.removeClass(t._config.collapsingClass).addClass(t._config.collapseClass + " " + t._config.collapseInClass).height("").attr("aria-expanded", !0),
                                    t.setTransitioning(!1),
                                    i.trigger(v.SHOWN)
                                };
                                if (!y.supportsTransitionEnd())
                                    return void s();
                                i.height(i[0].scrollHeight).one(y.TRANSITION_END, s),
                                o(h)
                            }
                        }
                    }
                }
            }, {
                key: "_hide",
                value: function(n) {
                    if (!this._transitioning && e(n).hasClass(this._config.collapseInClass)) {
                        var t = this
                          , i = e(n);
                        if (i.length) {
                            var a = e.Event(v.HIDE);
                            if (i.trigger(a),
                            !a.isDefaultPrevented()) {
                                i.parent("li").removeClass(this._config.activeClass),
                                i.height(i.height())[0].offsetHeight,
                                i.addClass(this._config.collapsingClass).removeClass(this._config.collapseClass).removeClass(this._config.collapseInClass),
                                this.setTransitioning(!0);
                                var s = function() {
                                    t._transitioning && t._config.onTransitionEnd && t._config.onTransitionEnd(),
                                    t.setTransitioning(!1),
                                    i.trigger(v.HIDDEN),
                                    i.removeClass(t._config.collapsingClass).addClass(t._config.collapseClass).attr("aria-expanded", !1)
                                };
                                if (!y.supportsTransitionEnd())
                                    return void s();
                                0 === i.height() || "none" === i.css("display") ? s() : i.height(0).one(y.TRANSITION_END, s),
                                o(h)
                            }
                        }
                    }
                }
            }, {
                key: "_doubleTapToGo",
                value: function(n) {
                    return n.hasClass("doubleTapToGo") ? (n.removeClass("doubleTapToGo"),
                    !0) : n.parent().children("ul").length ? (e(this._element).find(".doubleTapToGo").removeClass("doubleTapToGo"),
                    n.addClass("doubleTapToGo"),
                    !1) : void 0
                }
            }, {
                key: "setTransitioning",
                value: function(e) {
                    this._transitioning = e
                }
            }, {
                key: "_getConfig",
                value: function(n) {
                    return n = e.extend({}, p, n)
                }
            }], [{
                key: "_jQueryInterface",
                value: function(t) {
                    return this.each(function() {
                        var a = e(this)
                          , s = a.data(c)
                          , o = e.extend({}, p, a.data(), "object" === ("undefined" === typeof t ? "undefined" : i(t)) && t);
                        if (s || (s = new n(this,o),
                        a.data(c, s)),
                        "string" === typeof t) {
                            if (void 0 === s[t])
                                throw new Error('No method named "' + t + '"');
                            s[t]()
                        }
                    })
                }
            }]),
            n
        }();
        return e.fn[r] = C._jQueryInterface,
        e.fn[r].Constructor = C,
        e.fn[r].noConflict = function() {
            return e.fn[r] = u,
            C._jQueryInterface
        }
        ,
        C
    }(jQuery)
}),
!function(e) {
    "use strict";
    e(document).ready(function() {
        e(document).trigger("jais.ready")
    }),
    e(document).on("jais.ready", function() {
        var n = e(".add-tooltip");
        n.length && n.tooltip();
        var t = e(".add-popover");
        t.length && t.popover(),
        e("#navbar-container .navbar-top-links").on("shown.bs.dropdown", ".dropdown", function() {
            e(this).find(".nano").nanoScroller({
                preventPageScrolling: !0
            })
        }),
        e.jaisNav("bind"),
        e.jaisAside("bind")
    })
}(jQuery),
!function(e) {
    "use strict";
    var n = null
      , t = function(e) {
        {
            var n = e.find(".mega-dropdown-toggle");
            e.find(".mega-dropdown-menu")
        }
        n.on("click", function(n) {
            n.preventDefault(),
            e.toggleClass("open")
        })
    }
      , i = {
        toggle: function() {
            return this.toggleClass("open"),
            null
        },
        show: function() {
            return this.addClass("open"),
            null
        },
        hide: function() {
            return this.removeClass("open"),
            null
        }
    };
    e.fn.jaisMega = function(n) {
        var a = !1;
        return this.each(function() {
            i[n] ? a = i[n].apply(e(this).find("input"), Array.prototype.slice.call(arguments, 1)) : "object" != typeof n && n || t(e(this))
        }),
        a
    }
    ,
    e(document).on("jais.ready", function() {
        n = e(".mega-dropdown"),
        n.length && (n.jaisMega(),
        e("html").on("click", function(t) {
            e(t.target).closest(".mega-dropdown").length || n.removeClass("open")
        }))
    })
}(jQuery),
!function(e) {
    "use strict";
    e(document).on("jais.ready", function() {
        var n = e('[data-dismiss="panel"]');
        n.length ? n.one("click", function(n) {
            n.preventDefault();
            var t = e(this).parents(".panel");
            t.addClass("remove").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
                "opacity" === e.originalEvent.propertyName && t.remove()
            })
        }) : n = null
    })
}(jQuery),
!function(e) {
    "use strict";
    e(document).one("jais.ready", function() {
        function o() {
            t.scrollTop() > s && !a ? (n.addClass("in").stop(!0, !0).css({
                animation: "none"
            }).show(0).css({
                animation: "jellyIn .8s"
            }),
            a = !0) : t.scrollTop() < s && a && (n.removeClass("in"),
            a = !1)
        }
        var n = e(".scroll-top")
          , t = e(window)
          , i = function() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        }();
        if (n.length && !i) {
            var a = !1
              , s = 250;
            o(),
            t.scroll(o),
            n.on("click", function(n) {
                n.preventDefault(),
                e("body, html").animate({
                    scrollTop: 0
                }, 500)
            })
        } else
            n = null,
            t = null;
        i = null
    })
}(jQuery),
!function(e) {
    "use strict";
    var n = {
        displayIcon: !0,
        iconColor: "text-dark",
        iconClass: "fa fa-refresh fa-spin fa-2x",
        title: "",
        desc: ""
    }
      , t = function() {
        return (65536 * (1 + Math.random()) | 0).toString(16).substring(1)
    }
      , i = {
        show: function(n) {
            var i = e(n.attr("data-target"))
              , a = "jais-overlay-" + t() + t() + "-" + t()
              , s = e('<div id="' + a + '" class="panel-overlay"></div>');
            return n.prop("disabled", !0).data("jaisOverlay", a),
            i.addClass("panel-overlay-wrap"),
            s.appendTo(i).html(n.data("overlayTemplate")),
            null
        },
        hide: function(n) {
            var t = e(n.attr("data-target"))
              , i = e("#" + n.data("jaisOverlay"));
            return i.length && (n.prop("disabled", !1),
            t.removeClass("panel-overlay-wrap"),
            i.hide().remove()),
            null
        }
    }
      , a = function(t, i) {
        if (t.data("overlayTemplate"))
            return null;
        var a = e.extend({}, n, i)
          , s = a.displayIcon ? '<span class="panel-overlay-icon ' + a.iconColor + '"><i class="' + a.iconClass + '"></i></span>' : "";
        return t.data("overlayTemplate", '<div class="panel-overlay-content pad-all unselectable">' + s + '<h4 class="panel-overlay-title">' + a.title + "</h4><p>" + a.desc + "</p></div>"),
        null
    };
    e.fn.jaisOverlay = function(n) {
        return i[n] ? i[n](this) : "object" != typeof n && n ? null : this.each(function() {
            a(e(this), n)
        })
    }
}(jQuery),
!function(e) {
    "use strict";
    var n, i, a, s, t = {}, o = !1, l = function() {
        var e = document.body || document.documentElement
          , n = e.style
          , t = void 0 !== n.transition || void 0 !== n.WebkitTransition;
        return t
    }();
    e.jaisNoty = function(r) {
        {
            var h, c = {
                type: "primary",
                icon: "",
                title: "",
                message: "",
                closeBtn: !0,
                container: "page",
                floating: {
                    position: "top-right",
                    animationIn: "jellyIn",
                    animationOut: "fadeOut"
                },
                html: null,
                focus: !0,
                timer: 0,
                onShow: function() {},
                onShown: function() {},
                onHide: function() {},
                onHidden: function() {}
            }, f = e.extend({}, c, r), d = e('<div class="alert-wrap"></div>'), u = function() {
                var e = "";
                return r && r.icon && (e = '<div class="media-left alert-icon"><i class="' + f.icon + '"></i></div>'),
                e
            }, p = function() {
                var e = f.closeBtn ? '<button class="close" type="button"><i class="pci-cross pci-circle"></i></button>' : ""
                  , n = '<div class="alert alert-' + f.type + '" role="alert">' + e + '<div class="media">';
                return f.html ? n + f.html + "</div></div>" : n + u() + '<div class="media-body"><h4 class="alert-title">' + f.title + '</h4><p class="alert-message">' + f.message + "</p></div></div>"
            }(), v = function() {
                return f.onHide(),
                "floating" === f.container && f.floating.animationOut && (d.removeClass(f.floating.animationIn).addClass(f.floating.animationOut),
                l || (f.onHidden(),
                d.remove())),
                d.removeClass("in").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
                    "max-height" === e.originalEvent.propertyName && (f.onHidden(),
                    d.remove())
                }),
                clearInterval(h),
                null
            }, g = function(n) {
                e("body, html").animate({
                    scrollTop: n
                }, 300, function() {
                    d.addClass("in")
                })
            };
            !function() {
                if (f.onShow(),
                "page" === f.container)
                    n || (n = e('<div id="page-alert"></div>'),
                    s && s.length || (s = e("#content-container")),
                    s.prepend(n)),
                    i = n,
                    f.focus && g(0);
                else if ("floating" === f.container)
                    t[f.floating.position] || (t[f.floating.position] = e('<div id="floating-' + f.floating.position + '" class="floating-container"></div>'),
                    a && s.length || (a = e("#container")),
                    a.append(t[f.floating.position])),
                    i = t[f.floating.position],
                    f.floating.animationIn && d.addClass("in animated " + f.floating.animationIn),
                    f.focus = !1;
                else {
                    var l = e(f.container)
                      , r = l.children(".panel-alert")
                      , c = l.children(".panel-heading");
                    if (!l.length)
                        return o = !1,
                        !1;
                    r.length ? i = r : (i = e('<div class="panel-alert"></div>'),
                    c.length ? c.after(i) : l.prepend(i)),
                    f.focus && g(l.offset().top - 30)
                }
                return o = !0,
                !1
            }()
        }
        if (o) {
            if (i.append(d.html(p)),
            d.find('[data-dismiss="noty"]').one("click", v),
            f.closeBtn && d.find(".close").one("click", v),
            f.timer > 0 && (h = setInterval(v, f.timer)),
            !f.focus)
                var y = setInterval(function() {
                    d.addClass("in"),
                    clearInterval(y)
                }, 200);
            d.one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(e) {
                "max-height" != e.originalEvent.propertyName && "animationend" != e.type || !o || (f.onShown(),
                o = !1)
            })
        }
    }
}(jQuery),
!function(e) {
    "use strict";
    var n = {
        dynamicMode: !0,
        selectedOn: null,
        onChange: null
    }
      , t = function(t, i) {
        var a = e.extend({}, n, i)
          , s = t.find(".lang-selected")
          , o = s.parent(".lang-selector").siblings(".dropdown-menu")
          , l = o.find("a")
          , r = l.filter(".active").find(".lang-id").text()
          , c = l.filter(".active").find(".lang-name").text()
          , f = function(e) {
            l.removeClass("active"),
            e.addClass("active"),
            s.html(e.html()),
            r = e.find(".lang-id").text(),
            c = e.find(".lang-name").text(),
            t.trigger("onChange", [{
                id: r,
                name: c
            }]),
            "function" === typeof a.onChange && a.onChange.call(this, {
                id: r,
                name: c
            })
        };
        l.on("click", function(n) {
            a.dynamicMode && (n.preventDefault(),
            n.stopPropagation()),
            t.dropdown("toggle"),
            f(e(this))
        }),
        a.selectedOn && f(e(a.selectedOn))
    }
      , i = {
        getSelectedID: function() {
            return e(this).find(".lang-id").text()
        },
        getSelectedName: function() {
            return e(this).find(".lang-name").text()
        },
        getSelected: function() {
            var n = e(this);
            return {
                id: n.find(".lang-id").text(),
                name: n.find(".lang-name").text()
            }
        },
        setDisable: function() {
            return e(this).addClass("disabled"),
            null
        },
        setEnable: function() {
            return e(this).removeClass("disabled"),
            null
        }
    };
    e.fn.jaisLanguage = function(n) {
        var a = !1;
        return this.each(function() {
            i[n] ? a = i[n].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof n && n || t(e(this), n)
        }),
        a
    }
}(jQuery),
!function(e) {
    "use strict";
    var n, t = function(n) {
        if (!n.data("jais-check")) {
            n.data("jais-check", !0),
            n.text().trim().length ? n.addClass("form-text") : n.removeClass("form-text");
            var t = n.find("input")[0]
              , i = t.name
              , a = function() {
                return "radio" === t.type && i ? e(".form-radio").not(n).find("input").filter('input[name="' + i + '"]').parent() : !1
            }()
              , s = function() {
                "radio" === t.type && a.length && a.each(function() {
                    var n = e(this);
                    n.hasClass("active") && n.trigger("jais.ch.unchecked"),
                    n.removeClass("active")
                }),
                t.checked ? n.addClass("active").trigger("jais.ch.checked") : n.removeClass("active").trigger("jais.ch.unchecked")
            };
            t.checked ? n.addClass("active") : n.removeClass("active"),
            e(t).on("change", s)
        }
    }, i = {
        isChecked: function() {
            return this[0].checked
        },
        toggle: function() {
            return this[0].checked = !this[0].checked,
            this.trigger("change"),
            null
        },
        toggleOn: function() {
            return this[0].checked || (this[0].checked = !0,
            this.trigger("change")),
            null
        },
        toggleOff: function() {
            return this[0].checked && "checkbox" === this[0].type && (this[0].checked = !1,
            this.trigger("change")),
            null
        }
    }, a = function() {
        n = e(".form-checkbox, .form-radio"),
        n.length && n.jaisCheck()
    };
    e.fn.jaisCheck = function(n) {
        var a = !1;
        return this.each(function() {
            i[n] ? a = i[n].apply(e(this).find("input"), Array.prototype.slice.call(arguments, 1)) : "object" != typeof n && n || t(e(this))
        }),
        a
    }
    ,
    e(document).on("jais.ready", a).on("change", ".form-checkbox, .form-radio", a).on("change", ".btn-file :file", function() {
        var n = e(this)
          , t = n.get(0).files ? n.get(0).files.length : 1
          , i = n.val().replace(/\\/g, "/").replace(/.*\//, "")
          , a = function() {
            try {
                return n[0].files[0].size
            } catch (e) {
                return "Nan"
            }
        }()
          , s = function() {
            if ("Nan" === a)
                return "Unknown";
            var e = Math.floor(Math.log(a) / Math.log(1024));
            return 1 * (a / Math.pow(1024, e)).toFixed(2) + " " + ["B", "kB", "MB", "GB", "TB"][e]
        }();
        n.trigger("fileselect", [t, i, s])
    })
}(jQuery),
!function(e) {
    e(document).on("jais.ready", function() {
        var n = e("#mainnav-shortcut");
        n.length ? n.find("li").each(function() {
            var n = e(this);
            n.popover({
                animation: !1,
                trigger: "hover",
                placement: "bottom",
                container: "#mainnav-container",
                viewport: "#mainnav-container",
                template: '<div class="popover mainnav-shortcut"><div class="arrow"></div><div class="popover-content"></div>'
            })
        }) : n = null
    })
}(jQuery),
!function(e, n) {
    var t = {};
    t.eventName = "resizeEnd",
    t.delay = 250,
    t.poll = function() {
        var i = e(this)
          , a = i.data(t.eventName);
        a.timeoutId && n.clearTimeout(a.timeoutId),
        a.timeoutId = n.setTimeout(function() {
            i.trigger(t.eventName)
        }, t.delay)
    }
    ,
    e.event.special[t.eventName] = {
        setup: function() {
            var n = e(this);
            n.data(t.eventName, {}),
            n.on("resize", t.poll)
        },
        teardown: function() {
            var i = e(this)
              , a = i.data(t.eventName);
            a.timeoutId && n.clearTimeout(a.timeoutId),
            i.removeData(t.eventName),
            i.off("resize", t.poll)
        }
    },
    e.fn[t.eventName] = function(e, n) {
        return arguments.length > 0 ? this.on(t.eventName, null, e, n) : this.trigger(t.eventName)
    }
}(jQuery, this),
!function(e) {
    "use strict";
    var n = null
      , t = null
      , i = null
      , a = null
      , s = null
      , o = null
      , l = !1
      , r = !1
      , c = null
      , f = null
      , u = e(window)
      , h = !1
      , p = function() {
        var n, i = e('#mainnav-menu > li > a, #mainnav-menu-wrap .mainnav-widget a[data-toggle="menu-widget"]');
        i.each(function() {
            var s = e(this)
              , o = s.children(".menu-title")
              , l = s.siblings(".collapse")
              , r = e(s.attr("data-target"))
              , c = r.length ? r.parent() : null
              , f = null
              , d = null
              , u = null
              , h = null
              , y = (s.outerHeight() - s.height() / 4,
            function() {
                return r.length && s.on("click", function(e) {
                    e.preventDefault()
                }),
                l.length ? (s.on("click", function(e) {
                    e.preventDefault()
                }).parent("li").removeClass("active"),
                !0) : !1
            }())
              , C = null
              , b = function(e) {
                clearInterval(C),
                C = setInterval(function() {
                    e.nanoScroller({
                        preventPageScrolling: !0,
                        alwaysVisible: !0
                    }),
                    clearInterval(C)
                }, 100)
            };
            e(document).on("click", function(n) {
                e(n.target).closest("#mainnav-container").length || s.removeClass("hover").popover("hide")
            }),
            e("#mainnav-menu-wrap > .nano").on("update", function() {
                s.removeClass("hover").popover("hide")
            }),
            s.popover({
                animation: !1,
                trigger: "manual",
                container: "#mainnav",
                viewport: s,
                html: !0,
                title: function() {
                    return y ? o.html() : null
                },
                content: function() {
                    var n;
                    return y ? (n = e('<div class="sub-menu"></div>'),
                    l.addClass("pop-in").wrap('<div class="nano-content"></div>').parent().appendTo(n)) : r.length ? (n = e('<div class="sidebar-widget-popover"></div>'),
                    r.wrap('<div class="nano-content"></div>').parent().appendTo(n)) : n = '<span class="single-content">' + o.html() + "</span>",
                    n
                },
                template: '<div class="popover menu-popover"><h4 class="popover-title"></h4><div class="popover-content"></div></div>'
            }).on("show.bs.popover", function() {
                if (!f) {
                    if (f = s.data("bs.popover").tip(),
                    d = f.find(".popover-title"),
                    u = f.children(".popover-content"),
                    !y && 0 === r.length)
                        return;
                    h = u.children(".sub-menu")
                }
                !y && 0 === r.length
            }).on("shown.bs.popover", function() {
                if (!y && 0 === r.length) {
                    var n = 0 - .5 * s.outerHeight();
                    return void u.css({
                        "margin-top": n + "px",
                        width: "auto"
                    })
                }
                var i = parseInt(f.css("top"), 10)
                  , o = s.outerHeight()
                  , l = function() {
                    return t.hasClass("mainnav-fixed") ? e(window).outerHeight() - i - o : e(document).height() - i - o
                }()
                  , c = u.find(".nano-content").children().css("height", "auto").outerHeight();
                u.find(".nano-content").children().css("height", ""),
                i > l ? (d.length && !d.is(":visible") && (o = Math.round(0 - .5 * o)),
                i -= 5,
                u.css({
                    top: "",
                    bottom: o + "px",
                    height: i
                }).children().addClass("nano").css({
                    width: "100%"
                }).nanoScroller({
                    preventPageScrolling: !0
                }),
                b(u.find(".nano"))) : (!t.hasClass("navbar-fixed") && a.hasClass("affix-top") && (l -= 50),
                c > l ? ((t.hasClass("navbar-fixed") || a.hasClass("affix-top")) && (l -= o + 5),
                l -= 5,
                u.css({
                    top: o + "px",
                    bottom: "",
                    height: l
                }).children().addClass("nano").css({
                    width: "100%"
                }).nanoScroller({
                    preventPageScrolling: !0
                }),
                b(u.find(".nano"))) : (d.length && !d.is(":visible") && (o = Math.round(0 - .5 * o)),
                u.css({
                    top: o + "px",
                    bottom: "",
                    height: "auto"
                }))),
                d.length && d.css("height", s.outerHeight()),
                u.on("click", function() {
                    u.find(".nano-pane").hide(),
                    b(u.find(".nano"))
                })
            }).on("click", function() {
                t.hasClass("mainnav-sm") && (i.popover("hide"),
                s.addClass("hover").popover("show"))
            }).hover(function() {
                i.popover("hide"),
                s.addClass("hover").popover("show").one("hidden.bs.popover", function() {
                    s.removeClass("hover"),
                    y ? l.removeAttr("style").appendTo(s.parent()) : r.length && r.appendTo(c),
                    clearInterval(n)
                })
            }, function() {
                clearInterval(n),
                n = setInterval(function() {
                    f && (f.one("mouseleave", function() {
                        s.removeClass("hover").popover("hide")
                    }),
                    f.is(":hover") || s.removeClass("hover").popover("hide")),
                    clearInterval(n)
                }, 100)
            })
        }),
        r = !0
    }
      , v = function() {
        var t = e("#mainnav-menu").find(".collapse");
        t.length && t.each(function() {
            var n = e(this);
            n.hasClass("in") ? n.parent("li").addClass("active") : n.parent("li").removeClass("active")
        }),
        n.popover("destroy").unbind("mouseenter mouseleave"),
        r = !1
    }
      , g = function() {
        var i, n = t.width();
        i = 740 >= n ? "xs" : n > 740 && 992 > n ? "sm" : n >= 992 && 1200 >= n ? "md" : "lg",
        f != i && (f = i,
        c = i,
        "sm" === c && t.hasClass("mainnav-lg") ? e.jaisNav("collapse") : "xs" === c && t.hasClass("mainnav-lg") && t.removeClass("mainnav-sm mainnav-out mainnav-lg").addClass("mainnav-sm"))
    }
      , m = function() {
        a.css(t.hasClass("boxed-layout") && t.hasClass("mainnav-fixed") && i.length ? {
            left: i.offset().left + "px"
        } : {
            left: ""
        })
    }
      , y = function() {
        if (!h)
            try {
                a.jaisAffix("update")
            } catch (e) {
                h = !0
            }
    }
      , C = function() {
        return y(),
        v(),
        g(),
        m(),
        ("collapse" === l || t.hasClass("mainnav-sm")) && (t.removeClass("mainnav-in mainnav-out mainnav-lg"),
        p()),
        s = e("#mainnav").height(),
        l = !1,
        null
    }
      , T = {
        revealToggle: function() {
            t.hasClass("reveal") || t.addClass("reveal"),
            t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"),
            r && v()
        },
        revealIn: function() {
            t.hasClass("reveal") || t.addClass("reveal"),
            t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"),
            r && v()
        },
        revealOut: function() {
            t.hasClass("reveal") || t.addClass("reveal"),
            t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"),
            r && v()
        },
        slideToggle: function() {
            t.hasClass("slide") || t.addClass("slide"),
            t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"),
            r && v()
        },
        slideIn: function() {
            t.hasClass("slide") || t.addClass("slide"),
            t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"),
            r && v()
        },
        slideOut: function() {
            t.hasClass("slide") || t.addClass("slide"),
            t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"),
            r && v()
        },
        pushToggle: function() {
            t.toggleClass("mainnav-in mainnav-out").removeClass("mainnav-lg mainnav-sm"),
            t.hasClass("mainnav-in mainnav-out") && t.removeClass("mainnav-in"),
            r && v()
        },
        pushIn: function() {
            t.addClass("mainnav-in").removeClass("mainnav-out mainnav-lg mainnav-sm"),
            r && v()
        },
        pushOut: function() {
            t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"),
            r && v()
        },
        colExpToggle: function() {
            return t.hasClass("mainnav-lg mainnav-sm") && t.removeClass("mainnav-lg"),
            t.toggleClass("mainnav-lg mainnav-sm").removeClass("mainnav-in mainnav-out"),
            u.trigger("resize")
        },
        collapse: function() {
            return t.addClass("mainnav-sm").removeClass("mainnav-lg mainnav-in mainnav-out"),
            l = "collapse",
            u.trigger("resize")
        },
        expand: function() {
            return t.removeClass("mainnav-sm mainnav-in mainnav-out").addClass("mainnav-lg"),
            u.trigger("resize")
        },
        togglePosition: function() {
            t.toggleClass("mainnav-fixed"),
            y()
        },
        fixedPosition: function() {
            t.addClass("mainnav-fixed"),
            o.nanoScroller({
                preventPageScrolling: !0
            }),
            y()
        },
        staticPosition: function() {
            t.removeClass("mainnav-fixed"),
            o.nanoScroller({
                preventPageScrolling: !1
            }),
            y()
        },
        update: C,
        refresh: C,
        getScreenSize: function() {
            return f
        },
        bind: function() {
            var l = e("#mainnav-menu");
            if (0 === l.length)
                return !1;
            n = e('#mainnav-menu > li > a, #mainnav-menu-wrap .mainnav-widget a[data-toggle="menu-widget"]'),
            t = e("#container"),
            i = t.children(".boxed"),
            a = e("#mainnav-container"),
            s = e("#mainnav").height();
            var r = null;
            a.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(n) {
                (r || n.target === a[0]) && (clearInterval(r),
                r = setInterval(function() {
                    e(window).trigger("resize"),
                    clearInterval(r),
                    r = null
                }, 300))
            });
            var c = e(".mainnav-toggle");
            c.length && c.on("click", function(n) {
                n.preventDefault(),
                n.stopPropagation(),
                e.jaisNav(c.hasClass("push") ? "pushToggle" : c.hasClass("slide") ? "slideToggle" : c.hasClass("reveal") ? "revealToggle" : "colExpToggle")
            });
            try {
                l.metisMenu({
                    toggle: !0
                })
            } catch (f) {
                console.error(f.message)
            }
            try {
                o = e("#mainnav-menu-wrap > .nano"),
                o.length && o.nanoScroller({
                    preventPageScrolling: t.hasClass("mainnav-fixed") ? !0 : !1
                })
            } catch (f) {
                console.error(f.message)
            }
            e(window).on("resizeEnd", C).trigger("resize")
        }
    };
    e.jaisNav = function(e, n) {
        if (T[e]) {
            ("colExpToggle" === e || "expand" === e || "collapse" === e) && ("xs" === c && "collapse" === e ? e = "pushOut" : "xs" != c && "sm" != c || "colExpToggle" != e && "expand" != e || !t.hasClass("mainnav-sm") || (e = "pushIn"));
            var i = T[e].apply(this, Array.prototype.slice.call(arguments, 1));
            if ("bind" != e && C(),
            n)
                return n();
            if (i)
                return i
        }
        return null
    }
    ,
    e.fn.isOnScreen = function() {
        var e = {
            top: u.scrollTop(),
            left: u.scrollLeft()
        };
        e.right = e.left + u.width(),
        e.bottom = e.top + u.height();
        var n = this.offset();
        return n.right = n.left + this.outerWidth(),
        n.bottom = n.top + this.outerHeight(),
        !(e.right < n.left || e.left > n.right || e.bottom < n.bottom || e.top > n.top)
    }
}(jQuery),
!function(e) {
    "use strict";
    var t, n = null, i = e(window), a = {
        toggleHideShow: function() {
            t.toggleClass("aside-in"),
            i.trigger("resize"),
            t.hasClass("aside-in") && s()
        },
        show: function() {
            t.addClass("aside-in"),
            i.trigger("resize"),
            s()
        },
        hide: function() {
            t.removeClass("aside-in"),
            i.trigger("resize")
        },
        toggleAlign: function() {
            t.toggleClass("aside-left"),
            c()
        },
        alignLeft: function() {
            t.addClass("aside-left"),
            c()
        },
        alignRight: function() {
            t.removeClass("aside-left"),
            c()
        },
        togglePosition: function() {
            t.toggleClass("aside-fixed"),
            c()
        },
        fixedPosition: function() {
            t.addClass("aside-fixed"),
            c()
        },
        staticPosition: function() {
            t.removeClass("aside-fixed"),
            c()
        },
        toggleTheme: function() {
            t.toggleClass("aside-bright")
        },
        brightTheme: function() {
            t.addClass("aside-bright")
        },
        darkTheme: function() {
            t.removeClass("aside-bright")
        },
        update: function() {
            c()
        },
        bind: function() {
            f()
        }
    }, s = function() {
        var n = t.width();
        t.hasClass("mainnav-in") && n > 740 && (n > 740 && 992 > n ? e.jaisNav("collapse") : t.removeClass("mainnav-in mainnav-lg mainnav-sm").addClass("mainnav-out"))
    }, o = e("#container").children(".boxed"), c = function() {
        try {
            n.jaisAffix("update")
        } catch (e) {}
        var i = {};
        i = t.hasClass("boxed-layout") && t.hasClass("aside-fixed") && o.length ? t.hasClass("aside-left") ? {
            "-ms-transform": "translateX(" + o.offset().left + "px)",
            "-webkit-transform": "translateX(" + o.offset().left + "px)",
            transform: "translateX(" + o.offset().left + "px)"
        } : {
            "-ms-transform": "translateX(" + (0 - o.offset().left) + "px)",
            "-webkit-transform": "translateX(" + (0 - o.offset().left) + "px)",
            transform: "translateX(" + (0 - o.offset().left) + "px)"
        } : {
            "-ms-transform": "",
            "-webkit-transform": "",
            transform: "",
            right: ""
        },
        n.css(i)
    }, f = function() {
        if (n = e("#aside-container"),
        n.length) {
            t = e("#container"),
            i.on("resizeEnd", c),
            n.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
                e.target === n[0] && i.trigger("resize")
            }),
            n.find(".nano").nanoScroller({
                preventPageScrolling: t.hasClass("aside-fixed") ? !0 : !1
            });
            var a = e(".aside-toggle");
            a.length && a.on("click", function(n) {
                n.preventDefault(),
                e.jaisAside("toggleHideShow")
            })
        }
    };
    e.jaisAside = function(e, n) {
        return a[e] && (a[e].apply(this, Array.prototype.slice.call(arguments, 1)),
        n) ? n() : null
    }
}(jQuery),
!function(e) {
    "use strict";
    var n, t, i, a, s, o, l = function(e) {
        clearInterval(o),
        o = setInterval(function() {
            e[0] === n[0] ? a.nanoScroller({
                flash: !0,
                preventPageScrolling: i.hasClass("mainnav-fixed") ? !0 : !1
            }) : e[0] === t[0] && s.nanoScroller({
                preventPageScrolling: i.hasClass("aside-fixed") ? !0 : !1
            }),
            clearInterval(o),
            o = null
        }, 500)
    }, r = function() {
        i = e("#container"),
        n = e("#mainnav-container"),
        t = e("#aside-container"),
        a = e("#mainnav-menu-wrap > .nano"),
        s = e("#aside > .nano"),
        n.length && n.jaisAffix({
            className: "mainnav-fixed"
        }),
        t.length && t.jaisAffix({
            className: "aside-fixed"
        })
    };
    e.fn.jaisAffix = function(n) {
        return this.each(function() {
            var a, t = e(this);
            "object" != typeof n && n ? "update" === n ? (t.data("jais.af.class") || r(),
            a = t.data("jais.af.class"),
            l(t)) : "bind" === n && r() : (a = n.className,
            t.data("jais.af.class", n.className)),
            i.hasClass(a) && !i.hasClass("navbar-fixed") ? t.affix({
                offset: {
                    top: e("#navbar").outerHeight()
                }
            }).on("affixed.bs.affix affix.bs.affix", function() {
                l(t)
            }) : (!i.hasClass(a) || i.hasClass("navbar-fixed")) && (e(window).off(t.attr("id") + ".affix"),
            t.removeClass("affix affix-top affix-bottom").removeData("bs.affix"))
        })
    }
}(jQuery);
