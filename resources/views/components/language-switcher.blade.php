@props(['currentLocale' => 'ar'])

<div class="dropdown">
    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fe fe-globe fe-16"></i>
        <span class="d-none d-sm-inline ml-2">
            @if($currentLocale === 'ar')
                العربية
            @else
                English
            @endif
        </span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
        <a class="dropdown-item {{ $currentLocale === 'ar' ? 'active' : '' }}" href="#" onclick="switchLanguage('ar')">
            <i class="fe fe-check {{ $currentLocale === 'ar' ? '' : 'd-none' }}"></i>
            العربية
        </a>
        <a class="dropdown-item {{ $currentLocale === 'en' ? 'active' : '' }}" href="#" onclick="switchLanguage('en')">
            <i class="fe fe-check {{ $currentLocale === 'en' ? '' : 'd-none' }}"></i>
            English
        </a>
    </div>
</div>

<script>
function switchLanguage(locale) {
    // Create a form to submit the language change
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("language.switch") }}';

    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfToken);

    // Add locale
    const localeInput = document.createElement('input');
    localeInput.type = 'hidden';
    localeInput.name = 'locale';
    localeInput.value = locale;
    form.appendChild(localeInput);

    // Submit the form
    document.body.appendChild(form);
    form.submit();
}
</script>
