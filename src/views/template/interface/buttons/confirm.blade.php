@include("management-interface::template.interface.buttons.base", [
    'label' => isset($label) ? $label : 'management-interface::action.confirm',
    'color' => isset($color) ? $color : 'primary'
])