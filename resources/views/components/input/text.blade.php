<div class="w-full flex flex-col gap-1 text-black">
    <label
        class="text-xs uppercase"
        :class="{ hidden: labelHidden }"
        :for="id || name"
    >
        {{ label }}
    </label>
    <input
        :name="name"
        :id="id || name"
        :type="type"
        :placeholder="placeholder"
        class="
        w-full
        rounded-lg
        bg-white
        border border-black
        text-black
        py-2
        px-4
        h-12
      "
    />
    <div
        class="text-red-400 text-xs"
        :class="{
        hidden: !error
      }"
    >
        {{ error }}
    </div>
</div>
