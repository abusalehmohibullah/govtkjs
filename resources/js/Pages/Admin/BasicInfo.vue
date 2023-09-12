  
<script setup>
import { ref, reactive } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import FormSection from '@/Components/FormSection.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
                <!-- Use the Form component to wrap your form -->
                <FormSection @submitted="submitForm">
                    <template #title>
                        Update Password
                    </template>

                    <template #description>
                        Ensure your account is using a long, random password to stay secure.
                    </template>

                    <template #form>
                        <!-- Use the Text Input component for each form field -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="formData.name" @input="validateName" class="mt-1 block w-full"
                                :class="{ 'border-red-500 focus:border-red-500': errors.name }" type="text" />
                            <InputError :message="errors.name" class="text-red-500" />
                        </div>

                    </template>

                    <template #actions>
                        <PrimaryButton type="submit">Submit</PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AdminLayout>
</template>

  