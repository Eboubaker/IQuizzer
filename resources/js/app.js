/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = require('jquery');
window.jQuery = $;
require('alpinejs');
require('./auto-grow');
$.fn.extend({
    clickAway: function(handler) {
        document.addEventListener('click',
            (click) =>  !this.is(click.target) && typeof handler === 'function' ?  handler(this) :null);
    }
});
$(document).ready(function() {
    let addRippleEffect = window.rippleEffect = function (e) {

        let target = $(e.target);
        if (target.is('.animate-ripple') || target.parents('.animate-ripple').length !== 0)
        {
            if (!target.is('.animate-ripple')) {
                target = target.parents('.animate-ripple');
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
            ripple.style.top = top + 'px';
            ripple.style.left = left + 'px';
            ripple.classList.add('show');
        }
    };
    $('.animate-ripple').each(function (index, button) {
        button = $(button);
        button.on('mousedown', addRippleEffect);
    });
});


window.noticesHandler = function () {
    return {
        notices: [],
        visible: [],
        add(notice) {
            notice.id = Date.now()
            this.notices.push(notice)
            this.fire(notice.id)
        },
        fire(id) {
            this.visible.push(this.notices.find(notice => notice.id == id))
            const timeShown = (notice.type == 'success' ? 3000 : 6000) * this.visible.length
            setTimeout(() => {
                this.remove(id)
            }, timeShown)
        },
        remove(id) {
            const notice = this.visible.find(notice => notice.id == id)
            const index = this.visible.indexOf(notice)
            this.visible.splice(index, 1)
        },
        getIcon(notice){
            if ( notice.type == 'success')
                return "<div class='text-green-500 rounded-full bg-white float-left' ><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-check' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z'/></svg></div>" ;
            else if ( notice.type == 'info')
                return  "<div class='text-blue-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-info' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z'/><circle cx='8' cy='4.5' r='1'/></svg></div>" ;
            else if ( notice.type == 'warning')
                return  "<div class='text-orange-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-exclamation' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z'/></svg></div>" ;
            else if ( notice.type == 'danger')
                return  "<div class='text-red-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z'/><path fill-rule='evenodd' d='M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z'/></svg></div>" ;
        }
    };
}