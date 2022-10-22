<script setup>
import { ref, onMounted } from "vue";
import { v4 as uuid } from "uuid";

const selectedImage = ref(null);

const props = defineProps({
  id: {
    type: String,
    default: () => "file-input-" + uuid(),
  },
  required: {
    type: Boolean,
    default: false,
  },
  modelValue: [Object, String],
  error: String,
  label: {
    type: String,
    default: () => null,
  },
});

onMounted(() => {
  if (props.modelValue) {
    selectedImage.value = props.modelValue;
  }
});

const emit = defineEmits(["onChange"]);

function handleImageChanged(file) {
  emit("onChange", file);

  let reader = new FileReader();
  reader.onload = (e) => (selectedImage.value = e.target.result);
  reader.readAsDataURL(file);
}
</script>
<template>
  <div class="my-2">
    <label v-if="label" class="text-sm font-medium text-gray-900 block mb-1" :for="id">
      {{ label }}
      <span v-show="required" class="text-red-500">*</span>
    </label>

    <img class="w-full rounded-md border shadow dark:border-cool-gray-800" @click.prevent="$refs.image.click()" :class="{ 'border-red-500': error, 'w-max': !selectedImage }" :src="selectedImage ? selectedImage : '/images/default.png'" />

    <input @input="handleImageChanged($event.target.files[0])" accept="image/png,image/jpeg" ref="image" type="file" style="display: none" />
    <div v-if="error" class="text-red-500 mt-1 text-sm">{{ error }}</div>
  </div>
</template>