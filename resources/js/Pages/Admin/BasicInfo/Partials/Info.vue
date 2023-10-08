  
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
    name: props.basicInfo.name,
    established: props.basicInfo.established,
    permission: props.basicInfo.permission,
    recognition: props.basicInfo.recognition,
    mpo: props.basicInfo.mpo,
    nationalized: props.basicInfo.nationalized,
    eiin: props.basicInfo.eiin,
    school_code: props.basicInfo.school_code,
    college_code: props.basicInfo.college_code,
    vocational_code: props.basicInfo.vocational_code,
});


const updateInfo = () => {
    form.put(route('admin.basic-info.update'), {
        errorBag: 'updateInfo',
        preserveScroll: true,
    });
};
</script>

<template>
    <div id="infoForm">
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateInfo">
            <template #title>
                Update Basic Info
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->
                <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12">
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" v-model="form.name" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.name }" type="text" />
                    <InputError :message="form.errors.name" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="established" value="Established" />
                    <TextInput id="established" v-model="form.established" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.established }" type="text" />
                    <InputError :message="form.errors.established" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="permission" value="Permission" />
                    <TextInput id="permission" v-model="form.permission" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.permission }" type="text" />
                    <InputError :message="form.errors.permission" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="recognition" value="Recognition" />
                    <TextInput id="recognition" v-model="form.recognition" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.recognition }" type="text" />
                    <InputError :message="form.errors.recognition" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="mpo" value="MPO" />
                    <TextInput id="mpo" v-model="form.mpo" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.mpo }" type="text" />
                    <InputError :message="form.errors.mpo" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="nationalized" value="Nationalized" />
                    <TextInput id="nationalized" v-model="form.nationalized" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.nationalized }" type="text" />
                    <InputError :message="form.errors.nationalized" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="eiin" value="EIIN No" />
                    <TextInput id="eiin" v-model="form.eiin" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.eiin }" type="text" />
                    <InputError :message="form.errors.eiin" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="school_code" value="School Code" />
                    <TextInput id="school_code" v-model="form.school_code" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.school_code }" type="text" />
                    <InputError :message="form.errors.school_code" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="college_code" value="College Code" />
                    <TextInput id="college_code" v-model="form.college_code" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.college_code }" type="text" />
                    <InputError :message="form.errors.college_code" class="text-red-500" />
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                    <InputLabel for="vocational_code" value="Vocational Code" />
                    <TextInput id="vocational_code" v-model="form.vocational_code" @input="validateName" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.vocational_code }" type="text" />
                    <InputError :message="form.errors.vocational_code" class="text-red-500" />
                </div>
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