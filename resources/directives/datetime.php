<?php
$blade->directive('datetime', function ($expression) {
    return "<?php echo with({$expression})->format('F d, Y g:i a'); ?>";
});
