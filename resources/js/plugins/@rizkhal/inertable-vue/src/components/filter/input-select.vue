<template>
  <div :class="$attrs.class" class="flex flex-col space-y-2">
    <label
      v-if="label"
      class="text-sm font-medium text-gray-900 block"
      :for="id"
      >{{ label }}:</label
    >
    <select
      :id="id"
      ref="input"
      v-model="selected"
      v-bind="{ ...$attrs, class: null }"
      :class="{ 'border-red-500 border': error }"
      class="
        p-2.5
        block
        w-full
        sm:text-sm
        rounded-lg
        bg-gray-50
        text-gray-900
        border border-gray-300
        focus:ring-cyan-600 focus:border-cyan-600
      "
    >
      <slot />
    </select>
    <div v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { v4 as uuid } from "uuid";

const emit = defineEmits(["update:modelValue"]);

const input = ref(null);
const selected = ref(props.modelValue);

const props = defineProps({
  id: {
    type: String,
    default() {
      return `select-input-${uuid()}`;
    },
  },
  error: String,
  label: String,
  modelValue: [String, Number, Boolean],
});

watch(
  () => selected,
  () => emit("update:modelValue", selected)
);

const focus = () => {
  input.focus();
};

const select = () => {
  input.select();
};
</script>
