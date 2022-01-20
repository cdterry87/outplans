<div class="flex items-center gap-2">
    <input
        class="
        h-4
        w-4
        rounded-sm
        transition
        duration-200
        cursor-pointer
        text-indigo-600
        border-black
        focus:ring-0
      "
        type="checkbox"
        :value="value"
        :name="name"
        :id="id"
    />
    <label
        class="inline-block text-black text-sm"
        :for="id"
    >
        {{ label }}
    </label>
</div>
