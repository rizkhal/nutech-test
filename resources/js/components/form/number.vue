<template>
  <div :class="$attrs.class">
    <label v-if="label" class="text-sm font-medium text-gray-900 block mb-1" :for="id">
      {{ label }}
      <span v-show="required" class="text-red-500">*</span>
    </label>
    <div class="relative mt-1 text-gray-700">
      <div v-show="prefix" class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="text-gray-600 dark:text-cool-gray-200"> Rp. </span>
      </div>
      <input :id="id" type="text" v-bind="{ ...$attrs, class: null }" :value="modelValue" @input="handleInput" @keypress="handleKeyPressed" :class="{ 'border-red-500 dark:border-red-500': error, 'pr-9 pl-10': prefix }" class="p-2.5 block w-full sm:text-sm rounded-lg bg-gray-50 text-gray-900 border border-gray-300 focus:ring-indigo-600 focus:border-indigo-600 disabled:cursor-not-allowed disabled:bg-gray-200" />
    </div>
    <div v-if="error" class="text-red-500 mt-1 text-sm">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from "uuid";
import { number } from "~/helpers";

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `currency-input-${uuid()}`;
      },
    },
    error: String,
    label: String,
    prefix: {
      type: String,
      default: () => null,
    },
    required: {
      type: Boolean,
      default: false,
    },
    modelValue: [String, Number],
  },
  emits: ["update:modelValue"],
  mounted() {
    if (this.modelValue) {
      this.$emit("update:modelValue", number(this.modelValue));
    }
  },
  methods: {
    handleKeyPressed(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    handleInput(event) {
      this.$emit("update:modelValue", number(event.target.value));
    },
  },
};
</script>
