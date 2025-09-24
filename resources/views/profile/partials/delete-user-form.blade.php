<div>
    <p class="text-muted mb-4">بمجرد حذف حسابك، سيتم حذف جميع الموارد والبيانات الخاصة به نهائياً. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات تريد الاحتفاظ بها</p>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        حذف الحساب
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">تأكيد حذف الحساب</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">بمجرد حذف حسابك، سيتم حذف جميع الموارد والبيانات الخاصة به نهائياً. يرجى إدخال كلمة المرور لتأكيد رغبتك في حذف حسابك نهائياً</p>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                            @error('userDeletion.password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">حذف الحساب</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
