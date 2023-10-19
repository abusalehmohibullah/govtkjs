
<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: Boolean,
        default: false,
    },
    id: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>
  
<template>
    <div class="form-check form-switch relative">
        <input 
            v-model="proxyChecked" 
            type="checkbox" 
            role="switch" 
            :value="value"   
            class="form-check-input checked:bg-auto checked:bg-right" 
            :id="id"
        />
        <div class="absolute top-[14px] left-0">
            <label :for="id" class="form-check-label text-[8px] select-none">
                <small :class="proxyChecked ? 'text-blue-700 font-bold' : ''">
                    {{ proxyChecked ? 'SHOWED' : 'HIDDEN' }}
                </small>
            </label>
        </div>
    </div>
</template>
  