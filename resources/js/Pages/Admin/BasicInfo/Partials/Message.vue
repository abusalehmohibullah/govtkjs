  
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
    message_1_title: props.basicInfo.message_1_title,
    message_1_content: props.basicInfo.message_1_content,
    message_2_title: props.basicInfo.message_2_title,
    message_2_content: props.basicInfo.message_2_content,
});


const updateMessage = () => {
    form.put(route('admin.basic-info.update'), {
        errorBag: 'updateMessage',
        preserveScroll: true,
    });
};
</script>

<template>
    <div id="messageForm">
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateMessage">
            <template #title>
                Message Section
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="message_1_title" value="Message 1 Title" />
                    <TextInput id="message_1_title" v-model="form.message_1_title" @input="validateName"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.message_1_title }" type="text" />
                    <InputError :message="form.errors.message_1_title" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="message_1_content" value="Message 1 Content" />
                    <TextArea id="message_1_content" v-model="form.message_1_content" @input="validateName"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.message_1_content }" type="text" />
                    <InputError :message="form.errors.message_1_content" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="message_2_title" value="Message 2 Title" />
                    <TextInput id="message_2_title" v-model="form.message_2_title" @input="validateName"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.message_2_title }" type="text" />
                    <InputError :message="form.errors.message_2_title" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="message_2_content" value="Message 2 Content" />
                    <TextArea id="message_2_content" v-model="form.message_2_content" @input="validateName"
                        class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.message_2_content }" type="text" />
                    <InputError :message="form.errors.message_2_content" class="text-red-500" />
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
</div></template>