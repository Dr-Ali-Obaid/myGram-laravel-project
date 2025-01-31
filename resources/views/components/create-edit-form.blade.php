<input type="file" id="file-input" name="image" class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl">
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file-input-help">
                PNG, JPG or GIF
            </p>
            <textarea name="description"  rows="5" class="mt-10 w-full border border-gray-200 rounded-xl" placeholder="{{__('Write a description ...')}}">{{$post->description ?? ""}}</textarea>