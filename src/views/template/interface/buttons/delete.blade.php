@include("management-interface::template.interface.buttons.base", [
    'label' => isset($label) ? $label : 'management-interface::action.delete',
    'color' => isset($color) ? $color : 'danger'
])