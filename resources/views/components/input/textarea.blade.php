<div class="w-full flex flex-col gap-1">
    <label
        class="text-xs uppercase"
        :for="id || name"
    >
        {{ label }}
    </label>
    <textarea
        :name="name"
        :id="id || name"
        :placeholder="placeholder"
        :rows="rows"
        :cols="cols"
        class="w-full rounded-lg bg-white border border-black text-black p-2"
    >
    </textarea>
    <div
        class="text-red-400 text-xs"
        :class="{
        hidden: !error
      }"
    >
        {{ error }}
    </div>
</div>
