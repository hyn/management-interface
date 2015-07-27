@include("management-interface::template.interface.buttons.base", [
    'label' => isset($label) ? $label : 'management-interface::action.add',
    'color' => isset($color) ? $color : 'primary',
    'raised' => true
])