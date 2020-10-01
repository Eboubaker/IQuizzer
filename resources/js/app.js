/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = require('jquery');
require('alpinejs');
window.Popper = require('@popperjs/core');
$.fn.extend({
    clickAway: function(handler) {
        document.addEventListener('click',
            (click) =>  !this.is(click.target) && typeof handler === 'function' ?  handler(this) :null);
    }
});
$(document).ready(function() {
    let addRippleEffect = window.rippleEffect = function (e) {
        let target = $(e.target);
        if (!target.is('button') && target.parents('.animate-ripple').length === 0)
        {}else {
            if (!target.is('button')) {
                target = target.parents('button');
            }
            if (!target.css('position').startsWith('relative')) {
                console.error("position attribute error");
            }
            target = target[0];

            let rect = target.getBoundingClientRect();
            let ripple = target.querySelector('.ripple');
            if (!ripple) {
                ripple = document.createElement('span');
                ripple.className = 'ripple';
                ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
                target.appendChild(ripple);
            }
            ripple.classList.remove('show');
            let top = e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop;
            let left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
            console.log(e.pageY);
            ripple.style.top = top + 'px';
            ripple.style.left = left + 'px';
            ripple.classList.add('show');
        }
    };
    $('.animate-ripple').each(function (index, button) {
        button = $(button);
        if (!button.is('button')) {
            return;
        }
        button.on('mousedown', addRippleEffect);
    });
});