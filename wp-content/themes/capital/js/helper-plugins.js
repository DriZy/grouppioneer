// CSS3 Transitions
function Swipe(t, e) {
    function n() {
        p = v.children, m = new Array(p.length), g = t.getBoundingClientRect().width || t.offsetWidth, v.style.width = p.length * g + "px";
        for (var e = p.length; e--;) {
            var n = p[e];
            n.style.width = g + "px", n.setAttribute("data-index", e), d.transitions && (n.style.left = e * -g + "px", r(e, y > e ? -g : e > y ? g : 0, 0))
        }
        d.transitions || (v.style.left = y * -g + "px"), t.style.visibility = "visible"
    }

    function i() {
        y ? o(y - 1) : e.continuous && o(p.length - 1)
    }

    function s() {
        y < p.length - 1 ? o(y + 1) : e.continuous && o(0)
    }

    function o(t, n) {
        if (y != t) {
            if (d.transitions) {
                for (var i = Math.abs(y - t) - 1, s = Math.abs(y - t) / (y - t); i--;) r((t > y ? t : y) - i - 1, g * s, 0);
                r(y, g * s, n || w), r(t, 0, n || w)
            } else u(y * -g, t * -g, n || w);
            y = t, f(e.callback && e.callback(y, p[y]))
        }
    }

    function r(t, e, n) {
        a(t, e, n), m[t] = e
    }

    function a(t, e, n) {
        var i = p[t],
            s = i && i.style;
        s && (s.webkitTransitionDuration = s.MozTransitionDuration = s.msTransitionDuration = s.OTransitionDuration = s.transitionDuration = n + "ms", s.webkitTransform = "translate(" + e + "px,0)translateZ(0)", s.msTransform = s.MozTransform = s.OTransform = "translateX(" + e + "px)")
    }

    function u(t, n, i) {
        if (!i) return void(v.style.left = n + "px");
        var s = +new Date,
            o = setInterval(function() {
                var r = +new Date - s;
                return r > i ? (v.style.left = n + "px", x && l(), e.transitionEnd && e.transitionEnd.call(event, y, p[y]), void clearInterval(o)) : void(v.style.left = (n - t) * (Math.floor(r / i * 100) / 100) + t + "px")
            }, 4)
    }

    function l() {
        b = setTimeout(s, x)
    }

    function c() {
        x = 0, clearTimeout(b)
    }
    var h = function() {},
        f = function(t) {
            setTimeout(t || h, 0)
        },
        d = {
            addEventListener: !!window.addEventListener,
            touch: "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch,
            transitions: function(t) {
                var e = ["transitionProperty", "WebkitTransition", "MozTransition", "OTransition", "msTransition"];
                for (var n in e)
                    if (void 0 !== t.style[e[n]]) return !0;
                return !1
            }(document.createElement("swipe"))
        };
    if (t) {
        var p, m, g, v = t.children[0];
        e = e || {};
        var y = parseInt(e.startSlide, 10) || 0,
            w = e.speed || 300;
        e.continuous = void 0 !== e.continuous ? e.continuous : !0;
        var b, _, x = e.auto || 0,
            k = {},
            M = {},
            A = {
                handleEvent: function(t) {
                    switch (t.type) {
                        case "touchstart":
                            this.start(t);
                            break;
                        case "touchmove":
                            this.move(t);
                            break;
                        case "touchend":
                            f(this.end(t));
                            break;
                        case "webkitTransitionEnd":
                        case "msTransitionEnd":
                        case "oTransitionEnd":
                        case "otransitionend":
                        case "transitionend":
                            f(this.transitionEnd(t));
                            break;
                        case "resize":
                            f(n.call())
                    }
                    e.stopPropagation && t.stopPropagation()
                },
                start: function(t) {
                    var e = t.touches[0];
                    k = {
                        x: e.pageX,
                        y: e.pageY,
                        time: +new Date
                    }, _ = void 0, M = {}, v.addEventListener("touchmove", this, !1), v.addEventListener("touchend", this, !1)
                },
                move: function(t) {
                    if (!(t.touches.length > 1 || t.scale && 1 !== t.scale)) {
                        e.disableScroll && t.preventDefault();
                        var n = t.touches[0];
                        M = {
                            x: n.pageX - k.x,
                            y: n.pageY - k.y
                        }, "undefined" == typeof _ && (_ = !!(_ || Math.abs(M.x) < Math.abs(M.y))), _ || (t.preventDefault(), c(), M.x = M.x / (!y && M.x > 0 || y == p.length - 1 && M.x < 0 ? Math.abs(M.x) / g + 1 : 1), a(y - 1, M.x + m[y - 1], 0), a(y, M.x + m[y], 0), a(y + 1, M.x + m[y + 1], 0))
                    }
                },
                end: function(t) {
                    var n = +new Date - k.time,
                        i = Number(n) < 250 && Math.abs(M.x) > 20 || Math.abs(M.x) > g / 2,
                        s = !y && M.x > 0 || y == p.length - 1 && M.x < 0,
                        o = M.x < 0;
                    _ || (i && !s ? (o ? (r(y - 1, -g, 0), r(y, m[y] - g, w), r(y + 1, m[y + 1] - g, w), y += 1) : (r(y + 1, g, 0), r(y, m[y] + g, w), r(y - 1, m[y - 1] + g, w), y += -1), e.callback && e.callback(y, p[y])) : (r(y - 1, -g, w), r(y, 0, w), r(y + 1, g, w))), v.removeEventListener("touchmove", A, !1), v.removeEventListener("touchend", A, !1)
                },
                transitionEnd: function(t) {
                    parseInt(t.target.getAttribute("data-index"), 10) == y && (x && l(), e.transitionEnd && e.transitionEnd.call(t, y, p[y]))
                }
            };
        return n(), x && l(), d.addEventListener ? (d.touch && v.addEventListener("touchstart", A, !1), d.transitions && (v.addEventListener("webkitTransitionEnd", A, !1), v.addEventListener("msTransitionEnd", A, !1), v.addEventListener("oTransitionEnd", A, !1), v.addEventListener("otransitionend", A, !1), v.addEventListener("transitionend", A, !1)), window.addEventListener("resize", A, !1)) : window.onresize = function() {
            n()
        }, {
            setup: function() {
                n()
            },
            slide: function(t, e) {
                c(), o(t, e)
            },
            prev: function() {
                c(), i()
            },
            next: function() {
                c(), s()
            },
            getPos: function() {
                return y
            },
            getNumSlides: function() {
                return p.length
            },
            kill: function() {
                c(), v.style.width = "auto", v.style.left = 0;
                for (var t = p.length; t--;) {
                    var e = p[t];
                    e.style.width = "100%", e.style.left = 0, d.transitions && a(t, 0, 0)
                }
                d.addEventListener ? (v.removeEventListener("touchstart", A, !1), v.removeEventListener("webkitTransitionEnd", A, !1), v.removeEventListener("msTransitionEnd", A, !1), v.removeEventListener("oTransitionEnd", A, !1), v.removeEventListener("otransitionend", A, !1), v.removeEventListener("transitionend", A, !1), window.removeEventListener("resize", A, !1)) : window.onresize = null
            }
        }
    }
}

//Debounce
! function(t) {
    var e, n, i = t.event;
    e = i.special.debouncedresize = {
        setup: function() {
            t(this).on("resize", e.handler)
        },
        teardown: function() {
            t(this).off("resize", e.handler)
        },
        handler: function(t, s) {
            var o = this,
                r = arguments,
                a = function() {
                    t.type = "debouncedresize", i.dispatch.apply(o, r)
                };
            n && clearTimeout(n), s ? a() : n = setTimeout(a, e.threshold)
        },
        threshold: 150
    }
}

// Sticky Plugin
(jQuery),
function(t) {
    var e = {
            topSpacing: 0,
            bottomSpacing: 0,
            className: "is-sticky",
            wrapperClassName: "sticky-wrapper",
            center: !1,
            getWidthFrom: ""
        },
        n = t(window),
        i = t(document),
        s = [],
        o = n.height(),
        r = function() {
            for (var e = n.scrollTop(), r = i.height(), a = r - o, u = e > a ? a - e : 0, l = 0; l < s.length; l++) {
                var c = s[l],
                    h = c.stickyWrapper.offset().top,
                    f = h - c.topSpacing - u;
                if (f >= e) null !== c.currentTop && (c.stickyElement.css("position", "").css("top", ""), c.stickyElement.parent().removeClass(c.className), c.currentTop = null);
                else {
                    var d = r - c.stickyElement.outerHeight() - c.topSpacing - c.bottomSpacing - e - u;
                    0 > d ? d += c.topSpacing : d = c.topSpacing, c.currentTop != d && (c.stickyElement.css("position", "fixed").css("top", d), "undefined" != typeof c.getWidthFrom && c.stickyElement.css("width", t(c.getWidthFrom).width()), c.stickyElement.parent().addClass(c.className), c.currentTop = d)
                }
            }
        },
        a = function() {
            o = n.height()
        },
        u = {
            init: function(n) {
                var i = t.extend(e, n);
                return this.each(function() {
                    var e = t(this),
                        n = e.attr("id"),
                        o = t("<div></div>").attr("id", n + "-sticky-wrapper").addClass(i.wrapperClassName);
                    e.wrapAll(o), i.center && e.parent().css({
                        width: e.outerWidth(),
                        marginLeft: "auto",
                        marginRight: "auto"
                    }), "right" == e.css("float") && e.css({
                        "float": "none"
                    }).parent().css({
                        "float": "right"
                    });
                    var r = e.parent();
                    r.css("height", e.outerHeight()), s.push({
                        topSpacing: i.topSpacing,
                        bottomSpacing: i.bottomSpacing,
                        stickyElement: e,
                        currentTop: null,
                        stickyWrapper: r,
                        className: i.className,
                        getWidthFrom: i.getWidthFrom
                    })
                })
            },
            update: r
        };
    window.addEventListener ? (window.addEventListener("scroll", r, !1), window.addEventListener("resize", a, !1)) : window.attachEvent && (window.attachEvent("onscroll", r), window.attachEvent("onresize", a)), t.fn.sticky = function(e) {
        return u[e] ? u[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? void t.error("Method " + e + " does not exist on jQuery.sticky") : u.init.apply(this, arguments)
    }, t(function() {
        setTimeout(r, 0)
    })
}

// Isotope Plugin
(jQuery),
function(t, e, n) {
    "use strict";
    var i, s = t.document,
        o = t.Modernizr,
        r = function(t) {
            return t.charAt(0).toUpperCase() + t.slice(1)
        },
        a = "Moz Webkit O Ms".split(" "),
        u = function(t) {
            var e, n = s.documentElement.style;
            if ("string" == typeof n[t]) return t;
            t = r(t);
            for (var i = 0, o = a.length; o > i; i++)
                if (e = a[i] + t, "string" == typeof n[e]) return e
        },
        l = u("transform"),
        c = u("transitionProperty"),
        h = {
            csstransforms: function() {
                return !!l
            },
            csstransforms3d: function() {
                var t = !!u("perspective");
                if (t) {
                    var n = " -o- -moz- -ms- -webkit- -khtml- ".split(" "),
                        i = "@media (" + n.join("transform-3d),(") + "modernizr)",
                        s = e("<style>" + i + "{#modernizr{height:3px}}</style>").appendTo("head"),
                        o = e('<div id="modernizr" />').appendTo("html");
                    t = 3 === o.height(), o.remove(), s.remove()
                }
                return t
            },
            csstransitions: function() {
                return !!c
            }
        };
    if (o)
        for (i in h) o.hasOwnProperty(i) || o.addTest(i, h[i]);
    else {
        o = t.Modernizr = {
            _version: "1.6ish: miniModernizr for Isotope"
        };
        var f, d = " ";
        for (i in h) f = h[i](), o[i] = f, d += " " + (f ? "" : "no-") + i;
        e("html").addClass(d)
    }
    if (o.csstransforms) {
        var p = o.csstransforms3d ? {
                translate: function(t) {
                    return "translate3d(" + t[0] + "px, " + t[1] + "px, 0) "
                },
                scale: function(t) {
                    return "scale3d(" + t + ", " + t + ", 1) "
                }
            } : {
                translate: function(t) {
                    return "translate(" + t[0] + "px, " + t[1] + "px) "
                },
                scale: function(t) {
                    return "scale(" + t + ") "
                }
            },
            m = function(t, n, i) {
                var s, o, r = e.data(t, "isoTransform") || {},
                    a = {},
                    u = {};
                a[n] = i, e.extend(r, a);
                for (s in r) o = r[s], u[s] = p[s](o);
                var c = u.translate || "",
                    h = u.scale || "",
                    f = c + h;
                e.data(t, "isoTransform", r), t.style[l] = f
            };
        e.cssNumber.scale = !0, e.cssHooks.scale = {
            set: function(t, e) {
                m(t, "scale", e)
            },
            get: function(t, n) {
                var i = e.data(t, "isoTransform");
                return i && i.scale ? i.scale : 1
            }
        }, e.fx.step.scale = function(t) {
            e.cssHooks.scale.set(t.elem, t.now + t.unit)
        }, e.cssNumber.translate = !0, e.cssHooks.translate = {
            set: function(t, e) {
                m(t, "translate", e)
            },
            get: function(t, n) {
                var i = e.data(t, "isoTransform");
                return i && i.translate ? i.translate : [0, 0]
            }
        }
    }
    var g, v;
    o.csstransitions && (g = {
        WebkitTransitionProperty: "webkitTransitionEnd",
        MozTransitionProperty: "transitionend",
        OTransitionProperty: "oTransitionEnd otransitionend",
        transitionProperty: "transitionend"
    }[c], v = u("transitionDuration"));
    var y, w = e.event,
        b = e.event.handle ? "handle" : "dispatch";
    w.special.smartresize = {
        setup: function() {
            e(this).bind("resize", w.special.smartresize.handler)
        },
        teardown: function() {
            e(this).unbind("resize", w.special.smartresize.handler)
        },
        handler: function(t, e) {
            var n = this,
                i = arguments;
            t.type = "smartresize", y && clearTimeout(y), y = setTimeout(function() {
                w[b].apply(n, i)
            }, "execAsap" === e ? 0 : 100)
        }
    }, e.fn.smartresize = function(t) {
        return t ? this.bind("smartresize", t) : this.trigger("smartresize", ["execAsap"])
    }, e.Isotope = function(t, n, i) {
        this.element = e(n), this._create(t), this._init(i)
    };
    var _ = ["width", "height"],
        x = e(t);
    e.Isotope.settings = {
        resizable: !0,
        layoutMode: "masonry",
        containerClass: "isotope",
        itemClass: "isotope-item",
        hiddenClass: "isotope-hidden",
        hiddenStyle: {
            opacity: 0,
            scale: .001
        },
        visibleStyle: {
            opacity: 1,
            scale: 1
        },
        containerStyle: {
            position: "relative",
            overflow: "hidden"
        },
        animationEngine: "best-available",
        animationOptions: {
            queue: !1,
            duration: 800
        },
        sortBy: "original-order",
        sortAscending: !0,
        resizesContainer: !0,
        transformsEnabled: !0,
        itemPositionDataEnabled: !1
    }, e.Isotope.prototype = {
        _create: function(t) {
            this.options = e.extend({}, e.Isotope.settings, t), this.styleQueue = [], this.elemCount = 0;
            var n = this.element[0].style;
            this.originalStyle = {};
            var i = _.slice(0);
            for (var s in this.options.containerStyle) i.push(s);
            for (var o = 0, r = i.length; r > o; o++) s = i[o], this.originalStyle[s] = n[s] || "";
            this.element.css(this.options.containerStyle), this._updateAnimationEngine(), this._updateUsingTransforms();
            var a = {
                "original-order": function(t, e) {
                    return e.elemCount++, e.elemCount
                },
                random: function() {
                    return Math.random()
                }
            };
            this.options.getSortData = e.extend(this.options.getSortData, a), this.reloadItems(), this.offset = {
                left: parseInt(this.element.css("padding-left") || 0, 10),
                top: parseInt(this.element.css("padding-top") || 0, 10)
            };
            var u = this;
            setTimeout(function() {
                u.element.addClass(u.options.containerClass)
            }, 0), this.options.resizable && x.bind("smartresize.isotope", function() {
                u.resize()
            }), this.element.delegate("." + this.options.hiddenClass, "click", function() {
                return !1
            })
        },
        _getAtoms: function(t) {
            var e = this.options.itemSelector,
                n = e ? t.filter(e).add(t.find(e)) : t,
                i = {
                    position: "absolute"
                };
            return n = n.filter(function(t, e) {
                return 1 === e.nodeType
            }), this.usingTransforms && (i.left = 0, i.top = 0), n.css(i).addClass(this.options.itemClass), this.updateSortData(n, !0), n
        },
        _init: function(t) {
            this.$filteredAtoms = this._filter(this.$allAtoms), this._sort(), this.reLayout(t)
        },
        option: function(t) {
            if (e.isPlainObject(t)) {
                this.options = e.extend(!0, this.options, t);
                var n;
                for (var i in t) n = "_update" + r(i), this[n] && this[n]()
            }
        },
        _updateAnimationEngine: function() {
            var t, e = this.options.animationEngine.toLowerCase().replace(/[ _\-]/g, "");
            switch (e) {
                case "css":
                case "none":
                    t = !1;
                    break;
                case "jquery":
                    t = !0;
                    break;
                default:
                    t = !o.csstransitions
            }
            this.isUsingJQueryAnimation = t, this._updateUsingTransforms()
        },
        _updateTransformsEnabled: function() {
            this._updateUsingTransforms()
        },
        _updateUsingTransforms: function() {
            var t = this.usingTransforms = this.options.transformsEnabled && o.csstransforms && o.csstransitions && !this.isUsingJQueryAnimation;
            t || (delete this.options.hiddenStyle.scale, delete this.options.visibleStyle.scale), this.getPositionStyles = t ? this._translate : this._positionAbs
        },
        _filter: function(t) {
            var e = "" === this.options.filter ? "*" : this.options.filter;
            if (!e) return t;
            var n = this.options.hiddenClass,
                i = "." + n,
                s = t.filter(i),
                o = s;
            if ("*" !== e) {
                o = s.filter(e);
                var r = t.not(i).not(e).addClass(n);
                this.styleQueue.push({
                    $el: r,
                    style: this.options.hiddenStyle
                })
            }
            return this.styleQueue.push({
                $el: o,
                style: this.options.visibleStyle
            }), o.removeClass(n), t.filter(e)
        },
        updateSortData: function(t, n) {
            var i, s, o = this,
                r = this.options.getSortData;
            t.each(function() {
                i = e(this), s = {};
                for (var t in r) n || "original-order" !== t ? s[t] = r[t](i, o) : s[t] = e.data(this, "isotope-sort-data")[t];
                e.data(this, "isotope-sort-data", s)
            })
        },
        _sort: function() {
            var t = this.options.sortBy,
                e = this._getSorter,
                n = this.options.sortAscending ? 1 : -1,
                i = function(i, s) {
                    var o = e(i, t),
                        r = e(s, t);
                    return o === r && "original-order" !== t && (o = e(i, "original-order"), r = e(s, "original-order")), (o > r ? 1 : r > o ? -1 : 0) * n
                };
            this.$filteredAtoms.sort(i)
        },
        _getSorter: function(t, n) {
            return e.data(t, "isotope-sort-data")[n]
        },
        _translate: function(t, e) {
            return {
                translate: [t, e]
            }
        },
        _positionAbs: function(t, e) {
            return {
                left: t,
                top: e
            }
        },
        _pushPosition: function(t, e, n) {
            e = Math.round(e + this.offset.left), n = Math.round(n + this.offset.top);
            var i = this.getPositionStyles(e, n);
            this.styleQueue.push({
                $el: t,
                style: i
            }), this.options.itemPositionDataEnabled && t.data("isotope-item-position", {
                x: e,
                y: n
            })
        },
        layout: function(t, e) {
            var n = this.options.layoutMode;
            if (this["_" + n + "Layout"](t), this.options.resizesContainer) {
                var i = this["_" + n + "GetContainerSize"]();
                this.styleQueue.push({
                    $el: this.element,
                    style: i
                })
            }
            this._processStyleQueue(t, e), this.isLaidOut = !0
        },
        _processStyleQueue: function(t, n) {
            var i, s, r, a, u = this.isLaidOut && this.isUsingJQueryAnimation ? "animate" : "css",
                l = this.options.animationOptions,
                c = this.options.onLayout;
            if (s = function(t, e) {
                    e.$el[u](e.style, l)
                }, this._isInserting && this.isUsingJQueryAnimation) s = function(t, e) {
                i = e.$el.hasClass("no-transition") ? "css" : u, e.$el[i](e.style, l)
            };
            else if (n || c || l.complete) {
                var h = !1,
                    f = [n, c, l.complete],
                    d = this;
                if (r = !0, a = function() {
                        if (!h) {
                            for (var e, n = 0, i = f.length; i > n; n++) e = f[n], "function" == typeof e && e.call(d.element, t, d);
                            h = !0
                        }
                    }, this.isUsingJQueryAnimation && "animate" === u) l.complete = a, r = !1;
                else if (o.csstransitions) {
                    for (var p, m = 0, y = this.styleQueue[0], w = y && y.$el; !w || !w.length;) {
                        if (p = this.styleQueue[m++], !p) return;
                        w = p.$el
                    }
                    var b = parseFloat(getComputedStyle(w[0])[v]);
                    b > 0 && (s = function(t, e) {
                        e.$el[u](e.style, l).one(g, a)
                    }, r = !1)
                }
            }
            e.each(this.styleQueue, s), r && a(), this.styleQueue = []
        },
        resize: function() {
            this["_" + this.options.layoutMode + "ResizeChanged"]() && this.reLayout()
        },
        reLayout: function(t) {
            this["_" + this.options.layoutMode + "Reset"](), this.layout(this.$filteredAtoms, t)
        },
        addItems: function(t, e) {
            var n = this._getAtoms(t);
            this.$allAtoms = this.$allAtoms.add(n), e && e(n)
        },
        insert: function(t, e) {
            this.element.append(t);
            var n = this;
            this.addItems(t, function(t) {
                var i = n._filter(t);
                n._addHideAppended(i), n._sort(), n.reLayout(), n._revealAppended(i, e)
            })
        },
        appended: function(t, e) {
            var n = this;
            this.addItems(t, function(t) {
                n._addHideAppended(t), n.layout(t), n._revealAppended(t, e)
            })
        },
        _addHideAppended: function(t) {
            this.$filteredAtoms = this.$filteredAtoms.add(t), t.addClass("no-transition"), this._isInserting = !0, this.styleQueue.push({
                $el: t,
                style: this.options.hiddenStyle
            })
        },
        _revealAppended: function(t, e) {
            var n = this;
            setTimeout(function() {
                t.removeClass("no-transition"), n.styleQueue.push({
                    $el: t,
                    style: n.options.visibleStyle
                }), n._isInserting = !1, n._processStyleQueue(t, e)
            }, 10)
        },
        reloadItems: function() {
            this.$allAtoms = this._getAtoms(this.element.children())
        },
        remove: function(t, e) {
            this.$allAtoms = this.$allAtoms.not(t), this.$filteredAtoms = this.$filteredAtoms.not(t);
            var n = this,
                i = function() {
                    t.remove(), e && e.call(n.element)
                };
            t.filter(":not(." + this.options.hiddenClass + ")").length ? (this.styleQueue.push({
                $el: t,
                style: this.options.hiddenStyle
            }), this._sort(), this.reLayout(i)) : i()
        },
        shuffle: function(t) {
            this.updateSortData(this.$allAtoms), this.options.sortBy = "random", this._sort(), this.reLayout(t)
        },
        destroy: function() {
            var t = this.usingTransforms,
                e = this.options;
            this.$allAtoms.removeClass(e.hiddenClass + " " + e.itemClass).each(function() {
                var e = this.style;
                e.position = "", e.top = "", e.left = "", e.opacity = "", t && (e[l] = "")
            });
            var n = this.element[0].style;
            for (var i in this.originalStyle) n[i] = this.originalStyle[i];
            this.element.unbind(".isotope").undelegate("." + e.hiddenClass, "click").removeClass(e.containerClass).removeData("isotope"), x.unbind(".isotope")
        },
        _getSegments: function(t) {
            var e, n = this.options.layoutMode,
                i = t ? "rowHeight" : "columnWidth",
                s = t ? "height" : "width",
                o = t ? "rows" : "cols",
                a = this.element[s](),
                u = this.options[n] && this.options[n][i] || this.$filteredAtoms["outer" + r(s)](!0) || a;
            e = Math.floor(a / u), e = Math.max(e, 1), this[n][o] = e, this[n][i] = u
        },
        _checkIfSegmentsChanged: function(t) {
            var e = this.options.layoutMode,
                n = t ? "rows" : "cols",
                i = this[e][n];
            return this._getSegments(t), this[e][n] !== i
        },
        _masonryReset: function() {
            this.masonry = {}, this._getSegments();
            var t = this.masonry.cols;
            for (this.masonry.colYs = []; t--;) this.masonry.colYs.push(0)
        },
        _masonryLayout: function(t) {
            var n = this,
                i = n.masonry;
            t.each(function() {
                var t = e(this),
                    s = Math.ceil(t.outerWidth(!0) / i.columnWidth);
                if (s = Math.min(s, i.cols), 1 === s) n._masonryPlaceBrick(t, i.colYs);
                else {
                    var o, r, a = i.cols + 1 - s,
                        u = [];
                    for (r = 0; a > r; r++) o = i.colYs.slice(r, r + s), u[r] = Math.max.apply(Math, o);
                    n._masonryPlaceBrick(t, u)
                }
            })
        },
        _masonryPlaceBrick: function(t, e) {
            for (var n = Math.min.apply(Math, e), i = 0, s = 0, o = e.length; o > s; s++)
                if (e[s] === n) {
                    i = s;
                    break
                }
            var r = this.masonry.columnWidth * i,
                a = n;
            this._pushPosition(t, r, a);
            var u = n + t.outerHeight(!0),
                l = this.masonry.cols + 1 - o;
            for (s = 0; l > s; s++) this.masonry.colYs[i + s] = u
        },
        _masonryGetContainerSize: function() {
            var t = Math.max.apply(Math, this.masonry.colYs);
            return {
                height: t
            }
        },
        _masonryResizeChanged: function() {
            return this._checkIfSegmentsChanged()
        },
        _fitRowsReset: function() {
            this.fitRows = {
                x: 0,
                y: 0,
                height: 0
            }
        },
        _fitRowsLayout: function(t) {
            var n = this,
                i = this.element.width(),
                s = this.fitRows;
            t.each(function() {
                var t = e(this),
                    o = t.outerWidth(!0),
                    r = t.outerHeight(!0);
                0 !== s.x && o + s.x > i && (s.x = 0, s.y = s.height), n._pushPosition(t, s.x, s.y), s.height = Math.max(s.y + r, s.height), s.x += o
            })
        },
        _fitRowsGetContainerSize: function() {
            return {
                height: this.fitRows.height
            }
        },
        _fitRowsResizeChanged: function() {
            return !0
        },
        _cellsByRowReset: function() {
            this.cellsByRow = {
                index: 0
            }, this._getSegments(), this._getSegments(!0)
        },
        _cellsByRowLayout: function(t) {
            var n = this,
                i = this.cellsByRow;
            t.each(function() {
                var t = e(this),
                    s = i.index % i.cols,
                    o = Math.floor(i.index / i.cols),
                    r = (s + .5) * i.columnWidth - t.outerWidth(!0) / 2,
                    a = (o + .5) * i.rowHeight - t.outerHeight(!0) / 2;
                n._pushPosition(t, r, a), i.index++
            })
        },
        _cellsByRowGetContainerSize: function() {
            return {
                height: Math.ceil(this.$filteredAtoms.length / this.cellsByRow.cols) * this.cellsByRow.rowHeight + this.offset.top
            }
        },
        _cellsByRowResizeChanged: function() {
            return this._checkIfSegmentsChanged()
        },
        _straightDownReset: function() {
            this.straightDown = {
                y: 0
            }
        },
        _straightDownLayout: function(t) {
            var n = this;
            t.each(function(t) {
                var i = e(this);
                n._pushPosition(i, 0, n.straightDown.y), n.straightDown.y += i.outerHeight(!0)
            })
        },
        _straightDownGetContainerSize: function() {
            return {
                height: this.straightDown.y
            }
        },
        _straightDownResizeChanged: function() {
            return !0
        },
        _masonryHorizontalReset: function() {
            this.masonryHorizontal = {}, this._getSegments(!0);
            var t = this.masonryHorizontal.rows;
            for (this.masonryHorizontal.rowXs = []; t--;) this.masonryHorizontal.rowXs.push(0)
        },
        _masonryHorizontalLayout: function(t) {
            var n = this,
                i = n.masonryHorizontal;
            t.each(function() {
                var t = e(this),
                    s = Math.ceil(t.outerHeight(!0) / i.rowHeight);
                if (s = Math.min(s, i.rows), 1 === s) n._masonryHorizontalPlaceBrick(t, i.rowXs);
                else {
                    var o, r, a = i.rows + 1 - s,
                        u = [];
                    for (r = 0; a > r; r++) o = i.rowXs.slice(r, r + s), u[r] = Math.max.apply(Math, o);
                    n._masonryHorizontalPlaceBrick(t, u)
                }
            })
        },
        _masonryHorizontalPlaceBrick: function(t, e) {
            for (var n = Math.min.apply(Math, e), i = 0, s = 0, o = e.length; o > s; s++)
                if (e[s] === n) {
                    i = s;
                    break
                }
            var r = n,
                a = this.masonryHorizontal.rowHeight * i;
            this._pushPosition(t, r, a);
            var u = n + t.outerWidth(!0),
                l = this.masonryHorizontal.rows + 1 - o;
            for (s = 0; l > s; s++) this.masonryHorizontal.rowXs[i + s] = u
        },
        _masonryHorizontalGetContainerSize: function() {
            var t = Math.max.apply(Math, this.masonryHorizontal.rowXs);
            return {
                width: t
            }
        },
        _masonryHorizontalResizeChanged: function() {
            return this._checkIfSegmentsChanged(!0)
        },
        _fitColumnsReset: function() {
            this.fitColumns = {
                x: 0,
                y: 0,
                width: 0
            }
        },
        _fitColumnsLayout: function(t) {
            var n = this,
                i = this.element.height(),
                s = this.fitColumns;
            t.each(function() {
                var t = e(this),
                    o = t.outerWidth(!0),
                    r = t.outerHeight(!0);
                0 !== s.y && r + s.y > i && (s.x = s.width, s.y = 0), n._pushPosition(t, s.x, s.y), s.width = Math.max(s.x + o, s.width), s.y += r
            })
        },
        _fitColumnsGetContainerSize: function() {
            return {
                width: this.fitColumns.width
            }
        },
        _fitColumnsResizeChanged: function() {
            return !0
        },
        _cellsByColumnReset: function() {
            this.cellsByColumn = {
                index: 0
            }, this._getSegments(), this._getSegments(!0)
        },
        _cellsByColumnLayout: function(t) {
            var n = this,
                i = this.cellsByColumn;
            t.each(function() {
                var t = e(this),
                    s = Math.floor(i.index / i.rows),
                    o = i.index % i.rows,
                    r = (s + .5) * i.columnWidth - t.outerWidth(!0) / 2,
                    a = (o + .5) * i.rowHeight - t.outerHeight(!0) / 2;
                n._pushPosition(t, r, a), i.index++
            })
        },
        _cellsByColumnGetContainerSize: function() {
            return {
                width: Math.ceil(this.$filteredAtoms.length / this.cellsByColumn.rows) * this.cellsByColumn.columnWidth
            }
        },
        _cellsByColumnResizeChanged: function() {
            return this._checkIfSegmentsChanged(!0)
        },
        _straightAcrossReset: function() {
            this.straightAcross = {
                x: 0
            }
        },
        _straightAcrossLayout: function(t) {
            var n = this;
            t.each(function(t) {
                var i = e(this);
                n._pushPosition(i, n.straightAcross.x, 0), n.straightAcross.x += i.outerWidth(!0)
            })
        },
        _straightAcrossGetContainerSize: function() {
            return {
                width: this.straightAcross.x
            }
        },
        _straightAcrossResizeChanged: function() {
            return !0
        }
    }, e.fn.imagesLoaded = function(t) {
        function n() {
            t.call(s, o)
        }

        function i(t) {
            var s = t.target;
            s.src !== a && -1 === e.inArray(s, u) && (u.push(s), --r <= 0 && (setTimeout(n), o.unbind(".imagesLoaded", i)))
        }
        var s = this,
            o = s.find("img").add(s.filter("img")),
            r = o.length,
            a = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",
            u = [];
        return r || n(), o.bind("load.imagesLoaded error.imagesLoaded", i).each(function() {
            var t = this.src;
            this.src = a, this.src = t
        }), s
    };
    var k = function(e) {
        t.console && t.console.error(e)
    };
    e.fn.isotope = function(t, n) {
        if ("string" == typeof t) {
            var i = Array.prototype.slice.call(arguments, 1);
            this.each(function() {
                var n = e.data(this, "isotope");
                return n ? e.isFunction(n[t]) && "_" !== t.charAt(0) ? void n[t].apply(n, i) : void k("no such method '" + t + "' for isotope instance") : void k("cannot call methods on isotope prior to initialization; attempted to call method '" + t + "'")
            })
        } else this.each(function() {
            var i = e.data(this, "isotope");
            i ? (i.option(t), i._init(n)) : e.data(this, "isotope", new e.Isotope(t, this, n))
        });
        return this
    }
}

// Sloppy Masonry
(window, jQuery),
function(t, e) {
    e.extend(e.Isotope.prototype, {
        _sloppyMasonryReset: function() {
            var t = this.element.width(),
                e = this.options.sloppyMasonry && this.options.sloppyMasonry.columnWidth || this.$filteredAtoms.outerWidth(!0) || t;
            this.sloppyMasonry = {
                cols: Math.round(t / e),
                columnWidth: e
            };
            var n = this.sloppyMasonry.cols;
            for (this.sloppyMasonry.colYs = []; n--;) this.sloppyMasonry.colYs.push(0)
        },
        _sloppyMasonryLayout: function(t) {
            var n = this,
                i = n.sloppyMasonry;
            t.each(function() {
                var t = e(this),
                    s = Math.round(t.outerWidth(!0) / i.columnWidth);
                if (s = Math.min(s, i.cols), 1 === s) n._sloppyMasonryPlaceBrick(t, i.colYs);
                else {
                    var o, r, a = i.cols + 1 - s,
                        u = [];
                    for (r = 0; a > r; r++) o = i.colYs.slice(r, r + s), u[r] = Math.max.apply(Math, o);
                    n._sloppyMasonryPlaceBrick(t, u)
                }
            })
        },
        _sloppyMasonryPlaceBrick: function(t, e) {
            for (var n = Math.min.apply(Math, e), i = 0, s = 0, o = e.length; o > s; s++)
                if (e[s] === n) {
                    i = s;
                    break
                }
            var r = this.sloppyMasonry.columnWidth * i,
                a = n;
            this._pushPosition(t, r, a);
            var u = n + t.outerHeight(!0),
                l = this.sloppyMasonry.cols + 1 - o;
            for (s = 0; l > s; s++) this.sloppyMasonry.colYs[i + s] = u
        },
        _sloppyMasonryGetContainerSize: function() {
            var t = Math.max.apply(Math, this.sloppyMasonry.colYs);
            return {
                height: t
            }
        },
        _sloppyMasonryResizeChanged: function() {
            return !0
        }
    })
}

// jQuery Touch Swipe
(this, this.jQuery),
function(t) {
    function e(e) {
        return !e || void 0 !== e.allowPageScroll || void 0 === e.swipe && void 0 === e.swipeStatus || (e.allowPageScroll = a), e || (e = {}), e = t.extend({}, t.fn.swipe.defaults, e), this.each(function() {
            var i = t(this),
                s = i.data(v);
            s || (s = new n(this, e), i.data(v, s))
        })
    }

    function n(e, n) {
        function y(t) {
            var e, t = t.originalEvent,
                i = g ? t.touches[0] : t;
            return B = f, g ? W = t.touches.length : t.preventDefault(), P = 0, j = null, H = 0, g && W !== n.fingers && n.fingers !== h ? _(t) : (C = S = i.pageX, E = z = i.pageY, Y = (new Date).getTime(), n.swipeStatus && (e = x(t, B))), !1 === e ? (B = m, x(t, B), e) : (R.bind(L, w), void R.bind(Q, b))
        }

        function w(t) {
            if (t = t.originalEvent, B !== p && B !== m) {
                var e, f = g ? t.touches[0] : t;
                S = f.pageX, z = f.pageY, $ = (new Date).getTime(), j = A(), g && (W = t.touches.length), B = d;
                var f = t,
                    v = j;
                if (n.allowPageScroll === a) f.preventDefault();
                else {
                    var y = n.allowPageScroll === u;
                    switch (v) {
                        case i:
                            (n.swipeLeft && y || !y && n.allowPageScroll != l) && f.preventDefault();
                            break;
                        case s:
                            (n.swipeRight && y || !y && n.allowPageScroll != l) && f.preventDefault();
                            break;
                        case o:
                            (n.swipeUp && y || !y && n.allowPageScroll != c) && f.preventDefault();
                            break;
                        case r:
                            (n.swipeDown && y || !y && n.allowPageScroll != c) && f.preventDefault()
                    }
                }
                W !== n.fingers && n.fingers !== h && g ? (B = m, x(t, B)) : (P = M(), H = $ - Y, n.swipeStatus && (e = x(t, B, j, P, H)), n.triggerOnTouchEnd || (f = !(n.maxTimeThreshold ? !(H >= n.maxTimeThreshold) : 1), !0 === k() ? (B = p, e = x(t, B)) : f && (B = m, x(t, B)))), !1 === e && (B = m, x(t, B))
            }
        }

        function b(t) {
            if (t = t.originalEvent, t.preventDefault(), $ = (new Date).getTime(), P = M(), j = A(), H = $ - Y, n.triggerOnTouchEnd || !1 === n.triggerOnTouchEnd && B === d)
                if (B = p, W !== n.fingers && n.fingers !== h && g || 0 === S) B = m, x(t, B);
                else {
                    var e = !(n.maxTimeThreshold ? !(H >= n.maxTimeThreshold) : 1);
                    !0 !== k() && null !== k() || e ? (e || !1 === k()) && (B = m, x(t, B)) : x(t, B)
                } else B === d && (B = m, x(t, B));
            R.unbind(L, w, !1), R.unbind(Q, b, !1)
        }

        function _() {
            Y = $ = z = S = E = C = W = 0
        }

        function x(t, e) {
            var a = void 0;
            if (n.swipeStatus && (a = n.swipeStatus.call(R, t, e, j || null, P || 0, H || 0, W)), e !== m || !n.click || 1 !== W && g || !isNaN(P) && 0 !== P || (a = n.click.call(R, t, t.target)), e == p) switch (n.swipe && (a = n.swipe.call(R, t, j, P, H, W)), j) {
                case i:
                    n.swipeLeft && (a = n.swipeLeft.call(R, t, j, P, H, W));
                    break;
                case s:
                    n.swipeRight && (a = n.swipeRight.call(R, t, j, P, H, W));
                    break;
                case o:
                    n.swipeUp && (a = n.swipeUp.call(R, t, j, P, H, W));
                    break;
                case r:
                    n.swipeDown && (a = n.swipeDown.call(R, t, j, P, H, W))
            }
            return (e === m || e === p) && _(t), a
        }

        function k() {
            return null !== n.threshold ? P >= n.threshold : null
        }

        function M() {
            return Math.round(Math.sqrt(Math.pow(S - C, 2) + Math.pow(z - E, 2)))
        }

        function A() {
            var t;
            return t = Math.atan2(z - E, C - S), t = Math.round(180 * t / Math.PI), 0 > t && (t = 360 - Math.abs(t)), 45 >= t && t >= 0 ? i : 360 >= t && t >= 315 ? i : t >= 135 && 225 >= t ? s : t > 45 && 135 > t ? r : o
        }

        function T() {
            R.unbind(O, y), R.unbind(D, _), R.unbind(L, w), R.unbind(Q, b)
        }
        var S, z, C, E, I = g || !n.fallbackToMouseEvents,
            O = I ? "touchstart" : "mousedown",
            L = I ? "touchmove" : "mousemove",
            Q = I ? "touchend" : "mouseup",
            D = "touchcancel",
            P = 0,
            j = null,
            H = 0,
            R = t(e),
            B = "start",
            W = 0,
            Y = z = S = E = C = 0,
            $ = 0;
        try {
            R.bind(O, y), R.bind(D, _)
        } catch (N) {
            t.error("events not supported " + O + "," + D + " on jQuery.swipe")
        }
        this.enable = function() {
            return R.bind(O, y), R.bind(D, _), R
        }, this.disable = function() {
            return T(), R
        }, this.destroy = function() {
            return T(), R.data(v, null), R
        }
    }
    var i = "left",
        s = "right",
        o = "up",
        r = "down",
        a = "none",
        u = "auto",
        l = "horizontal",
        c = "vertical",
        h = "all",
        f = "start",
        d = "move",
        p = "end",
        m = "cancel",
        g = "ontouchstart" in window,
        v = "TouchSwipe";
    t.fn.swipe = function(n) {
        var i = t(this),
            s = i.data(v);
        if (s && "string" == typeof n) {
            if (s[n]) return s[n].apply(this, Array.prototype.slice.call(arguments, 1));
            t.error("Method " + n + " does not exist on jQuery.swipe")
        } else if (!(s || "object" != typeof n && n)) return e.apply(this, arguments);
        return i
    }, t.fn.swipe.defaults = {
        fingers: 1,
        threshold: 75,
        maxTimeThreshold: null,
        swipe: null,
        swipeLeft: null,
        swipeRight: null,
        swipeUp: null,
        swipeDown: null,
        swipeStatus: null,
        click: null,
        triggerOnTouchEnd: !0,
        allowPageScroll: "auto",
        fallbackToMouseEvents: !0
    }, t.fn.swipe.phases = {
        PHASE_START: f,
        PHASE_MOVE: d,
        PHASE_END: p,
        PHASE_CANCEL: m
    }, t.fn.swipe.directions = {
        LEFT: i,
        RIGHT: s,
        UP: o,
        DOWN: r
    }, t.fn.swipe.pageScroll = {
        NONE: a,
        HORIZONTAL: l,
        VERTICAL: c,
        AUTO: u
    }, t.fn.swipe.fingers = {
        ONE: 1,
        TWO: 2,
        THREE: 3,
        ALL: h
    }
}(jQuery),
function(t, e) {
    var n, i = t.jQuery || t.Cowboy || (t.Cowboy = {});
    i.throttle = n = function(t, n, s, o) {
        function r() {
            function i() {
                u = +new Date, s.apply(l, h)
            }

            function r() {
                a = e
            }
            var l = this,
                c = +new Date - u,
                h = arguments;
            o && !a && i(), a && clearTimeout(a), o === e && c > t ? i() : n !== !0 && (a = setTimeout(o ? r : i, o === e ? t - c : t))
        }
        var a, u = 0;
        return "boolean" != typeof n && (o = s, s = n, n = e), i.guid && (r.guid = s.guid = s.guid || i.guid++), r
    }, i.debounce = function(t, i, s) {
        return s === e ? n(t, i, !1) : n(t, s, i !== !1)
    }
}(this),
function(t) {
    function e(e, n, i) {
        var s = n.hash.slice(1),
            o = document.getElementById(s) || document.getElementsByName(s)[0];
        if (o) {
            e && e.preventDefault();
            var r = t(i.target);
            if (!(i.lock && r.is(":animated") || i.onBefore && i.onBefore.call(i, e, o, r) === !1)) {
                if (i.stop && r.stop(!0), i.hash) {
                    var a = o.id == s ? "id" : "name",
                        u = t("<a> </a>").attr(a, s).css({
                            position: "absolute",
                            top: t(window).scrollTop(),
                            left: t(window).scrollLeft()
                        });
                    o[a] = "", t("body").prepend(u), location = n.hash, u.remove(), o[a] = s
                }
                r.scrollTo(o, i).trigger("notify.serialScroll", [o])
            }
        }
    }
    var n = location.href.replace(/#.*/, ""),
        i = t.localScroll = function(e) {
            t("body").localScroll(e)
        };
    i.defaults = {
        duration: 1e3,
        axis: "y",
        event: "click",
        stop: !0,
        target: window,
        reset: !0
    }, i.hash = function(n) {
        if (location.hash) {
            if (n = t.extend({}, i.defaults, n), n.hash = !1, n.reset) {
                var s = n.duration;
                delete n.duration, t(n.target).scrollTo(0, n), n.duration = s
            }
            e(0, location, n)
        }
    }, t.fn.localScroll = function(s) {
        function o() {
            return !!this.href && !!this.hash && this.href.replace(this.hash, "") == n && (!s.filter || t(this).is(s.filter))
        }
        return s = t.extend({}, i.defaults, s), s.lazy ? this.bind(s.event, function(n) {
            var i = t([n.target, n.target.parentNode]).filter(o)[0];
            i && e(n, i, s)
        }) : this.find("a,area").filter(o).bind(s.event, function(t) {
            e(t, this, s)
        }).end().end()
    }
}

// jQuery ImageLoaded
(jQuery),
function(t, e) {
    var n = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    t.fn.imagesLoaded = function(i) {
        function s() {
            var e = t(f),
                n = t(d);
            u && (d.length ? u.reject(c, e, n) : u.resolve(c)), t.isFunction(i) && i.call(a, c, e, n)
        }

        function o(t) {
            r(t.target, "error" === t.type)
        }

        function r(e, i) {
            e.src !== n && -1 === t.inArray(e, h) && (h.push(e), i ? d.push(e) : f.push(e), t.data(e, "imagesLoaded", {
                isBroken: i,
                src: e.src
            }), l && u.notifyWith(t(e), [i, c, t(f), t(d)]), c.length === h.length && (setTimeout(s), c.unbind(".imagesLoaded", o)))
        }
        var a = this,
            u = t.isFunction(t.Deferred) ? t.Deferred() : 0,
            l = t.isFunction(u.notify),
            c = a.find("img").add(a.filter("img")),
            h = [],
            f = [],
            d = [];
        return t.isPlainObject(i) && t.each(i, function(t, e) {
            "callback" === t ? i = e : u && u[t](e)
        }), c.length ? c.bind("load.imagesLoaded error.imagesLoaded", o).each(function(i, s) {
            var o = s.src,
                a = t.data(s, "imagesLoaded");
            return a && a.src === o ? void r(s, a.isBroken) : s.complete && s.naturalWidth !== e ? void r(s, 0 === s.naturalWidth || 0 === s.naturalHeight) : void((s.readyState || s.complete) && (s.src = n, s.src = o))
        }) : s(), u ? u.promise(a) : a
    }
}

// jQuery Easing
(jQuery), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
        def: "easeOutQuad",
        swing: function(t, e, n, i, s) {
            return jQuery.easing[jQuery.easing.def](t, e, n, i, s)
        },
        easeInQuad: function(t, e, n, i, s) {
            return i * (e /= s) * e + n
        },
        easeOutQuad: function(t, e, n, i, s) {
            return -i * (e /= s) * (e - 2) + n
        },
        easeInOutQuad: function(t, e, n, i, s) {
            return (e /= s / 2) < 1 ? i / 2 * e * e + n : -i / 2 * (--e * (e - 2) - 1) + n
        },
        easeInCubic: function(t, e, n, i, s) {
            return i * (e /= s) * e * e + n
        },
        easeOutCubic: function(t, e, n, i, s) {
            return i * ((e = e / s - 1) * e * e + 1) + n
        },
        easeInOutCubic: function(t, e, n, i, s) {
            return (e /= s / 2) < 1 ? i / 2 * e * e * e + n : i / 2 * ((e -= 2) * e * e + 2) + n
        },
        easeInQuart: function(t, e, n, i, s) {
            return i * (e /= s) * e * e * e + n
        },
        easeOutQuart: function(t, e, n, i, s) {
            return -i * ((e = e / s - 1) * e * e * e - 1) + n
        },
        easeInOutQuart: function(t, e, n, i, s) {
            return (e /= s / 2) < 1 ? i / 2 * e * e * e * e + n : -i / 2 * ((e -= 2) * e * e * e - 2) + n
        },
        easeInQuint: function(t, e, n, i, s) {
            return i * (e /= s) * e * e * e * e + n
        },
        easeOutQuint: function(t, e, n, i, s) {
            return i * ((e = e / s - 1) * e * e * e * e + 1) + n
        },
        easeInOutQuint: function(t, e, n, i, s) {
            return (e /= s / 2) < 1 ? i / 2 * e * e * e * e * e + n : i / 2 * ((e -= 2) * e * e * e * e + 2) + n
        },
        easeInSine: function(t, e, n, i, s) {
            return -i * Math.cos(e / s * (Math.PI / 2)) + i + n
        },
        easeOutSine: function(t, e, n, i, s) {
            return i * Math.sin(e / s * (Math.PI / 2)) + n
        },
        easeInOutSine: function(t, e, n, i, s) {
            return -i / 2 * (Math.cos(Math.PI * e / s) - 1) + n
        },
        easeInExpo: function(t, e, n, i, s) {
            return 0 == e ? n : i * Math.pow(2, 10 * (e / s - 1)) + n
        },
        easeOutExpo: function(t, e, n, i, s) {
            return e == s ? n + i : i * (-Math.pow(2, -10 * e / s) + 1) + n
        },
        easeInOutExpo: function(t, e, n, i, s) {
            return 0 == e ? n : e == s ? n + i : (e /= s / 2) < 1 ? i / 2 * Math.pow(2, 10 * (e - 1)) + n : i / 2 * (-Math.pow(2, -10 * --e) + 2) + n
        },
        easeInCirc: function(t, e, n, i, s) {
            return -i * (Math.sqrt(1 - (e /= s) * e) - 1) + n
        },
        easeOutCirc: function(t, e, n, i, s) {
            return i * Math.sqrt(1 - (e = e / s - 1) * e) + n
        },
        easeInOutCirc: function(t, e, n, i, s) {
            return (e /= s / 2) < 1 ? -i / 2 * (Math.sqrt(1 - e * e) - 1) + n : i / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + n
        },
        easeInElastic: function(t, e, n, i, s) {
            var o = 1.70158,
                r = 0,
                a = i;
            if (0 == e) return n;
            if (1 == (e /= s)) return n + i;
            if (r || (r = .3 * s), a < Math.abs(i)) {
                a = i;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(i / a);
            return -(a * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * s - o) * (2 * Math.PI) / r)) + n
        },
        easeOutElastic: function(t, e, n, i, s) {
            var o = 1.70158,
                r = 0,
                a = i;
            if (0 == e) return n;
            if (1 == (e /= s)) return n + i;
            if (r || (r = .3 * s), a < Math.abs(i)) {
                a = i;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(i / a);
            return a * Math.pow(2, -10 * e) * Math.sin((e * s - o) * (2 * Math.PI) / r) + i + n
        },
        easeInOutElastic: function(t, e, n, i, s) {
            var o = 1.70158,
                r = 0,
                a = i;
            if (0 == e) return n;
            if (2 == (e /= s / 2)) return n + i;
            if (r || (r = s * (.3 * 1.5)), a < Math.abs(i)) {
                a = i;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(i / a);
            return 1 > e ? -.5 * (a * Math.pow(2, 10 * (e -= 1)) * Math.sin((e * s - o) * (2 * Math.PI) / r)) + n : a * Math.pow(2, -10 * (e -= 1)) * Math.sin((e * s - o) * (2 * Math.PI) / r) * .5 + i + n
        },
        easeInBack: function(t, e, n, i, s, o) {
            return void 0 == o && (o = 1.70158), i * (e /= s) * e * ((o + 1) * e - o) + n
        },
        easeOutBack: function(t, e, n, i, s, o) {
            return void 0 == o && (o = 1.70158), i * ((e = e / s - 1) * e * ((o + 1) * e + o) + 1) + n
        },
        easeInOutBack: function(t, e, n, i, s, o) {
            return void 0 == o && (o = 1.70158), (e /= s / 2) < 1 ? i / 2 * (e * e * (((o *= 1.525) + 1) * e - o)) + n : i / 2 * ((e -= 2) * e * (((o *= 1.525) + 1) * e + o) + 2) + n
        },
        easeInBounce: function(t, e, n, i, s) {
            return i - jQuery.easing.easeOutBounce(t, s - e, 0, i, s) + n
        },
        easeOutBounce: function(t, e, n, i, s) {
            return (e /= s) < 1 / 2.75 ? i * (7.5625 * e * e) + n : 2 / 2.75 > e ? i * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + n : 2.5 / 2.75 > e ? i * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + n : i * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + n
        },
        easeInOutBounce: function(t, e, n, i, s) {
            return s / 2 > e ? .5 * jQuery.easing.easeInBounce(t, 2 * e, 0, i, s) + n : .5 * jQuery.easing.easeOutBounce(t, 2 * e - s, 0, i, s) + .5 * i + n
        }
    }),
    function(t) {
        (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(t) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0, 4))
    }(navigator.userAgent || navigator.vendor || window.opera),
    function(t, e) {
        var n, i = t.jQuery || t.Cowboy || (t.Cowboy = {});
        i.throttle = n = function(t, n, s, o) {
            function r() {
                function i() {
                    u = +new Date, s.apply(l, h)
                }

                function r() {
                    a = e
                }
                var l = this,
                    c = +new Date - u,
                    h = arguments;
                o && !a && i(), a && clearTimeout(a), o === e && c > t ? i() : n !== !0 && (a = setTimeout(o ? r : i, o === e ? t - c : t))
            }
            var a, u = 0;
            return "boolean" != typeof n && (o = s, s = n, n = e), i.guid && (r.guid = s.guid = s.guid || i.guid++), r
        }, i.debounce = function(t, i, s) {
            return s === e ? n(t, i, !1) : n(t, s, i !== !1)
        }
    }(this),
    function(t) {
        t.fn.hoverIntent = function(e, n, i) {
            var s = {
                interval: 100,
                sensitivity: 7,
                timeout: 0
            };
            s = "object" == typeof e ? t.extend(s, e) : t.isFunction(n) ? t.extend(s, {
                over: e,
                out: n,
                selector: i
            }) : t.extend(s, {
                over: e,
                out: e,
                selector: n
            });
            var o, r, a, u, l = function(t) {
                    o = t.pageX, r = t.pageY
                },
                c = function(e, n) {
                    return n.hoverIntent_t = clearTimeout(n.hoverIntent_t), Math.abs(a - o) + Math.abs(u - r) < s.sensitivity ? (t(n).off("mousemove.hoverIntent", l), n.hoverIntent_s = 1, s.over.apply(n, [e])) : (a = o, u = r, void(n.hoverIntent_t = setTimeout(function() {
                        c(e, n)
                    }, s.interval)))
                },
                h = function(t, e) {
                    return e.hoverIntent_t = clearTimeout(e.hoverIntent_t), e.hoverIntent_s = 0, s.out.apply(e, [t])
                },
                f = function(e) {
                    var n = jQuery.extend({}, e),
                        i = this;
                    i.hoverIntent_t && (i.hoverIntent_t = clearTimeout(i.hoverIntent_t)), "mouseenter" == e.type ? (a = n.pageX, u = n.pageY, t(i).on("mousemove.hoverIntent", l), 1 != i.hoverIntent_s && (i.hoverIntent_t = setTimeout(function() {
                        c(n, i)
                    }, s.interval))) : (t(i).off("mousemove.hoverIntent", l), 1 == i.hoverIntent_s && (i.hoverIntent_t = setTimeout(function() {
                        h(n, i)
                    }, s.timeout)))
                };
            return this.on({
                "mouseenter.hoverIntent": f,
                "mouseleave.hoverIntent": f
            }, s.selector)
        }
    }(jQuery),
    function(t) {
        function e(t) {
            return "object" == typeof t ? t : {
                top: t,
                left: t
            }
        }
        var n = t.scrollTo = function(e, n, i) {
            t(window).scrollTo(e, n, i)
        };
        n.defaults = {
            axis: "xy",
            duration: parseFloat(t.fn.jquery) >= 1.3 ? 0 : 1,
            limit: !0
        }, n.window = function(e) {
            return t(window)._scrollable()
        }, t.fn._scrollable = function() {
            return this.map(function() {
                var e = this,
                    n = !e.nodeName || -1 != t.inArray(e.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]);
                if (!n) return e;
                var i = (e.contentWindow || e).document || e.ownerDocument || e;
                return /webkit/i.test(navigator.userAgent) || "BackCompat" == i.compatMode ? i.body : i.documentElement
            })
        }, t.fn.scrollTo = function(i, s, o) {
            return "object" == typeof s && (o = s, s = 0), "function" == typeof o && (o = {
                onAfter: o
            }), "max" == i && (i = 9e9), o = t.extend({}, n.defaults, o), s = s || o.duration, o.queue = o.queue && o.axis.length > 1, o.queue && (s /= 2), o.offset = e(o.offset), o.over = e(o.over), this._scrollable().each(function() {
                function r(t) {
                    l.animate(h, s, o.easing, t && function() {
                        t.call(this, i, o)
                    })
                }
                if (null != i) {
                    var a, u = this,
                        l = t(u),
                        c = i,
                        h = {},
                        f = l.is("html,body");
                    switch (typeof c) {
                        case "number":
                        case "string":
                            if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(c)) {
                                c = e(c);
                                break
                            }
                            if (c = t(c, this), !c.length) return;
                        case "object":
                            (c.is || c.style) && (a = (c = t(c)).offset())
                    }
                    t.each(o.axis.split(""), function(t, e) {
                        var i = "x" == e ? "Left" : "Top",
                            s = i.toLowerCase(),
                            d = "scroll" + i,
                            p = u[d],
                            m = n.max(u, e);
                        if (a) h[d] = a[s] + (f ? 0 : p - l.offset()[s]), o.margin && (h[d] -= parseInt(c.css("margin" + i)) || 0, h[d] -= parseInt(c.css("border" + i + "Width")) || 0), h[d] += o.offset[s] || 0, o.over[s] && (h[d] += c["x" == e ? "width" : "height"]() * o.over[s]);
                        else {
                            var g = c[s];
                            h[d] = g.slice && "%" == g.slice(-1) ? parseFloat(g) / 100 * m : g
                        }
                        o.limit && /^\d+$/.test(h[d]) && (h[d] = h[d] <= 0 ? 0 : Math.min(h[d], m)), !t && o.queue && (p != h[d] && r(o.onAfterFirst), delete h[d])
                    }), r(o.onAfter)
                }
            }).end()
        }, n.max = function(e, n) {
            var i = "x" == n ? "Width" : "Height",
                s = "scroll" + i;
            if (!t(e).is("html,body")) return e[s] - t(e)[i.toLowerCase()]();
            var o = "client" + i,
                r = e.ownerDocument.documentElement,
                a = e.ownerDocument.body;
            return Math.max(r[s], a[s]) - Math.min(r[o], a[o])
        }
    }(jQuery),
    function(t) {
        "function" == typeof define && define.amd && define.amd.jQuery ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        function e(t) {
            return t
        }

        function n(t) {
            return decodeURIComponent(t.replace(s, " "))
        }

        function i(t) {
            0 === t.indexOf('"') && (t = t.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
            try {
                return o.json ? JSON.parse(t) : t
            } catch (e) {}
        }
        var s = /\+/g,
            o = t.cookie = function(s, r, a) {
                if (void 0 !== r) {
                    if (a = t.extend({}, o.defaults, a), "number" == typeof a.expires) {
                        var u = a.expires,
                            l = a.expires = new Date;
                        l.setDate(l.getDate() + u)
                    }
                    return r = o.json ? JSON.stringify(r) : String(r), document.cookie = [encodeURIComponent(s), "=", o.raw ? r : encodeURIComponent(r), a.expires ? "; expires=" + a.expires.toUTCString() : "", a.path ? "; path=" + a.path : "", a.domain ? "; domain=" + a.domain : "", a.secure ? "; secure" : ""].join("")
                }
                for (var c = o.raw ? e : n, h = document.cookie.split("; "), f = s ? void 0 : {}, d = 0, p = h.length; p > d; d++) {
                    var m = h[d].split("="),
                        g = c(m.shift()),
                        v = c(m.join("="));
                    if (s && s === g) {
                        f = i(v);
                        break
                    }
                    s || (f[g] = i(v))
                }
                return f
            };
        o.defaults = {}, t.removeCookie = function(e, n) {
            return void 0 !== t.cookie(e) ? (t.cookie(e, "", t.extend(n, {
                expires: -1
            })), !0) : !1
        }
    }), (window.jQuery || window.Zepto) && ! function(t) {
        t.fn.Swipe = function(e) {
            return this.each(function() {
                t(this).data("Swipe", new Swipe(t(this)[0], e))
            })
        }
    }(window.jQuery || window.Zepto),
	// jQuery Tweetie plugin
    function(t) {
        t.fn.twittie = function(e) {
            var n = t.extend({
                    count: 10,
                    hideReplies: !1,
                    dateFormat: "%b/%d/%Y",
                    template: "{{date}} - {{tweet}}"
                }, e),
                i = function(t) {
                    for (var e = t.split(" "), n = "", i = 0, s = e.length; s > i; i++) {
                        var o = e[i],
                            r = "https://twitter.com/#!/"; - 1 !== o.indexOf("#") && (o = '<a href="' + r + "search/" + o.replace("#", "%23").replace(/[^A-Za-z0-9]/, "") + '" target="_blank">' + o + "</a>"), -1 !== o.indexOf("@") && (o = '<a href="' + r + o.replace("@", "").replace(/[^A-Za-z0-9]/, "") + '" target="_blank">' + o + "</a>"), -1 !== o.indexOf("http://") && (o = '<a href="' + o + '" target="_blank">' + o + "</a>"), n += o + " "
                    }
                    return n
                },
                s = function(t) {
                    var e = t.split(" ");
                    t = new Date(Date.parse(e[1] + " " + e[2] + ", " + e[5] + " " + e[3] + " UTC"));
                    for (var i = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], s = {
                            "%d": t.getDate(),
                            "%m": t.getMonth() + 1,
                            "%b": i[t.getMonth()].substr(0, 3),
                            "%B": i[t.getMonth()],
                            "%y": String(t.getFullYear()).slice(-2),
                            "%Y": t.getFullYear()
                        }, o = n.dateFormat, r = n.dateFormat.match(/%[dmbByY]/g), a = 0, u = r.length; u > a; a++) o = o.replace(r[a], s[r[a]]);
                    return o
                },
                o = function(t) {
                    for (var e = n.template, i = ["date", "tweet", "avatar"], s = 0, o = i.length; o > s; s++) e = e.replace(new RegExp("{{" + i[s] + "}}", "gi"), t[i[s]]);
                    return e
                };
            this.html("<span>Loading...</span>");
            var r = this;
            t.getJSON("api/tweet.php", {
                count: n.count,
                exclude_replies: n.hideReplies
            }, function(t) {
                r.find("span").fadeOut("fast", function() {
                    r.html("<ul></ul>");
                    for (var e = 0; e < n.count && t[e]; e++) {
                        var a = {
                            date: s(t[e].created_at),
                            tweet: i(t[e].text),
                            avatar: '<img src="' + t[e].user.profile_image_url + '" />'
                        };
                        r.find("ul").append("<li>" + o(a) + "</li>")
                    }
                })
            })
        }
    }(jQuery),
    function(t) {
        t.fn.appear = function(e, n) {
            var i = t.extend({
                data: void 0,
                one: !0,
                accX: 0,
                accY: 0
            }, n);
            return this.each(function() {
                var n = t(this);
                if (n.appeared = !1, !e) return void n.trigger("appear", i.data);
                var s = t(window),
                    o = function() {
                        if (!n.is(":visible")) return void(n.appeared = !1);
                        var t = s.scrollLeft(),
                            e = s.scrollTop(),
                            o = n.offset(),
                            r = o.left,
                            a = o.top,
                            u = i.accX,
                            l = i.accY,
                            c = n.height(),
                            h = s.height(),
                            f = n.width(),
                            d = s.width();
                        a + c + l >= e && e + h + l >= a && r + f + u >= t && t + d + u >= r ? n.appeared || n.trigger("appear", i.data) : n.appeared = !1
                    },
                    r = function() {
                        if (n.appeared = !0, i.one) {
                            s.unbind("scroll", o);
                            var r = t.inArray(o, t.fn.appear.checks);
                            r >= 0 && t.fn.appear.checks.splice(r, 1)
                        }
                        e.apply(this, arguments)
                    };
                i.one ? n.one("appear", i.data, r) : n.bind("appear", i.data, r), s.scroll(o), t.fn.appear.checks.push(o), o()
            })
        }, t.extend(t.fn.appear, {
            checks: [],
            timeout: null,
            checkAll: function() {
                var e = t.fn.appear.checks.length;
                if (e > 0)
                    for (; e--;) t.fn.appear.checks[e]()
            },
            run: function() {
                t.fn.appear.timeout && clearTimeout(t.fn.appear.timeout), t.fn.appear.timeout = setTimeout(t.fn.appear.checkAll, 20)
            }
        }), t.each(["append", "prepend", "after", "before", "attr", "removeAttr", "addClass", "removeClass", "toggleClass", "remove", "css", "show", "hide"], function(e, n) {
            var i = t.fn[n];
            i && (t.fn[n] = function() {
                var e = i.apply(this, arguments);
                return t.fn.appear.run(), e
            })
        })
    }(jQuery),
    function(t) {
        var e = t(window),
            n = e.height();
        e.resize(function() {
            n = e.height()
        }), t.fn.parallax = function(i, s, o) {
            function r() {
                l.each(function() {
                    u = l.offset().top
                }), a = o ? function(t) {
                    return t.outerHeight(!0)
                } : function(t) {
                    return t.height()
                }, (arguments.length < 1 || null === i) && (i = "50%"), (arguments.length < 2 || null === s) && (s = .5), (arguments.length < 3 || null === o) && (o = !0);
                var r = e.scrollTop();
                l.each(function() {
                    var e = t(this),
                        o = e.offset().top,
                        c = a(e);
                    r > o + c || o > r + n || l.css("backgroundPosition", i + " " + Math.round((u - r) * s) + "px")
                })
            }
            var a, u, l = t(this);
            e.bind("scroll", r).resize(r), r()
        }
    }(jQuery),
    function(t) {
        function e(t) {
            if (t in a.style) return t;
            var e = ["Moz", "Webkit", "O", "ms"],
                n = t.charAt(0).toUpperCase() + t.substr(1);
            if (t in a.style) return t;
            for (t = 0; t < e.length; ++t) {
                var i = e[t] + n;
                if (i in a.style) return i
            }
        }

        function n(t) {
            return "string" == typeof t && this.parse(t), this
        }

        function i(e, n, i, s) {
            var o = [];
            t.each(e, function(e) {
                e = t.camelCase(e), e = t.transit.propertyMap[e] || t.cssProps[e] || e, e = e.replace(/([A-Z])/g, function(t) {
                    return "-" + t.toLowerCase()
                }), -1 === t.inArray(e, o) && o.push(e)
            }), t.cssEase[i] && (i = t.cssEase[i]);
            var a = "" + r(n) + " " + i;
            0 < parseInt(s, 10) && (a += " " + r(s));
            var u = [];
            return t.each(o, function(t, e) {
                u.push(e + " " + a)
            }), u.join(", ")
        }

        function s(e, n) {
            n || (t.cssNumber[e] = !0), t.transit.propertyMap[e] = u.transform, t.cssHooks[e] = {
                get: function(n) {
                    return t(n).css("transit:transform").get(e)
                },
                set: function(n, i) {
                    var s = t(n).css("transit:transform");
                    s.setFromString(e, i), t(n).css({
                        "transit:transform": s
                    })
                }
            }
        }

        function o(t, e) {
            return "string" != typeof t || t.match(/^[\-0-9\.]+$/) ? "" + t + e : t
        }

        function r(e) {
            return t.fx.speeds[e] && (e = t.fx.speeds[e]), o(e, "ms")
        }
        t.transit = {
            version: "0.9.9",
            propertyMap: {
                marginLeft: "margin",
                marginRight: "margin",
                marginBottom: "margin",
                marginTop: "margin",
                paddingLeft: "padding",
                paddingRight: "padding",
                paddingBottom: "padding",
                paddingTop: "padding"
            },
            enabled: !0,
            useTransitionEnd: !1
        };
        var a = document.createElement("div"),
            u = {},
            l = -1 < navigator.userAgent.toLowerCase().indexOf("chrome");
        u.transition = e("transition"), u.transitionDelay = e("transitionDelay"), u.transform = e("transform"), u.transformOrigin = e("transformOrigin"), a.style[u.transform] = "", a.style[u.transform] = "rotateY(90deg)", u.transform3d = "" !== a.style[u.transform];
        var c, h = u.transitionEnd = {
            transition: "transitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd",
            WebkitTransition: "webkitTransitionEnd",
            msTransition: "MSTransitionEnd"
        }[u.transition] || null;
        for (c in u) u.hasOwnProperty(c) && "undefined" == typeof t.support[c] && (t.support[c] = u[c]);
        a = null, t.cssEase = {
            _default: "ease",
            "in": "ease-in",
            out: "ease-out",
            "in-out": "ease-in-out",
            snap: "cubic-bezier(0,1,.5,1)",
            easeOutCubic: "cubic-bezier(.215,.61,.355,1)",
            easeInOutCubic: "cubic-bezier(.645,.045,.355,1)",
            easeInCirc: "cubic-bezier(.6,.04,.98,.335)",
            easeOutCirc: "cubic-bezier(.075,.82,.165,1)",
            easeInOutCirc: "cubic-bezier(.785,.135,.15,.86)",
            easeInExpo: "cubic-bezier(.95,.05,.795,.035)",
            easeOutExpo: "cubic-bezier(.19,1,.22,1)",
            easeInOutExpo: "cubic-bezier(1,0,0,1)",
            easeInQuad: "cubic-bezier(.55,.085,.68,.53)",
            easeOutQuad: "cubic-bezier(.25,.46,.45,.94)",
            easeInOutQuad: "cubic-bezier(.455,.03,.515,.955)",
            easeInQuart: "cubic-bezier(.895,.03,.685,.22)",
            easeOutQuart: "cubic-bezier(.165,.84,.44,1)",
            easeInOutQuart: "cubic-bezier(.77,0,.175,1)",
            easeInQuint: "cubic-bezier(.755,.05,.855,.06)",
            easeOutQuint: "cubic-bezier(.23,1,.32,1)",
            easeInOutQuint: "cubic-bezier(.86,0,.07,1)",
            easeInSine: "cubic-bezier(.47,0,.745,.715)",
            easeOutSine: "cubic-bezier(.39,.575,.565,1)",
            easeInOutSine: "cubic-bezier(.445,.05,.55,.95)",
            easeInBack: "cubic-bezier(.6,-.28,.735,.045)",
            easeOutBack: "cubic-bezier(.175, .885,.32,1.275)",
            easeInOutBack: "cubic-bezier(.68,-.55,.265,1.55)"
        }, t.cssHooks["transit:transform"] = {
            get: function(e) {
                return t(e).data("transform") || new n
            },
            set: function(e, i) {
                var s = i;
                s instanceof n || (s = new n(s)), e.style[u.transform] = "WebkitTransform" !== u.transform || l ? s.toString() : s.toString(!0), t(e).data("transform", s)
            }
        }, t.cssHooks.transform = {
            set: t.cssHooks["transit:transform"].set
        }, "1.8" > t.fn.jquery && (t.cssHooks.transformOrigin = {
            get: function(t) {
                return t.style[u.transformOrigin]
            },
            set: function(t, e) {
                t.style[u.transformOrigin] = e
            }
        }, t.cssHooks.transition = {
            get: function(t) {
                return t.style[u.transition]
            },
            set: function(t, e) {
                t.style[u.transition] = e
            }
        }), s("scale"), s("translate"), s("rotate"), s("rotateX"), s("rotateY"), s("rotate3d"), s("perspective"), s("skewX"), s("skewY"), s("x", !0), s("y", !0), n.prototype = {
            setFromString: function(t, e) {
                var i = "string" == typeof e ? e.split(",") : e.constructor === Array ? e : [e];
                i.unshift(t), n.prototype.set.apply(this, i)
            },
            set: function(t) {
                var e = Array.prototype.slice.apply(arguments, [1]);
                this.setter[t] ? this.setter[t].apply(this, e) : this[t] = e.join(",")
            },
            get: function(t) {
                return this.getter[t] ? this.getter[t].apply(this) : this[t] || 0
            },
            setter: {
                rotate: function(t) {
                    this.rotate = o(t, "deg")
                },
                rotateX: function(t) {
                    this.rotateX = o(t, "deg")
                },
                rotateY: function(t) {
                    this.rotateY = o(t, "deg")
                },
                scale: function(t, e) {
                    void 0 === e && (e = t), this.scale = t + "," + e
                },
                skewX: function(t) {
                    this.skewX = o(t, "deg")
                },
                skewY: function(t) {
                    this.skewY = o(t, "deg")
                },
                perspective: function(t) {
                    this.perspective = o(t, "px")
                },
                x: function(t) {
                    this.set("translate", t, null)
                },
                y: function(t) {
                    this.set("translate", null, t)
                },
                translate: function(t, e) {
                    void 0 === this._translateX && (this._translateX = 0), void 0 === this._translateY && (this._translateY = 0), null !== t && void 0 !== t && (this._translateX = o(t, "px")), null !== e && void 0 !== e && (this._translateY = o(e, "px")), this.translate = this._translateX + "," + this._translateY
                }
            },
            getter: {
                x: function() {
                    return this._translateX || 0
                },
                y: function() {
                    return this._translateY || 0
                },
                scale: function() {
                    var t = (this.scale || "1,1").split(",");
                    return t[0] && (t[0] = parseFloat(t[0])), t[1] && (t[1] = parseFloat(t[1])), t[0] === t[1] ? t[0] : t
                },
                rotate3d: function() {
                    for (var t = (this.rotate3d || "0,0,0,0deg").split(","), e = 0; 3 >= e; ++e) t[e] && (t[e] = parseFloat(t[e]));
                    return t[3] && (t[3] = o(t[3], "deg")), t
                }
            },
            parse: function(t) {
                var e = this;
                t.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function(t, n, i) {
                    e.setFromString(n, i)
                })
            },
            toString: function(t) {
                var e, n = [];
                for (e in this) this.hasOwnProperty(e) && (u.transform3d || "rotateX" !== e && "rotateY" !== e && "perspective" !== e && "transformOrigin" !== e) && "_" !== e[0] && (t && "scale" === e ? n.push(e + "3d(" + this[e] + ",1)") : t && "translate" === e ? n.push(e + "3d(" + this[e] + ",0)") : n.push(e + "(" + this[e] + ")"));
                return n.join(" ")
            }
        }, t.fn.transition = t.fn.transit = function(e, n, s, o) {
            var a = this,
                l = 0,
                c = !0;
            "function" == typeof n && (o = n, n = void 0), "function" == typeof s && (o = s, s = void 0), "undefined" != typeof e.easing && (s = e.easing, delete e.easing), "undefined" != typeof e.duration && (n = e.duration, delete e.duration), "undefined" != typeof e.complete && (o = e.complete, delete e.complete), "undefined" != typeof e.queue && (c = e.queue, delete e.queue), "undefined" != typeof e.delay && (l = e.delay, delete e.delay), "undefined" == typeof n && (n = t.fx.speeds._default), "undefined" == typeof s && (s = t.cssEase._default), n = r(n);
            var f = i(e, n, s, l),
                d = t.transit.enabled && u.transition ? parseInt(n, 10) + parseInt(l, 10) : 0;
            if (0 === d) return n = c, s = function(t) {
                a.css(e), o && o.apply(a), t && t()
            }, !0 === n ? a.queue(s) : n ? a.queue(n, s) : s(), a;
            var p = {};
            return n = c, s = function(n) {
                this.offsetWidth;
                var i = !1,
                    s = function() {
                        i && a.unbind(h, s), d > 0 && a.each(function() {
                            this.style[u.transition] = p[this] || null
                        }), "function" == typeof o && o.apply(a), "function" == typeof n && n()
                    };
                d > 0 && h && t.transit.useTransitionEnd ? (i = !0, a.bind(h, s)) : window.setTimeout(s, d), a.each(function() {
                    d > 0 && (this.style[u.transition] = f), t(this).css(e)
                })
            }, !0 === n ? a.queue(s) : n ? a.queue(n, s) : s(), this
        }, t.transit.getTransitionValue = i
    }(jQuery),
    function(t) {
        function e(e) {
            var n = e || window.event,
                i = [].slice.call(arguments, 1),
                s = 0,
                o = 0,
                r = 0;
            return e = t.event.fix(n), e.type = "mousewheel", n.wheelDelta && (s = n.wheelDelta / 120), n.detail && (s = -n.detail / 3), r = s, void 0 !== n.axis && n.axis === n.HORIZONTAL_AXIS && (r = 0, o = -1 * s), void 0 !== n.wheelDeltaY && (r = n.wheelDeltaY / 120), void 0 !== n.wheelDeltaX && (o = -1 * n.wheelDeltaX / 120), i.unshift(e, s, o, r), (t.event.dispatch || t.event.handle).apply(this, i)
        }
        var n = ["DOMMouseScroll", "mousewheel"];
        if (t.event.fixHooks)
            for (var i = n.length; i;) t.event.fixHooks[n[--i]] = t.event.mouseHooks;
        t.event.special.mousewheel = {
            setup: function() {
                if (this.addEventListener)
                    for (var t = n.length; t;) this.addEventListener(n[--t], e, !1);
                else this.onmousewheel = e
            },
            teardown: function() {
                if (this.removeEventListener)
                    for (var t = n.length; t;) this.removeEventListener(n[--t], e, !1);
                else this.onmousewheel = null
            }
        }, t.fn.extend({
            mousewheel: function(t) {
                return t ? this.bind("mousewheel", t) : this.trigger("mousewheel")
            },
            unmousewheel: function(t) {
                return this.unbind("mousewheel", t)
            }
        })
    }
	
	// jQuery Tiny Nav plugin
	(jQuery),
    function(t, e, n) {
        t.fn.tinyNav = function(i) {
            var s = t.extend({
                active: "selected",
                header: "",
                indent: "- ",
                label: ""
            }, i);
            return this.each(function() {
                n++;
                var i = t(this),
                    o = "tinynav" + n,
                    r = ".l_" + o,
                    a = t("<select/>").attr("id", o).addClass("tinynav " + o);
                if (i.is("ul,ol")) {
                    "" !== s.header && a.append(t("<option/>").text(s.header));
                    var u = "";
                    i.addClass("l_" + o).find("a").each(function() {
                        u += '<option value="' + t(this).attr("href") + '">';
                        var e;
                        for (e = 0; e < t(this).parents("ul, ol").length - 1; e++) u += s.indent;
                        u += t(this).text() + "</option>"
                    }), a.append(u), s.header || a.find(":eq(" + t(r + " li").index(t(r + " li." + s.active)) + ")").attr("selected", !0), a.change(function() {
                        e.location.href = t(this).val()
                    }), t(r).after(a), s.label && a.before(t("<label/>").attr("for", o).addClass("tinynav_label " + o + "_label").append(s.label))
                }
            })
        }
    }(jQuery, this, 0);