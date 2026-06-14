<script setup>
import { ref, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import SidebarLink from '@/Components/SidebarLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const userMenuOpen = ref(false);
const page = usePage();

// Ensure role check is robust by checking the user table's role column or Spatie roles
const userRole = computed(() => page.props.auth.user?.role?.toLowerCase() || '');
const userRoles = computed(() => page.props.auth.user?.roles?.map(r => r.name.toLowerCase()) || []);

const isAdmin = computed(() => userRole.value === 'admin' || userRoles.value.includes('admin'));
const isSppg = computed(() => userRole.value === 'sppg' || userRoles.value.includes('sppg'));
const isSupplier = computed(() => userRole.value === 'supplier' || userRoles.value.includes('supplier'));

const notifications = computed(() => page.props.auth.notifications || []);
</script>

<template>
    <div class="flex h-screen bg-[#F8FAFC] bg-[url('/logos/background-dashboard.png')] bg-cover bg-center bg-fixed font-sans selection:bg-mbg-green/30">
        <!-- Sidebar Desktop -->
        <aside class="hidden md:flex flex-col w-64 bg-[#0F172A] bg-[url('/logos/background-sidebar.png')] bg-cover bg-bottom bg-no-repeat border-r border-[#1E293B] transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-20 relative">
            <div class="h-24 flex items-center justify-center px-4 border-b border-[#1E293B] bg-[#0F172A] overflow-hidden">
                <Link :href="route('dashboard')" class="flex items-center justify-center group w-full py-2">
                    <ApplicationLogo class="w-4/5 md:w-[200px] h-auto object-contain transition-transform group-hover:scale-105" />
                </Link>
            </div>
            
            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 scrollbar-thin scrollbar-thumb-gray-700">
                <!-- Admin Links -->
                <template v-if="isAdmin">
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-2 font-display">Platform Overview</div>
                    <SidebarLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Admin Dashboard</span>
                    </SidebarLink>
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8 font-display">Operations</div>
                    <SidebarLink :href="route('admin.verification.index')" :active="route().current('admin.verification.*')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Verifikasi Data</span>
                    </SidebarLink>
                </template>

                <!-- SPPG Links -->
                <template v-if="isSppg">
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-2 font-display">DASHBOARD</div>
                    <SidebarLink :href="route('sppg.dashboard')" :active="route().current('sppg.dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">SPPG Overview</span>
                    </SidebarLink>
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8 font-display">OPERATIONS</div>
                    <SidebarLink :href="route('sppg.procurement.index')" :active="route().current('sppg.procurement.*')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Pengadaan Kebutuhan</span>
                    </SidebarLink>
                    <SidebarLink :href="route('sppg.partnerships.index')" :active="route().current('sppg.partnerships.*')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Kemitraan Jaringan</span>
                    </SidebarLink>
                </template>

                <!-- Supplier Links -->
                <template v-if="isSupplier">
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-2 font-display">DASHBOARD</div>
                    <SidebarLink :href="route('supplier.dashboard')" :active="route().current('supplier.dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Performa Supply</span>
                    </SidebarLink>
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8 font-display">OPERATIONS</div>
                    <SidebarLink :href="route('supplier.partnerships.index')" :active="route().current('supplier.partnerships.*')">
                        <template #icon>
                            <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                        </template>
                        <span class="font-medium text-[13px]">Kotak Masuk</span>
                    </SidebarLink>
                </template>
                
                <!-- Tautan Eksternal -->
                <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8 font-display">EKSTERNAL</div>
                <SidebarLink href="/">
                    <template #icon>
                        <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </template>
                    <span class="font-medium text-[13px]">Website Utama</span>
                </SidebarLink>

            </nav>
            
            <!-- User Profile (Bottom) -->
            <div class="p-4 border-t border-[#1E293B] bg-[#0F172A] relative">
                <!-- Full Screen Dropdown Overlay -->
                <div v-if="userMenuOpen" class="fixed inset-0 z-40" @click="userMenuOpen = false"></div>
                
                <button @click="userMenuOpen = !userMenuOpen" class="relative z-40 w-full flex items-center justify-between px-2 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-[#1E293B] hover:text-white transition-all border border-transparent">
                    <div class="flex items-center gap-3 truncate">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-mbg-green to-emerald-700 text-white flex items-center justify-center font-bold shadow-sm shrink-0">
                            {{ $page.props.auth.user.name.charAt(0) }}
                        </div>
                        <div class="text-left truncate">
                            <div class="font-semibold text-gray-100 leading-tight truncate">{{ $page.props.auth.user.name }}</div>
                            <div class="text-[11px] text-gray-400 mt-0.5 capitalize tracking-wide">{{ userRole || userRoles.join(', ') }}</div>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-500 shrink-0 ml-1 transition-transform" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                </button>

                <!-- Premium Floating Dropdown -->
                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="transform opacity-0 scale-95 translate-y-2"
                    enter-to-class="transform opacity-100 scale-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="transform opacity-100 scale-100 translate-y-0"
                    leave-to-class="transform opacity-0 scale-95 translate-y-2"
                >
                    <div v-show="userMenuOpen" class="absolute bottom-full left-4 right-4 mb-3 bg-[#1E293B] border border-[#334155] rounded-xl shadow-2xl overflow-hidden z-50 ring-1 ring-black/50">
                        <div class="px-4 py-3 border-b border-[#334155] bg-[#0F172A]/50">
                            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest mb-0.5 font-display">Masuk sebagai</p>
                            <p class="text-[13px] font-medium text-white truncate">{{ $page.props.auth.user.email }}</p>
                        </div>
                        <div class="py-1.5 px-1.5">
                            <Link :href="route('profile.edit')" class="flex items-center gap-2.5 px-3 py-2 text-[13px] font-medium text-gray-300 rounded-lg hover:bg-white/5 hover:text-white transition-colors group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Pengaturan Akun
                            </Link>
                            <Link :href="route('logout')" method="post" as="button" class="w-full flex items-center gap-2.5 px-3 py-2 text-[13px] font-medium text-red-400 rounded-lg hover:bg-red-500/10 hover:text-red-300 transition-colors group">
                                <svg class="w-4 h-4 text-red-400 group-hover:text-red-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar Aplikasi
                            </Link>
                        </div>
                    </div>
                </transition>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-10 sticky top-0">
                
                <!-- Left Header / Breadcrumb -->
                <div class="flex items-center gap-4">
                    <button @click="showingNavigationDropdown = true" class="md:hidden p-2 -ml-2 rounded-md text-gray-500 hover:bg-gray-100 focus:ring-2 focus:ring-mbg-green">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <div class="hidden sm:flex items-center text-sm font-medium">
                        <span class="text-gray-400">MBGBrain</span>
                        <svg class="w-4 h-4 text-gray-300 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <h2 class="text-gray-900 truncate font-display font-semibold text-base" v-if="$slots.header">
                            <slot name="header" />
                        </h2>
                    </div>
                </div>
                
                <!-- Right Header -->
                <div class="flex items-center space-x-3">
                    <!-- Notifications -->
                    <div class="relative">
                        <Dropdown align="right" width="80">
                            <template #trigger>
                                <button type="button" class="relative p-2 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none transition-colors border border-transparent hover:border-gray-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <span v-if="notifications.length > 0" class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                                </button>
                            </template>
                            <template #content>
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                    <p class="text-xs font-bold text-gray-800 uppercase tracking-wider">Notifikasi</p>
                                </div>
                                <div class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-200">
                                    <div v-if="notifications.length > 0">
                                        <Link v-for="notif in notifications.slice(0, 10)" :key="notif.id" :href="notif.data.url" class="block px-4 py-3 hover:bg-mbg-fresh-mint border-b border-gray-50 transition-colors">
                                            <p class="text-sm font-semibold text-gray-900">{{ notif.data.title }}</p>
                                            <p class="text-xs text-gray-500 mt-1 leading-relaxed line-clamp-2">{{ notif.data.message }}</p>
                                        </Link>
                                    </div>
                                    <div v-else class="px-4 py-8 flex flex-col items-center justify-center text-center">
                                        <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">All caught up</p>
                                        <p class="text-xs text-gray-500 mt-1">Tidak ada notifikasi baru.</p>
                                    </div>
                                </div>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="sm:hidden mb-6 flex items-center">
                    <h2 class="text-xl font-bold text-gray-900" v-if="$slots.header">
                        <slot name="header" />
                    </h2>
                </div>
                
                <!-- Flash Messages with Enterprise Styling -->
                <div v-if="$page.props.flash.success" class="mb-6 bg-mbg-fresh-mint border border-mbg-green/30 text-mbg-green-hover px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm ring-1 ring-mbg-green/5">
                    <svg class="w-5 h-5 text-mbg-green shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h4 class="text-sm font-bold text-mbg-green">Success</h4>
                        <p class="text-sm mt-0.5">{{ $page.props.flash.success }}</p>
                    </div>
                </div>
                <div v-if="$page.props.flash.error" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm ring-1 ring-red-500/5">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h4 class="text-sm font-bold text-red-800">Error</h4>
                        <p class="text-sm mt-0.5">{{ $page.props.flash.error }}</p>
                    </div>
                </div>

                <!-- Page Content Slot -->
                <div class="animate-fade-in-up">
                    <slot />
                </div>
            </main>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div v-if="showingNavigationDropdown" class="fixed inset-0 z-40 md:hidden">
            <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="showingNavigationDropdown = false"></div>
            <div class="fixed inset-y-0 left-0 flex flex-col w-[280px] bg-[#0F172A] bg-[url('/logos/background-sidebar.png')] bg-cover bg-bottom bg-no-repeat shadow-2xl z-50 transform transition-transform">
                <!-- Mobile Logo -->
                <div class="h-24 flex items-center justify-between px-6 border-b border-[#1E293B] bg-[#0F172A]">
                    <div class="flex items-center justify-center w-full max-w-[180px]">
                        <ApplicationLogo class="w-full h-auto object-contain object-left" />
                    </div>
                    <button @click="showingNavigationDropdown = false" class="text-gray-400 hover:text-white bg-white/5 rounded-full p-1 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Mobile Navigation -->
                <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                    <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </SidebarLink>
                    <template v-if="isAdmin">
                        <SidebarLink :href="route('admin.verification.index')" :active="route().current('admin.verification.*')">
                            Verifikasi Data
                        </SidebarLink>
                    </template>
                    <template v-if="isSppg">
                        <SidebarLink :href="route('sppg.procurement.index')" :active="route().current('sppg.procurement.*')">
                            Pengadaan Kebutuhan
                        </SidebarLink>
                        <SidebarLink :href="route('sppg.partnerships.index')" :active="route().current('sppg.partnerships.*')">
                            Kemitraan Jaringan
                        </SidebarLink>
                    </template>
                    <template v-if="isSupplier">
                        <SidebarLink :href="route('supplier.partnerships.index')" :active="route().current('supplier.partnerships.*')">
                            Kotak Masuk Kemitraan
                        </SidebarLink>
                    </template>
                    
                    <!-- Tautan Eksternal -->
                    <div class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 mt-8 font-display">EKSTERNAL</div>
                    <SidebarLink href="/">
                        Website Utama
                    </SidebarLink>
                </nav>
            </div>
        </div>
    </div>
</template>

<style>
.animate-fade-in-up {
    animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
