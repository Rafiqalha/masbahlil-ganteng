<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    partnerships: Array,
});
</script>

<template>
    <Head title="Kerja Sama (SPPG)" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Permintaan Kerja Sama Anda</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div v-if="partnerships.length === 0" class="text-center py-8 text-gray-500">
                            Belum ada permintaan kerja sama yang Anda kirim. 
                            <br>
                            Silakan jalankan algoritma SAW pada Kebutuhan Pengadaan Anda.
                        </div>

                        <div v-else class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kebutuhan (ID)</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Respon</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="p in partnerships" :key="p.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ new Date(p.created_at).toLocaleDateString('id-ID') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ p.procurement_request.kategori_produk }}</div>
                                            <div class="text-xs text-gray-500">Vol: {{ p.procurement_request.jumlah_kebutuhan }} {{ p.procurement_request.satuan }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-indigo-600">{{ p.supplier.nama_usaha }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="{
                                                'bg-yellow-100 text-yellow-800': p.status === 'PENDING',
                                                'bg-green-100 text-green-800': p.status === 'ACTIVE' || p.status === 'COMPLETED',
                                                'bg-red-100 text-red-800': p.status === 'REJECTED' || p.status === 'EXPIRED',
                                            }" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                                {{ p.status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span v-if="p.responded_at">{{ new Date(p.responded_at).toLocaleDateString('id-ID') }}</span>
                                            <span v-else>-</span>
                                            <div v-if="p.status === 'REJECTED' && p.catatan_penolakan" class="text-xs text-red-500 mt-1">
                                                "{{ p.catatan_penolakan }}"
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
