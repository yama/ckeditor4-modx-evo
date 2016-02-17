//<?php
/*
 * CKEditor4 for Modx Evolution
 *
 * Latest Updates / Issues on Github:
 * https://github.com/Deesen/ckeditor4-modx-evo
 *
 * @events: OnRichTextEditorRegister, OnRichTextEditorInit, OnInterfaceSettingsRender
 * @configuration: &width=Width;text;100%
 *
 */
if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

// Init
include_once(MODX_BASE_PATH."assets/plugins/ckeditor4/class.modxRTEbridge.inc.php");
$rte = new modxRTEbridge('ckeditor4');

// Overwrite item-parameters
// $rte->set('width',          '75%', 'string' );                               // Overwrite width parameter
// $rte->set('height',         isset($height) ? $height : '400px', 'string' );  // Get/set height from plugin-configuration
// $rte->set('height',         NULL );                                          // Removes "height" completely from editor-init

// Internal Stuff - Don´t touch!
$showSettingsInterface = true;  // Show/Hide interface in Modx- / user-configuration (false for "Mini")
$editorLabel = $rte->pluginParams['editorLabel'];

$e = &$modx->event;
switch ($e->name) {
    // register for manager
    case "OnRichTextEditorRegister":
        $e->output($editorLabel);
        break;

    // render script for JS-initialization
    case "OnRichTextEditorInit":
        if ($editor === $editorLabel) {
            $script = $rte->getEditorScript();
            $e->output($script);
        };
        break;

    // render Modx- / User-configuration settings-list
    case "OnInterfaceSettingsRender":
        if( $showSettingsInterface === true ) {
            $html = $rte->getModxSettings();
            $e->output($html);
        };
        break;

    default :
        return; // important! stop here!
        break;
}