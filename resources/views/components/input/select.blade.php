<div class="w-full flex flex-col gap-1">
    <label
        class="text-xs uppercase"
        :for="id || name"
    >
        {{ label }}
    </label>
    <select class="w-full rounded-lg bg-white border border-black text-black p-3 h-12">
        {{ $slot }}
    </select>
    <div
        class="text-red-400 text-xs"
        :class="{
        hidden: !error
      }"
    >
        {{ error }}
    </div>
</div>
