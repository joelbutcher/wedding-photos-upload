<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

</script>

<template>
  <Head title="Welcome"/>

  <div class="relative flex items-top justify-center min-h-screen bg-[#997a31]">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="flex flex-col items-center justify-center pt-8 sm:justify-start">
        <p class="font-semibold text-sm tracking-widest text-white uppercase">
          Welcome to
        </p>
        <h1 class="font-bold text-4xl text-white mt-2">
          {{ $page.props.names }}'s
        </h1>


          <p class="font-semibold text-sm tracking-widest text-white uppercase mt-2">
            Wedding Photo Upload
          </p>
      </div>

      <div class="mt-8">
        <div class="text-slate-600 dark:text-slate-200 text-sm p-6">

        </div>
      </div>

      <div class="mt-8">

      </div>
    </div>
  </div>
</template>
