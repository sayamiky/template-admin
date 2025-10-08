<x-admin-layout>
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan /</span> Profil Saya
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Profil</h5>
                <!-- Account -->
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <hr class="my-0">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
                <hr class="my-0">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</x-admin-layout>
