function clear() { $('.toaster').remove(); }
function wrapper(el) { return $($(el).data('toast').wrapper); }
function hasToaster() { equal($('.toaster').length, 1, 'expected a single toast container'); }

$(function() {
    module('Toast Creation');
    
    test('Container is created automatically', function() {
        clear();
        $('<p>xxx</p>').toast();
        hasToaster();
    });
    
    test('Toast has "toast" class', function() {
        clear(); 
        var el = $('<p>test</p>').toast();
        ok(wrapper(el).hasClass('toast'));
    })
    
    test('Toast type "none" is not called out', function() {
        clear();
        var el = $('<p>test</p>').toast({ type: 'none' });
        equal(wrapper(el)[0].className, 'toast');
    });
    
    test('Other toast types are called out', function() {
        clear();
        var LOW   = $('<p>test</p>').toast({ type: 'LOW' });
        var MEDIUM = $('<p>test</p>').toast({ type: 'MEDIUM' });
        var HIGH   = $('<p>test</p>').toast({ type: 'HIGH' });
        var CRITICAL  = $('<p>test</p>').toast({ type: 'CRITICAL' });
        
        ok(wrapper(LOW  ).hasClass('toast-LOW'),   'LOW toast should have toast-LOW class');
        ok(wrapper(MEDIUM).hasClass('toast-MEDIUM'), 'MEDIUM toast should have toast-MEDIUM class');
        ok(wrapper(HIGH  ).hasClass('toast-HIGH'),   'HIGH toast should have toast-HIGH class');
        ok(wrapper(CRITICAL ).hasClass('toast-CRITICAL'),  'CRITICAL toast should have toast-CRITICAL class');
    });
    
    module('Toast Configuration');
    // todo
    // test('option "width"', function() {});
    // test('option "selector"', function() {});
    // test('option "type"', function() {});
    // test('option "text"', function() {});
    // test('option "closeText"', function() {});
    // test('option "sticky"', function() {});
    // test('option "duration"', function() {});
    // test('option "close"', function() {});
    
    module('Toast Removal');
    // todo
    // test('by timeout', function() {});
    // test('by API call', function() {});
    // test('by mouse click', function() {});

    module('(cleanup)');
    test('(cleanup)', function() { clear(); })
});