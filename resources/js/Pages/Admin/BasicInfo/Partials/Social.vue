  
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
    facebook: props.basicInfo.facebook,
    x: props.basicInfo.x,
    instagram: props.basicInfo.instagram,
    linkedin: props.basicInfo.linkedin,
    youtube: props.basicInfo.youtube,
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
                Social Media
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="facebook" value="Facebook" />
                    <TextInput id="facebook" v-model="form.facebook" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.facebook }" type="text" />
                    <InputError :message="form.errors.facebook" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="x" value="Tweeter/X" />
                    <TextInput id="x" v-model="form.x" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.x }" type="text" />
                    <InputError :message="form.errors.x" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="instagram" value="Instagram" />
                    <TextInput id="instagram" v-model="form.instagram" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.instagram }" type="text" />
                    <InputError :message="form.errors.instagram" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="linkedin" value="LinkedIn" />
                    <TextInput id="linkedin" v-model="form.linkedin" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.linkedin }" type="text" />
                    <InputError :message="form.errors.linkedin" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="youtube" value="YouTube" />
                    <TextInput id="youtube" v-model="form.youtube" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.youtube }" type="text" />
                    <InputError :message="form.errors.youtube" class="text-red-500" />
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