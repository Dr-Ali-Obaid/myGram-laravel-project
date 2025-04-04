<div>
    <li class="flex flex-col md:flex-row text-center">
        <div class="font-bold md:font-normal md:mr-1">
            {{$user->posts->count()}}
        </div>
        <span class="md:text-black text-neutral-500">
            {{$user->posts->count() > 1 ? "posts" : "post"}}
        </span>
    </li>
</div>

