(function($) {
    function _action(search) {
        return '[data-action="'+search+'"]';
    }
    function _component(search) {
        return '[data-component="'+search+'"]';
    }
    function _name(search) {
        return '[data-name="'+search+'"]';
    }

    $(document).ready(function() {
        $(_component('select')).select2();
    });
})(jQuery);