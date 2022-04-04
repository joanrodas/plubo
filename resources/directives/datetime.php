<?php
PluginPlaceholderBlade::getInstance()->make_directive('test', function ($expression) {
    return "<?php echo 'SI'; ?>";
});
