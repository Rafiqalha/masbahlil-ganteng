<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SupplierMap from '@/Components/Maps/SupplierMap.vue';

const props = defineProps({
    procurement: Object,
});

const runMatching = () => {
    router.post(route('sppg.procurement.match', props.procurement.id), {}, {
        preserveScroll: true,
    });
};

const sendRequest = (supplierId) => {
    router.post(route('sppg.partnerships.store'), {
        procurement_request_id: props.procurement.id,
        supplier_id: supplierId,
    }, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Detail Pengadaan" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-4">
                    <Link :href="route('sppg.procurement.index')" class="text-gray-500 hover:text-gray-700">
                        &larr; Kembali
                    </Link>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Permintaan Pengadaan</h2>
                </div>
                <PrimaryButton v-if="procurement.status === 'OPEN'" @click="runMatching" class="bg-indigo-600 hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    Jalankan Matching SAW
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Informasi Pengadaan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ procurement.kategori_produk }}</h3>
                                <p class="text-sm text-gray-500">ID: {{ procurement.id }}</p>
                            </div>
                            <span :class="{
                                'bg-blue-100 text-blue-800': procurement.status === 'OPEN',
                                'bg-green-100 text-green-800': procurement.status === 'MATCHED',
                                'bg-gray-100 text-gray-800': procurement.status === 'CLOSED',
                            }" class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full">
                                {{ procurement.status }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-500">Kuantitas</p>
                                <p class="font-medium text-lg">{{ procurement.jumlah_kebutuhan }} {{ procurement.satuan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga Maksimal per Porsi</p>
                                <p class="font-medium text-lg">Rp {{ Number(procurement.harga_maksimal).toLocaleString('id-ID') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Radius Maksimal Supplier</p>
                                <p class="font-medium text-lg">{{ procurement.radius_km }} KM</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Mulai</p>
                                <p class="font-medium">{{ new Date(procurement.tanggal_mulai).toLocaleDateString('id-ID') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Selesai</p>
                                <p class="font-medium">{{ new Date(procurement.tanggal_selesai).toLocaleDateString('id-ID') }}</p>
                            </div>
                            <div class="col-span-1 md:col-span-3 mt-4 pt-4 border-t border-gray-100">
                                <p class="text-sm text-gray-500 mb-1">Deskripsi / Catatan Tambahan</p>
                                <p class="text-gray-700 whitespace-pre-wrap">{{ procurement.deskripsi_kebutuhan || '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hasil Matching -->
                <div v-if="procurement.matching_results && procurement.matching_results.length > 0" class="space-y-6">
                    
                    <!-- Peta Sebaran Supplier -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-bold mb-4">Peta Rekomendasi Supplier</h3>
                            <SupplierMap 
                                :sppgLat="Number(procurement.sppg.latitude)" 
                                :sppgLng="Number(procurement.sppg.longitude)" 
                                :radiusKm="Number(procurement.radius_km)"
                                :suppliers="procurement.matching_results"
                            />
                        </div>
                    </div>

                    <!-- Tabel Ranking -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold">Hasil Ranking Algoritma SAW</h3>
                                <span class="text-sm text-gray-500">{{ procurement.matching_results.length }} Supplier ditemukan</span>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jarak</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor SAW</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="result in procurement.matching_results" :key="result.id" :class="{'bg-yellow-50': result.ranking === 1}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center w-8 h-8 rounded-full font-bold" 
                                                    :class="result.ranking === 1 ? 'bg-yellow-400 text-yellow-900' : 'bg-gray-200 text-gray-700'">
                                                    {{ result.ranking }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-indigo-600">{{ result.supplier.nama_usaha }}</div>
                                                <div class="text-xs text-gray-500">{{ result.supplier.kategori_produk }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ Number(result.distance_km).toFixed(2) }} KM</div>
                                                <div class="text-xs text-gray-500">Skor: {{ Number(result.distance_score).toFixed(2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ result.supplier.kapasitas_harian }} {{ result.supplier.satuan_kapasitas }}</div>
                                                <div class="text-xs text-gray-500">Skor: {{ Number(result.capacity_score).toFixed(2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-lg font-bold text-gray-900">{{ (Number(result.total_score) * 100).toFixed(1) }}%</div>
                                                <div class="text-xs text-gray-500 text-[10px]">
                                                    Doc: {{ Number(result.document_score).toFixed(2) }} | Hist: {{ Number(result.history_score).toFixed(2) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button @click="sendRequest(result.supplier.id)" class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1 rounded text-xs">
                                                    Kirim Permintaan
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State jika belum di-match -->
                <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="p-8 text-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Rekomendasi</h3>
                            <p class="mt-1 text-sm text-gray-500 mb-4">Klik tombol "Jalankan Matching SAW" di pojok kanan atas untuk memindai supplier terdekat.</p>
                            <PrimaryButton @click="runMatching" class="bg-indigo-600 hover:bg-indigo-700">Mulai Pemindaian Sekarang</PrimaryButton>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
