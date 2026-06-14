<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    partnerships: Array,
});

const rejectReason = ref('');
const showRejectModal = ref(false);
const selectedPartnershipId = ref(null);

const acceptRequest = (id) => {
    if(confirm('Apakah Anda yakin ingin menerima kerja sama ini?')) {
        router.put(route('supplier.partnerships.update', id), {
            status: 'ACTIVE',
        });
    }
};

const openRejectModal = (id) => {
    selectedPartnershipId.value = id;
    rejectReason.value = '';
    showRejectModal.value = true;
};

const closeRejectModal = () => {
    showRejectModal.value = false;
    selectedPartnershipId.value = null;
    rejectReason.value = '';
};

const submitReject = () => {
    if(!rejectReason.value.trim()) {
        alert('Alasan penolakan harus diisi!');
        return;
    }
    router.put(route('supplier.partnerships.update', selectedPartnershipId.value), {
        status: 'REJECTED',
        catatan_penolakan: rejectReason.value,
    }, {
        onSuccess: () => closeRejectModal()
    });
};
</script>

<template>
    <Head title="Kerja Sama (Supplier)" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kotak Masuk Permintaan Kerja Sama</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div v-if="partnerships.length === 0" class="text-center py-8 text-gray-500">
                            Belum ada permintaan kerja sama dari SPPG.
                        </div>

                        <div v-else class="space-y-6">
                            <div v-for="p in partnerships" :key="p.id" class="border rounded-lg p-5 shadow-sm" :class="{'bg-indigo-50 border-indigo-200': p.status === 'PENDING'}">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-lg font-bold text-gray-900">{{ p.procurement_request.sppg.nama_sppg }}</h3>
                                            <span :class="{
                                                'bg-yellow-100 text-yellow-800': p.status === 'PENDING',
                                                'bg-green-100 text-green-800': p.status === 'ACTIVE' || p.status === 'COMPLETED',
                                                'bg-red-100 text-red-800': p.status === 'REJECTED' || p.status === 'EXPIRED',
                                            }" class="px-2 py-0.5 text-xs font-semibold rounded-full">
                                                {{ p.status }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">Membutuhkan: <span class="font-semibold">{{ p.procurement_request.kategori_produk }}</span> sebanyak {{ p.procurement_request.jumlah_kebutuhan }} {{ p.procurement_request.satuan }} / hari</p>
                                        <p class="text-sm text-gray-500">Diterima pada: {{ new Date(p.created_at).toLocaleString('id-ID') }}</p>
                                        
                                        <div v-if="p.status === 'REJECTED'" class="mt-2 text-sm text-red-600 bg-red-50 p-2 rounded">
                                            Alasan ditolak: {{ p.catatan_penolakan }}
                                        </div>
                                    </div>

                                    <div v-if="p.status === 'PENDING'" class="mt-4 md:mt-0 flex gap-2">
                                        <button @click="acceptRequest(p.id)" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold shadow-sm">
                                            Terima
                                        </button>
                                        <button @click="openRejectModal(p.id)" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold shadow-sm">
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tolak -->
        <div v-if="showRejectModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="closeRejectModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tolak Permintaan Kerja Sama</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-4">Mohon berikan alasan mengapa Anda menolak permintaan kerja sama ini.</p>
                            <textarea v-model="rejectReason" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Kapasitas penuh, di luar jangkauan, dll..."></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="submitReject" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Kirim Penolakan
                        </button>
                        <button @click="closeRejectModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
