<script setup>
import { onMounted, ref, watch } from 'vue';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

const props = defineProps({
    modelValue: {
        type: Object,
        default: () => ({ lat: -6.2088, lng: 106.8456 }) // Default Jakarta
    }
});

const emit = defineEmits(['update:modelValue']);

const mapContainer = ref(null);
let map = null;
let marker = null;

// Fix Leaflet's default icon path issues with Vite
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
});

onMounted(() => {
    const initialLat = props.modelValue.lat || -6.2088;
    const initialLng = props.modelValue.lng || 106.8456;

    map = L.map(mapContainer.value).setView([initialLat, initialLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (props.modelValue.lat && props.modelValue.lng) {
        marker = L.marker([initialLat, initialLng]).addTo(map);
    }

    map.on('click', (e) => {
        const { lat, lng } = e.latlng;
        
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        emit('update:modelValue', { lat, lng });
    });
});

watch(() => props.modelValue, (newVal) => {
    if (newVal.lat && newVal.lng && map) {
        if (marker) {
            marker.setLatLng([newVal.lat, newVal.lng]);
        } else {
            marker = L.marker([newVal.lat, newVal.lng]).addTo(map);
        }
        map.setView([newVal.lat, newVal.lng]);
    }
}, { deep: true });

</script>

<template>
    <div ref="mapContainer" style="height: 300px; width: 100%; border-radius: 0.375rem; z-index: 10;"></div>
</template>
