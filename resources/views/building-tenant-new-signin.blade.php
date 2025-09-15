<x-layout.auth>
    <div x-data="{ currentForm: 'super-admin' }">
        <div class="absolute inset-0">
            <img src="/assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16 tenant">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[28%]" />
            <div class="relative flex w-full max-w-[800px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[500px] lg:flex-row lg:gap-10 xl:gap-0">
                <!-- Left Part: Dropdown and Logo -->
                <div class="relative w-full lg:max-w-[250px] p-4 flex flex-col items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)]" style="
    padding-bottom: 12rem;
">
                    <div class="w-36 mb-8">
                        <img src="/assets/images/security-logo.png" alt="Logo" class="w-full" />
                    </div>
                    <div class="w-full space-y-4">
                        <!-- Role Selection Dropdown -->
                        <div class="relative w-full">
                            <select
                                x-model="currentForm"
                                class="w-full p-3 bg-white border-0 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary/50 appearance-none cursor-pointer"
                            >
                                <option value="super-admin">Super Admin</option>
                                <option value="building-admin">Building Admin</option>
                                <option value="building-security">Building Security</option>
                                <option value="building-tenant">Building User</option>
                                <option value="school-admin">School Admin</option>
                                <option value="school-security">School Security</option>

                            </select>
                            <!-- Dropdown arrow -->
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Part: Form -->
                <div class="relative flex w-full flex-col items-center justify-center gap-4 px-4 pb-12 pt-4 sm:px-6 lg:max-w-[500px]">
                    <!-- Slider Container -->
                    <div class="w-full max-w-[360px] lg:mt-12">
                        <!-- Building Tenant Form -->
                        <div x-show="currentForm === 'building-tenant'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Building User</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-5 dark:text-white" method="POST" action="{{ route('building-tenant.login') }}">
                                @csrf
                                <label for="redirectUrl" hidden>Select Login Type</label>
                                <div class="relative text-white-dark" hidden>
                                    <select id="redirectUrl" name="redirect_url" class="w-full p-2 border border-gray-300 rounded-md" onchange="updateFormAction()" hidden>
                                        <option value="building">Building</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter Email"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password"
                                            placeholder="Enter Password"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Secret Key -->
                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password"
                                            placeholder="Enter Secret Key"
                                            class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- School Security Form -->
                        <div x-show="currentForm === 'school-security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">School Security</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                             <form id="loginForm" class="space-y-5 dark:text-white" method="POST" action="{{ route('school.security.login') }}">
                                @csrf
                                <label for="redirectUrl" hidden>Select Login Type</label>
                                <div class="relative text-white-dark" hidden>
                                    <select id="redirectUrl" name="redirect_url" class="w-full p-2 border border-gray-300 rounded-md" onchange="updateFormAction()" hidden>
                                        <option value="building">Building</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter Email"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password"
                                            placeholder="Enter Password"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Secret Key -->
                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password"
                                            placeholder="Enter Secret Key"
                                            class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- Building Security Form -->
                        <div x-show="currentForm === 'building-security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Building Security</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-5 dark:text-white" method="POST" action="{{ route('building-security.login') }}">
                                @csrf
                                <label for="redirectUrl" hidden>Select Login Type</label>
                                <div class="relative text-white-dark" hidden>
                                    <select id="redirectUrl" name="redirect_url" class="w-full p-2 border border-gray-300 rounded-md" onchange="updateFormAction()" hidden>
                                        <option value="building">Building</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter Email"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password"
                                            placeholder="Enter Password"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Secret Key -->
                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password"
                                            placeholder="Enter Secret Key"
                                            class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- Super Admin Form -->
                        <div x-show="currentForm === 'super-admin'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Super Admin</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form class="space-y-5 dark:text-white" method="POST" action="{{ route('super-admin.login') }}">
                                @csrf
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email" value="{{ old('email') }}"
                                            placeholder="Enter Email" class="form-input ps-10 placeholder:text-white-dark"
                                            required />
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password" placeholder="Enter Password"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="text"
                                            placeholder="Enter Secret Key"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign in
                                </button>
                            </form>
                        </div>

                        <!-- School Admin Form -->
                        <div x-show="currentForm === 'school-admin'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">School Admin</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-5 dark:text-white" method="POST" action="{{ route('school-admin.login') }}">
                                @csrf

                                <!-- Email -->
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email"
                                               value="{{ old('email') }}"
                                               placeholder="Enter Email"
                                               class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password"
                                               placeholder="Enter Password"
                                               class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Secret Key -->
                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password"
                                               placeholder="Enter Secret Key"
                                               class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <button type="submit"
                                        class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- Building Admin Form -->
                        <div x-show="currentForm === 'building-admin'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Building Admin</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-5 dark:text-white" method="POST" action="{{ route('building-admin.login') }}">
                                @csrf
                                <label for="redirectUrl" hidden>Select Login Type</label>
                                <div class="relative text-white-dark" hidden>
                                    <select id="redirectUrl" name="redirect_url" class="w-full p-2 border border-gray-300 rounded-md" onchange="updateFormAction()" hidden>
                                        <option value="building">Building</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="Email">User Name<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter Email"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="Password">Password<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password"
                                            placeholder="Enter Password"
                                            class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Secret Key -->
                                <div>
                                    <label for="SecretKey">Secret Key<span class="text-red-500">*</span></label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password"
                                            placeholder="Enter Secret Key"
                                            class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('secret_key')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.auth>
