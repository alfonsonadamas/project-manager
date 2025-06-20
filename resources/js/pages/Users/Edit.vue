<script setup lang="ts">
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({
    user: Object,
    roles: Array,
})

const form = reactive({
    name: props.user.name,
    email: props.user.email,
    role_id: props.user.role_id,
    errors: {},
})

const submit = () => {
    router.put(`/users/${props.user.id}`, form, {
        onSuccess: () => {
            Swal.fire('¡Actualizado!', 'El usuario se actualizó correctamente.', 'success')
        },
        onError: (e) => {
            form.errors = e
        }
    })
}
</script>

<template>
    <AppLayout title="Editar Usuario">
        <div class="max-w-4xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

            <form @submit.prevent="submit" class="space-y-6 bg-white p-6 rounded shadow text-black">
                <div>
                    <label class="block mb-1">Nombre</label>
                    <input v-model="form.name" type="text" class="w-full border p-2 rounded" />
                    <span class="text-red-500 text-sm">{{ form.errors.name }}</span>
                </div>

                <div>
                    <label class="block mb-1">Email</label>
                    <input v-model="form.email" type="email" class="w-full border p-2 rounded" />
                    <span class="text-red-500 text-sm">{{ form.errors.email }}</span>
                </div>

                <div>
                    <label class="block mb-1">Rol</label>
                    <select v-model="form.role_id" class="w-full border p-2 rounded">
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                    <span class="text-red-500 text-sm">{{ form.errors.role_id }}</span>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar Cambios
                </button>
            </form>
        </div>
    </AppLayout>
</template>
