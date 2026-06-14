<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    type: String, // 'supplier' or 'sppg'
    entity: Object,
});

const form = useForm({
    status_verifikasi: 'APPROVED',
    catatan_verifikasi: '',
});

const submitVerification = () => {
    form.post(route('admin.verification.update', { type: props.type, id: props.entity.id }));
};
</script>

<template>
    <Head :title="`Detail Verifikasi - ${type === 'supplier' ? 'Supplier' : 'SPPG'}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.verification.index')" class="text-gray-500 hover:text-gray-700">
                    &larr; Kembali
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tinjau Berkas {{ type === 'supplier' ? 'Supplier' : 'SPPG' }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- Detail Entitas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Informasi Profil</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                            <!-- Field Khusus Supplier -->
                            <template v-if="type === 'supplier'">
                                <div>
                                    <p class="text-sm text-gray-500">Nama Perusahaan / Usaha</p>
                                    <p class="font-medium text-lg">{{ entity.nama_perusahaan }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Bentuk Badan Usaha</p>
                                    <p class="font-medium">{{ entity.bentuk_badan_usaha }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Jenis Usaha</p>
                                    <p class="font-medium">{{ entity.jenis_usaha }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kapasitas Produksi Harian</p>
                                    <p class="font-medium">{{ entity.kapasitas_produksi_harian ? entity.kapasitas_produksi_harian + ' Porsi' : '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nama PIC</p>
                                    <p class="font-medium">{{ entity.nama_pic }}</p>
                                </div>
                            </template>

                            <!-- Field Khusus SPPG -->
                            <template v-if="type === 'sppg'">
                                <div>
                                    <p class="text-sm text-gray-500">Nama SPPG</p>
                                    <p class="font-medium text-lg">{{ entity.nama_sppg }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Penanggung Jawab</p>
                                    <p class="font-medium">{{ entity.penanggung_jawab || '-' }}</p>
                                </div>
                            </template>

                            <!-- Field Umum (Keduanya punya ini) -->
                            <div>
                                <p class="text-sm text-gray-500">Alamat Lengkap</p>
                                <p class="font-medium">{{ entity.alamat || '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nomor Telepon</p>
                                <p class="font-medium">{{ entity.nomor_telepon || '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Titik Koordinat</p>
                                <p class="font-medium">
                                    {{ entity.latitude ? `${entity.latitude}, ${entity.longitude}` : 'Belum diatur' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendukung (Hanya untuk Supplier) -->
                <div v-if="type === 'supplier'" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Dokumen Pendukung</h3>
                        
                        <div v-if="entity.documents && entity.documents.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div v-for="doc in entity.documents" :key="doc.id" class="border rounded-lg p-4 flex justify-between items-center bg-gray-50">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ doc.nama_dokumen }}</p>
                                        <p class="text-xs text-gray-500">{{ doc.jenis_dokumen }}</p>
                                    </div>
                                </div>
                                <a :href="'/storage/' + doc.file_path" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Buka File</a>
                            </div>
                        </div>
                        <div v-else class="text-sm text-gray-500 italic p-4 bg-yellow-50 rounded text-yellow-800">
                            Supplier ini belum mengunggah dokumen apapun.
                        </div>
                    </div>
                </div>

                <!-- Form Keputusan Verifikasi -->
                <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg border-2 border-indigo-100">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">Keputusan Verifikasi</h3>
                        
                        <form @submit.prevent="submitVerification" class="space-y-6">
                            <div>
                                <InputLabel value="Status Keputusan" />
                                <div class="mt-2 flex items-center space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.status_verifikasi" value="APPROVED" class="text-green-600 focus:ring-green-500" required>
                                        <span class="ml-2 text-gray-700 font-medium">Terima & Verifikasi (APPROVED)</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.status_verifikasi" value="REJECTED" class="text-red-600 focus:ring-red-500" required>
                                        <span class="ml-2 text-gray-700 font-medium">Tolak (REJECTED)</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <InputLabel for="catatan_verifikasi" value="Catatan / Alasan (Opsional, penting jika ditolak)" />
                                <textarea
                                    id="catatan_verifikasi"
                                    v-model="form.catatan_verifikasi"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3"
                                    placeholder="Contoh: Dokumen KTP buram, mohon unggah ulang."
                                ></textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing" :class="{ 'bg-green-600 hover:bg-green-700 focus:bg-green-700': form.status_verifikasi === 'APPROVED', 'bg-red-600 hover:bg-red-700 focus:bg-red-700': form.status_verifikasi === 'REJECTED' }">
                                    Simpan Keputusan
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
