<div>
    <p class="text-muted mb-4">تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للحفاظ على الأمان</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">كلمة المرور الحالية</label>
            <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
            @error('updatePassword.current_password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">كلمة المرور الجديدة</label>
            <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
            @error('updatePassword.password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">تأكيد كلمة المرور</label>
            <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
            @error('updatePassword.password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">حفظ كلمة المرور</button>

            @if (session('status') === 'password-updated')
                <span class="text-success ms-3">تم تحديث كلمة المرور بنجاح</span>
            @endif
        </div>
    </form>
</div>
