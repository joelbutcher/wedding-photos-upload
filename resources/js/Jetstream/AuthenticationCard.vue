<script setup>
import Card from '@/Components/Card.vue';

</script>
<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 dark:bg-slate-800">
    <div>
      <slot name="logo" />
    </div>

    <Card>
      <slot />
    </Card>
  </div>
</template>
