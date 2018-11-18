<?php
if ( ! function_exists('renderDataAttributes')) {
    function renderDataAttributes($attributes)
    {
        $mapped = [];
        foreach ($attributes as $key => $value) {
            $mapped[] = 'data-' . $key . '="' . $value . '"';
        };

        return implode(' ', $mapped);
    }
}
?>
@if(!empty($options))
    <script type="text/javascript">
        var RecaptchaOptions = <?=json_encode($options) ?>;
    </script>
@endif
<script src='https://www.google.com/recaptcha/api.js?render=onload{{ (isset($lang) ? '&hl='.$lang : '') }}'></script>
<div class="g-recaptcha" data-sitekey="{{ $public_key }}" <?=renderDataAttributes($dataParams)?>></div>
