  
<script setup>
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    basicInfo: Object,
});


const form = useForm({
    address: props.basicInfo.address,
    phone: props.basicInfo.phone,
    email: props.basicInfo.email,
});

const updateContact = () => {
    form.put(route('admin.basic-info.update'), {
        errorBag: 'updateContact',
        preserveScroll: true,
    });
};
</script>

<template>
    <div id="contactForm">
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateContact">
            <template #title>
                Contacts
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="address" value="Address" />
                    <TextInput id="address" v-model="form.address" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.address }" type="text" />
                    <InputError :message="form.errors.address" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="phone" value="Phone" />
                    <TextInput id="phone" v-model="form.phone" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.phone }" type="text" />
                    <InputError :message="form.errors.phone" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.email }" type="text" />
                    <InputError :message="form.errors.email" class="text-red-500" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3" :class=" {'text-green-600' : form.recentlySuccessful, ' text-gray-600' : form.processing}">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>