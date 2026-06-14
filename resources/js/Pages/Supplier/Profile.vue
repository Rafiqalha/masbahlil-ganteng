<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LocationPicker from '@/Components/Maps/LocationPicker.vue';

const props = defineProps({
    supplier: Object,
});

const profileForm = useForm({
    nama_usaha: props.supplier.nama_usaha || '',
    kategori_produk: props.supplier.kategori_produk === '-' ? '' : (props.supplier.kategori_produk || ''),
    alamat: props.supplier.alamat === '-' ? '' : (props.supplier.alamat || ''),
    kapasitas_produksi_harian: props.supplier.kapasitas_produksi_harian || '',
    latitude: props.supplier.latitude || '',
    longitude: props.supplier.longitude || '',
});

const documentForm = useForm({
    nama_dokumen: '',
    file_path: null,
});

const updateProfile = () => {
    profileForm.put(route('supplier.profile.update'), {
        preserveScroll: true,
    });
};

const uploadDocument = () => {
    documentForm.post(route('supplier.documents.store'), {
        preserveScroll: true,
        onSuccess: () => documentForm.reset(),
    });
};

const deleteDocument = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
        useForm({}).delete(route('supplier.documents.destroy', id), {
            preserveScroll: true,
        });
    }
};

const onLocationSelected = (location) => {
    profileForm.latitude = location.lat;
    profileForm.longitude = location.lng;
};
</script>

<template>
    <Head title="Profil Supplier" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Profil & Dokumen</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <!-- Notifikasi -->
                <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                </div>

                <!-- Form Profil -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Informasi Usaha</h2>
                            <p class="mt-1 text-sm text-gray-600">Perbarui informasi dasar dan lokasi usaha Anda.</p>
                        </header>

                        <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="nama_usaha" value="Nama Usaha" />
                                <TextInput
                                    id="nama_usaha"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="profileForm.nama_usaha"
                                    required
                                />
                                <InputError class="mt-2" :message="profileForm.errors.nama_usaha" />
                            </div>

                            <div>
                                <InputLabel for="kategori_produk" value="Kategori Produk" />
                                <select
                                    id="kategori_produk"
                                    v-model="profileForm.kategori_produk"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled>Pilih Kategori</option>
                                    <option value="Makanan Pokok">Makanan Pokok</option>
                                    <option value="Lauk Pauk">Lauk Pauk</option>
                                    <option value="Sayuran">Sayuran</option>
                                    <option value="Buah-buahan">Buah-buahan</option>
                                    <option value="Susu/Minuman Sehat">Susu/Minuman Sehat</option>
                                </select>
                                <InputError class="mt-2" :message="profileForm.errors.kategori_produk" />
                            </div>

                            <div>
                                <InputLabel for="alamat" value="Alamat Lengkap" />
                                <TextInput
                                    id="alamat"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="profileForm.alamat"
                                    required
                                />
                                <InputError class="mt-2" :message="profileForm.errors.alamat" />
                            </div>

                            <div>
                                <InputLabel for="kapasitas_produksi_harian" value="Kapasitas Produksi Harian (Porsi)" />
                                <TextInput
                                    id="kapasitas_produksi_harian"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="profileForm.kapasitas_produksi_harian"
                                />
                                <InputError class="mt-2" :message="profileForm.errors.kapasitas_produksi_harian" />
                            </div>

                            <!-- Map Component -->
                            <div>
                                <InputLabel value="Titik Lokasi (Peta)" />
                                <div class="mt-2">
                                    <LocationPicker 
                                        :modelValue="{ lat: profileForm.latitude, lng: profileForm.longitude }"
                                        @update:modelValue="onLocationSelected"
                                    />
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    Lat: {{ profileForm.latitude || '-' }}, Lng: {{ profileForm.longitude || '-' }}
                                </div>
                                <InputError class="mt-2" :message="profileForm.errors.latitude" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="profileForm.processing">Simpan Profil</PrimaryButton>
                                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                    <p v-if="profileForm.recentlySuccessful" class="text-sm text-gray-600">Berhasil disimpan.</p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Kelola Dokumen -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Upload Dokumen</h2>
                            <p class="mt-1 text-sm text-gray-600">Unggah KTP, NIB, Sertifikat Halal, atau dokumen lain yang diperlukan.</p>
                        </header>

                        <form @submit.prevent="uploadDocument" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="nama_dokumen" value="Nama Dokumen" />
                                <TextInput
                                    id="nama_dokumen"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="documentForm.nama_dokumen"
                                    placeholder="Contoh: KTP, NIB, Sertifikat Halal"
                                    required
                                />
                                <InputError class="mt-2" :message="documentForm.errors.nama_dokumen" />
                            </div>

                            <div>
                                <InputLabel for="file_path" value="File (PDF, JPG, PNG)" />
                                <input
                                    id="file_path"
                                    type="file"
                                    @input="documentForm.file_path = $event.target.files[0]"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    required
                                />
                                <InputError class="mt-2" :message="documentForm.errors.file_path" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="documentForm.processing">Unggah Dokumen</PrimaryButton>
                            </div>
                        </form>
                        
                        <div class="mt-8">
                            <h3 class="text-md font-medium text-gray-900 mb-4">Dokumen Tersimpan</h3>
                            <ul v-if="supplier.documents && supplier.documents.length > 0" class="divide-y divide-gray-200 border-t border-gray-200">
                                <li v-for="doc in supplier.documents" :key="doc.id" class="py-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">{{ doc.nama_dokumen }}</span>
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ doc.status_verifikasi }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <a :href="'/storage/' + doc.file_path" target="_blank" class="text-sm text-blue-600 hover:text-blue-900">Lihat</a>
                                        <button @click="deleteDocument(doc.id)" type="button" class="text-sm text-red-600 hover:text-red-900">Hapus</button>
                                    </div>
                                </li>
                            </ul>
                            <p v-else class="text-sm text-gray-500 italic">Belum ada dokumen.</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
