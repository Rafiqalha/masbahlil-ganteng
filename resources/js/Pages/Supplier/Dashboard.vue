<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import KpiCard from '@/Components/Dashboard/KpiCard.vue';

defineProps({
    supplier: Object,
});
</script>

<template>
    <Head title="Supplier Overview" />

    <AuthenticatedLayout>
        <template #header>
            Supplier Overview
        </template>

        <div class="space-y-6 max-w-7xl mx-auto">
            <!-- Status Verification Alert -->
            <div v-if="supplier.status_verifikasi === 'PENDING'" class="bg-mbg-sky/30 border border-mbg-sky text-mbg-navy p-5 rounded-2xl flex items-start gap-4">
                <svg class="w-6 h-6 mt-0.5 text-mbg-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-semibold mb-1">Menunggu Verifikasi Admin</h3>
                    <p class="text-sm">Akun Anda sedang menunggu verifikasi dari Admin. Lengkapi profil dan dokumen Anda agar proses verifikasi lebih cepat.</p>
                    <Link :href="route('supplier.profile.edit')" class="inline-block mt-3 text-sm font-medium hover:underline text-mbg-navy underline">
                        Lengkapi Profil & Dokumen
                    </Link>
                </div>
            </div>

            <!-- Profile and Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Information -->
                <div class="lg:col-span-2 mbg-card overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-display font-bold text-gray-900">Profil Usaha</h3>
                        <Link :href="route('supplier.profile.edit')" class="text-mbg-navy hover:text-mbg-green text-xs font-semibold uppercase tracking-wider transition-colors">Edit Profil</Link>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-6">
                            <div class="flex flex-col border-b border-gray-50 pb-4">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Nama Usaha</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-semibold">{{ supplier.nama_usaha }}</dd>
                            </div>
                            <div class="flex flex-col border-b border-gray-50 pb-4">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Kategori Produk</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-semibold">{{ supplier.kategori_produk }}</dd>
                            </div>
                            <div class="flex flex-col border-b border-gray-50 pb-4 md:col-span-2">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Alamat</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-medium leading-relaxed">{{ supplier.alamat }}</dd>
                            </div>
                            <div class="flex flex-col pt-1">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display">Kapasitas Produksi Harian</dt>
                                <dd class="mt-1 text-[15px] text-gray-900 font-semibold text-mbg-navy">{{ supplier.kapasitas_produksi_harian || 'Belum diisi' }} Porsi</dd>
                            </div>
                            <div class="flex flex-col pt-1">
                                <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest font-display mb-1">Koordinat</dt>
                                <dd class="mt-1">
                                    <span class="text-xs text-gray-500 font-mono inline-block bg-gray-50 px-2 py-1 rounded">Lat: {{ supplier.latitude || '-' }}, Lng: {{ supplier.longitude || '-' }}</span>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="mbg-card overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-display font-bold text-gray-900">Dokumen Pendukung</h3>
                        <Link :href="route('supplier.profile.edit')" class="text-mbg-navy hover:text-mbg-green text-xs font-semibold uppercase tracking-wider transition-colors">Kelola</Link>
                    </div>
                    
                    <div class="flex-1 p-0 overflow-y-auto max-h-80">
                        <ul v-if="supplier.documents && supplier.documents.length > 0" class="divide-y divide-gray-100">
                            <li v-for="doc in supplier.documents" :key="doc.id" class="p-6 hover:bg-gray-50 transition-colors flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-[14px] text-gray-900">{{ doc.nama_dokumen }}</p>
                                    <span class="inline-flex mt-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-md uppercase tracking-wider"
                                        :class="{
                                            'bg-yellow-100 text-yellow-800': doc.status_verifikasi === 'PENDING',
                                            'bg-mbg-light-green text-mbg-green-hover': doc.status_verifikasi === 'VALID',
                                            'bg-red-100 text-red-800': doc.status_verifikasi === 'INVALID'
                                        }">
                                        {{ doc.status_verifikasi }}
                                    </span>
                                </div>
                                <a :href="'/storage/' + doc.file_path" target="_blank" class="text-mbg-navy hover:text-mbg-green p-2 bg-mbg-sky/30 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </li>
                        </ul>
                        <div v-else class="h-full flex items-center justify-center p-8 text-center text-sm text-gray-500">
                            Belum ada dokumen yang diunggah.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
