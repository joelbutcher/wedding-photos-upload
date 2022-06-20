<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Upload from '@/Pages/Upload/Partials/Upload.vue';
import UploadsTable from '@/Pages/Upload/Partials/UploadsTable.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  uploads: {
    type: Object,
    required: true,
    default: (rawProps) => {
      console.log(rawProps);
      return {
        current_page: 1,
        data: [],
        first_page_url: 'http://wedding.test/uploads?page=1',
        from: 1,
        last_page: 1,
        last_page_url: 'http://wedding.test/uploads?page=1',
        links: [
          {
            active: false,
            label: '&laquo; Previous',
            url: null,
          },
          {
            active: true,
            label: '1',
            url: 'http://wedding.test/uploads?page=1',
          },
          {
            active: false,
            label: 'Next &raquo;',
            url: null,
          },
        ],
        next_page_url: null,
        path: 'http://wedding.test/uploads',
        per_page: 15,
        prev_page_url: null,
        to: 10,
        total: 10,
      };
    },
  },
});
</script>

<template>
  <AppLayout title="Uploads">
    <template #header>
      <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
        Uploads
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="sm:hidden bg-white dark:bg-slate-700 overflow-hidden shadow">
          <template v-for="upload in uploads.data">
            <Link :href="route('uploads.show', {upload: upload.uuid})">
              <Upload :upload="upload" />
            </Link>
          </template>
        </div>

        <div class="hidden sm:block bg-white dark:bg-slate-600 overflow-hidden shadow-lg rounded-lg">
          <UploadsTable :uploads="uploads.data" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
