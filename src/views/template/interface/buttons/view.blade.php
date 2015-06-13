@include("management-interface::template.interface.buttons.base", [
    'label' => isset($label) ? $label : 'management-interface::action.view',
    'color' => isset($color) ? $color : 'default'
])