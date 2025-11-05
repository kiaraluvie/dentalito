<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import axios from 'axios';

// ------------------------------
// Props
// ------------------------------
const props = defineProps({
    patientId: {
        type: Number,
        required: true
    },
    initialOdontogramData: {
        type: Object,
        default: () => null
    }
});

// ------------------------------
// Estado Reactivo
// ------------------------------
const odontogramData = ref([]);
const selectedToothId = ref(null);
const isLoading = ref(false);
const errorMessage = ref('');
const successMessage = ref('');

// ------------------------------
// Estado Computado
// ------------------------------
const selectedTooth = computed(() => {
    return odontogramData.value.find(t => t.id === selectedToothId.value);
});

// ------------------------------
// Lógica de Inicialización
// ------------------------------
const initializeOdontogram = () => {
    if (props.initialOdontogramData && props.initialOdontogramData.data_json) {
        odontogramData.value = JSON.parse(props.initialOdontogramData.data_json);
    } else {
        odontogramData.value = Array.from({ length: 32 }, (_, i) => createDefaultTooth(i + 1));
    }
};

const createDefaultTooth = (toothId) => {
    return {
        id: toothId,
        estado_general: 'sano',
        superficies: {
            oclusal: { tratamientos: [] },
            mesial: { tratamientos: [] },
            distal: { tratamientos: [] },
            vestibular: { tratamientos: [] },
            lingual: { tratamientos: [] }
        }
    };
};

// ------------------------------
// Métodos de Interacción
// ------------------------------
const selectTooth = (toothId) => {
    selectedToothId.value = selectedToothId.value === toothId ? null : toothId;
};

/**
 * Aplica o remueve un tratamiento de una superficie dental.
 * @param {string} surface - La superficie del diente.
 * @param {string} treatment - El tratamiento a aplicar.
 */
const applyTreatment = (surface, treatment) => {
    if (!selectedTooth.value) return;

    const surfaceTreatments = selectedTooth.value.superficies[surface].tratamientos;
    const treatmentIndex = surfaceTreatments.indexOf(treatment);

    if (treatmentIndex > -1) {
        surfaceTreatments.splice(treatmentIndex, 1);
    } else {
        surfaceTreatments.push(treatment);
    }
};

// ------------------------------
// Interacción con Backend
// ------------------------------
const saveOdontogram = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';

    try {
        const payload = {
            odontogram_date: new Date().toISOString().slice(0, 10),
            data_json: JSON.stringify(odontogramData.value)
        };

        let response;
        if (props.initialOdontogramData) {
            // Actualizar odontograma existente
            const url = `/dental_management/patients/${props.patientId}/odontogram/${props.initialOdontogramData.id}`;
            response = await axios.patch(url, payload);
            successMessage.value = 'Odontograma actualizado con éxito.';
        } else {
            // Crear nuevo odontograma
            const url = `/dental_management/patients/${props.patientId}/odontogram`;
            response = await axios.post(url, payload);
            successMessage.value = 'Odontograma guardado con éxito.';
        }
    } catch (error) {
        errorMessage.value = 'Error al guardar el odontograma. Por favor, inténtalo de nuevo.';
        console.error(error);
    } finally {
        isLoading.value = false;
    }
};

// ------------------------------
// Ciclo de Vida y Observadores
// ------------------------------
onMounted(initializeOdontogram);
watch(() => props.initialOdontogramData, initializeOdontogram);
</script>

<template>
    <div class="odontogram-container">
        <!-- Panel de Control -->
        <div class="control-panel">
            <div v-if="selectedTooth">
                <h3>Diente {{ selectedTooth.id }}</h3>
                <!-- Controles de estado y tratamientos -->
                <div class="tooth-controls">
                    <!-- Ejemplo de tratamientos para una superficie -->
                    <div class="surface-controls">
                        <h4>Oclusal</h4>
                        <button @click="applyTreatment('oclusal', 'caries')">Caries</button>
                        <button @click="applyTreatment('oclusal', 'restauracion')">Restauración</button>
                    </div>
                </div>
            </div>
            <p v-else>Selecciona un diente para ver sus detalles.</p>
        </div>

        <!-- Visualización del Odontograma -->
        <div class="odontogram-grid">
            <div class="arcada">
                <div v-for="tooth in odontogramData.slice(0, 16)" :key="tooth.id" class="tooth"
                    :class="{ 'selected': selectedToothId === tooth.id }" @click="selectTooth(tooth.id)">
                    {{ tooth.id }}
                </div>
            </div>
            <div class="arcada">
                <div v-for="tooth in odontogramData.slice(16, 32)" :key="tooth.id" class="tooth"
                    :class="{ 'selected': selectedToothId === tooth.id }" @click="selectTooth(tooth.id)">
                    {{ tooth.id }}
                </div>
            </div>
        </div>

        <!-- Botón de Guardar y Mensajes -->
        <div class="actions">
            <button @click="saveOdontogram" :disabled="isLoading">
                {{ isLoading ? 'Guardando...' : 'Guardar Odontograma' }}
            </button>
            <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
            <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
        </div>
    </div>
</template>

<style scoped>
.odontogram-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
}
.control-panel {
    border: 1px solid #ccc;
    padding: 1rem;
    border-radius: 8px;
    width: 80%;
}
.odontogram-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.arcada {
    display: flex;
    gap: 0.5rem;
}
.tooth {
    width: 40px;
    height: 40px;
    border: 1px solid #aaa;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
.tooth.selected {
    background-color: #007bff;
    color: white;
}
.actions {
    text-align: center;
}
.success-message {
    color: green;
}
.error-message {
    color: red;
}
</style>
