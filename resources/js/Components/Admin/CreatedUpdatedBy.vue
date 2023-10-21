<script setup>

const { createdUpdatedBy } = defineProps(['createdUpdatedBy']);

const formatName = (name) => {
    // Split the name into parts by spaces
    const nameParts = name.split(' ');

    // Capitalize the first letter of each part except the last one
    const formattedName = nameParts
        .map((part, index) => (index === nameParts.length - 1 ? part.charAt(0).toUpperCase() + part.slice(1).toLowerCase() : part.charAt(0).toUpperCase() + '.'))
        .join(' ');

    return formattedName;
};

const formatDateTime = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'short' });
    const year = date.getFullYear();

    const dateFormatted = `${day} ${month}, ${year}`;

    // Format the time
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12; // Convert to 12-hour format

    const timeFormatted = `${formattedHours}:${minutes < 10 ? '0' : ''}${minutes} ${ampm}`;

    return `${dateFormatted} at \n${timeFormatted}`;
};
</script>


<template>
    <div v-if="createdUpdatedBy.updated_by">
        <div class="text-xs">
            <div>Last updated by </div>
            <div class="text-blue-700">{{ formatName(createdUpdatedBy.updated_by.name) }}</div>
        </div>
        <div class="text-xs whitespace-nowrap">
            {{ formatDateTime(createdUpdatedBy.updated_at) }}
        </div>
    </div>
    <div v-else>
        <div class="text-xs">
            <div>Created by </div>
            <div class="text-blue-700">{{ formatName(createdUpdatedBy.created_by.name) }}</div>
        </div>
        <div class="text-xs whitespace-nowrap">
            {{ formatDateTime(createdUpdatedBy.created_at) }}
        </div>
    </div>
</template>