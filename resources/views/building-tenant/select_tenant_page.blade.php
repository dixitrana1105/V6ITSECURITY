<x-layout.auth>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818]">
        <div class="relative w-full max-w-lg bg-white/90 dark:bg-gray-900 p-8 rounded-2xl shadow-lg backdrop-blur">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="/assets/images/security-logo.png" alt="Logo" class="h-16 w-auto">
                </a>
            </div>

            <!-- Title -->
            <h1 class="text-2xl font-extrabold text-center text-primary mb-6">
                Select Tenant
            </h1>

            <!-- Form -->
            <form method="POST" action="{{ route('building-tenant.confirmTenant') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="password" value="{{ $password }}">
                <input type="hidden" name="secret_key" value="{{ $secret_key }}">

               <div class="space-y-3">
                    @foreach($tenants as $tenant)
                        <label class="flex items-center justify-between p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="tenant_id" value="{{ $tenant->id }}" required>
                                <span class="font-medium">
                                    {{ $tenant->Building_Master->name ?? 'Unknown Building' }}
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>



                <button type="submit"
                    class="btn btn-gradient mt-6 w-full uppercase shadow-lg rounded-lg py-3">
                    Continue
                </button>
            </form>
        </div>
    </div>
</x-layout.auth>
