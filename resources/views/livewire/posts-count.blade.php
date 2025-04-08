<div>
    <li class="flex flex-col md:flex-row text-center">
        <div class="font-bold md:font-normal md:ltr:mr-1 md:rtl:ml-1">
            {{$user->posts->count()}}
        </div>
        <span class="md:text-black text-neutral-500">
            {{$user->posts->count() > 1 ? __("posts") : __("post")}}
        </span>
    </li>
</div>

