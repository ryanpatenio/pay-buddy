(self.webpackChunkdashly = self.webpackChunkdashly || []).push([[539], {
    9178: function(t, e, n) {
        var o, s;
        s = void 0 !== n.g ? n.g : "undefined" != typeof window ? window : this,
        o = function() {
            return function(t) {
                "use strict";
                var e = {
                    navClass: "active",
                    contentClass: "active",
                    nested: !1,
                    nestedClass: "active",
                    offset: 0,
                    reflow: !1,
                    events: !0
                }
                  , n = function(t, e, n) {
                    if (n.settings.events) {
                        var o = new CustomEvent(t,{
                            bubbles: !0,
                            cancelable: !0,
                            detail: n
                        });
                        e.dispatchEvent(o)
                    }
                }
                  , o = function(t) {
                    var e = 0;
                    if (t.offsetParent)
                        for (; t; )
                            e += t.offsetTop,
                            t = t.offsetParent;
                    return e >= 0 ? e : 0
                }
                  , s = function(t) {
                    t && t.sort((function(t, e) {
                        return o(t.content) < o(e.content) ? -1 : 1
                    }
                    ))
                }
                  , c = function(e, n, o) {
                    var s = e.getBoundingClientRect()
                      , c = function(t) {
                        return "function" == typeof t.offset ? parseFloat(t.offset()) : parseFloat(t.offset)
                    }(n);
                    return o ? parseInt(s.bottom, 10) < (t.innerHeight || document.documentElement.clientHeight) : parseInt(s.top, 10) <= c
                }
                  , r = function() {
                    return t.innerHeight + t.pageYOffset >= Math.max(document.body.scrollHeight, document.documentElement.scrollHeight, document.body.offsetHeight, document.documentElement.offsetHeight, document.body.clientHeight, document.documentElement.clientHeight)
                }
                  , i = function(t, e) {
                    var n = t[t.length - 1];
                    if (function(t, e) {
                        return !(!r() || !c(t.content, e, !0))
                    }(n, e))
                        return n;
                    for (var o = t.length - 1; o >= 0; o--)
                        if (c(t[o].content, e))
                            return t[o]
                }
                  , a = function(t, e) {
                    if (e.nested && t.parentNode) {
                        var n = t.parentNode.closest("li");
                        n && (n.classList.remove(e.nestedClass),
                        a(n, e))
                    }
                }
                  , l = function(t, e) {
                    if (t) {
                        var o = t.nav.closest("li");
                        o && (o.classList.remove(e.navClass),
                        t.content.classList.remove(e.contentClass),
                        a(o, e),
                        n("gumshoeDeactivate", o, {
                            link: t.nav,
                            content: t.content,
                            settings: e
                        }))
                    }
                }
                  , u = function(t, e) {
                    if (e.nested) {
                        var n = t.parentNode.closest("li");
                        n && (n.classList.add(e.nestedClass),
                        u(n, e))
                    }
                };
                return function(o, c) {
                    var r, a, f, d, v, m = {
                        setup: function() {
                            r = document.querySelectorAll(o),
                            a = [],
                            Array.prototype.forEach.call(r, (function(t) {
                                var e = document.getElementById(decodeURIComponent(t.hash.substr(1)));
                                e && a.push({
                                    nav: t,
                                    content: e
                                })
                            }
                            )),
                            s(a)
                        },
                        detect: function() {
                            var t = i(a, v);
                            t ? f && t.content === f.content || (l(f, v),
                            function(t, e) {
                                if (t) {
                                    var o = t.nav.closest("li");
                                    o && (o.classList.add(e.navClass),
                                    t.content.classList.add(e.contentClass),
                                    u(o, e),
                                    n("gumshoeActivate", o, {
                                        link: t.nav,
                                        content: t.content,
                                        settings: e
                                    }))
                                }
                            }(t, v),
                            f = t) : f && (l(f, v),
                            f = null)
                        }
                    }, p = function(e) {
                        d && t.cancelAnimationFrame(d),
                        d = t.requestAnimationFrame(m.detect)
                    }, h = function(e) {
                        d && t.cancelAnimationFrame(d),
                        d = t.requestAnimationFrame((function() {
                            s(a),
                            m.detect()
                        }
                        ))
                    };
                    return m.destroy = function() {
                        f && l(f, v),
                        t.removeEventListener("scroll", p, !1),
                        v.reflow && t.removeEventListener("resize", h, !1),
                        a = null,
                        r = null,
                        f = null,
                        d = null,
                        v = null
                    }
                    ,
                    v = function() {
                        var t = {};
                        return Array.prototype.forEach.call(arguments, (function(e) {
                            for (var n in e) {
                                if (!e.hasOwnProperty(n))
                                    return;
                                t[n] = e[n]
                            }
                        }
                        )),
                        t
                    }(e, c || {}),
                    m.setup(),
                    m.detect(),
                    t.addEventListener("scroll", p, !1),
                    v.reflow && t.addEventListener("resize", h, !1),
                    m
                }
            }(s)
        }
        .apply(e, []),
        void 0 === o || (t.exports = o)
    }
}]);
