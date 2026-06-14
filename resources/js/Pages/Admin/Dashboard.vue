<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import KpiCard from '@/Components/Dashboard/KpiCard.vue';

defineProps({
    stats: Object,
    recent_verifications: Object,
});
</script>

<template>
    <Head title="Overview" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center text-sm">
                <span class="text-gray-400 font-medium mr-2">MBGBrain</span>
                <span class="text-gray-300 mr-2">&gt;</span>
                <span class="font-bold text-gray-900">National Overview</span>
            </div>
        </template>

        <div class="space-y-6 max-w-7xl mx-auto">
            
            <!-- Enterprise KPI Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <KpiCard 
                    title="Total Supplier" 
                    :value="stats.total_suppliers"
                    iconBgClass="bg-[#E3F2FD] text-[#2196F3]"
                >
                    <template #icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </template>
                    <template #bg-graphic>
                        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 60C20 60 30 40 50 40C70 40 80 60 100 60V100H0V60Z" fill="#E3F2FD" opacity="0.5"/></svg>
                    </template>
                </KpiCard>
                
                <KpiCard 
                    title="Total SPPG" 
                    :value="stats.total_sppgs"
                    iconBgClass="bg-[#E8F5E9] text-[#4CAF50]"
                >
                    <template #icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </template>
                    <template #bg-graphic>
                        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 60C20 60 30 40 50 40C70 40 80 60 100 60V100H0V60Z" fill="#E8F5E9" opacity="0.5"/></svg>
                    </template>
                </KpiCard>
                
                <KpiCard 
                    title="Active Procurements" 
                    :value="stats.total_procurements"
                    iconBgClass="bg-[#EDE7F6] text-[#7E57C2]"
                >
                    <template #icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </template>
                    <template #bg-graphic>
                        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 60C20 60 30 40 50 40C70 40 80 60 100 60V100H0V60Z" fill="#EDE7F6" opacity="0.5"/></svg>
                    </template>
                </KpiCard>
                
                <KpiCard 
                    title="Pending Verification" 
                    :value="stats.pending_verifications"
                    :trendValue="stats.pending_verifications > 0 ? 'Requires Action' : 'All Clear'"
                    :trendDirection="stats.pending_verifications > 0 ? 'down' : 'up'"
                    iconBgClass="bg-[#FFF3E0] text-[#FF9800]"
                >
                    <template #icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </template>
                    <template #bg-graphic>
                        <svg width="100" height="60" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 60C20 60 30 40 50 40C70 40 80 60 100 60V100H0V60Z" fill="#FFF3E0" opacity="0.5"/></svg>
                    </template>
                </KpiCard>
            </div>

            <!-- Verification Data Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-4">
                <!-- Recent Supplier Verifications -->
                <div class="mbg-card overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-[13px] font-display font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-[#E3F2FD] text-[#2196F3] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </span>
                            Verifikasi Supplier Terbaru
                        </h3>
                        <Link :href="route('admin.verification.index')" class="text-[#2196F3] hover:text-[#1976D2] text-[10px] font-bold uppercase tracking-wider transition-colors">Lihat Semua &rarr;</Link>
                    </div>
                    <div class="p-0">
                        <table class="min-w-full divide-y divide-gray-100" v-if="recent_verifications.suppliers.length > 0">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="supplier in recent_verifications.suppliers" :key="supplier.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <p class="text-[15px] font-semibold text-gray-900">{{ supplier.nama_perusahaan }}</p>
                                        <p class="text-[13px] text-gray-500 mt-1 font-medium">{{ supplier.jenis_usaha }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <Link :href="route('admin.verification.show', { type: 'supplier', id: supplier.id })" class="inline-flex items-center justify-center px-4 py-2 bg-mbg-bg-secondary hover:bg-mbg-green/10 text-mbg-navy hover:text-mbg-green-hover text-sm font-semibold rounded-lg transition-colors">Review &rarr;</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="p-8 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-[#E3F2FD] rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-[#2196F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                </div>
                                Tidak ada supplier yang menunggu verifikasi.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent SPPG Verifications -->
                <div class="mbg-card overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-[13px] font-display font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-[#E8F5E9] text-[#4CAF50] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </span>
                            Verifikasi SPPG Terbaru
                        </h3>
                        <Link :href="route('admin.verification.index')" class="text-[#2196F3] hover:text-[#1976D2] text-[10px] font-bold uppercase tracking-wider transition-colors">Lihat Semua &rarr;</Link>
                    </div>
                    <div class="p-0">
                        <table class="min-w-full divide-y divide-gray-100" v-if="recent_verifications.sppgs.length > 0">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="sppg in recent_verifications.sppgs" :key="sppg.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <p class="text-[15px] font-semibold text-gray-900">{{ sppg.nama_sppg }}</p>
                                        <p class="text-[13px] text-gray-500 mt-1 font-medium">PJ: {{ sppg.penanggung_jawab || '-' }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <Link :href="route('admin.verification.show', { type: 'sppg', id: sppg.id })" class="inline-flex items-center justify-center px-4 py-2 bg-mbg-bg-secondary hover:bg-mbg-green/10 text-mbg-navy hover:text-mbg-green-hover text-sm font-semibold rounded-lg transition-colors">Review &rarr;</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="p-8 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-[#E8F5E9] rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-[#4CAF50]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                </div>
                                Tidak ada SPPG yang menunggu verifikasi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>
