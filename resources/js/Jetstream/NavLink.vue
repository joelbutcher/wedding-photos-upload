<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-700 transition'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:border-gray-300 focus:outline-none focus:text-slate-700 focus:border-gray-300 transition';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
