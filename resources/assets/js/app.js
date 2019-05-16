
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

window.setEditable = function (comp, content) {
    $('.' + comp + ' .' + content).prop('contenteditable', true);
    $('.' + comp + ' .' + content).focus();
    $('.' + comp + ' .' + content + '-save-button').show();
};

window.setStanceTitleEditable = function (comp, content) {
    $('.' + comp + ' .' + content).prop('contenteditable', true);
    $('.' + comp + ' .' + content).focus();
    $('#editStanceTitle').toggle();
    $('#saveStanceTitle').toggle();
    $('#cancelStanceTitle').toggle();
};

window.closeStanceTitleEditable = function (comp, content) {
    $('.' + comp + ' .' + content).prop('contenteditable', false);
    $('#editStanceTitle').toggle();
    $('#saveStanceTitle').toggle();
    $('#cancelStanceTitle').toggle();
};

window.saveDivToHidden = function (divClass, hiddenClass) {
    $('.' + hiddenClass).val(tinyMCE.activeEditor.getContent());
};

window.savePoliProfileToHidden = function () {
    $('.hidden-aboutme').val(tinyMCE.get('aboutmeeditor').getContent());
    $('.hidden-stance').val(tinyMCE.get('stance').getContent());
};

window.addClassTo = function (targetClass, classToAdd) {
    $('.' + targetClass).addClass(classToAdd);
};

window.removeClass = function (classToRemove) {
    $('#wardmap').removeClass(classToRemove);
};

window.showPostalCodeModal = function () {
    alert('asdfas');
    $('#requestPostalcode').removeClass('hide');
    $('#requestPostalcode').addClass('show');
};

window.enableEditor = function(editor, content) {
    $('#' + editor).toggle();
    $('#' + content).toggle();
};

window.enableAboutEditor = function(editor, content) {
    $('#' + editor).toggle();
    $('#' + content).toggle();
    $('#aboutmeSaveButton').toggle();
    $('#aboutmeEditButton').toggle();
    $('#aboutmeCancelButton').toggle();
};

window.enableStanceEditor = function(editor, content) {
    $('#' + editor).toggle();
    $('#' + content).toggle();
    $('#saveStanceContent').toggle();
    $('#cancelStanceContent').toggle();
    $('#editStanceContent').toggle();
};
