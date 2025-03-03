<x-app>
    <div class="h-[800px] w-full flex flex-col items-center justify-center">
        <div class="">
            <form action="{{ route('register') }}" method="post"
                class="bg-white w-[600px] h-auto shadow-lg rounded-md flex flex-col">
                @csrf

                <h1 class="p-4 border border-transparent border-l-black font-bold text-xl text-center">REGISTRATION</h1>
                <div class="p-6 flex flex-col text-xs gap-2">
                    <label name="error_query" class="bg-gray-50 text-gray-500"></label>
                    <div class="flex gap-2 w-full">
                        <div class="flex flex-col w-1/2">
                            <label class="text-gray-500" for="firstname">First Name *</label>
                            <input value="{{old('firstname')}}" type="text" name="firstname" id="firstname"
                                placeholder="Enter your first name"
                                class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                            <label name="firstname_err" class="text-red-600">
                                @error('firstname')
                                    Firstname field is required
                                @enderror
                            </label>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <label class="text-gray-500" for="lastname">Last Name *</label>
                            <input value="{{old('lastname')}}" type="text" name="lastname" id="lastname"
                                placeholder="Enter your last name"
                                class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                            <label name="lastname_err" class="text-red-600">
                                @error('lastname')
                                    Lastname field is required
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="email">Email *</label>
                        <input value="{{old('email')}}" type="email" name="email" id="email"
                            placeholder="e.g: example@gmail.com"
                            class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                        <label name="email_err" class="text-red-600">
                            @error('email')
                                Email field is required
                            @enderror
                        </label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="password">Password *</label>
                        <input value="{{old('password')}}" type="password" name="password" id="password" placeholder="password"
                            class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                        <label name="password_err" class="text-red-600">
                            @error('password')
                                Password field is required
                            @enderror
                        </label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="password_confirmation">Confirm Password *</label>
                        <input value="{{old('password_confirmation')}}" type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm password" class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none">
                        <label name="password_confirmation_err" class="text-red-600">
                            @error('password_confirmation')
                                Password confirmation field is required
                            @enderror
                        </label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="role_id">Role *</label>
                        <select class="bg-gray-100 rounded-md pl-2 p-1 text-xs border-none" name="role_id" id="role_id">
                            <option value="3" selected>Touriste</option>
                            <option value="2">Proprietaire</option>
                        </select>
                        <label name="email_err" class="text-red-600">
                            @error('email')
                                Email field is required
                            @enderror
                        </label>
                    </div>

                    {{-- <div class="flex gap-1">
                        <input type="checkbox" name="show-pwd" id="show-pwd">
                        <label for="show-pwd">show password</label>
                    </div> --}}

                    <p class="text-gray-500 text-xs">*: Required fields</p>

                    <input type="submit" name="submit" id="submit" value="Sign Up"
                        class="bg-gray-500 rounded-md p-2 text-white">
                    <p class="mt-1">Already have an Account? <a class="font-bold hover:underline"
                            href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</x-app>
