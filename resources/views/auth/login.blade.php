<x-app>
    <div class="h-[800px] w-full flex flex-col items-center justify-center">
        <div class="">
            <form action="{{ route('login') }}" method="post"
                class="bg-white w-[500px] h-auto shadow-lg rounded-md flex flex-col">
                @csrf

                <h1 class="p-4 border border-transparent border-l-black font-bold text-lg text-center">LOGIN</h1>
                <div class="p-6 flex flex-col text-xs gap-2">
                    <label name="error_query" class="bg-gray-50 text-gray-500"></label>
                    <div class="flex flex-col">
                        <label class="text-gray-500" for="email">email </label>
                        <input value="{{ old('email') }}" type="email" name="email" id="email"
                            placeholder="e.g: example@gmail.com"
                            class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                        <label name="email_err" class="text-red-600">
                            @error('email')
                                Email field is required
                            @enderror
                        </label>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-500" for="password">password </label>
                        <input value="{{ old('password') }}" type="password" name="password" id="password"
                            placeholder="password" class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                        <label name="password_err" class="text-red-600">
                            @error('password')
                                Password field is required
                            @enderror
                        </label>
                    </div>

                    <div class="flex gap-1">
                        <input type="checkbox" name="show-pwd" id="show-pwd">
                        <label for="show-pwd">show password</label>
                    </div>

                    <input type="submit" name="submit" id="submit" value="Login"
                        class="bg-gray-500 rounded-lg p-2 mt-8 text-white">
                    <p class="mt-1">Don't have an Account? <a class="font-bold hover:underline"
                            href="{{ route('register') }}">Register</a></p>
                            
                    <a class="font-bold hover:underline" href="{{ route('password.request') }}">Forget password</a>
                </div>
            </form>
        </div>
    </div>
</x-app>
