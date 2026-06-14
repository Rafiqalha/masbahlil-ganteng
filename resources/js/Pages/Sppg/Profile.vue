<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LocationPicker from '@/Components/Maps/LocationPicker.vue';

const props = defineProps({
    sppg: Object,
});

const form = useForm({
    nama_sppg: props.sppg.nama_sppg || '',
    penanggung_jawab: props.sppg.penanggung_jawab === '-' ? '' : (props.sppg.penanggung_jawab || ''),
    nomor_telepon: props.sppg.nomor_telepon === '-' ? '' : (props.sppg.nomor_telepon || ''),
    alamat: props.sppg.alamat === '-' ? '' : (props.sppg.alamat || ''),
    latitude: props.sppg.latitude || '',
    longitude: props.sppg.longitude || '',
});

const updateProfile = () => {
    form.put(route('sppg.profile.update'), {
        preserveScroll: true,
    });
};

const onLocationSelected = (location) => {
    form.latitude = location.lat;
    form.longitude = location.lng;
};
</script>

<template>
    <Head title="Profil SPPG" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Profil SPPG</h2>
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
                            <h2 class="text-lg font-medium text-gray-900">Informasi SPPG</h2>
                            <p class="mt-1 text-sm text-gray-600">Perbarui nama, kontak, dan lokasi penempatan Anda.</p>
                        </header>

                        <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="nama_sppg" value="Nama SPPG (Satuan Pelayanan)" />
                                <TextInput
                                    id="nama_sppg"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nama_sppg"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.nama_sppg" />
                            </div>

                            <div>
                                <InputLabel for="penanggung_jawab" value="Nama Penanggung Jawab" />
                                <TextInput
                                    id="penanggung_jawab"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.penanggung_jawab"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.penanggung_jawab" />
                            </div>

                            <div>
                                <InputLabel for="nomor_telepon" value="Nomor Telepon / WhatsApp" />
                                <TextInput
                                    id="nomor_telepon"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nomor_telepon"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.nomor_telepon" />
                            </div>

                            <div>
                                <InputLabel for="alamat" value="Alamat Lengkap" />
                                <TextInput
                                    id="alamat"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.alamat"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.alamat" />
                            </div>

                            <!-- Map Component -->
                            <div>
                                <InputLabel value="Titik Lokasi (Peta)" />
                                <div class="mt-2">
                                    <LocationPicker 
                                        :modelValue="{ lat: form.latitude, lng: form.longitude }"
                                        @update:modelValue="onLocationSelected"
                                    />
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    Lat: {{ form.latitude || '-' }}, Lng: {{ form.longitude || '-' }}
                                </div>
                                <InputError class="mt-2" :message="form.errors.latitude" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Simpan Profil</PrimaryButton>
                                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Berhasil disimpan.</p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
