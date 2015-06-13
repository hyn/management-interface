@if(!isset($elm) && isset($href))
    <?php $elm = 'a'; ?>
@elseif(!isset($elm))
    <?php $elm = 'button'; ?>
@endif
<?php
        $classes = ['btn'];
        $classes[] = sprintf("btn-%s", isset($color) ? $color : 'default');
        if(isset($size))
            $classes[] = sprintf("btn-%s", $size);
        if(isset($flat) && $flat)
            $classes[] = "btn-flat";
        if(isset($raised) && $raised)
            $classes[] = 'btn-raised';
        if(isset($block) && $block)
            $classes[] = 'btn-block';
        if(isset($pull))
            $classes[] = sprintf('pull-%s', $pull);
?>

<{{ $elm or 'button' }}
    class="{{ join(' ', $classes) }}"
        @if(isset($href))
            href="{{ $href }}"
        @endif
        @if(isset($target))
            target="{{ $target }}"
        @endif
        @if(isset($tooltip))
            data-tooltip="{!! $tooltip !!}"
        @endif

        @if(isset($modal))
            data-toggle="modal" data-target="{{ $modal }}"
        @endif
        >
        @if(isset($icon) && strstr($icon,':'))
            @include($icon)
        @elseif(isset($icon))
            {{ $icon }}
        @endif

        @if(isset($label) && strstr($label,':'))
            {{ trans($label) }}
        @elseif(isset($label))
            {{ $label }}
        @endif
</{{ $elm or 'button' }}>