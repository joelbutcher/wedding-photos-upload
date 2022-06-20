<script setup>
defineProps({
  value: String,
});
</script>

<template>
  <label class="block font-bold text-xs text-slate-800 dark:text-white uppercase tracking-widest">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>
