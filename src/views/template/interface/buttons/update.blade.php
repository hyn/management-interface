@include("management-interface::template.interface.buttons.base", [
    'label' => isset($label) ? $label : 'management-interface::action.edit',
    'color' => isset($color) ? $color : 'default'
])