<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  upload: {
    type: Object,
    validator: (o) => (
      o.hasOwnProperty('id') &&
      o.hasOwnProperty('uuid') &&
      o.hasOwnProperty('name') &&
      o.hasOwnProperty('email') &&
      o.hasOwnProperty('profile_photo_url') &&
      o.hasOwnProperty('images_count') &&
      o.hasOwnProperty('created_at')
    ),
  }
});
</script>

<template>
  <AppLayout :title="`${upload.name} – Uploads`">
    <template #header>
      <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
        {{ upload.name }}
      </h2>
      <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
        <a href="javascript:history.back()">&larr; Back to Uploads</a>
      </div>
    </template>

    <div>
    </div>
  </AppLayout>
</template>
