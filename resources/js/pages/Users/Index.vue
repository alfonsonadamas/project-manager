<script setup lang="ts">
import Swal from 'sweetalert2'
import AppLayout from '@/Layouts/AppLayout.vue'
import { router, Link } from '@inertiajs/vue3'

defineProps({
    users: Array,
})

const deleteUser = (id: number) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción eliminará al usuario permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/users/${id}`, {
                onSuccess: () => {
                    Swal.fire('¡Eliminado!', 'El usuario ha sido eliminado.', 'success')
                }
            })
        }
    })
}
</script>

<template>
    <AppLayout title="Usuarios">
        <div class="max-w-6xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>

            <table class="min-w-full table-auto bg-white shadow rounded text-black">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Rol</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="border-t text-sm">
                        <td class="px-4 py-2">{{ user.name }}</td>
                        <td class="px-4 py-2">{{ user.email }}</td>
                        <td class="px-4 py-2">{{ user.role.name }}</td>
                        <td class="px-4 py-2">
                            <Link :href="`/users/${user.id}`" class="text-green-600 hover:underline mr-5">Ver</Link>
                            <Link :href="`/users/${user.id}/edit`" class="text-blue-600 hover:underline mr-5">Editar
                            </Link>
                            <button @click="deleteUser(user.id)" class="text-red-600 hover:underline">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
