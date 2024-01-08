<script setup>
import { ref, onMounted, defineProps, defineEmits, watch, watchEffect } from 'vue';

const props = defineProps(['data', 'selectedData']);
const emit = defineEmits(['selected-items-updated']);

const selectedItems = ref([]);
const allItemIds = ref([]);

const toggleSelection = (item) => {
    const isSelected = selectedItems.value.includes(item.id);

    if (isSelected) {
        selectedItems.value = selectedItems.value.filter((selectedItemId) => selectedItemId !== item.id);
    } else {
        selectedItems.value = [...selectedItems.value, item.id];
    }

    // emit('selected-items-updated', selectedItems.value);
};

const toggleSelectAll = () => {
    if (selectedItems.value.length === allItemIds.value.length) {
        // Deselect all if all are selected
        selectedItems.value = [];
    } else {
        // Select all
        selectedItems.value = [...allItemIds.value];
    }

    // emit('selected-items-updated', selectedItems.value);
};

// Watch for changes in selectedItems
watch(selectedItems, () => {
    // Update the parent component when selectedItems change
    emit('selected-items-updated', selectedItems.value);
});

// Watch for changes in data
watchEffect(() => {
    if (props.data) {
        allItemIds.value = props.data.map((item) => item.id);
    }
});

const getItemName = (itemId) => {
    const data = props.data.find(data => data.id === itemId);
    return data ? data.name : '';
};

const getItemCode = (itemId) => {
    const data = props.data.find(data => data.id === itemId);
    return data ? data.code : '';
};

onMounted(() => {
    if (props.selectedData) {
        props.selectedData.forEach((data) => {
            selectedItems.value.push(data.id);
        });
    }

    emit('selected-items-updated', selectedItems.value);
});
</script>

<template>
    <div class="border rounded-md p-2 my-2">
        <div class="text-base font-semibold mb-2">Assign Subjects</div>
        <div class="border rounded-md p-2">
            <!-- Selected Items: -->
            <div class="flex flex-wrap gap-2">
                <div v-if="selectedItems.length > 0" v-for="selectedItem in selectedItems" :key="selectedItem"
                    class="bg-indigo-700 text-white rounded-full px-2 py-1 capitalize flex gap-2">
                    {{ getItemCode(selectedItem) + '-' + getItemName(selectedItem) }}
                    <label :for="'item-' + selectedItem">
                        <i class="bi bi-x-lg hover:font-extrabold cursor-pointer text-gray-300 hover:text-white"></i>
                    </label>
                </div>
                <div v-else class="text-center w-full font-bold text-lg"> No subject selected</div>
            </div>
        </div>
        <div>
            <!-- <hr class="m-0 p-0"> -->
            <div class="flex gap-5 mt-2">
                <label class="capitalize flex items-center gap-1 cursor-pointer">
                    <input type="checkbox" :checked="selectedItems.length === allItemIds.length" @change="toggleSelectAll"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer">
                    Select All
                </label>
                <div v-for="item in data" :key="item.id" class="py-1">
                    <label class="flex items-center gap-1">
                        <input type="checkbox" :id="'item-' + item.id" :checked="selectedItems.includes(item.id)" @change="toggleSelection(item)"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        {{ item.code + '-' + item.name }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.permission-container:has(.permission-item) {
    display: none !important;
}
</style>
