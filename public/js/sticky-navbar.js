!function(t){var n={};function o(r){if(n[r])return n[r].exports;var e=n[r]={i:r,l:!1,exports:{}};return t[r].call(e.exports,e,e.exports,o),e.l=!0,e.exports}o.m=t,o.c=n,o.d=function(t,n,r){o.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},o.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(n,"a",n),n},o.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},o.p="",o(o.s=43)}({43:function(t,n,o){t.exports=o(44)},44:function(t,n){$(document).ready(function(){var t=".tabs-container",n=$(t).offset().top,o=0;$(window).scroll(function(){var r=$(this).scrollTop();r<o&&($(window).scrollTop()>n?$(t).addClass("sticky"):$(t).removeClass("sticky")),o=r})})}});