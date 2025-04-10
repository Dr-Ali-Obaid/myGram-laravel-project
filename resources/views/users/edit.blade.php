<x-app-layout>
<form action="/u/{{$user->username}}/update" method="POST" enctype="multipart/form-data" class="container mx-auto px-4 sm:px-6">
        @csrf
        @method("PATCH")
  <div class="space-y-12 ">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">{{__("Profile")}}</h2>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="username" class="block text-sm/6 font-medium text-gray-900">{{__("Username")}}</label>
          <div class="mt-2">
              <input type="text" name="username" id="username" class="block w-full min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 focus:outline-none sm:text-sm/6 rounded-md" value="{{$user->username}}">  
              @error('username')
                  <div class="mt-2 text-sm text-red-600">{{$message}}</div>
              @enderror
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="about" class="block text-sm/6 font-medium text-gray-900">{{__("Bio")}}</label>
          <div class="mt-2">
            <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{$user->bio}}</textarea>
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="image" class="block text-sm/6 font-medium text-gray-900">{{__("Photo")}}</label>
          <div class="mt-2 flex items-center gap-x-3">
            <img src="{{Str::startsWith(auth()->user()->image, 'http') ? auth()->user()->image : Storage::url(auth()->user()->image)}}" class="h-12 w-12 rounded-full ltr:mr-5 rtl:ml-5 border border-gray-300">
            <input type="file" name="image" id="file_input" class="w-full border border-gray-200 bg-gray-50 block rounded-xl focus:outline-none hidden">
            <button type="button" onclick=" document.getElementById('file_input').click()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{__("Change Photo")}}</button>
          </div>
          @error('image')
            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
        </div>
        <div class="sm:col-span-4">
            <label for="private_account" class=" text-sm/6 font-medium text-gray-900">{{__("Private Account")}}</label>
            <div class="mt-2 flex items-center gap-x-3">
              <input type="checkbox" name="private_account" id="private_account" class=" border border-gray-400 rounded-xl bg-white focus:outline-none"
              {{$user->private_account? 'checked' : ''}}>
            </div>
          </div>
      </div>
      <div class="col-span-6 sm:col-span-3 mt-5">
        <label for="lang" class="block text-sm font-medium text-gray-700 mb-3">{{ __('Language') }}</label>
        <select id="lang" name="lang"
                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 ltr:px-3 rtl:px-8 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        </select>
    </div>
    </div>

    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">{{__("Personal Information")}}</h2>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="name" class="block text-sm/6 font-medium text-gray-900"> {{__("Name")}}</label>
          <div class="mt-2">
            <input type="text" name="name" value="{{$user->name}}" id="name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            @error('name')
            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
          </div>
        </div>
        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" value="{{$user->email}}" type="email" autocomplete="email"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            @error('email')
            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
          </div>
        </div>
        <div class="sm:col-span-4">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">{{__("Password")}}</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              @error('password')
              <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
            </div>
          </div>
          <div class="sm:col-span-4">
            <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">{{__("Password Confirmaiton")}}</label>
            <div class="mt-2">
              <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              @error('password_confirmation')
              <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
            </div>
          </div>
      </div>
    </div>

   
  </div>

  <div class="flex items-center justify-end gap-x-6">
    <x-secondary-button class="my-6 ">{{__("Cancel")}}</x-secondary-button>
   <x-primary-button>{{__("Save")}}</x-primary-button>
  </div>
</form>

</x-app-layout>