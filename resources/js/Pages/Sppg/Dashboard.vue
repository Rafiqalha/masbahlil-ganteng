<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import KpiCard from '@/Components/Dashboard/KpiCard.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    sppg: Object,
    procurements: Array,
});
</script>

<template>
    <Head title="SPPG Overview" />

    <AuthenticatedLayout>
        <template #header>
            SPPG Overview
        </template>

        <div class="space-y-6 max-w-7xl mx-auto">
            <!-- Status Verification Alert -->
            <div v-if="sppg.status_verifikasi === 'PENDING'" class="bg-mbg-sky/30 border border-mbg-sky text-mbg-navy p-5 rounded-2xl flex items-start gap-4">
                <svg class="w-6 h-6 mt-0.5 text-mbg-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-semibold mb-1">Menunggu Verifikasi Admin</h3>
                    <p class="text-sm">Akun SPPG Anda sedang dalam proses peninjauan. Mohon pastikan profil Anda lengkap agar proses verifikasi lebih cepat.</p>
                    <Link :href="route('sppg.profile.edit')" class="inline-block mt-3 text-sm font-medium hover:underline text-mbg-navy underline">
                        Lengkapi Profil SPPG
                    </Link>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Information -->
                <div class="mbg-card overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-display font-bold text-gray-900">Profil Satuan Pelayanan</h3>
                        <Link :href="route('sppg.profile.edit')" class="text-mbg-navy hover:text-mbg-green text-xs font-semibold uppercase tracking-wider transition-colors">Edit Profil</Link>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div class="flex flex-col border-b border-gray-50 pb-4">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Nama SPPG</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-semibold">{{ sppg.nama_sppg }}</dd>
                            </div>
                            <div class="flex flex-col border-b border-gray-50 pb-4">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Penanggung Jawab</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-semibold">{{ sppg.penanggung_jawab || '-' }}</dd>
                            </div>
                            <div class="flex flex-col border-b border-gray-50 pb-4">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Alamat & Koordinat</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-medium leading-relaxed">
                                    {{ sppg.alamat || '-' }} <br>
                                    <span class="text-xs text-gray-500 font-mono mt-1 inline-block bg-gray-50 px-2 py-1 rounded">Lat: {{ sppg.latitude || '-' }}, Lng: {{ sppg.longitude || '-' }}</span>
                                </dd>
                            </div>
                            <div class="flex flex-col pt-1">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display mb-2">Status Verifikasi</dt>
                                <dd class="mt-1">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full"
                                        :class="{
                                            'bg-yellow-100 text-yellow-800': sppg.status_verifikasi === 'PENDING',
                                            'bg-mbg-light-green text-mbg-green-hover': sppg.status_verifikasi === 'APPROVED',
                                            'bg-red-100 text-red-800': sppg.status_verifikasi === 'REJECTED'
                                        }">
                                        {{ sppg.status_verifikasi }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Recent Procurements -->
                <div class="mbg-card overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-display font-bold text-gray-900">Pengadaan Terbaru</h3>
                        <Link :href="route('sppg.procurement.index')" class="text-mbg-navy hover:text-mbg-green text-xs font-semibold uppercase tracking-wider transition-colors">Lihat Semua</Link>
                    </div>
                    
                    <div class="flex-1 p-0">
                        <table class="min-w-full divide-y divide-gray-100" v-if="procurements && procurements.length > 0">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="proc in procurements" :key="proc.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <p class="text-[15px] font-semibold text-gray-900">{{ proc.kategori_produk }}</p>
                                        <p class="text-[13px] text-gray-500 mt-1 font-medium">
                                            {{ proc.jumlah_kebutuhan }} Porsi &middot; {{ new Date(proc.tanggal_mulai).toLocaleDateString() }} - {{ new Date(proc.tanggal_selesai).toLocaleDateString() }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-md"
                                            :class="{
                                                'bg-mbg-sky text-mbg-navy': proc.status === 'OPEN',
                                                'bg-mbg-light-green text-mbg-green-hover': proc.status === 'FULFILLED',
                                                'bg-gray-100 text-gray-600': proc.status === 'CLOSED'
                                            }">
                                            {{ proc.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="h-full flex items-center justify-center p-8 text-center text-sm text-gray-500">
                            Belum ada pengadaan.
                        </div>
                    </div>
                    <div class="p-5 border-t border-gray-100 bg-gray-50/50">
                        <Link :href="route('sppg.procurement.create')">
                            <PrimaryButton class="w-full justify-center">Buat Pengadaan Baru</PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
