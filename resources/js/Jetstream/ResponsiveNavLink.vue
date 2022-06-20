<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-base font-medium text-indigo-700 dark:text-indigo-200 bg-indigo-50 dark:bg-indigo-900 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-slate-600 dark:text-slate-300 hover:text-slate-800 hover:text-slate-100 hover:bg-gray-50 dark:hover:bg-slate-800 hover:border-gray-300 focus:outline-none focus:text-slate-800 dark:focus:text-slate-100 focus:bg-gray-50 dark:focus:bg-slate-900 focus:border-gray-300 dark:focus:border-slate-600 transition';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-left">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
