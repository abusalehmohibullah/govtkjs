  
<script setup>
import { ref, reactive } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const formData = reactive({
    name: '',
    // Add other form fields here
});

const errors = reactive({});

const typingTimeout = ref(null);

const validateName = () => {
    clearTimeout(typingTimeout.value);
    typingTimeout.value = setTimeout(() => {
        // Perform client-side validation here
        errors.name = formData.name.length < 3 ? 'Name must be at least 3 characters long' : null;
    }, 1000); // Adjust the debounce timeout as needed
};

const submitForm = () => {
    // Handle form submission logic
    if (Object.keys(errors).length === 0) {
        // Form is valid, submit it
        // You can optionally make a server request here if needed
        // post('/submit-form', formData);
    }
};
</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Basic Info
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <form @submit.prevent="submitForm">
                    <div>
                        <label for="name">Name</label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="formData.name" @input="validateName" :class="{ 'border-red-500 focus:border-red-500 ': errors.name }"
                            type="text" id="name" />
                        <span v-if="errors.name" class="text-red-500">{{ errors.name }}</span>
                    </div>

                    <!-- Other form fields here -->

                    <button type="submit">Submit</button>
                </form>

            </div>
        </div>
    </AdminLayout>
</template>

  