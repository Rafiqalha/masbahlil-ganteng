<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen w-full bg-cover bg-center bg-no-repeat relative flex" style="background-image: url('/logos/background-login.png');">
        
        <!-- Main Container: Split 50/50 on Desktop -->
        <div class="w-full max-w-[1400px] mx-auto flex flex-col lg:flex-row h-screen">
            
            <!-- Left Side: Typography & Branding -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 lg:px-16 xl:px-24 pt-12 lg:pt-0">
                <Link href="/" class="mb-6 inline-block hover:opacity-90 transition-opacity">
                    <img src="/logos/logo-mbg.png" alt="MBGBrain Logo" class="h-24 md:h-28 lg:h-32 w-auto object-contain object-left" />
                </Link>

                <h1 class="font-serif text-4xl lg:text-[3.5rem] font-bold text-slate-900 leading-[1.15] mb-6 tracking-tight">
                    Membangun Ekosistem <br /> Gizi Nasional yang <br />
                    <span class="text-emerald-600 italic">Cerdas & Berkelanjutan</span>
                </h1>
                
                <p class="text-slate-600 text-lg lg:text-xl max-w-lg font-light leading-relaxed">
                    Menghubungkan SPPG, Supplier, dan UMKM dalam satu ekosistem digital untuk Indonesia yang lebih sehat.
                </p>
            </div>

            <!-- Right Side: The Form Card -->
            <div class="w-full lg:w-1/2 flex justify-center items-center p-6 sm:p-12 h-full">
                <!-- Premium White Card -->
                <div class="w-full max-w-md bg-white rounded-[2rem] p-8 sm:p-10 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-slate-100 relative">
                    <!-- Decorative Dots Pattern (Top Right) -->
                    <div class="absolute top-6 right-6 grid grid-cols-4 gap-1.5 opacity-20">
                        <div v-for="n in 16" :key="'tr-'+n" class="w-1 h-1 bg-emerald-600 rounded-full"></div>
                    </div>
                    <!-- Decorative Dots Pattern (Bottom Left) -->
                    <div class="absolute bottom-6 left-6 grid grid-cols-4 gap-1.5 opacity-20">
                        <div v-for="n in 16" :key="'bl-'+n" class="w-1 h-1 bg-emerald-600 rounded-full"></div>
                    </div>

                    <!-- Inner Slot Container -->
                    <div class="relative z-10 lg:px-4">
                        <slot />
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
