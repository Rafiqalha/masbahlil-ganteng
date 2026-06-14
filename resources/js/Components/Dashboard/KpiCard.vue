<script setup>
defineProps({
    title: {
        type: String,
        required: true,
    },
    value: {
        type: [String, Number],
        required: true,
    },
    trendValue: {
        type: String,
        default: null,
    },
    trendDirection: {
        type: String,
        default: 'up', // 'up' or 'down'
    },
    iconBgClass: {
        type: String,
        default: 'bg-mbg-sky/40 text-mbg-navy',
    }
});
</script>

<template>
    <div class="p-6 relative overflow-hidden flex flex-col justify-center bg-white/90 backdrop-blur-md rounded-2xl border border-gray-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] hover:shadow-lg transition-all duration-300 group">
        <!-- Optional Background Graphic -->
        <div class="absolute bottom-0 right-0 opacity-60 pointer-events-none transition-transform duration-500 group-hover:scale-105">
            <slot name="bg-graphic" />
        </div>
        
        <h3 class="text-[11px] font-display font-bold text-gray-500 uppercase tracking-[0.15em] mb-5 relative z-10 text-center">{{ title }}</h3>
        
        <div class="flex items-center justify-center sm:justify-start gap-4 relative z-10 px-2">
            <div v-if="$slots.icon" class="w-12 h-12 flex items-center justify-center rounded-xl group-hover:scale-105 transition-transform" :class="iconBgClass">
                <slot name="icon" />
            </div>
            
            <div class="text-[36px] font-display font-bold text-gray-900 tracking-tight leading-none">{{ value }}</div>
            
            <!-- Trend Pill -->
            <div v-if="trendValue" class="flex items-center ml-auto text-[11px] font-bold px-3 py-1.5 rounded-full border"
                 :class="trendDirection === 'up' ? 'bg-[#E8F5E9] text-mbg-green border-mbg-green/20' : 'bg-[#FFF3E0] text-orange-600 border-orange-200'">
                <svg v-if="trendDirection === 'up'" class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                <svg v-else class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                {{ trendValue }}
            </div>
        </div>
        
        <div v-if="$slots.footer" class="mt-4 pt-4 border-t border-gray-100/50 text-[13px] text-gray-500 font-medium relative z-10 text-center">
            <slot name="footer" />
        </div>
    </div>
</template>
