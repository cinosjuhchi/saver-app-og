        <div class="flex flex-col h-screen justify-center px-6 py-12 lg:px-8 rounded-lg shadow-sm">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2
                    class="text-center text-2xl font-bold leading-9 tracking-tight text-black"
                >
                    Masuk ke <span class="bg-clip-text text-transparent bg-gradient-to-r from-birumuda to-birutua font-black">SaverApp</span>
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/login" method="POST">
                    @csrf
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-black"
                            >Nama Pengguna</label
                        >
                        <div class="mt-2">
                            <input
                                id="nama"
                                name="username"
                                type="nama"
                                autocomplete="nama"
                                value="{{ old('username') }}"
                                class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:outline-none focus:ring-birumuda @error('username') invalid:border-red-500 @enderror sm:text-sm sm:leading-6 px-2"
                            />
                            @error('username')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium leading-6 text-black"
                                >Password</label
                            >
                        </div>
                        <div class="mt-2">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                class="block w-full px-2 @error('password') invalid:border-red-500 @enderror rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:outline-none focus:ring-birumuda sm:text-sm sm:leading-6"
                            />
                            @error('password')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-gradient-to-r from-birumuda to-birutua px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-birumuda transition-all  ease-in-out duration-100"
                        >
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>