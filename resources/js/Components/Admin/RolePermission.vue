<script setup>
import { ref, onMounted, defineProps } from 'vue';

// Define props explicitly
const props = defineProps({
    user: Object,
    roles: Array,
    userPermissions: Array,
});

const selectedPermissions = ref([]);

// Example of handling form submission
const submitForm = () => {
    // Handle the selected permissions and submit the form
    console.log(selectedPermissions.value);
};

// const isRoleChecked = (roleId) => {
//     const rolePermissions = props.roles.find(role => role.id === roleId).permissions.map(permission => permission.id);
//     return rolePermissions.every(permissionId => selectedPermissions.value.includes(permissionId));
// };

// const markAllPermissions = (role) => {
//     const rolePermissions = role.permissions.map(permission => permission.id);
//         selectedPermissions.value = [...selectedPermissions.value, ...rolePermissions];
    
// };

const isSelectAllChecked = (roleId) => {
    const rolePermissions = props.roles.find(role => role.id === roleId).permissions.map(permission => permission.id);
    return rolePermissions.every(permissionId => selectedPermissions.value.includes(permissionId));
};

const toggleAllPermissions = (role) => {
    const rolePermissions = role.permissions.map(permission => permission.id);
    if (isSelectAllChecked(role.id)) {
        // Deselect all permissions in this group
        selectedPermissions.value = selectedPermissions.value.filter(permissionId => !rolePermissions.includes(permissionId));
    } else {
        // Select all permissions in this group
        selectedPermissions.value = [...selectedPermissions.value, ...rolePermissions];
    }
};

onMounted(() => {
    // Pre-select the checkboxes based on userPermissions
    props.userPermissions.forEach((permissionId) => {
        selectedPermissions.value.push(permissionId);
    });
});

</script>

<template>
    <div>Assign Roles</div>
    <div class="flex gap-5">
        <div v-for="role in roles" :key="role.id" class="py-1">
            <label class="text-lg capitalize flex items-center gap-1">
                <input type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                {{ role.name.replace(/_/g, ' ') }}
            </label>
        </div>
    </div>
    <div>Customize Permissions</div>
    <div class="flex justify-between">
        <div v-for="role in roles" :key="role.id" class="py-1">
            <div class="text-xl font-bold capitalize">{{ role.name.replace(/_/g, ' ') }}</div>
            <hr class="m-0 p-0">
            <label class="text-lg capitalize flex items-center gap-1">
                <input type="checkbox" :checked="isSelectAllChecked(role.id)" @change="toggleAllPermissions(role)"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    Give All Permissions
            </label>
            <div class="ml-5">
                <div v-for="permission in role.permissions" :key="permission.id" class="py-1">
                    <label class="text-lg capitalize flex items-center gap-1">
                        <!-- <dd>{{ selectedPermissions }}</dd> -->
                        <input type="checkbox" :checked="selectedPermissions.includes(permission.id)" :value="permission.id" v-model="selectedPermissions"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        {{ permission.name.replace(/_/g, ' ') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
