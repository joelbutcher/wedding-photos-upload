<script setup>
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
  <div class="py-4 border-b border-gray-200 dark:border-slate-800">
    <div class="flex items-center justify-between px-4">
      <div class="flex items-center">
        <div class="shrink-0 mr-3">
          <img class="h-10 w-10 rounded-full object-cover" :src="upload.profile_photo_url" :alt="upload.profile_photo_url">
        </div>

        <div>
          <div class="font-medium text-base text-slate-800 dark:text-slate-100">
            {{ upload.name }}
          </div>
          <p class="font-medium text-sm text-slate-500 dark:text-slate-400 truncate">
            {{ upload.email }}
          </p>
        </div>
      </div>

      <div class="flex flex-col items-center justify-center dark:text-slate-100">
        <div>
          {{ upload.images_count }}
        </div>
        <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">
          Images
        </div>
      </div>
    </div>
  </div>
</template>
