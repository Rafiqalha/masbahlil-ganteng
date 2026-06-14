<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link 
        :href="href" 
        class="group flex items-center px-3.5 py-2.5 text-[14px] font-bold rounded-xl transition-all duration-200"
        :class="active 
            ? 'bg-mbg-green/15 text-mbg-green shadow-sm ring-1 ring-mbg-green/10' 
            : 'text-gray-400 hover:bg-white/5 hover:text-white font-medium'"
    >
        <div class="mr-3.5 flex-shrink-0 transition-colors" :class="active ? 'text-mbg-green' : 'text-gray-500 group-hover:text-gray-300'">
            <slot name="icon" />
        </div>
        <span class="flex-1 truncate tracking-wide"><slot /></span>
    </Link>
</template>
