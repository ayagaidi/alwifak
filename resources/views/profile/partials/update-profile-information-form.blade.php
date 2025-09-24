<div>
    <p class="text-muted mb-4">قم بتحديث معلومات ملفك الشخصي وعنوان البريد الإلكتروني</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-muted">
                        عنوان بريدك الإلكتروني غير مُفعل

                        <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                            اضغط هنا لإرسال رابط التفعيل مرة أخرى
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            تم إرسال رابط تفعيل جديد إلى عنوان بريدك الإلكتروني
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success ms-3">تم الحفظ بنجاح</span>
            @endif
        </div>
    </form>
</div>
