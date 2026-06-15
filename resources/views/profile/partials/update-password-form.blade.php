                <section>

                    <header style="margin-bottom:24px;">
                        <h2 style="font-size:20px;font-weight:700;margin-bottom:6px;">
                            Update Password
                        </h2>

                        <p style="color:#6b7280;line-height:1.6;">
                            Keep your account secure by using a strong password.
                        </p>
                    </header>

                    <form
                        method="POST"
                        action="{{ route('password.update') }}"
                        x-data="{ loading:false }"
                        @submit="loading=true"
                    >
                        @csrf
                        @method('put')

                        <div style="display:grid;grid-template-columns:1fr;gap:20px;max-width:640px;">

                            <div>
                                <x-input-label
                                    for="update_password_current_password"
                                    value="Current Password"
                                />

                                <x-text-input
                                    id="update_password_current_password"
                                    name="current_password"
                                    type="password"
                                    autocomplete="current-password"
                                />

                                <x-input-error
                                    :messages="$errors->updatePassword->get('current_password')"
                                />
                            </div>

                            <div>
                                <x-input-label
                                    for="update_password_password"
                                    value="New Password"
                                />

                                <x-text-input
                                    id="update_password_password"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                />

                                <x-input-error
                                    :messages="$errors->updatePassword->get('password')"
                                />
                            </div>

                            <div>
                                <x-input-label
                                    for="update_password_password_confirmation"
                                    value="Confirm Password"
                                />

                                <x-text-input
                                    id="update_password_password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                />

                                <x-input-error
                                    :messages="$errors->updatePassword->get('password_confirmation')"
                                />
                            </div>

                        </div>

                        <div style="margin-top:24px;display:flex;align-items:center;gap:14px;">

                            <button
                                type="submit"
                                class="btn btn-primary"
                                x-bind:disabled="loading"
                            >
                                <span x-show="!loading">
                                    Update Password
                                </span>

                                <span x-show="loading">
                                    Updating...
                                </span>
                            </button>

                            @if (session('status') === 'password-updated')

                                <span
                                    x-data="{ show:true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2500)"
                                    style="color:#166534;font-size:14px;font-weight:600;"
                                >
                                    Password updated.
                                </span>

                            @endif

                        </div>

                    </form>

                </section>