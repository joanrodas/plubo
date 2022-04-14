<?php
$blade = \PluginPlaceholder\Includes\BladeLoader::getInstance();

$blade->make_directive('test', function ($expression) {
    return "<?php echo 'SI'; ?>";
});
