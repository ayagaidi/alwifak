# TODO: Enhance Login Page

## Completed
- [x] Create resources/lang/en/auth.php with login translations
- [x] Create resources/lang/ar/auth.php with login translations
- [x] Edit resources/views/auth/login.blade.php:
  - Wrap form in Bootstrap card for better UI
  - Make labels visible above inputs
  - Add forgot password link
  - Localize all text using __()
  - Improve logo section with alt text
  - Enhance SweetAlert for better error handling
  - Ensure RTL compatibility

## Followup
- [ ] Test login page: Run `php artisan serve`, open in browser, verify form, localization, responsiveness
- [ ] Check console for errors

# TODO: Add Language Switcher to Front Layout

## Completed
- [x] Include language-switcher component in header-btn ul of resources/views/front/app.blade.php
- [x] Add switchLanguage JavaScript function to handle POST request to /language/switch with CSRF token
- [x] Pass current locale from session to component

## Followup
- [ ] Test language switcher: Run `php artisan serve`, open front page, click dropdown, switch languages, verify page reloads and locale changes
- [ ] Check console for errors
