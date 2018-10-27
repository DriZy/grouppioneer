// jQuery FitVids plugin
! function(t) {
    t.fn.fitVids = function(e) {
        var i = {
                customSelector: null
            },
            s = document.createElement("div"),
            n = document.getElementsByTagName("base")[0] || document.getElementsByTagName("script")[0];
        return s.className = "fit-vids-style", s.innerHTML = "&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>", n.parentNode.insertBefore(s, n), e && t.extend(i, e), this.each(function() {
            var e = ["iframe[src*='player.vimeo.com']", "iframe[src*='youtube.com']", "iframe[src*='youtube-nocookie.com']", "iframe[src*='kickstarter.com']", "object", "embed"];
            i.customSelector && e.push(i.customSelector);
            var s = t(this).find(e.join(","));
            s.each(function() {
                var e = t(this);
                if (!("embed" === this.tagName.toLowerCase() && e.parent("object").length || e.parent(".fluid-width-video-wrapper").length)) {
                    var i = "object" === this.tagName.toLowerCase() || e.attr("height") && !isNaN(parseInt(e.attr("height"), 10)) ? parseInt(e.attr("height"), 10) : e.height(),
                        s = isNaN(parseInt(e.attr("width"), 10)) ? e.width() : parseInt(e.attr("width"), 10),
                        n = i / s;
                    if (!e.attr("id")) {
                        var a = "fitvid" + Math.floor(999999 * Math.random());
                        e.attr("id", a)
                    }
                    e.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", 100 * n + "%"), e.removeAttr("height").removeAttr("width")
                }
            })
        })
    }
}
// Superfish Menu
(jQuery), ! function(t, e) {
    "use strict";
    var i = function() {
        var i = {
                bcClass: "sf-breadcrumb",
                menuClass: "sf-js-enabled",
                anchorClass: "sf-with-ul",
                menuArrowClass: "sf-arrows"
            },
            s = function() {
                var e = /^(?![\w\W]*Windows Phone)[\w\W]*(iPhone|iPad|iPod)/i.test(navigator.userAgent);
                return e && t("html").css("cursor", "pointer").on("click", t.noop), e
            }(),
            n = function() {
                var t = document.documentElement.style;
                return "behavior" in t && "fill" in t && /iemobile/i.test(navigator.userAgent)
            }(),
            a = function() {
                return !!e.PointerEvent
            }(),
            o = function(t, e, s) {
                var n, a = i.menuClass;
                e.cssArrows && (a += " " + i.menuArrowClass), n = s ? "addClass" : "removeClass", t[n](a)
            },
            h = function(e, s) {
                return e.find("li." + s.pathClass).slice(0, s.pathLevels).addClass(s.hoverClass + " " + i.bcClass).filter(function() {
                    return t(this).children(s.popUpSelector).hide().show().length
                }).removeClass(s.pathClass)
            },
            r = function(t, e) {
                var s = e ? "addClass" : "removeClass";
                t.children("a")[s](i.anchorClass)
            },
            l = function(t) {
                var e = t.css("ms-touch-action"),
                    i = t.css("touch-action");
                i = i || e, i = "pan-y" === i ? "auto" : "pan-y", t.css({
                    "ms-touch-action": i,
                    "touch-action": i
                })
            },
            d = function(t) {
                return t.closest("." + i.menuClass)
            },
            c = function(t) {
                return d(t).data("sfOptions")
            },
            u = function() {
                var e = t(this),
                    i = c(e);
                clearTimeout(i.sfTimer), e.siblings().superfish("hide").end().superfish("show")
            },
            p = function(e) {
                e.retainPath = t.inArray(this[0], e.$path) > -1, this.superfish("hide"), this.parents("." + e.hoverClass).length || (e.onIdle.call(d(this)), e.$path.length && t.proxy(u, e.$path)())
            },
            f = function() {
                var e = t(this),
                    i = c(e);
                s ? t.proxy(p, e, i)() : (clearTimeout(i.sfTimer), i.sfTimer = setTimeout(t.proxy(p, e, i), i.delay))
            },
            v = function(e) {
                var i = t(this),
                    s = c(i),
                    n = i.siblings(e.data.popUpSelector);
                return s.onHandleTouch.call(n) === !1 ? this : void(n.length > 0 && n.is(":hidden") && (i.one("click.superfish", !1), "MSPointerDown" === e.type || "pointerdown" === e.type ? i.trigger("focus") : t.proxy(u, i.parent("li"))()))
            },
            m = function(e, i) {
                var o = "li:has(" + i.popUpSelector + ")";
                t.fn.hoverIntent && !i.disableHI ? e.hoverIntent(u, f, o) : e.on("mouseenter.superfish", o, u).on("mouseleave.superfish", o, f);
                var h = "MSPointerDown.superfish";
                a && (h = "pointerdown.superfish"), s || (h += " touchend.superfish"), n && (h += " mousedown.superfish"), e.on("focusin.superfish", "li", u).on("focusout.superfish", "li", f).on(h, "a", i, v)
            };
        return {
            hide: function(e) {
                if (this.length) {
                    var i = this,
                        s = c(i);
                    if (!s) return this;
                    var n = s.retainPath === !0 ? s.$path : "",
                        a = i.find("li." + s.hoverClass).add(this).not(n).removeClass(s.hoverClass).children(s.popUpSelector),
                        o = s.speedOut;
                    if (e && (a.show(), o = 0), s.retainPath = !1, s.onBeforeHide.call(a) === !1) return this;
                    a.stop(!0, !0).animate(s.animationOut, o, function() {
                        var e = t(this);
                        s.onHide.call(e)
                    })
                }
                return this
            },
            show: function() {
                var t = c(this);
                if (!t) return this;
                var e = this.addClass(t.hoverClass),
                    i = e.children(t.popUpSelector);
                return t.onBeforeShow.call(i) === !1 ? this : (i.stop(!0, !0).animate(t.animation, t.speed, function() {
                    t.onShow.call(i)
                }), this)
            },
            destroy: function() {
                return this.each(function() {
                    var e, s = t(this),
                        n = s.data("sfOptions");
                    return n ? (e = s.find(n.popUpSelector).parent("li"), clearTimeout(n.sfTimer), o(s, n), r(e), l(s), s.off(".superfish").off(".hoverIntent"), e.children(n.popUpSelector).attr("style", function(t, e) {
                        return e.replace(/display[^;]+;?/g, "")
                    }), n.$path.removeClass(n.hoverClass + " " + i.bcClass).addClass(n.pathClass), s.find("." + n.hoverClass).removeClass(n.hoverClass), n.onDestroy.call(s), void s.removeData("sfOptions")) : !1
                })
            },
            init: function(e) {
                return this.each(function() {
                    var s = t(this);
                    if (s.data("sfOptions")) return !1;
                    var n = t.extend({}, t.fn.superfish.defaults, e),
                        a = s.find(n.popUpSelector).parent("li");
                    n.$path = h(s, n), s.data("sfOptions", n), o(s, n, !0), r(a, !0), l(s), m(s, n), a.not("." + i.bcClass).superfish("hide", !0), n.onInit.call(this)
                })
            }
        }
    }();
    t.fn.superfish = function(e, s) {
        return i[e] ? i[e].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof e && e ? t.error("Method " + e + " does not exist on jQuery.fn.superfish") : i.init.apply(this, arguments)
    }, t.fn.superfish.defaults = {
        popUpSelector: "ul,.sf-mega",
        hoverClass: "sfHover",
        pathClass: "overrideThisToUse",
        pathLevels: 1,
        delay: 800,
        animation: {
            opacity: "show"
        },
        animationOut: {
            opacity: "hide"
        },
        speed: "normal",
        speedOut: "fast",
        cssArrows: !0,
        disableHI: !1,
        onInit: t.noop,
        onBeforeShow: t.noop,
        onShow: t.noop,
        onBeforeHide: t.noop,
        onHide: t.noop,
        onIdle: t.noop,
        onDestroy: t.noop,
        onHandleTouch: t.noop
    }
}
// jQuery animated Knob
(jQuery, window),
function(t) {
    "object" == typeof exports ? module.exports = t(require("jquery")) : "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
}(function(t) {
    "use strict";
    var e = {},
        i = Math.max,
        s = Math.min;
    e.c = {}, e.c.d = t(document), e.c.t = function(t) {
        return t.originalEvent.touches.length - 1
    }, e.o = function() {
        var i = this;
        this.o = null, this.$ = null, this.i = null, this.g = null, this.v = null, this.cv = null, this.x = 0, this.y = 0, this.w = 0, this.h = 0, this.$c = null, this.c = null, this.t = 0, this.isInit = !1, this.fgcolor = null, this.pColor = null, this.dH = null, this.cH = null, this.eH = null, this.rH = null, this.scale = 1, this.relative = !1, this.relativeWidth = !1, this.relativeHeight = !1, this.$div = null, this.run = function() {
            var e = function(t, e) {
                var s;
                for (s in e) i.o[s] = e[s];
                i._carve().init(), i._configure()._draw()
            };
            if (!this.$.data("kontroled")) {
                if (this.$.data("kontroled", !0), this.extend(), this.o = t.extend({
                        min: void 0 !== this.$.data("min") ? this.$.data("min") : 0,
                        max: void 0 !== this.$.data("max") ? this.$.data("max") : 100,
                        stopper: !0,
                        readonly: this.$.data("readonly") || "readonly" === this.$.attr("readonly"),
                        cursor: this.$.data("cursor") === !0 && 30 || this.$.data("cursor") || 0,
                        thickness: this.$.data("thickness") && Math.max(Math.min(this.$.data("thickness"), 1), .01) || .35,
                        lineCap: this.$.data("linecap") || "butt",
                        width: this.$.data("width") || 200,
                        height: this.$.data("height") || 200,
                        displayinput: null == this.$.data("displayinput") || this.$.data("displayinput"),
                        displayPrevious: this.$.data("displayprevious"),
                        fgcolor: this.$.data("fgcolor") || "#87CEEB",
                        inputColor: this.$.data("inputcolor"),
                        font: this.$.data("font") || "Arial",
                        fontWeight: this.$.data("font-weight") || "bold",
                        inline: !1,
                        step: this.$.data("step") || 1,
                        rotation: this.$.data("rotation"),
                        draw: null,
                        change: null,
                        cancel: null,
                        release: null,
                        format: function(t) {
                            return t
                        },
                        parse: function(t) {
                            return parseFloat(t)
                        }
                    }, this.o), this.o.flip = "anticlockwise" === this.o.rotation || "acw" === this.o.rotation, this.o.inputColor || (this.o.inputColor = this.o.fgcolor), this.$.is("fieldset") ? (this.v = {}, this.i = this.$.find("input"), this.i.each(function(e) {
                        var s = t(this);
                        i.i[e] = s, i.v[e] = i.o.parse(s.val()), s.bind("change blur", function() {
                            var t = {};
                            t[e] = s.val(), i.val(i._validate(t))
                        })
                    }), this.$.find("legend").remove()) : (this.i = this.$, this.v = this.o.parse(this.$.val()), "" === this.v && (this.v = this.o.min), this.$.bind("change blur", function() {
                        i.val(i._validate(i.o.parse(i.$.val())))
                    })), !this.o.displayinput && this.$.hide(), this.$c = t(document.createElement("canvas")).attr({
                        width: this.o.width,
                        height: this.o.height
                    }), this.$div = t('<div style="' + (this.o.inline ? "display:inline;" : "") + "width:" + this.o.width + "px;height:" + this.o.height + 'px;"></div>'), this.$.wrap(this.$div).before(this.$c), this.$div = this.$.parent(), "undefined" != typeof G_vmlCanvasManager && G_vmlCanvasManager.initElement(this.$c[0]), this.c = this.$c[0].getContext ? this.$c[0].getContext("2d") : null, !this.c) throw {
                    name: "CanvasNotSupportedException",
                    message: "Canvas not supported. Please use excanvas on IE8.0.",
                    toString: function() {
                        return this.name + ": " + this.message
                    }
                };
                return this.scale = (window.devicePixelRatio || 1) / (this.c.webkitBackingStorePixelRatio || this.c.mozBackingStorePixelRatio || this.c.msBackingStorePixelRatio || this.c.oBackingStorePixelRatio || this.c.backingStorePixelRatio || 1), this.relativeWidth = this.o.width % 1 !== 0 && this.o.width.indexOf("%"), this.relativeHeight = this.o.height % 1 !== 0 && this.o.height.indexOf("%"), this.relative = this.relativeWidth || this.relativeHeight, this._carve(), this.v instanceof Object ? (this.cv = {}, this.copy(this.v, this.cv)) : this.cv = this.v, this.$.bind("configure", e).parent().bind("configure", e), this._listen()._configure()._xy().init(), this.isInit = !0, this.$.val(this.o.format(this.v)), this._draw(), this
            }
        }, this._carve = function() {
            if (this.relative) {
                var t = this.relativeWidth ? this.$div.parent().width() * parseInt(this.o.width) / 100 : this.$div.parent().width(),
                    e = this.relativeHeight ? this.$div.parent().height() * parseInt(this.o.height) / 100 : this.$div.parent().height();
                this.w = this.h = Math.min(t, e)
            } else this.w = this.o.width, this.h = this.o.height;
            return this.$div.css({
                width: this.w + "px",
                height: this.h + "px"
            }), this.$c.attr({
                width: this.w,
                height: this.h
            }), 1 !== this.scale && (this.$c[0].width = this.$c[0].width * this.scale, this.$c[0].height = this.$c[0].height * this.scale, this.$c.width(this.w), this.$c.height(this.h)), this
        }, this._draw = function() {
            var t = !0;
            i.g = i.c, i.clear(), i.dH && (t = i.dH()), t !== !1 && i.draw()
        }, this._touch = function(t) {
            var s = function(t) {
                var e = i.xy2val(t.originalEvent.touches[i.t].pageX, t.originalEvent.touches[i.t].pageY);
                e != i.cv && (i.cH && i.cH(e) === !1 || (i.change(i._validate(e)), i._draw()))
            };
            return this.t = e.c.t(t), s(t), e.c.d.bind("touchmove.k", s).bind("touchend.k", function() {
                e.c.d.unbind("touchmove.k touchend.k"), i.val(i.cv)
            }), this
        }, this._mouse = function(t) {
            var s = function(t) {
                var e = i.xy2val(t.pageX, t.pageY);
                e != i.cv && (i.cH && i.cH(e) === !1 || (i.change(i._validate(e)), i._draw()))
            };
            return s(t), e.c.d.bind("mousemove.k", s).bind("keyup.k", function(t) {
                if (27 === t.keyCode) {
                    if (e.c.d.unbind("mouseup.k mousemove.k keyup.k"), i.eH && i.eH() === !1) return;
                    i.cancel()
                }
            }).bind("mouseup.k", function(t) {
                e.c.d.unbind("mousemove.k mouseup.k keyup.k"), i.val(i.cv)
            }), this
        }, this._xy = function() {
            var t = this.$c.offset();
            return this.x = t.left, this.y = t.top, this
        }, this._listen = function() {
            return this.o.readonly ? this.$.attr("readonly", "readonly") : (this.$c.bind("mousedown", function(t) {
                t.preventDefault(), i._xy()._mouse(t)
            }).bind("touchstart", function(t) {
                t.preventDefault(), i._xy()._touch(t)
            }), this.listen()), this.relative && t(window).resize(function() {
                i._carve().init(), i._draw()
            }), this
        }, this._configure = function() {
            return this.o.draw && (this.dH = this.o.draw), this.o.change && (this.cH = this.o.change), this.o.cancel && (this.eH = this.o.cancel), this.o.release && (this.rH = this.o.release), this.o.displayPrevious ? (this.pColor = this.h2rgba(this.o.fgcolor, "0.4"), this.fgcolor = this.h2rgba(this.o.fgcolor, "0.6")) : this.fgcolor = this.o.fgcolor, this
        }, this._clear = function() {
            this.$c[0].width = this.$c[0].width
        }, this._validate = function(t) {
            var e = ~~((0 > t ? -.5 : .5) + t / this.o.step) * this.o.step;
            return Math.round(100 * e) / 100
        }, this.listen = function() {}, this.extend = function() {}, this.init = function() {}, this.change = function(t) {}, this.val = function(t) {}, this.xy2val = function(t, e) {}, this.draw = function() {}, this.clear = function() {
            this._clear()
        }, this.h2rgba = function(t, e) {
            var i;
            return t = t.substring(1, 7), i = [parseInt(t.substring(0, 2), 16), parseInt(t.substring(2, 4), 16), parseInt(t.substring(4, 6), 16)], "rgba(" + i[0] + "," + i[1] + "," + i[2] + "," + e + ")"
        }, this.copy = function(t, e) {
            for (var i in t) e[i] = t[i]
        }
    }, e.Dial = function() {
        e.o.call(this), this.startAngle = null, this.xy = null, this.radius = null, this.lineWidth = null, this.cursorExt = null, this.w2 = null, this.PI2 = 2 * Math.PI, this.extend = function() {
            this.o = t.extend({
                bgColor: this.$.data("bgcolor") || "#EEEEEE",
                angleOffset: this.$.data("angleoffset") || 0,
                angleArc: this.$.data("anglearc") || 360,
                inline: !0
            }, this.o)
        }, this.val = function(t, e) {
            return null == t ? this.v : (t = this.o.parse(t), void(e !== !1 && t != this.v && this.rH && this.rH(t) === !1 || (this.cv = this.o.stopper ? i(s(t, this.o.max), this.o.min) : t, this.v = this.cv, this.$.val(this.o.format(this.v)), this._draw())))
        }, this.xy2val = function(t, e) {
            var n, a;
            return n = Math.atan2(t - (this.x + this.w2), -(e - this.y - this.w2)) - this.angleOffset, this.o.flip && (n = this.angleArc - n - this.PI2), this.angleArc != this.PI2 && 0 > n && n > -.5 ? n = 0 : 0 > n && (n += this.PI2), a = n * (this.o.max - this.o.min) / this.angleArc + this.o.min, this.o.stopper && (a = i(s(a, this.o.max), this.o.min)), a
        }, this.listen = function() {
            var e, n, a, o, h = this,
                r = function(t) {
                    t.preventDefault();
                    var a = t.originalEvent,
                        o = a.detail || a.wheelDeltaX,
                        r = a.detail || a.wheelDeltaY,
                        l = h._validate(h.o.parse(h.$.val())) + (o > 0 || r > 0 ? h.o.step : 0 > o || 0 > r ? -h.o.step : 0);
                    l = i(s(l, h.o.max), h.o.min), h.val(l, !1), h.rH && (clearTimeout(e), e = setTimeout(function() {
                        h.rH(l), e = null
                    }, 100), n || (n = setTimeout(function() {
                        e && h.rH(l), n = null
                    }, 200)))
                },
                l = 1,
                d = {
                    37: -h.o.step,
                    38: h.o.step,
                    39: h.o.step,
                    40: -h.o.step
                };
            this.$.bind("keydown", function(e) {
                var n = e.keyCode;
                if (n >= 96 && 105 >= n && (n = e.keyCode = n - 48), a = parseInt(String.fromCharCode(n)), isNaN(a) && (13 !== n && 8 !== n && 9 !== n && 189 !== n && (190 !== n || h.$.val().match(/\./)) && e.preventDefault(), t.inArray(n, [37, 38, 39, 40]) > -1)) {
                    e.preventDefault();
                    var r = h.o.parse(h.$.val()) + d[n] * l;
                    h.o.stopper && (r = i(s(r, h.o.max), h.o.min)), h.change(h._validate(r)), h._draw(), o = window.setTimeout(function() {
                        l *= 2
                    }, 30)
                }
            }).bind("keyup", function(t) {
                isNaN(a) ? o && (window.clearTimeout(o), o = null, l = 1, h.val(h.$.val())) : h.$.val() > h.o.max && h.$.val(h.o.max) || h.$.val() < h.o.min && h.$.val(h.o.min)
            }), this.$c.bind("mousewheel DOMMouseScroll", r), this.$.bind("mousewheel DOMMouseScroll", r)
        }, this.init = function() {
            (this.v < this.o.min || this.v > this.o.max) && (this.v = this.o.min), this.$.val(this.v), this.w2 = this.w / 2, this.cursorExt = this.o.cursor / 100, this.xy = this.w2 * this.scale, this.lineWidth = this.xy * this.o.thickness, this.lineCap = this.o.lineCap, this.radius = this.xy - this.lineWidth / 2, this.o.angleOffset && (this.o.angleOffset = isNaN(this.o.angleOffset) ? 0 : this.o.angleOffset), this.o.angleArc && (this.o.angleArc = isNaN(this.o.angleArc) ? this.PI2 : this.o.angleArc), this.angleOffset = this.o.angleOffset * Math.PI / 180, this.angleArc = this.o.angleArc * Math.PI / 180, this.startAngle = 1.5 * Math.PI + this.angleOffset, this.endAngle = 1.5 * Math.PI + this.angleOffset + this.angleArc;
            var t = i(String(Math.abs(this.o.max)).length, String(Math.abs(this.o.min)).length, 2) + 2;
            this.o.displayinput && this.i.css({
                width: (this.w / 2 + 4 >> 0) + "px",
                height: (this.w / 3 >> 0) + "px",
                position: "absolute",
                "vertical-align": "middle",
                "margin-top": (this.w / 3 >> 0) + "px",
                "margin-left": "-" + (3 * this.w / 4 + 2 >> 0) + "px",
                border: 0,
                background: "none",
                font: this.o.fontWeight + " " + (this.w / t >> 0) + "px " + this.o.font,
                "text-align": "center",
                color: this.o.inputColor || this.o.fgcolor,
                padding: "0px",
                "-webkit-appearance": "none"
            }) || this.i.css({
                width: "0px",
                visibility: "hidden"
            })
        }, this.change = function(t) {
            this.cv = t, this.$.val(this.o.format(t))
        }, this.angle = function(t) {
            return (t - this.o.min) * this.angleArc / (this.o.max - this.o.min)
        }, this.arc = function(t) {
            var e, i;
            return t = this.angle(t), this.o.flip ? (e = this.endAngle + 1e-5, i = e - t - 1e-5) : (e = this.startAngle - 1e-5, i = e + t + 1e-5), this.o.cursor && (e = i - this.cursorExt) && (i += this.cursorExt), {
                s: e,
                e: i,
                d: this.o.flip && !this.o.cursor
            }
        }, this.draw = function() {
            var t, e = this.g,
                i = this.arc(this.cv),
                s = 1;
            e.lineWidth = this.lineWidth, e.lineCap = this.lineCap, "none" !== this.o.bgColor && (e.beginPath(), e.strokeStyle = this.o.bgColor, e.arc(this.xy, this.xy, this.radius, this.endAngle - 1e-5, this.startAngle + 1e-5, !0), e.stroke()), this.o.displayPrevious && (t = this.arc(this.v), e.beginPath(), e.strokeStyle = this.pColor, e.arc(this.xy, this.xy, this.radius, t.s, t.e, t.d), e.stroke(), s = this.cv == this.v), e.beginPath(), e.strokeStyle = s ? this.o.fgcolor : this.fgcolor, e.arc(this.xy, this.xy, this.radius, i.s, i.e, i.d), e.stroke()
        }, this.cancel = function() {
            this.val(this.v)
        }
    }, t.fn.dial = t.fn.knob = function(i) {
        return this.each(function() {
            var s = new e.Dial;
            s.o = i, s.$ = t(this), s.run()
        }).parent()
    }
}),
// jQuery Scroll To plugin
function(t) {
    function e(t) {
        return "object" == typeof t ? t : {
            top: t,
            left: t
        }
    }
    var i = t.scrollTo = function(e, i, s) {
        t(window).scrollTo(e, i, s)
    };
    i.defaults = {
        axis: "xy",
        duration: parseFloat(t.fn.jquery) >= 1.3 ? 0 : 1,
        limit: !0
    }, i.window = function(e) {
        return t(window)._scrollable()
    }, t.fn._scrollable = function() {
        return this.map(function() {
            var e = this,
                i = !e.nodeName || -1 != t.inArray(e.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]);
            if (!i) return e;
            var s = (e.contentWindow || e).document || e.ownerDocument || e;
            return /webkit/i.test(navigator.userAgent) || "BackCompat" == s.compatMode ? s.body : s.documentElement
        })
    }, t.fn.scrollTo = function(s, n, a) {
        return "object" == typeof n && (a = n, n = 0), "function" == typeof a && (a = {
            onAfter: a
        }), "max" == s && (s = 9e9), a = t.extend({}, i.defaults, a), n = n || a.duration, a.queue = a.queue && a.axis.length > 1, a.queue && (n /= 2), a.offset = e(a.offset), a.over = e(a.over), this._scrollable().each(function() {
            function o(t) {
                l.animate(c, n, a.easing, t && function() {
                    t.call(this, s, a)
                })
            }
            if (s) {
                var h, r = this,
                    l = t(r),
                    d = s,
                    c = {},
                    u = l.is("html,body");
                switch (typeof d) {
                    case "number":
                    case "string":
                        if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(d)) {
                            d = e(d);
                            break
                        }
                        if (d = t(d, this), !d.length) return;
                    case "object":
                        (d.is || d.style) && (h = (d = t(d)).offset())
                }
                t.each(a.axis.split(""), function(t, e) {
                    var s = "x" == e ? "Left" : "Top",
                        n = s.toLowerCase(),
                        p = "scroll" + s,
                        f = r[p],
                        v = i.max(r, e);
                    if (h) c[p] = h[n] + (u ? 0 : f - l.offset()[n]), a.margin && (c[p] -= parseInt(d.css("margin" + s)) || 0, c[p] -= parseInt(d.css("border" + s + "Width")) || 0), c[p] += a.offset[n] || 0, a.over[n] && (c[p] += d["x" == e ? "width" : "height"]() * a.over[n]);
                    else {
                        var m = d[n];
                        c[p] = m.slice && "%" == m.slice(-1) ? parseFloat(m) / 100 * v : m
                    }
                    a.limit && /^\d+$/.test(c[p]) && (c[p] = c[p] <= 0 ? 0 : Math.min(c[p], v)), !t && a.queue && (f != c[p] && o(a.onAfterFirst), delete c[p])
                }), o(a.onAfter)
            }
        }).end()
    }, i.max = function(e, i) {
        var s = "x" == i ? "Width" : "Height",
            n = "scroll" + s;
        if (!t(e).is("html,body")) return e[n] - t(e)[s.toLowerCase()]();
        var a = "client" + s,
            o = e.ownerDocument.documentElement,
            h = e.ownerDocument.body;
        return Math.max(o[n], h[n]) - Math.min(o[a], h[a])
    }
}(jQuery),

// jQuery CountTo plugin
function(t) {
    function e(t, e) {
        return t.toFixed(e.decimals)
    }
    t.fn.countTo = function(e) {
        return e = e || {}, t(this).each(function() {
            function i() {
                d += o, l++, s(d), "function" == typeof n.onUpdate && n.onUpdate.call(h, d), l >= a && (r.removeData("countTo"), clearInterval(c.interval), d = n.to, "function" == typeof n.onComplete && n.onComplete.call(h, d))
            }

            function s(t) {
                var e = n.formatter.call(h, t, n);
                r.html(e)
            }
            var n = t.extend({}, t.fn.countTo.defaults, {
                    from: t(this).data("from"),
                    to: t(this).data("to"),
                    speed: t(this).data("speed"),
                    refreshInterval: t(this).data("refresh-interval"),
                    decimals: t(this).data("decimals")
                }, e),
                a = Math.ceil(n.speed / n.refreshInterval),
                o = (n.to - n.from) / a,
                h = this,
                r = t(this),
                l = 0,
                d = n.from,
                c = r.data("countTo") || {};
            r.data("countTo", c), c.interval && clearInterval(c.interval), c.interval = setInterval(i, n.refreshInterval), s(d)
        })
    }, t.fn.countTo.defaults = {
        from: 0,
        to: 0,
        speed: 1e3,
        refreshInterval: 100,
        decimals: 0,
        formatter: e,
        onUpdate: null,
        onComplete: null
    }
}
// jQuery BootStrap SelectPicker
(jQuery), ! function(t) {
    "use strict";
    t.expr[":"].icontains = function(e, i, s) {
        return t(e).text().toUpperCase().indexOf(s[3].toUpperCase()) >= 0
    };
    var e = function(i, s, n) {
        n && (n.stopPropagation(), n.preventDefault()), this.$element = t(i), this.$newElement = null, this.$button = null, this.$menu = null, this.$lis = null, this.options = s, null === this.options.title && (this.options.title = this.$element.attr("title")), this.val = e.prototype.val, this.render = e.prototype.render, this.refresh = e.prototype.refresh, this.setStyle = e.prototype.setStyle, this.selectAll = e.prototype.selectAll, this.deselectAll = e.prototype.deselectAll, this.destroy = e.prototype.destroy, this.remove = e.prototype.destroy, this.show = e.prototype.show, this.hide = e.prototype.hide, this.init()
    };
    e.VERSION = "1.6.0", e.DEFAULTS = {
        style: "btn-default",
        size: "auto",
        title: null,
        selectedTextFormat: "values",
        noneSelectedText: "Nothing selected",
        noneResultsText: "No results match",
        countSelectedText: "{0} of {1} selected",
        maxOptionsText: ["Limit reached ({n} {var} max)", "Group limit reached ({n} {var} max)", ["items", "item"]],
        width: !1,
        container: !1,
        hideDisabled: !1,
        showSubtext: !1,
        showIcon: !0,
        showContent: !0,
        dropupAuto: !0,
        header: !1,
        liveSearch: !1,
        actionsBox: !1,
        multipleSeparator: ", ",
        iconBase: "glyphicon",
        tickIcon: "glyphicon-ok",
        maxOptions: !1,
        mobile: !1
    }, e.prototype = {
        constructor: e,
        init: function() {
            var e = this,
                i = this.$element.attr("id");
            this.$element.hide(), this.multiple = this.$element.prop("multiple"), this.autofocus = this.$element.prop("autofocus"), this.$newElement = this.createView(), this.$element.after(this.$newElement), this.$menu = this.$newElement.find("> .dropdown-menu"), this.$button = this.$newElement.find("> button"), this.$searchbox = this.$newElement.find("input"), void 0 !== i && (this.$button.attr("data-id", i), t('label[for="' + i + '"]').click(function(t) {
                t.preventDefault(), e.$button.focus()
            })), this.checkDisabled(), this.clickListener(), this.options.liveSearch && this.liveSearchListener(), this.render(), this.liHeight(), this.setStyle(), this.setWidth(), this.options.container && this.selectPosition(), this.$menu.data("this", this), this.$newElement.data("this", this), this.options.mobile && this.mobile()
        },
        createDropdown: function() {
            var e = this.multiple ? " show-tick" : "",
                i = this.$element.parent().hasClass("input-group") ? " input-group-btn" : "",
                s = this.autofocus ? " autofocus" : "",
                n = this.options.header ? '<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;</button>' + this.options.header + "</div>" : "",
                a = this.options.liveSearch ? '<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control" autocomplete="off" /></div>' : "",
                o = this.options.actionsBox ? '<div class="bs-actionsbox"><div class="btn-group btn-block"><button class="actions-btn bs-select-all btn btn-sm btn-default">Select All</button><button class="actions-btn bs-deselect-all btn btn-sm btn-default">Deselect All</button></div></div>' : "",
                h = '<div class="btn-group bootstrap-select' + e + i + '"><button type="button" class="btn dropdown-toggle selectpicker" data-toggle="dropdown"' + s + '><span class="filter-option pull-left"></span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open">' + n + a + o + '<ul class="dropdown-menu inner selectpicker" role="menu"></ul></div></div>';
            return t(h)
        },
        createView: function() {
            var t = this.createDropdown(),
                e = this.createLi();
            return t.find("ul").append(e), t
        },
        reloadLi: function() {
            this.destroyLi();
            var t = this.createLi();
            this.$menu.find("ul").append(t)
        },
        destroyLi: function() {
            this.$menu.find("li").remove()
        },
        createLi: function() {
            var e = this,
                i = [],
                s = "",
                n = 0;
            return this.$element.find("option").each(function() {
                var s = t(this),
                    a = s.attr("class") || "",
                    o = s.attr("style") || "",
                    h = s.data("content") ? s.data("content") : s.html(),
                    r = void 0 !== s.data("subtext") ? '<small class="muted text-muted">' + s.data("subtext") + "</small>" : "",
                    l = void 0 !== s.data("icon") ? '<i class="' + e.options.iconBase + " " + s.data("icon") + '"></i> ' : "";
                if ("" !== l && (s.is(":disabled") || s.parent().is(":disabled")) && (l = "<span>" + l + "</span>"), s.data("content") || (h = l + '<span class="text">' + h + r + "</span>"), e.options.hideDisabled && (s.is(":disabled") || s.parent().is(":disabled"))) i.push('<a style="min-height: 0; padding: 0"></a>');
                else if (s.parent().is("optgroup") && s.data("divider") !== !0)
                    if (0 === s.index()) {
                        var d = s.parent().attr("label"),
                            c = void 0 !== s.parent().data("subtext") ? '<small class="muted text-muted">' + s.parent().data("subtext") + "</small>" : "",
                            u = s.parent().data("icon") ? '<i class="' + e.options.iconBase + " " + s.parent().data("icon") + '"></i> ' : "";
                        d = u + '<span class="text">' + d + c + "</span>", n += 1, i.push(0 !== s[0].index ? '<div class="div-contain"><div class="divider"></div></div><dt>' + d + "</dt>" + e.createA(h, "opt " + a, o, n) : "<dt>" + d + "</dt>" + e.createA(h, "opt " + a, o, n))
                    } else i.push(e.createA(h, "opt " + a, o, n));
                else i.push(s.data("divider") === !0 ? '<div class="div-contain"><div class="divider"></div></div>' : t(this).data("hidden") === !0 ? "<a></a>" : e.createA(h, a, o))
            }), t.each(i, function(t, e) {
                var i = "<a></a>" === e ? 'class="hide is-hidden"' : "";
                s += '<li rel="' + t + '"' + i + ">" + e + "</li>"
            }), this.multiple || 0 !== this.$element.find("option:selected").length || this.options.title || this.$element.find("option").eq(0).prop("selected", !0).attr("selected", "selected"), t(s)
        },
        createA: function(t, e, i, s) {
            return '<a tabindex="0" class="' + e + '" style="' + i + '"' + ("undefined" != typeof s ? 'data-optgroup="' + s + '"' : "") + ">" + t + '<i class="' + this.options.iconBase + " " + this.options.tickIcon + ' icon-ok check-mark"></i></a>'
        },
        render: function(e) {
            var i = this;
            e !== !1 && this.$element.find("option").each(function(e) {
                i.setDisabled(e, t(this).is(":disabled") || t(this).parent().is(":disabled")), i.setSelected(e, t(this).is(":selected"))
            }), this.tabIndex();
            var s = this.$element.find("option:selected").map(function() {
                    var e, s = t(this),
                        n = s.data("icon") && i.options.showIcon ? '<i class="' + i.options.iconBase + " " + s.data("icon") + '"></i> ' : "";
                    return e = i.options.showSubtext && s.attr("data-subtext") && !i.multiple ? ' <small class="muted text-muted">' + s.data("subtext") + "</small>" : "", s.data("content") && i.options.showContent ? s.data("content") : void 0 !== s.attr("title") ? s.attr("title") : n + s.html() + e
                }).toArray(),
                n = this.multiple ? s.join(this.options.multipleSeparator) : s[0];
            if (this.multiple && this.options.selectedTextFormat.indexOf("count") > -1) {
                var a = this.options.selectedTextFormat.split(">"),
                    o = this.options.hideDisabled ? ":not([disabled])" : "";
                (a.length > 1 && s.length > a[1] || 1 == a.length && s.length >= 2) && (n = this.options.countSelectedText.replace("{0}", s.length).replace("{1}", this.$element.find('option:not([data-divider="true"], [data-hidden="true"])' + o).length))
            }
            this.options.title = this.$element.attr("title"), "static" == this.options.selectedTextFormat && (n = this.options.title), n || (n = void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText), this.$button.attr("title", t.trim(t("<div/>").html(n).text()).replace(/\s\s+/g, " ")), this.$newElement.find(".filter-option").html(n)
        },
        setStyle: function(t, e) {
            this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device|validate\[.*\]/gi, ""));
            var i = t ? t : this.options.style;
            "add" == e ? this.$button.addClass(i) : "remove" == e ? this.$button.removeClass(i) : (this.$button.removeClass(this.options.style), this.$button.addClass(i))
        },
        liHeight: function() {
            if (this.options.size !== !1) {
                var t = this.$menu.parent().clone().find("> .dropdown-toggle").prop("autofocus", !1).end().appendTo("body"),
                    e = t.addClass("open").find("> .dropdown-menu"),
                    i = e.find("li > a").outerHeight(),
                    s = this.options.header ? e.find(".popover-title").outerHeight() : 0,
                    n = this.options.liveSearch ? e.find(".bootstrap-select-searchbox").outerHeight() : 0,
                    a = this.options.actionsBox ? e.find(".bs-actionsbox").outerHeight() : 0;
                t.remove(), this.$newElement.data("liHeight", i).data("headerHeight", s).data("searchHeight", n).data("actionsHeight", a)
            }
        },
        setSize: function() {
            var e, i, s, n = this,
                a = this.$menu,
                o = a.find(".inner"),
                h = this.$newElement.outerHeight(),
                r = this.$newElement.data("liHeight"),
                l = this.$newElement.data("headerHeight"),
                d = this.$newElement.data("searchHeight"),
                c = this.$newElement.data("actionsHeight"),
                u = a.find("li .divider").outerHeight(!0),
                p = parseInt(a.css("padding-top")) + parseInt(a.css("padding-bottom")) + parseInt(a.css("border-top-width")) + parseInt(a.css("border-bottom-width")),
                f = this.options.hideDisabled ? ":not(.disabled)" : "",
                v = t(window),
                m = p + parseInt(a.css("margin-top")) + parseInt(a.css("margin-bottom")) + 2,
                g = function() {
                    i = n.$newElement.offset().top - v.scrollTop(), s = v.height() - i - h
                };
            if (g(), this.options.header && a.css("padding-top", 0), "auto" == this.options.size) {
                var w = function() {
                    var t, h = n.$lis.not(".hide");
                    g(), e = s - m, n.options.dropupAuto && n.$newElement.toggleClass("dropup", i > s && e - m < a.height()), n.$newElement.hasClass("dropup") && (e = i - m), t = h.length + h.find("dt").length > 3 ? 3 * r + m - 2 : 0, a.css({
                        "max-height": e + "px",
                        overflow: "hidden",
                        "min-height": t + l + d + c + "px"
                    }), o.css({
                        "max-height": e - l - d - c - p + "px",
                        "overflow-y": "auto",
                        "min-height": Math.max(t - p, 0) + "px"
                    })
                };
                w(), this.$searchbox.off("input.getSize propertychange.getSize").on("input.getSize propertychange.getSize", w), t(window).off("resize.getSize").on("resize.getSize", w), t(window).off("scroll.getSize").on("scroll.getSize", w)
            } else if (this.options.size && "auto" != this.options.size && a.find("li" + f).length > this.options.size) {
                var b = a.find("li" + f + " > *").not(".div-contain").slice(0, this.options.size).last().parent().index(),
                    y = a.find("li").slice(0, b + 1).find(".div-contain").length;
                e = r * this.options.size + y * u + p, n.options.dropupAuto && this.$newElement.toggleClass("dropup", i > s && e < a.height()), a.css({
                    "max-height": e + l + d + c + "px",
                    overflow: "hidden"
                }), o.css({
                    "max-height": e - p + "px",
                    "overflow-y": "auto"
                })
            }
        },
        setWidth: function() {
            if ("auto" == this.options.width) {
                this.$menu.css("min-width", "0");
                var t = this.$newElement.clone().appendTo("body"),
                    e = t.find("> .dropdown-menu").css("width"),
                    i = t.css("width", "auto").find("> button").css("width");
                t.remove(), this.$newElement.css("width", Math.max(parseInt(e), parseInt(i)) + "px")
            } else "fit" == this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width")) : this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width)) : (this.$menu.css("min-width", ""), this.$newElement.css("width", ""));
            this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width")
        },
        selectPosition: function() {
            var e, i, s = this,
                n = "<div />",
                a = t(n),
                o = function(t) {
                    a.addClass(t.attr("class").replace(/form-control/gi, "")).toggleClass("dropup", t.hasClass("dropup")), e = t.offset(), i = t.hasClass("dropup") ? 0 : t[0].offsetHeight, a.css({
                        top: e.top + i,
                        left: e.left,
                        width: t[0].offsetWidth,
                        position: "absolute"
                    })
                };
            this.$newElement.on("click", function() {
                s.isDisabled() || (o(t(this)), a.appendTo(s.options.container), a.toggleClass("open", !t(this).hasClass("open")), a.append(s.$menu))
            }), t(window).resize(function() {
                o(s.$newElement)
            }), t(window).on("scroll", function() {
                o(s.$newElement)
            }), t("html").on("click", function(e) {
                t(e.target).closest(s.$newElement).length < 1 && a.removeClass("open")
            })
        },
        mobile: function() {
            this.$element.addClass("mobile-device").appendTo(this.$newElement), this.options.container && this.$menu.hide()
        },
        refresh: function() {
            this.$lis = null, this.reloadLi(), this.render(), this.setWidth(), this.setStyle(), this.checkDisabled(), this.liHeight()
        },
        update: function() {
            this.reloadLi(), this.setWidth(), this.setStyle(), this.checkDisabled(), this.liHeight()
        },
        setSelected: function(e, i) {
            null == this.$lis && (this.$lis = this.$menu.find("li")), t(this.$lis[e]).toggleClass("selected", i)
        },
        setDisabled: function(e, i) {
            null == this.$lis && (this.$lis = this.$menu.find("li")), i ? t(this.$lis[e]).addClass("disabled").find("a").attr("href", "#").attr("tabindex", -1) : t(this.$lis[e]).removeClass("disabled").find("a").removeAttr("href").attr("tabindex", 0)
        },
        isDisabled: function() {
            return this.$element.is(":disabled")
        },
        checkDisabled: function() {
            var t = this;
            this.isDisabled() ? this.$button.addClass("disabled").attr("tabindex", -1) : (this.$button.hasClass("disabled") && this.$button.removeClass("disabled"), -1 == this.$button.attr("tabindex") && (this.$element.data("tabindex") || this.$button.removeAttr("tabindex"))), this.$button.click(function() {
                return !t.isDisabled()
            })
        },
        tabIndex: function() {
            this.$element.is("[tabindex]") && (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex")))
        },
        clickListener: function() {
            var e = this;
            this.$newElement.on("touchstart.dropdown", ".dropdown-menu", function(t) {
                t.stopPropagation()
            }), this.$newElement.on("click", function() {
                e.setSize(), e.options.liveSearch || e.multiple || setTimeout(function() {
                    e.$menu.find(".selected a").focus()
                }, 10)
            }), this.$menu.on("click", "li a", function(i) {
                var s = t(this).parent().index(),
                    n = e.$element.val(),
                    a = e.$element.prop("selectedIndex");
                if (e.multiple && i.stopPropagation(), i.preventDefault(), !e.isDisabled() && !t(this).parent().hasClass("disabled")) {
                    var o = e.$element.find("option"),
                        h = o.eq(s),
                        r = h.prop("selected"),
                        l = h.parent("optgroup"),
                        d = e.options.maxOptions,
                        c = l.data("maxOptions") || !1;
                    if (e.multiple) {
                        if (h.prop("selected", !r), e.setSelected(s, !r), t(this).blur(), d !== !1 || c !== !1) {
                            var u = d < o.filter(":selected").length,
                                p = c < l.find("option:selected").length,
                                f = e.options.maxOptionsText,
                                v = f[0].replace("{n}", d),
                                m = f[1].replace("{n}", c),
                                g = t('<div class="notify"></div>');
                            if (d && u || c && p)
                                if (d && 1 == d) o.prop("selected", !1), h.prop("selected", !0), e.$menu.find(".selected").removeClass("selected"), e.setSelected(s, !0);
                                else if (c && 1 == c) {
                                l.find("option:selected").prop("selected", !1), h.prop("selected", !0);
                                var w = t(this).data("optgroup");
                                e.$menu.find(".selected").has('a[data-optgroup="' + w + '"]').removeClass("selected"), e.setSelected(s, !0)
                            } else f[2] && (v = v.replace("{var}", f[2][d > 1 ? 0 : 1]), m = m.replace("{var}", f[2][c > 1 ? 0 : 1])), h.prop("selected", !1), e.$menu.append(g), d && u && (g.append(t("<div>" + v + "</div>")), e.$element.trigger("maxReached.bs.select")), c && p && (g.append(t("<div>" + m + "</div>")), e.$element.trigger("maxReachedGrp.bs.select")), setTimeout(function() {
                                e.setSelected(s, !1)
                            }, 10), g.delay(750).fadeOut(300, function() {
                                t(this).remove()
                            })
                        }
                    } else o.prop("selected", !1), h.prop("selected", !0), e.$menu.find(".selected").removeClass("selected"), e.setSelected(s, !0);
                    e.multiple ? e.options.liveSearch && e.$searchbox.focus() : e.$button.focus(), (n != e.$element.val() && e.multiple || a != e.$element.prop("selectedIndex") && !e.multiple) && e.$element.change()
                }
            }), this.$menu.on("click", "li.disabled a, li dt, li .div-contain, .popover-title, .popover-title :not(.close)", function(t) {
                t.target == this && (t.preventDefault(), t.stopPropagation(), e.options.liveSearch ? e.$searchbox.focus() : e.$button.focus())
            }), this.$menu.on("click", ".popover-title .close", function() {
                e.$button.focus()
            }), this.$searchbox.on("click", function(t) {
                t.stopPropagation()
            }), this.$menu.on("click", ".actions-btn", function(i) {
                e.options.liveSearch ? e.$searchbox.focus() : e.$button.focus(), i.preventDefault(), i.stopPropagation(), t(this).is(".bs-select-all") ? e.selectAll() : e.deselectAll(), e.$element.change()
            }), this.$element.change(function() {
                e.render(!1)
            })
        },
        liveSearchListener: function() {
            var e = this,
                i = t('<li class="no-results"></li>');
            this.$newElement.on("click.dropdown.data-api", function() {
                e.$menu.find(".active").removeClass("active"), e.$searchbox.val() && (e.$searchbox.val(""), e.$lis.not(".is-hidden").removeClass("hide"), i.parent().length && i.remove()), e.multiple || e.$menu.find(".selected").addClass("active"), setTimeout(function() {
                    e.$searchbox.focus()
                }, 10)
            }), this.$searchbox.on("input propertychange", function() {
                e.$searchbox.val() ? (e.$lis.not(".is-hidden").removeClass("hide").find("a").not(":icontains(" + e.$searchbox.val() + ")").parent().addClass("hide"), e.$menu.find("li").filter(":visible:not(.no-results)").length ? i.parent().length && i.remove() : (i.parent().length && i.remove(), i.html(e.options.noneResultsText + ' "' + e.$searchbox.val() + '"').show(), e.$menu.find("li").last().after(i))) : (e.$lis.not(".is-hidden").removeClass("hide"), i.parent().length && i.remove()), e.$menu.find("li.active").removeClass("active"), e.$menu.find("li").filter(":visible:not(.divider)").eq(0).addClass("active").find("a").focus(), t(this).focus()
            }), this.$menu.on("mouseenter", "a", function(i) {
                e.$menu.find(".active").removeClass("active"), t(i.currentTarget).parent().not(".disabled").addClass("active")
            }), this.$menu.on("mouseleave", "a", function() {
                e.$menu.find(".active").removeClass("active")
            })
        },
        val: function(t) {
            return void 0 !== t ? (this.$element.val(t), this.$element.change(), this.render(), this.$element) : this.$element.val()
        },
        selectAll: function() {
            null == this.$lis && (this.$lis = this.$menu.find("li")), this.$element.find("option:enabled").prop("selected", !0), t(this.$lis).not(".disabled").addClass("selected"), this.render(!1)
        },
        deselectAll: function() {
            null == this.$lis && (this.$lis = this.$menu.find("li")), this.$element.find("option:enabled").prop("selected", !1), t(this.$lis).not(".disabled").removeClass("selected"), this.render(!1)
        },
        keydown: function(e) {
            var i, s, n, a, o, h, r, l, d, c, u, p, f = {
                32: " ",
                48: "0",
                49: "1",
                50: "2",
                51: "3",
                52: "4",
                53: "5",
                54: "6",
                55: "7",
                56: "8",
                57: "9",
                59: ";",
                65: "a",
                66: "b",
                67: "c",
                68: "d",
                69: "e",
                70: "f",
                71: "g",
                72: "h",
                73: "i",
                74: "j",
                75: "k",
                76: "l",
                77: "m",
                78: "n",
                79: "o",
                80: "p",
                81: "q",
                82: "r",
                83: "s",
                84: "t",
                85: "u",
                86: "v",
                87: "w",
                88: "x",
                89: "y",
                90: "z",
                96: "0",
                97: "1",
                98: "2",
                99: "3",
                100: "4",
                101: "5",
                102: "6",
                103: "7",
                104: "8",
                105: "9"
            };
            if (i = t(this), n = i.parent(), i.is("input") && (n = i.parent().parent()), c = n.data("this"), c.options.liveSearch && (n = i.parent().parent()), c.options.container && (n = c.$menu), s = t("[role=menu] li:not(.divider) a", n), p = c.$menu.parent().hasClass("open"), !p && /([0-9]|[A-z])/.test(String.fromCharCode(e.keyCode)) && (c.options.container ? c.$newElement.trigger("click") : (c.setSize(), c.$menu.parent().addClass("open"), p = !0), c.$searchbox.focus()), c.options.liveSearch && (/(^9$|27)/.test(e.keyCode.toString(10)) && p && 0 === c.$menu.find(".active").length && (e.preventDefault(), c.$menu.parent().removeClass("open"), c.$button.focus()), s = t("[role=menu] li:not(.divider):visible", n), i.val() || /(38|40)/.test(e.keyCode.toString(10)) || 0 === s.filter(".active").length && (s = c.$newElement.find("li").filter(":icontains(" + f[e.keyCode] + ")"))), s.length) {
                if (/(38|40)/.test(e.keyCode.toString(10))) a = s.index(s.filter(":focus")), h = s.parent(":not(.disabled):visible").first().index(), r = s.parent(":not(.disabled):visible").last().index(), o = s.eq(a).parent().nextAll(":not(.disabled):visible").eq(0).index(), l = s.eq(a).parent().prevAll(":not(.disabled):visible").eq(0).index(), d = s.eq(o).parent().prevAll(":not(.disabled):visible").eq(0).index(), c.options.liveSearch && (s.each(function(e) {
                    t(this).is(":not(.disabled)") && t(this).data("index", e)
                }), a = s.index(s.filter(".active")), h = s.filter(":not(.disabled):visible").first().data("index"), r = s.filter(":not(.disabled):visible").last().data("index"), o = s.eq(a).nextAll(":not(.disabled):visible").eq(0).data("index"), l = s.eq(a).prevAll(":not(.disabled):visible").eq(0).data("index"), d = s.eq(o).prevAll(":not(.disabled):visible").eq(0).data("index")), u = i.data("prevIndex"), 38 == e.keyCode && (c.options.liveSearch && (a -= 1), a != d && a > l && (a = l), h > a && (a = h), a == u && (a = r)), 40 == e.keyCode && (c.options.liveSearch && (a += 1), -1 == a && (a = 0), a != d && o > a && (a = o), a > r && (a = r), a == u && (a = h)), i.data("prevIndex", a), c.options.liveSearch ? (e.preventDefault(), i.is(".dropdown-toggle") || (s.removeClass("active"), s.eq(a).addClass("active").find("a").focus(), i.focus())) : s.eq(a).focus();
                else if (!i.is("input")) {
                    var v, m, g = [];
                    s.each(function() {
                        t(this).parent().is(":not(.disabled)") && t.trim(t(this).text().toLowerCase()).substring(0, 1) == f[e.keyCode] && g.push(t(this).parent().index())
                    }), v = t(document).data("keycount"), v++, t(document).data("keycount", v), m = t.trim(t(":focus").text().toLowerCase()).substring(0, 1), m != f[e.keyCode] ? (v = 1, t(document).data("keycount", v)) : v >= g.length && (t(document).data("keycount", 0), v > g.length && (v = 1)), s.eq(g[v - 1]).focus()
                }
                /(13|32)/.test(e.keyCode.toString(10)) && p && (/(32)/.test(e.keyCode.toString(10)) || e.preventDefault(), c.options.liveSearch ? /(32)/.test(e.keyCode.toString(10)) || (c.$menu.find(".active a").click(), i.focus()) : t(":focus").click(), t(document).data("keycount", 0)), (/(^9$|27)/.test(e.keyCode.toString(10)) && p && (c.multiple || c.options.liveSearch) || /(27)/.test(e.keyCode.toString(10)) && !p) && (c.$menu.parent().removeClass("open"), c.$button.focus())
            }
        },
        hide: function() {
            this.$newElement.hide()
        },
        show: function() {
            this.$newElement.show()
        },
        destroy: function() {
            this.$newElement.remove(), this.$element.remove()
        }
    }, t.fn.selectpicker = function(i, s) {
        var n, a = arguments,
            o = this.each(function() {
                if (t(this).is("select")) {
                    var o = t(this),
                        h = o.data("selectpicker"),
                        r = "object" == typeof i && i;
                    if (h) {
                        if (r)
                            for (var l in r) r.hasOwnProperty(l) && (h.options[l] = r[l])
                    } else o.data("selectpicker", h = new e(this, t.extend({}, e.DEFAULTS, t.fn.selectpicker.defaults || {}, o.data(), r), s));
                    if ("string" == typeof i) {
                        var d = i;
                        h[d] instanceof Function ? ([].shift.apply(a), n = h[d].apply(h, a)) : n = h.options[d]
                    }
                }
            });
        return "undefined" != typeof n ? n : o
    }, t.fn.selectpicker.Constructor = e, t(document).data("keycount", 0).on("keydown", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", e.prototype.keydown).on("focusin.modal", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", function(t) {
        t.stopPropagation()
    })
}

// jQyery BootStrap Date Picker
(jQuery), ! function(t) {
    function e() {
        return new Date(Date.UTC.apply(Date, arguments))
    }
    var i = function(e, i) {
        var a = this;
        switch (this.element = t(e), this.language = i.language || this.element.data("date-language") || "en", this.language = this.language in s ? this.language : "en", this.isRTL = s[this.language].rtl || !1, this.format = n.parseFormat(i.format || this.element.data("date-format") || "mm/dd/yyyy"), this.isInline = !1, this.isInput = this.element.is("input"), this.component = this.element.is(".date") ? this.element.find(".add-on") : !1, this.hasInput = this.component && this.element.find("input").length, this.component && 0 === this.component.length && (this.component = !1), this._attachEvents(), this.forceParse = !0, "forceParse" in i ? this.forceParse = i.forceParse : "dateForceParse" in this.element.data() && (this.forceParse = this.element.data("date-force-parse")), this.picker = t(n.template).appendTo(this.isInline ? this.element : "body").on({
            click: t.proxy(this.click, this),
            mousedown: t.proxy(this.mousedown, this)
        }), this.isInline ? this.picker.addClass("datepicker-inline") : this.picker.addClass("datepicker-dropdown dropdown-menu"), this.isRTL && (this.picker.addClass("datepicker-rtl"), this.picker.find(".prev i, .next i").toggleClass("icon-arrow-left icon-arrow-right")), t(document).on("mousedown", function(e) {
            0 === t(e.target).closest(".datepicker").length && a.hide()
        }), this.autoclose = !1, "autoclose" in i ? this.autoclose = i.autoclose : "dateAutoclose" in this.element.data() && (this.autoclose = this.element.data("date-autoclose")), this.keyboardNavigation = !0, "keyboardNavigation" in i ? this.keyboardNavigation = i.keyboardNavigation : "dateKeyboardNavigation" in this.element.data() && (this.keyboardNavigation = this.element.data("date-keyboard-navigation")), this.viewMode = this.startViewMode = 0, i.startView || this.element.data("date-start-view")) {
            case 2:
            case "decade":
                this.viewMode = this.startViewMode = 2;
                break;
            case 1:
            case "year":
                this.viewMode = this.startViewMode = 1
        }
        this.todayBtn = i.todayBtn || this.element.data("date-today-btn") || !1, this.todayHighlight = i.todayHighlight || this.element.data("date-today-highlight") || !1, this.weekStart = (i.weekStart || this.element.data("date-weekstart") || s[this.language].weekStart || 0) % 7, this.weekEnd = (this.weekStart + 6) % 7, this.startDate = -(1 / 0), this.endDate = 1 / 0, this.daysOfWeekDisabled = [], this.setStartDate(i.startDate || this.element.data("date-startdate")), this.setEndDate(i.endDate || this.element.data("date-enddate")), this.setDaysOfWeekDisabled(i.daysOfWeekDisabled || this.element.data("date-days-of-week-disabled")), this.fillDow(), this.fillMonths(), this.update(), this.showMode(), this.isInline && this.show()
    };
    i.prototype = {
        constructor: i,
        _events: [],
        _attachEvents: function() {
            this._detachEvents(), this.isInput ? this._events = [
                [this.element, {
                    focus: t.proxy(this.show, this),
                    keyup: t.proxy(this.update, this),
                    keydown: t.proxy(this.keydown, this)
                }]
            ] : this.component && this.hasInput ? this._events = [
                [this.element.find("input"), {
                    focus: t.proxy(this.show, this),
                    keyup: t.proxy(this.update, this),
                    keydown: t.proxy(this.keydown, this)
                }],
                [this.component, {
                    click: t.proxy(this.show, this)
                }]
            ] : this.element.is("div") ? this.isInline = !0 : this._events = [
                [this.element, {
                    click: t.proxy(this.show, this)
                }]
            ];
            for (var e, i, s = 0; s < this._events.length; s++) e = this._events[s][0], i = this._events[s][1], e.on(i)
        },
        _detachEvents: function() {
            for (var t, e, i = 0; i < this._events.length; i++) t = this._events[i][0], e = this._events[i][1], t.off(e);
            this._events = []
        },
        show: function(e) {
            this.picker.show(), this.height = this.component ? this.component.outerHeight() : this.element.outerHeight(), this.update(), this.place(), t(window).on("resize", t.proxy(this.place, this)), e && (e.stopPropagation(), e.preventDefault()), this.element.trigger({
                type: "show",
                date: this.date
            })
        },
        hide: function(e) {
            this.isInline || (this.picker.hide(), t(window).off("resize", this.place), this.viewMode = this.startViewMode, this.showMode(), this.isInput || t(document).off("mousedown", this.hide), this.forceParse && (this.isInput && this.element.val() || this.hasInput && this.element.find("input").val()) && this.setValue(), this.element.trigger({
                type: "hide",
                date: this.date
            }))
        },
        remove: function() {
            this._detachEvents(), this.picker.remove(), delete this.element.data().datepicker
        },
        getDate: function() {
            var t = this.getUTCDate();
            return new Date(t.getTime() + 6e4 * t.getTimezoneOffset())
        },
        getUTCDate: function() {
            return this.date
        },
        setDate: function(t) {
            this.setUTCDate(new Date(t.getTime() - 6e4 * t.getTimezoneOffset()))
        },
        setUTCDate: function(t) {
            this.date = t, this.setValue()
        },
        setValue: function() {
            var t = this.getFormattedDate();
            this.isInput ? this.element.val(t) : (this.component && this.element.find("input").val(t), this.element.data("date", t))
        },
        getFormattedDate: function(t) {
            return void 0 === t && (t = this.format), n.formatDate(this.date, t, this.language)
        },
        setStartDate: function(t) {
            this.startDate = t || -(1 / 0), this.startDate !== -(1 / 0) && (this.startDate = n.parseDate(this.startDate, this.format, this.language)), this.update(), this.updateNavArrows()
        },
        setEndDate: function(t) {
            this.endDate = t || 1 / 0, this.endDate !== 1 / 0 && (this.endDate = n.parseDate(this.endDate, this.format, this.language)), this.update(), this.updateNavArrows()
        },
        setDaysOfWeekDisabled: function(e) {
            this.daysOfWeekDisabled = e || [], t.isArray(this.daysOfWeekDisabled) || (this.daysOfWeekDisabled = this.daysOfWeekDisabled.split(/,\s*/)), this.daysOfWeekDisabled = t.map(this.daysOfWeekDisabled, function(t) {
                return parseInt(t, 10)
            }), this.update(), this.updateNavArrows()
        },
        place: function() {
            if (!this.isInline) {
                var e = parseInt(this.element.parents().filter(function() {
                        return "auto" != t(this).css("z-index")
                    }).first().css("z-index")) + 10,
                    i = this.component ? this.component.offset() : this.element.offset(),
                    s = this.component ? this.component.outerHeight(!0) : this.element.outerHeight(!0);
                this.picker.css({
                    top: i.top + s,
                    left: i.left,
                    zIndex: e
                })
            }
        },
        update: function() {
            var t, e = !1;
            arguments && arguments.length && ("string" == typeof arguments[0] || arguments[0] instanceof Date) ? (t = arguments[0], e = !0) : t = this.isInput ? this.element.val() : this.element.data("date") || this.element.find("input").val(), this.date = n.parseDate(t, this.format, this.language), e && this.setValue();
            var i = this.viewDate;
            this.date < this.startDate ? this.viewDate = new Date(this.startDate) : this.date > this.endDate ? this.viewDate = new Date(this.endDate) : this.viewDate = new Date(this.date), i && i.getTime() != this.viewDate.getTime() && this.element.trigger({
                type: "changeDate",
                date: this.viewDate
            }), this.fill()
        },
        fillDow: function() {
            for (var t = this.weekStart, e = "<tr>"; t < this.weekStart + 7;) e += '<th class="dow">' + s[this.language].daysMin[t++ % 7] + "</th>";
            e += "</tr>", this.picker.find(".datepicker-days thead").append(e)
        },
        fillMonths: function() {
            for (var t = "", e = 0; 12 > e;) t += '<span class="month">' + s[this.language].monthsShort[e++] + "</span>";
            this.picker.find(".datepicker-months td").html(t)
        },
        fill: function() {
            var i = new Date(this.viewDate),
                a = i.getUTCFullYear(),
                o = i.getUTCMonth(),
                h = this.startDate !== -(1 / 0) ? this.startDate.getUTCFullYear() : -(1 / 0),
                r = this.startDate !== -(1 / 0) ? this.startDate.getUTCMonth() : -(1 / 0),
                l = this.endDate !== 1 / 0 ? this.endDate.getUTCFullYear() : 1 / 0,
                d = this.endDate !== 1 / 0 ? this.endDate.getUTCMonth() : 1 / 0,
                c = this.date && this.date.valueOf(),
                u = new Date;
            this.picker.find(".datepicker-days thead th:eq(1)").text(s[this.language].months[o] + " " + a), this.picker.find("tfoot th.today").text(s[this.language].today).toggle(this.todayBtn !== !1), this.updateNavArrows(), this.fillMonths();
            var p = e(a, o - 1, 28, 0, 0, 0, 0),
                f = n.getDaysInMonth(p.getUTCFullYear(), p.getUTCMonth());
            p.setUTCDate(f), p.setUTCDate(f - (p.getUTCDay() - this.weekStart + 7) % 7);
            var v = new Date(p);
            v.setUTCDate(v.getUTCDate() + 42), v = v.valueOf();
            for (var m, g = []; p.valueOf() < v;) p.getUTCDay() == this.weekStart && g.push("<tr>"), m = "", p.getUTCFullYear() < a || p.getUTCFullYear() == a && p.getUTCMonth() < o ? m += " old" : (p.getUTCFullYear() > a || p.getUTCFullYear() == a && p.getUTCMonth() > o) && (m += " new"), this.todayHighlight && p.getUTCFullYear() == u.getFullYear() && p.getUTCMonth() == u.getMonth() && p.getUTCDate() == u.getDate() && (m += " today"), c && p.valueOf() == c && (m += " active"), (p.valueOf() < this.startDate || p.valueOf() > this.endDate || -1 !== t.inArray(p.getUTCDay(), this.daysOfWeekDisabled)) && (m += " disabled"), g.push('<td class="day' + m + '">' + p.getUTCDate() + "</td>"), p.getUTCDay() == this.weekEnd && g.push("</tr>"), p.setUTCDate(p.getUTCDate() + 1);
            this.picker.find(".datepicker-days tbody").empty().append(g.join(""));
            var w = this.date && this.date.getUTCFullYear(),
                b = this.picker.find(".datepicker-months").find("th:eq(1)").text(a).end().find("span").removeClass("active");
            w && w == a && b.eq(this.date.getUTCMonth()).addClass("active"), (h > a || a > l) && b.addClass("disabled"), a == h && b.slice(0, r).addClass("disabled"), a == l && b.slice(d + 1).addClass("disabled"), g = "", a = 10 * parseInt(a / 10, 10);
            var y = this.picker.find(".datepicker-years").find("th:eq(1)").text(a + "-" + (a + 9)).end().find("td");
            a -= 1;
            for (var $ = -1; 11 > $; $++) g += '<span class="year' + (-1 == $ || 10 == $ ? " old" : "") + (w == a ? " active" : "") + (h > a || a > l ? " disabled" : "") + '">' + a + "</span>", a += 1;
            y.html(g)
        },
        updateNavArrows: function() {
            var t = new Date(this.viewDate),
                e = t.getUTCFullYear(),
                i = t.getUTCMonth();
            switch (this.viewMode) {
                case 0:
                    this.startDate !== -(1 / 0) && e <= this.startDate.getUTCFullYear() && i <= this.startDate.getUTCMonth() ? this.picker.find(".prev").css({
                        visibility: "hidden"
                    }) : this.picker.find(".prev").css({
                        visibility: "visible"
                    }), this.endDate !== 1 / 0 && e >= this.endDate.getUTCFullYear() && i >= this.endDate.getUTCMonth() ? this.picker.find(".next").css({
                        visibility: "hidden"
                    }) : this.picker.find(".next").css({
                        visibility: "visible"
                    });
                    break;
                case 1:
                case 2:
                    this.startDate !== -(1 / 0) && e <= this.startDate.getUTCFullYear() ? this.picker.find(".prev").css({
                        visibility: "hidden"
                    }) : this.picker.find(".prev").css({
                        visibility: "visible"
                    }), this.endDate !== 1 / 0 && e >= this.endDate.getUTCFullYear() ? this.picker.find(".next").css({
                        visibility: "hidden"
                    }) : this.picker.find(".next").css({
                        visibility: "visible"
                    })
            }
        },
        click: function(i) {
            i.stopPropagation(), i.preventDefault();
            var s = t(i.target).closest("span, td, th");
            if (1 == s.length) switch (s[0].nodeName.toLowerCase()) {
                case "th":
                    switch (s[0].className) {
                        case "switch":
                            this.showMode(1);
                            break;
                        case "prev":
                        case "next":
                            var a = n.modes[this.viewMode].navStep * ("prev" == s[0].className ? -1 : 1);
                            switch (this.viewMode) {
                                case 0:
                                    this.viewDate = this.moveMonth(this.viewDate, a);
                                    break;
                                case 1:
                                case 2:
                                    this.viewDate = this.moveYear(this.viewDate, a)
                            }
                            this.fill();
                            break;
                        case "today":
                            var o = new Date;
                            o = e(o.getFullYear(), o.getMonth(), o.getDate(), 0, 0, 0), this.showMode(-2);
                            var h = "linked" == this.todayBtn ? null : "view";
                            this._setDate(o, h)
                    }
                    break;
                case "span":
                    if (!s.is(".disabled")) {
                        if (this.viewDate.setUTCDate(1), s.is(".month")) {
                            var r = s.parent().find("span").index(s);
                            this.viewDate.setUTCMonth(r), this.element.trigger({
                                type: "changeMonth",
                                date: this.viewDate
                            })
                        } else {
                            var l = parseInt(s.text(), 10) || 0;
                            this.viewDate.setUTCFullYear(l), this.element.trigger({
                                type: "changeYear",
                                date: this.viewDate
                            })
                        }
                        this.showMode(-1), this.fill()
                    }
                    break;
                case "td":
                    if (s.is(".day") && !s.is(".disabled")) {
                        var d = parseInt(s.text(), 10) || 1,
                            l = this.viewDate.getUTCFullYear(),
                            r = this.viewDate.getUTCMonth();
                        s.is(".old") ? 0 === r ? (r = 11, l -= 1) : r -= 1 : s.is(".new") && (11 == r ? (r = 0, l += 1) : r += 1), this._setDate(e(l, r, d, 0, 0, 0, 0))
                    }
            }
        },
        _setDate: function(t, e) {
            e && "date" != e || (this.date = t), e && "view" != e || (this.viewDate = t), this.fill(), this.setValue(), this.element.trigger({
                type: "changeDate",
                date: this.date
            });
            var i;
            this.isInput ? i = this.element : this.component && (i = this.element.find("input")), i && (i.change(), !this.autoclose || e && "date" != e || this.hide())
        },
        moveMonth: function(t, e) {
            if (!e) return t;
            var i, s, n = new Date(t.valueOf()),
                a = n.getUTCDate(),
                o = n.getUTCMonth(),
                h = Math.abs(e);
            if (e = e > 0 ? 1 : -1, 1 == h) s = -1 == e ? function() {
                return n.getUTCMonth() == o
            } : function() {
                return n.getUTCMonth() != i
            }, i = o + e, n.setUTCMonth(i), (0 > i || i > 11) && (i = (i + 12) % 12);
            else {
                for (var r = 0; h > r; r++) n = this.moveMonth(n, e);
                i = n.getUTCMonth(), n.setUTCDate(a), s = function() {
                    return i != n.getUTCMonth()
                }
            }
            for (; s();) n.setUTCDate(--a), n.setUTCMonth(i);
            return n
        },
        moveYear: function(t, e) {
            return this.moveMonth(t, 12 * e)
        },
        dateWithinRange: function(t) {
            return t >= this.startDate && t <= this.endDate
        },
        keydown: function(t) {
            if (this.picker.is(":not(:visible)")) return void(27 == t.keyCode && this.show());
            var e, i, s, n = !1;
            switch (t.keyCode) {
                case 27:
                    this.hide(), t.preventDefault();
                    break;
                case 37:
                case 39:
                    if (!this.keyboardNavigation) break;
                    e = 37 == t.keyCode ? -1 : 1, t.ctrlKey ? (i = this.moveYear(this.date, e), s = this.moveYear(this.viewDate, e)) : t.shiftKey ? (i = this.moveMonth(this.date, e), s = this.moveMonth(this.viewDate, e)) : (i = new Date(this.date), i.setUTCDate(this.date.getUTCDate() + e), s = new Date(this.viewDate), s.setUTCDate(this.viewDate.getUTCDate() + e)), this.dateWithinRange(i) && (this.date = i, this.viewDate = s, this.setValue(), this.update(), t.preventDefault(), n = !0);
                    break;
                case 38:
                case 40:
                    if (!this.keyboardNavigation) break;
                    e = 38 == t.keyCode ? -1 : 1, t.ctrlKey ? (i = this.moveYear(this.date, e), s = this.moveYear(this.viewDate, e)) : t.shiftKey ? (i = this.moveMonth(this.date, e), s = this.moveMonth(this.viewDate, e)) : (i = new Date(this.date), i.setUTCDate(this.date.getUTCDate() + 7 * e), s = new Date(this.viewDate), s.setUTCDate(this.viewDate.getUTCDate() + 7 * e)), this.dateWithinRange(i) && (this.date = i, this.viewDate = s, this.setValue(), this.update(), t.preventDefault(), n = !0);
                    break;
                case 13:
                    this.hide(), t.preventDefault();
                    break;
                case 9:
                    this.hide()
            }
            if (n) {
                this.element.trigger({
                    type: "changeDate",
                    date: this.date
                });
                var a;
                this.isInput ? a = this.element : this.component && (a = this.element.find("input")), a && a.change()
            }
        },
        showMode: function(t) {
            t && (this.viewMode = Math.max(0, Math.min(2, this.viewMode + t))), this.picker.find(">div").hide().filter(".datepicker-" + n.modes[this.viewMode].clsName).css("display", "block"), this.updateNavArrows()
        }
    }, t.fn.datepicker = function(e) {
        var s = Array.apply(null, arguments);
        return s.shift(), this.each(function() {
            var n = t(this),
                a = n.data("datepicker"),
                o = "object" == typeof e && e;
            a || n.data("datepicker", a = new i(this, t.extend({}, t.fn.datepicker.defaults, o))), "string" == typeof e && "function" == typeof a[e] && a[e].apply(a, s)
        })
    }, t.fn.datepicker.defaults = {}, t.fn.datepicker.Constructor = i;
    var s = t.fn.datepicker.dates = {
            en: {
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                today: "Today"
            }
        },
        n = {
            modes: [{
                clsName: "days",
                navFnc: "Month",
                navStep: 1
            }, {
                clsName: "months",
                navFnc: "FullYear",
                navStep: 1
            }, {
                clsName: "years",
                navFnc: "FullYear",
                navStep: 10
            }],
            isLeapYear: function(t) {
                return t % 4 === 0 && t % 100 !== 0 || t % 400 === 0
            },
            getDaysInMonth: function(t, e) {
                return [31, n.isLeapYear(t) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][e]
            },
            validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
            nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
            parseFormat: function(t) {
                var e = t.replace(this.validParts, "\x00").split("\x00"),
                    i = t.match(this.validParts);
                if (!e || !e.length || !i || 0 === i.length) throw new Error("Invalid date format.");
                return {
                    separators: e,
                    parts: i
                }
            },
            parseDate: function(n, a, o) {
                if (n instanceof Date) return n;
                if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(n)) {
                    var h, r, l = /([\-+]\d+)([dmwy])/,
                        d = n.match(/([\-+]\d+)([dmwy])/g);
                    n = new Date;
                    for (var c = 0; c < d.length; c++) switch (h = l.exec(d[c]), r = parseInt(h[1]), h[2]) {
                        case "d":
                            n.setUTCDate(n.getUTCDate() + r);
                            break;
                        case "m":
                            n = i.prototype.moveMonth.call(i.prototype, n, r);
                            break;
                        case "w":
                            n.setUTCDate(n.getUTCDate() + 7 * r);
                            break;
                        case "y":
                            n = i.prototype.moveYear.call(i.prototype, n, r)
                    }
                    return e(n.getUTCFullYear(), n.getUTCMonth(), n.getUTCDate(), 0, 0, 0)
                }
                var u, p, h, d = n && n.match(this.nonpunctuation) || [],
                    n = new Date,
                    f = {},
                    v = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
                    m = {
                        yyyy: function(t, e) {
                            return t.setUTCFullYear(e)
                        },
                        yy: function(t, e) {
                            return t.setUTCFullYear(2e3 + e)
                        },
                        m: function(t, e) {
                            for (e -= 1; 0 > e;) e += 12;
                            for (e %= 12, t.setUTCMonth(e); t.getUTCMonth() != e;) t.setUTCDate(t.getUTCDate() - 1);
                            return t
                        },
                        d: function(t, e) {
                            return t.setUTCDate(e)
                        }
                    };
                m.M = m.MM = m.mm = m.m, m.dd = m.d, n = e(n.getFullYear(), n.getMonth(), n.getDate(), 0, 0, 0);
                var g = a.parts.slice();
                if (d.length != g.length && (g = t(g).filter(function(e, i) {
                        return -1 !== t.inArray(i, v)
                    }).toArray()), d.length == g.length) {
                    for (var c = 0, w = g.length; w > c; c++) {
                        if (u = parseInt(d[c], 10), h = g[c], isNaN(u)) switch (h) {
                            case "MM":
                                p = t(s[o].months).filter(function() {
                                    var t = this.slice(0, d[c].length),
                                        e = d[c].slice(0, t.length);
                                    return t == e
                                }), u = t.inArray(p[0], s[o].months) + 1;
                                break;
                            case "M":
                                p = t(s[o].monthsShort).filter(function() {
                                    var t = this.slice(0, d[c].length),
                                        e = d[c].slice(0, t.length);
                                    return t == e
                                }), u = t.inArray(p[0], s[o].monthsShort) + 1
                        }
                        f[h] = u
                    }
                    for (var b, c = 0; c < v.length; c++) b = v[c], b in f && !isNaN(f[b]) && m[b](n, f[b])
                }
                return n
            },
            formatDate: function(e, i, n) {
                var a = {
                    d: e.getUTCDate(),
                    D: s[n].daysShort[e.getUTCDay()],
                    DD: s[n].days[e.getUTCDay()],
                    m: e.getUTCMonth() + 1,
                    M: s[n].monthsShort[e.getUTCMonth()],
                    MM: s[n].months[e.getUTCMonth()],
                    yy: e.getUTCFullYear().toString().substring(2),
                    yyyy: e.getUTCFullYear()
                };
                a.dd = (a.d < 10 ? "0" : "") + a.d, a.mm = (a.m < 10 ? "0" : "") + a.m;
                for (var e = [], o = t.extend([], i.separators), h = 0, r = i.parts.length; r > h; h++) o.length && e.push(o.shift()), e.push(a[i.parts[h]]);
                return e.join("")
            },
            headTemplate: '<thead><tr><th class="prev"><i class="icon-arrow-left"/></th><th colspan="5" class="switch"></th><th class="next"><i class="icon-arrow-right"/></th></tr></thead>',
            contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
            footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr></tfoot>'
        };
    n.template = '<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">' + n.headTemplate + "<tbody></tbody>" + n.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + n.headTemplate + n.contTemplate + n.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + n.headTemplate + n.contTemplate + n.footTemplate + "</table></div></div>", t.fn.datepicker.DPGlobal = n
}(window.jQuery),
	
// jQuery Auto vertical center plugin
function(t) {
    var e = -1,
        i = -1,
        s = function(e) {
            var i = 1,
                s = t(e),
                a = null,
                o = [];
            return s.each(function() {
                var e = t(this),
                    s = e.offset().top - n(e.css("margin-top")),
                    h = o.length > 0 ? o[o.length - 1] : null;
                null === h ? o.push(e) : Math.floor(Math.abs(a - s)) <= i ? o[o.length - 1] = h.add(e) : o.push(e), a = s
            }), o
        },
        n = function(t) {
            return parseFloat(t) || 0
        },
        a = function(e) {
            var i = {
                byRow: !0,
                remove: !1,
                property: "height"
            };
            return "object" == typeof e ? t.extend(i, e) : ("boolean" == typeof e ? i.byRow = e : "remove" === e && (i.remove = !0), i)
        },
        o = t.fn.matchHeight = function(e) {
            var i = a(e);
            if (i.remove) {
                var s = this;
                return this.css(i.property, ""), t.each(o._groups, function(t, e) {
                    e.elements = e.elements.not(s)
                }), this
            }
            return this.length <= 1 ? this : (o._groups.push({
                elements: this,
                options: i
            }), o._apply(this, i), this)
        };
    o._groups = [], o._throttle = 80, o._maintainScroll = !1, o._beforeUpdate = null, o._afterUpdate = null, o._apply = function(e, i) {
        var h = a(i),
            r = t(e),
            l = [r],
            d = t(window).scrollTop(),
            c = t("html").outerHeight(!0),
            u = r.parents().filter(":hidden");
        return u.each(function() {
            var e = t(this);
            e.data("style-cache", e.attr("style"))
        }), u.css("display", "block"), h.byRow && (r.each(function() {
            var e = t(this),
                i = "inline-block" === e.css("display") ? "inline-block" : "block";
            e.data("style-cache", e.attr("style")), e.css({
                display: i,
                "padding-top": "0",
                "padding-bottom": "0",
                "margin-top": "0",
                "margin-bottom": "0",
                "border-top-width": "0",
                "border-bottom-width": "0",
                height: "100px"
            })
        }), l = s(r), r.each(function() {
            var e = t(this);
            e.attr("style", e.data("style-cache") || "")
        })), t.each(l, function(e, i) {
            var s = t(i),
                a = 0;
            return h.byRow && s.length <= 1 ? void s.css(h.property, "") : (s.each(function() {
                var e = t(this),
                    i = "inline-block" === e.css("display") ? "inline-block" : "block",
                    s = {
                        display: i
                    };
                s[h.property] = "", e.css(s), e.outerHeight(!1) > a && (a = e.outerHeight(!1)), e.css("display", "")
            }), void s.each(function() {
                var e = t(this),
                    i = 0;
                "border-box" !== e.css("box-sizing") && (i += n(e.css("border-top-width")) + n(e.css("border-bottom-width")), i += n(e.css("padding-top")) + n(e.css("padding-bottom"))), e.css(h.property, a - i)
            }))
        }), u.each(function() {
            var e = t(this);
            e.attr("style", e.data("style-cache") || null)
        }), o._maintainScroll && t(window).scrollTop(d / c * t("html").outerHeight(!0)), this
    }, o._applyDataApi = function() {
        var e = {};
        t("[data-match-height], [data-mh]").each(function() {
            var i = t(this),
                s = i.attr("data-match-height") || i.attr("data-mh");
            s in e ? e[s] = e[s].add(i) : e[s] = i
        }), t.each(e, function() {
            this.matchHeight(!0)
        })
    };
    var h = function(e) {
        o._beforeUpdate && o._beforeUpdate(e, o._groups), t.each(o._groups, function() {
            o._apply(this.elements, this.options)
        }), o._afterUpdate && o._afterUpdate(e, o._groups)
    };
    o._update = function(s, n) {
        if (n && "resize" === n.type) {
            var a = t(window).width();
            if (a === e) return;
            e = a
        }
        s ? -1 === i && (i = setTimeout(function() {
            h(n), i = -1
        }, o._throttle)) : h(n)
    }, t(o._applyDataApi), t(window).bind("load", function(t) {
        o._update(!1, t)
    }), t(window).bind("resize orientationchange", function(t) {
        o._update(!0, t)
    })
}(jQuery), ! function(t) {
    t.fn.flexVerticalCenter = function(e) {
        var i = t.extend({
            cssAttribute: "margin-top",
            verticalOffset: 0,
            parentSelector: null,
            debounceTimeout: 25,
            deferTilWindowLoad: !1
        }, e || {});
        return this.each(function() {
            var e, s = t(this),
                n = function() {
                    var t = i.parentSelector && s.parents(i.parentSelector).length ? s.parents(i.parentSelector).first().height() : s.parent().height();
                    s.css(i.cssAttribute, (t - s.height()) / 2 + parseInt(i.verticalOffset)), void 0 !== i.complete && i.complete()
                };
            t(window).resize(function() {
                clearTimeout(e), e = setTimeout(n, i.debounceTimeout)
            }), i.deferTilWindowLoad || n(), t(window).on("load", function() {
                n()
            })
        })
    }
}(jQuery);