@props([
    'notification' => null,
    'read' => false,
])

<div
    class="
      flex flex-col
      gap-2
      bg-white
      border border-gray-200
      shadow-md
      rounded-lg
      p-4
      text-gray-600
    ">
    <div
        class="
        flex
        items-center
        justify-between
        gap-4
        border-b border-gray-200
        pb-2
      ">
        <h4 class="block font-bold">
            @if ($read)
                <i class="fas fa-envelope-open mr-2"></i>
            @else
                <i class="fas fa-envelope mr-2"></i>
            @endif
            This is the message title
        </h4>
        <i
            class="
          block
          fas
          fa-trash
          text-gray-600
          cursor-pointer
          hover:brightness-90
          transition
          duration-200
          ease-in-out
        "></i>
    </div>

    <p class="text-sm">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
        exercitationem aperiam eaque, amet ipsam magni et similique illum alias
        non accusantium qui? Ipsum sit, nostrum numquam nihil iste incidunt error,
        quos ex odio dolorum quam cumque cupiditate consectetur. Fuga, voluptate!
    </p>
    <div class="flex justify-between items-center text-xs mt-4">
        <a
            href="#"
            class="block font-bold"
        >
            Read More...
        </a>
        <div>Yesterday</div>
    </div>
</div>
