@props(['currentLocale' => 'ar'])

<div class="dropdown">
    <button class="btn btn-link text-white dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-globe"></i>
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
            <i class="fas fa-check {{ $currentLocale === 'ar' ? '' : 'd-none' }}"></i>
            العربية
        </a>
        <a class="dropdown-item {{ $currentLocale === 'en' ? 'active' : '' }}" href="#" onclick="switchLanguage('en')">
            <i class="fas fa-check {{ $currentLocale === 'en' ? '' : 'd-none' }}"></i>
            English
        </a>
    </div>
</div>


