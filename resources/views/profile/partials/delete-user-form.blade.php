<section class="space-y-6">
    <header>
        <h2 class="h5 text-dark">
            Hapus Akun
        </h2>

        <p class="mt-1 text-muted">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus
            akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button class="btn btn-danger" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Hapus Akun</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h2 class="h5 text-dark">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-muted">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan
                masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-4">
                <label for="password" class="form-label sr-only">Password</label>

                <input id="password" name="password" type="password" class="form-control" placeholder="Password">

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close')">
                    Batal
                </button>

                <button type="submit" class="btn btn-danger ms-3">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
