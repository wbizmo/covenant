                    <section x-data="{ deleteModal:false }">

                        <header style="margin-bottom:24px;">
                            <h2 style="font-size:20px;font-weight:700;margin-bottom:6px;color:#991b1b;">
                                Delete Account
                            </h2>

                            <p style="color:#6b7280;line-height:1.6;">
                                Permanently delete your account and remove all related data. This action cannot be undone.
                            </p>
                        </header>

                        <button
                            type="button"
                            class="btn"
                            style="
                                background:#dc2626;
                                color:#ffffff;
                            "
                            @click="deleteModal = true"
                        >
                            Delete Account
                        </button>

                        <div
                            x-show="deleteModal"
                            x-transition
                            style="
                                position:fixed;
                                inset:0;
                                background:rgba(17,24,39,.45);
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                z-index:9999;
                            "
                        >
                            <div
                                style="
                                    width:100%;
                                    max-width:460px;
                                    background:#ffffff;
                                    border-radius:20px;
                                    padding:28px;
                                    box-shadow:0 25px 60px rgba(0,0,0,.25);
                                "
                                @click.outside="deleteModal = false"
                            >
                                <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                                    <span
                                        class="material-symbols-rounded"
                                        style="color:#dc2626;font-size:32px;"
                                    >
                                        warning
                                    </span>

                                    <h2 style="font-size:20px;">
                                        Confirm Account Deletion
                                    </h2>
                                </div>

                                <p style="color:#6b7280;line-height:1.7;margin-bottom:24px;">
                                    Once your account is deleted, all resources and data will be permanently removed.
                                    Enter your password to confirm this action.
                                </p>

                                <form
                                    method="POST"
                                    action="{{ route('profile.destroy') }}"
                                    x-data="{ loading:false }"
                                    @submit="loading=true"
                                >
                                    @csrf
                                    @method('delete')

                                    <div>
                                        <x-input-label
                                            for="password"
                                            value="Password"
                                        />

                                        <x-text-input
                                            id="password"
                                            name="password"
                                            type="password"
                                            placeholder="Enter your password"
                                        />

                                        <x-input-error
                                            :messages="$errors->userDeletion->get('password')"
                                        />
                                    </div>

                                    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;">

                                        <button
                                            type="button"
                                            class="btn"
                                            style="background:#f3f4f6;"
                                            @click="deleteModal = false"
                                        >
                                            Cancel
                                        </button>

                                        <button
                                            type="submit"
                                            class="btn"
                                            style="background:#dc2626;color:white;"
                                            x-bind:disabled="loading"
                                        >
                                            <span x-show="!loading">
                                                Delete Account
                                            </span>

                                            <span x-show="loading">
                                                Deleting...
                                            </span>
                                        </button>

                                    </div>

                                </form>

                            </div>
                        </div>

                    </section>