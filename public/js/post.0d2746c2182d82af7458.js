!function(t){function e(o){if(n[o])return n[o].exports;var r=n[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,e),r.l=!0,r.exports}var n={};e.m=t,e.c=n,e.i=function(t){return t},e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:o})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=1)}({1:function(t,e,n){t.exports=n("AnCD")},AnCD:function(t,e){new Vue({el:"#comments",data:{comments:{}},methods:{toggleComment:function(t){this.comments.hasOwnProperty(t)?this.$set(this.comments,t,{isActive:!this.comments[t].isActive}):this.$set(this.comments,t,{isActive:!0})},isCommentActive:function(t){return!!this.comments.hasOwnProperty(t)&&this.comments[t].isActive}}})}});