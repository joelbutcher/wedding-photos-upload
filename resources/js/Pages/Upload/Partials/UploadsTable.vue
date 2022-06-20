<script setup>
defineProps({
  uploads: {
    type: Array,
    required: true,
    validator: (val) => val.every(o => (
       o.hasOwnProperty('id') &&
       o.hasOwnProperty('uuid') &&
       o.hasOwnProperty('name') &&
       o.hasOwnProperty('email') &&
       o.hasOwnProperty('profile_photo_url') &&
       o.hasOwnProperty('images_count') &&
       o.hasOwnProperty('created_at')
    )),
  },
});
</script>

<template>
  <table class="min-w-full shadow-lg table-fixed">
    <thead class="bg-slate-200 dark:bg-slate-900">
      <tr>
        <th scope="col" class="p-4">
          <span class="sr-only">Id</span>
        </th>
        <th scope="col" class="py-3 px-6 text-xs font-medium font-bold tracking-wider text-left text-slate-900 uppercase dark:text-white">
          Name
        </th>
        <th scope="col" class="py-3 px-6 text-xs font-medium font-bold tracking-wider text-left text-slate-900 uppercase dark:text-white">
          Email
        </th>
        <th scope="col" class="py-3 px-6 text-xs font-medium font-bold tracking-wider text-left text-slate-900 uppercase dark:text-white">
          Created At
        </th>
        <th scope="col" class="py-3 px-6 text-xs font-medium font-bold tracking-wider text-left text-slate-900 uppercase dark:text-white">
          Images
        </th>
        <th scope="col" class="py-3 px-6 text-xs font-medium font-bold tracking-wider text-left text-slate-900 uppercase dark:text-white">
          <span class="sr-only">View</span>
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-slate-800 bg-white">
      <template v-for="upload in uploads">
        <tr class="bg-white hover:bg-gray-100 dark:bg-slate-700 dark:hover:bg-slate-600">
          <td class="p-4 w-4 dark:text-white">
          {{ upload.id }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-slate-900 dark:text-slate-200 whitespace-nowrap">
            {{ upload.name }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-slate-900 dark:text-slate-200 whitespace-nowrap">
            {{ upload.email }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-slate-900 dark:text-slate-200 whitespace-nowrap">
            {{ new Date(upload.created_at).toLocaleDateString('en-GB') }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-slate-900 dark:text-slate-200 whitespace-nowrap text-right">
            {{ upload.images_count }}
          </td>
          <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
            <a :href="route('uploads.show', {upload: upload.uuid})" class="text-blue-600 dark:text-blue-500 hover:underline">
              View
            </a>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</template>
