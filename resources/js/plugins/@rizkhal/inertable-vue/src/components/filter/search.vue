<script setup>
defineProps({
  modelValue: {
    type: [String, null],
    required: true,
  },
});

defineEmits(["update:modelValue"]);
</script>
<template>
  <form class="lg:pr-3">
    <label for="users-search" class="sr-only">Search</label>
    <div class="mt-1 relative lg:w-64 xl:w-96">
      <input
        type="search"
        name="email"
        id="users-search"
        autocomplete="off"
        placeholder="Search"
        v-model="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="
          block
          p-2.5
          w-full
          sm:text-sm
          rounded-lg
          bg-gray-50
          text-gray-900
          border border-gray-300
          focus:ring-cyan-600 focus:border-cyan-600
        "
      />
    </div>
  </form>
</template>