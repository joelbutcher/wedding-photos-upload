<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
  <Link :href="'/'">
    <div class="flex flex-col items-center justify-center pt-8 sm:justify-start">
      <slot name="intro" />

      <h1 class="font-bold text-6xl font-serif text-slate-800 dark:text-white text-center">
        {{ $page.props.application.names }}'s
      </h1>


      <p class="font-semibold text-sm tracking-widest text-slate-800 dark:text-white uppercase text-center mt-6">
        Wedding Photo Upload
      </p>
    </div>
  </Link>
</template>
